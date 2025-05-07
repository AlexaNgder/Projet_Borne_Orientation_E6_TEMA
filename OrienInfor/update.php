<?php
session_start();
if(!isset($_SESSION['login']) && empty($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['ID'])) {
    if (!empty($_POST)) {
        $ID = isset($_GET['ID']) ? $_GET['ID'] : NULL;
        $nom = isset($_POST['Nom']) ? htmlspecialchars($_POST['Nom']) : '';
        $prenom = isset($_POST['Prenom']) ? htmlspecialchars($_POST['Prenom']) : '';
        $filiere = isset($_POST['BTS']) ? htmlspecialchars($_POST['BTS']) : '';
        $email = isset($_POST['Email']) ? htmlspecialchars($_POST['Email']) : '';
        $telephone = isset($_POST['Telephone']) ? htmlspecialchars($_POST['Telephone']) : '';
        $adresse = isset($_POST['Adresse']) ? htmlspecialchars($_POST['Adresse']) : '';
        $departement = isset($_POST['Departement']) ? htmlspecialchars($_POST['Departement']) : '';
        $codePostal = isset($_POST['CodePostal']) ? htmlspecialchars($_POST['CodePostal']) : '';
        $stmt = $pdo->prepare('UPDATE Clients SET ID = ?, Nom = ?, Prenom = ?, Filiere = ?, Email = ?, Telephone = ?, Adresse = ?, Departement = ?, Code_Postal = ? WHERE ID = ?');
        $stmt->execute([$ID, $nom, $prenom, $filiere, $email, $telephone, $adresse, $departement, $codePostal, $_GET['ID']]);
        $msg = 'Mise à jour avec succès!';
    }
    $stmt = $pdo->prepare('SELECT * FROM Clients WHERE ID = ?');
    $stmt->execute([$_GET['ID']]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$client) {
        exit('Le client n existe pas avec cette ID !');
    }
} else {
    exit('Pas d ID specifié !');
}
?>

<?=template_header('Read')?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-4 text-center">Modifier un Client</h2>
        <form action="update.php?ID=<?=$client['ID']?>" method="post">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="ID" class="form-label">ID</label>
                    <input type="text" class="form-control" name="ID" value="<?=$client['ID']?>" id="ID" readonly>
                </div>
                <div class="col-md-6">
                    <label for="Nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="Nom" id="Nom" value="<?=$client['Nom']?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="Prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="Prenom" id="Prenom" value="<?=$client['Prenom']?>" required>
                </div>
                <div class="col-md-6">
                    <label for="BTS" class="form-label">Filière</label>
                    <select name="BTS" id="BTS" class="form-select" required>
                        <option value="CIEL">BTS CIEL</option>
                        <option value="CRSA">BTS CRSA</option>
                        <option value="ATI">BTS ATI</option>
                        <option value="CCST">BTS CCST</option>
                        <option value="ET">BTS ET</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="Email" id="Email" value="<?=$client['Email']?>" required>
                </div>
                <div class="col-md-6">
                    <label for="Telephone" class="form-label">Téléphone</label>
                    <input type="number" class="form-control" name="Telephone" id="Telephone" value="<?=$client['Telephone']?>" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="Adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" name="Adresse" id="Adresse" value="<?=$client['Adresse']?>" required>
                </div>
                <div class="col-md-6">
                    <label for="Departement" class="form-label">Département</label>
                    <input type="text" class="form-control" name="Departement" id="Departement" value="<?=$client['Departement']?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="CodePostal" class="form-label">Code Postal</label>
                <input type="number" class="form-control" name="CodePostal" id="CodePostal" value="<?=$client['Code_Postal']?>"  required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?=template_footer()?>
