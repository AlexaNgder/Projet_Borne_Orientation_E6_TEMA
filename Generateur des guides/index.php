<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Télécharger une image</title>
    <style>
        body {
            text-align: center;
            margin-top: 80px;
        }
        img {
            margin-top: 50px;
            width: 448px;
            height: 248px;
        }
        .image-front {
            position: relative; 
            z-index: 1; 
        }
        .image-absolute {
            position: absolute;
            z-index: 2; 
            top: 280px; 
            left: 550px; 
            width: 180px;
            height: auto; 
        }
    </style>
</head>
<body>

<h1>Téléchargez une image</h1>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*" required>
    <input type="submit" value="Télécharger l'image de fond">
</form>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="image2" accept="image/*" required>
    <input type="submit" value="Télécharger l'image à superposer">
</form>
</body>
</html>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image'])&& isset($_FILES['image2'])) {
        $Image_Fichier = "Images/" . basename($_FILES["image"]["name"]);
        $Image_Fichier2 = "Images/" . basename($_FILES["image2"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $Image_Fichier)&& move_uploaded_file($_FILES["image2"]["tmp_name"], $Image_Fichier2)) {
            $_SESSION['image1'] = $Image_Fichier;
            $_SESSION['image2'] = $Image_Fichier2; 
        }
    }
}
if (isset($_SESSION['image1'])&&isset($_SESSION['image2'])) {
    echo "<img class='image-front' src='{$_SESSION['image1']}' alt='Image de fond'>";
    echo "<img class='image-absolute' src='{$_SESSION['image2']}' alt='Image superposée'>";
}
?>