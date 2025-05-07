<?php
session_start();
   if(!isset($_SESSION['login']) && empty($_SESSION['login'])) {
        header("Location: index.php");
        exit;
    }
include 'functions.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Connexion à la base de données
$pdo = pdo_connect_mysql();

// Vérifier si une demande d'exportation a été faite
if (isset($_GET['export']) && $_GET['export'] == 'excel') {
    // Code pour l'exportation Excel
    export_to_excel($pdo, isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'));
    exit;
}

// Par défaut, utilisez la date du jour
$selectedDate = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d");

// Récupérer les données pour le graphique pour la date sélectionnée
$stmt = $pdo->prepare("SELECT DATE_FORMAT(heure_visite, '%H') as heure, nombre_visites 
                     FROM visites 
                     WHERE date_visite = ?
                     ORDER BY heure_visite ASC");
$stmt->execute([$selectedDate]);
$visitData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculer les statistiques
$totalVisits = 0;
$minVisits = !empty($visitData) ? PHP_INT_MAX : 0;
$maxVisits = 0;
$avgVisits = 0;

if (!empty($visitData)) {
    foreach ($visitData as $visit) {
        $totalVisits += $visit['nombre_visites'];
        $minVisits = min($minVisits, $visit['nombre_visites']);
        $maxVisits = max($maxVisits, $visit['nombre_visites']);
    }
    $avgVisits = round($totalVisits / count($visitData), 1);
}

// Préparer les données pour le graphique
$labels = [];
$data = [];
foreach ($visitData as $visit) {
    $labels[] = $visit['heure'] . 'h';
    $data[] = $visit['nombre_visites'];
}

// Convertir en JSON pour JavaScript
$labelsJSON = json_encode($labels);
$dataJSON = json_encode($data);

// Récupérer les dates disponibles dans la base de données
$stmt = $pdo->prepare("SELECT DISTINCT date_visite FROM visites ORDER BY date_visite DESC");
$stmt->execute();
$availableDates = $stmt->fetchAll(PDO::FETCH_COLUMN);

function export_to_excel($pdo, $date) {
    // Vérifier si Composer est utilisé
    if (file_exists('vendor/autoload.php')) {
        require 'vendor/autoload.php';
    }    
    // Créer un nouveau document
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    // Titre de la feuille
    $sheet->setTitle('Statistiques de visites');
    
    // En-têtes
    $sheet->setCellValue('A1', 'Date');
    $sheet->setCellValue('B1', 'Heure');
    $sheet->setCellValue('C1', 'Nombre de visites');
    $sheet->setCellValue('F1', 'Statistiques');
    $sheet->setCellValue('G1', 'Visites');
    // Style pour l'en-tête
    $styleArray = [
        'font' => [
            'bold' => true,
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => '4F81BD',
            ],
        ],
    ];
    $sheet->getStyle('A1:G1')->applyFromArray($styleArray);
    
    // Récupérer les données
    $stmt = $pdo->prepare("SELECT date_visite, DATE_FORMAT(heure_visite, '%H:00') as heure, nombre_visites 
                          FROM visites 
                          WHERE date_visite = ?
                          ORDER BY heure_visite ASC");
    $stmt->execute([$date]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Remplir les données
    $row = 2;
    foreach ($data as $item) {
        $sheet->setCellValue('A' . $row, date('d/m/Y', strtotime($item['date_visite'])));
        $sheet->setCellValue('B' . $row, $item['heure']);
        $sheet->setCellValue('C' . $row, $item['nombre_visites']);
        $row++;
    }
    $lastDataRow = $row - 1;
    // Calcul des statistiques
    $sheet->setCellValue('F1', 'Statistiques');
    $sheet->getStyle('F1')->getFont()->setBold(true);
    
    $sheet->setCellValue('F2', 'Total:');
    $sheet->setCellValue('G2', '=SUM(C2:C' . $lastDataRow . ')');
    
    $sheet->setCellValue('F3', 'Minimum:');
    $sheet->setCellValue('G3', '=MIN(C2:C' . $lastDataRow . ')');
    
    $sheet->setCellValue('F4', 'Maximum:');
    $sheet->setCellValue('G4', '=MAX(C2:C' . $lastDataRow . ')');
    
    $sheet->setCellValue('F5', 'Moyenne:');
    $sheet->setCellValue('G5', '=AVERAGE(C2:C' . $lastDataRow . ')');
    
    // Ajuster la largeur des colonnes
    foreach(range('A', 'G') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Centrer toutes les cellules et ajouter des bordures
    $lastColumn = 'G';
    $styleArray = [
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];
    $sheet->getStyle('A1:' . $lastColumn . $row)->applyFromArray($styleArray);
    
    // Créer le fichier Excel
    $writer = new Xlsx($spreadsheet);
    
    // Définir les headers pour le téléchargement
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="statistiques_' . $date . '.xlsx"');
    header('Cache-Control: max-age=0');
    
    // Envoyer le fichier au navigateur
    $writer->save('php://output');
    exit;
}
?>
<?=template_header('Statistiques')?>
<div class="content">
    <h2>Statistiques de visites</h2>
    
    <div class="controls">
        <div class="date-selector">
            <form method="get" action="" id="dateForm">
                <label for="date">Sélectionner une date :</label>
                <select name="date" id="date" onchange="this.form.submit()">
                    <?php foreach ($availableDates as $date): ?>
                        <option value="<?= $date ?>" <?= $selectedDate == $date ? 'selected' : '' ?>>
                            <?= date("d/m/Y", strtotime($date)) ?>
                        </option>
                    <?php endforeach; ?>
                    <?php if (empty($availableDates) || !in_array(date("Y-m-d"), $availableDates)): ?>
                        <option value="<?= date("Y-m-d") ?>" <?= $selectedDate == date("Y-m-d") ? 'selected' : '' ?>>
                            <?= date("d/m/Y") ?> (Aujourd'hui)
                        </option>
                    <?php endif; ?>
                </select>
            </form>
        </div>
        
        <div class="export-button">
            <a href="?date=<?= $selectedDate ?>&export=excel" class="btn">Exporter en Excel</a>
        </div>
    </div>
    
    <div class="stats-summary">
        <div class="stat-box">
            <h3>Visites totales</h3>
            <p><?= $totalVisits ?></p>
        </div>
        <div class="stat-box">
            <h3>Minimum</h3>
            <p><?= $minVisits ?></p>
        </div>
        <div class="stat-box">
            <h3>Maximum</h3>
            <p><?= $maxVisits ?></p>
        </div>
        <div class="stat-box">
            <h3>Moyenne</h3>
            <p><?= $avgVisits ?></p>
        </div>
    </div>
    
    <div class="container">
        <canvas id="myChart"></canvas>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?=$labelsJSON?>,
                datasets: [{
                    label: 'Nombre de visites',
                    data: <?=$dataJSON?>,
                    borderWidth: 1,
                    tension: 0.1,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(75, 192, 192, 1)'
                }]
            },
            options: { 
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toString();
                            }
                        }
                    }
                }
            }
        });
    });
    </script>
</div>

<style>
.controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.date-selector {
    margin-bottom: 10px;
}

.date-selector select {
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ddd;
}

.export-button .btn {
    display: inline-block;
    padding: 8px 15px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    font-weight: bold;
}

.export-button .btn:hover {
    background-color: #45a049;
}

.stats-summary {
    display: flex;
    justify-content: space-between;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.stat-box {
    flex: 1;
    min-width: 150px;
    background-color: #f5f5f5;
    border-radius: 8px;
    padding: 15px;
    margin: 0 10px 10px 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.stat-box h3 {
    margin-top: 0;
    color: #555;
    font-size: 16px;
}

.stat-box p {
    margin-bottom: 0;
    font-size: 24px;
    font-weight: bold;
    color: #2a7d8c;
}

.container {
    height: 400px;
}
</style>
<?template_footer(); ?>