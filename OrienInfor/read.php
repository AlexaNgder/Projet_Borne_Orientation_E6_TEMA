<?php
	session_start();
   if(!isset($_SESSION['login']) || empty($_SESSION['login'])) {
        header("Location: index.php");
        exit;
    }
    include 'functions.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    $pdo = pdo_connect_mysql();
    
    // Vérifier si une demande d'exportation a été faite
    if (isset($_GET['export']) && $_GET['export'] == 'excel') {
        // Code pour l'exportation Excel
        export_to_excel($pdo);
        exit;
    }

    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $records_per_page = 5;
    $stmt = $pdo->prepare('SELECT * FROM Clients ORDER BY ID LIMIT :current_page, :record_per_page');
    $stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
    $stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
    $stmt->execute();
    $Clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $num_client = $pdo->query('SELECT COUNT(*) FROM Clients')->fetchColumn();

    // Fonction pour exporter vers Excel
    function export_to_excel($pdo) {
        if (file_exists('vendor/autoload.php')) {
            require 'vendor/autoload.php';
        }
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Titre de la feuille
        $sheet->setTitle('Liste des Clients');
        
        // En-têtes
        $headers = ['ID', 'Nom', 'Prenom', 'Filiere', 'Email', 'Telephone', 'Adresse', 'Departement', 'Code Postal'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '1', $header);
            // Activer les filtres pour chaque colonne
            $sheet->setAutoFilter($col . '1:' . $col . '1');
            $col++;
        }
        // Activer le filtre sur toute la plage de données
        $sheet->setAutoFilter('A1:I1'); 
        // Style pour l'en-tête
        $styleArray = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F81BD'],
            ],
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
        $sheet->getStyle('A1:I1')->applyFromArray($styleArray);
        
        // Récupérer toutes les données
        $stmt = $pdo->query("SELECT * FROM Clients ORDER BY ID");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Remplir les données
        $row = 2;
        foreach ($data as $item) {
            $col = 'A';
            foreach ($item as $value) {
                $sheet->setCellValue($col . $row, $value);
                $col++;
            }
            $row++;
        }
        
        // Ajuster la largeur des colonnes
        foreach(range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        // Créer le fichier Excel
        $writer = new Xlsx($spreadsheet);
        
        // Headers pour le téléchargement
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="liste_clients.xlsx"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Lire Clients</h2>
    <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
        <a href="create.php" class="create-contact">Créer Client</a>
        
    <div style="display: flex; justify-content: space-between; margin-bottom: 25px; ">
        <a href="?export=excel" class="btn" style = "display: inline-block;padding: 8px ;background-color: #4CAF50;color: white;text-decoration: none;border-radius: 4px;border: none; cursor: pointer;font-weight: bold;">Exporter en Excel</a>
    </div>
    </div>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nom</td>
                <td>Prenom</td>
                <td>Filiere</td>
                <td>Email</td>
                <td>Telephone</td>
                <td>Adresse</td>
                <td>Departement</td>
                <td>Code Postal</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Clients as $Client): ?>
            <tr>
                <td><?=$Client['ID']?></td>
                <td><?=$Client['Nom']?></td>
                <td><?=$Client['Prenom']?></td>
                <td><?=$Client['Filiere']?></td>
                <td><?=$Client['Email']?></td>
                <td><?=$Client['Telephone']?></td>
                <td><?=$Client['Adresse']?></td>
                <td><?=$Client['Departement']?></td>
                <td><?=$Client['Code_Postal']?></td>
                <td class="actions">
                    <a href="update.php?ID=<?=$Client['ID']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?ID=<?=$Client['ID']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1): ?>
        <a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page*$records_per_page < $num_client): ?>
        <a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>
<style>
    .btn:hover {
    background-color: #45a049;
}
</style>
<?=template_footer()?>
