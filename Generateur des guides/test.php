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
        .image-container {
            position: relative; /* Conteneur parent pour l'image absolue */
            display: inlne; /* Pour que le conteneur s'adapte à la taille de l'image */
        }
        .image-front {
            width: 448px;
            height: 248px;
            object-fit: cover; /* Pour garder le ratio de l'image */
            position: relative; /* L'image principale reste en position normale */
            z-index: 1; /* z-index inférieur à l'image absolue */
        }
        .image-absolute {
            position: absolute; /* La deuxième image est en position absolue */
            z-index: 2; /* Elle sera au-dessus de l'image principale */
            top: 0; /* Position de départ */
            left: 0; /* Position de départ */
            width: 180px; /* Taille réduite pour la superposition */
            height: auto; /* Garder le ratio */
        }
        .controls {
            position: fixed; /* Les boutons sont fixes à droite */
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .controls button {
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h1>Téléchargez une image</h1>

<!-- Formulaire pour la première image -->
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*" required>
    <input type="submit" value="Télécharger l'image de fond">
</form>

<!-- Formulaire pour la deuxième image -->
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="image2" accept="image/*" required>
    <input type="submit" value="Télécharger l'image à superposer">
</form>

<!-- Bouton pour télécharger l'image fusionnée -->
<div class="controls">
    <button onclick="downloadMergedImage()">Télécharger tout</button>
</div>

<?php
session_start(); // Démarrer la session pour conserver les images

// Dossier où les images seront stockées
$Image = "Images/";

// Vérifier si le dossier existe, sinon le créer
if (!is_dir($Image)) {
    mkdir($Image, 0755, true);
}

// Traitement des fichiers téléchargés
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Traitement de la première image
    if (isset($_FILES['image'])) {
        $Image_Fichier = $Image . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $Image_Fichier)) {
            echo "<h2>Image de fond téléchargée avec succès !</h2>";
            $_SESSION['image1'] = $Image_Fichier; // Stocker le chemin dans la session
        } else {
            echo "<h2>Erreur lors du téléchargement de l'image de fond.</h2>";
        }
    }

    // Traitement de la deuxième image
    if (isset($_FILES['image2'])) {
        $Image_Fichier2 = $Image . basename($_FILES["image2"]["name"]);
        if (move_uploaded_file($_FILES["image2"]["tmp_name"], $Image_Fichier2)) {
            echo "<h2>Image à superposer téléchargée avec succès !</h2>";
            $_SESSION['image2'] = $Image_Fichier2; // Stocker le chemin dans la session
        } else {
            echo "<h2>Erreur lors du téléchargement de l'image à superposer.</h2>";
        }
    }
}

// Afficher les images si elles existent
if (isset($_SESSION['image1']) || isset($_SESSION['image2'])) {
    echo "<div class='image-container'>";
    if (isset($_SESSION['image1'])) {
        echo "<img id='main-image' class='image-front' src='{$_SESSION['image1']}' alt='Image de fond'>";
    }
    if (isset($_SESSION['image2'])) {
        echo "<img id='movable-image' class='image-absolute' src='{$_SESSION['image2']}' alt='Image superposée'>";
    }
    echo "</div>";
}
?>

<script>
    // Fonction pour déplacer l'image avec les touches du clavier
    function deplacement() {
        document.addEventListener('keydown', function(event) {
            const box = document.getElementById('movable-image');
            const step = 10;
            const playground = box.parentNode;

            const currentTop = parseInt(box.style.top, 10) || 0;
            const currentLeft = parseInt(box.style.left, 10) || 0;

            const maxTop = playground.clientHeight - box.offsetHeight;
            const maxLeft = playground.clientWidth - box.offsetWidth;

            if (['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'].includes(event.key)) {
                event.preventDefault();
            }

            switch (event.key) {
                case 'ArrowUp':
                    if (currentTop - step >= 0) {
                        box.style.top = `${currentTop - step}px`;
                    }
                    break;
                case 'ArrowDown':
                    if (currentTop + step <= maxTop) {
                        box.style.top = `${currentTop + step}px`;
                    }
                    break;
                case 'ArrowLeft':
                    if (currentLeft - step >= 0) {
                        box.style.left = `${currentLeft - step}px`;
                    }
                    break;
                case 'ArrowRight':
                    if (currentLeft + step <= maxLeft) {
                        box.style.left = `${currentLeft + step}px`;
                    }
                    break;
            }
        });
    }

    // Appeler la fonction de déplacement au chargement de la page
    deplacement();

    // Fonction pour télécharger l'image fusionnée
    function downloadMergedImage() {
        const mainImage = document.getElementById('main-image');
        const movableImage = document.getElementById('movable-image');

        // Créer un canvas pour fusionner les images
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        // Définir la taille du canvas comme celle de l'image principale
        canvas.width = mainImage.width;
        canvas.height = mainImage.height;

        // Dessiner l'image principale sur le canvas
        ctx.drawImage(mainImage, 0, 0, canvas.width, canvas.height);

        // Dessiner l'image superposée sur le canvas
        const movableImageTop = parseInt(movableImage.style.top) || 0;
        const movableImageLeft = parseInt(movableImage.style.left) || 0;
        ctx.drawImage(movableImage, movableImageLeft, movableImageTop, movableImage.width, movableImage.height);

        // Convertir le canvas en image téléchargeable
        const link = document.createElement('a');
        link.download = 'image-fusionnee.png'; // Nom du fichier téléchargé
        link.href = canvas.toDataURL('image/png'); // Convertir le canvas en URL
        link.click(); // Déclencher le téléchargement
    }
</script>

</body>
</html>