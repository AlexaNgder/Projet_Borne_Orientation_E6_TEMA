<html>
   <head>
        <meta charset="UTF-8" />
        <title>Chemins ATI</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
   </head>
   <style>
        @import url('https://fonts.googleapis.com/css2?family=Unbounded:wght@300;500;700&display=swap');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Unbounded', cursive;
        }
        body{
            background-color:white;
            color: black;
        }
        .d-block.w-100 {
            height: 1500px;
            width: 1500px;
        }
        .Infos{
            padding: 10px 25px;
            border-radius: 60px;
        }
        /* Placer les boutons vers le bas */
        .carousel-control-prev, .carousel-control-next {
            position: absolute;
            bottom: 10px; /* Ajustez cette valeur pour déplacer les boutons plus ou moins bas */
            top: 100px; /* Supprimez le positionnement par défaut en haut */
        }
        /* Optionnel : Ajuster la taille des boutons pour correspondre au design */
        .carousel-control-prev-icon, .carousel-control-next-icon {
            width: 100px;
            height: 100px;
            background-size: 100%, 100%; /* Ajuste la taille des icônes */
        }
        #scrollUp {
            position: fixed;
            bottom: 10px;
            right: 10px; /* Position de départ visible */
            opacity: 0.5;
            transition: right 0.5s ease, opacity 0.5s ease; /* Transition pour lisser les mouvements */
        }
    </style>
   <body>
        <BR><center><h1>Chemin à suivre pour BTS ATI</h1><BR></center>
        <?php
            include("connexion.php");
            try
            {
                $bdd = new PDO('mysql:host=host;dbname=dbname;charset=utf8', 'root', 'root');
            }
            catch (Exception $e)
            {
                die('Erreur : ' . $e->getMessage());
            }
     		$currentDate = date("Y-m-d");
            $currentHour = date("H:00:00"); // Fixe les minutes et secondes à 00:00

            $stmt = $bdd->prepare("SELECT nombre_visites FROM visites WHERE heure_visite = ? AND date_visite = ?");
            $stmt->execute([$currentHour, $currentDate]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $stmt = $bdd->prepare("UPDATE visites SET nombre_visites = nombre_visites + 1 WHERE heure_visite = ? AND date_visite = ?");
                $stmt->execute([$currentHour, $currentDate]);
            } else {
                $stmt = $bdd->prepare("INSERT INTO visites (heure_visite, nombre_visites, date_visite) VALUES (?, 1, ?)");
                $stmt->execute([$currentHour, $currentDate]);
            }
            $reponse = $bdd->query('SELECT * FROM ATI');
            $activeClass = 'active';

            echo '<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">';

            while ($donnees = $reponse->fetch())
            {
                echo '<div class="carousel-item ' . $activeClass . '">
                        <img class="d-block w-100" src="Images/ATI/'.$donnees['Img'].'" alt="Image slide">
                    </div>';
                $activeClass = '';
            }

            echo '</div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>';

            $reponse->closeCursor();
        ?>
        <br><br>
        <center><button class="Infos"><a href="contact.html"><h1>Recevoir des informations</h1></a></button><center>
        <br><br>
        <div id="scrollUp" class="hidden">
            <a href="#top"><img src="to_top.png" alt="Scroll to top"/></a>
        </div>
        <script src="js/jquery-3.3.1.slim.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script>
            $('.carousel').carousel({
                interval: 0
            })
        </script>
   </body>
</html>
