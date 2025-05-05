<?php
    function pdo_connect_mysql() {
        $DATABASE_HOST = 'sql10.freesqldatabase.com';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = 'root';
        $DATABASE_NAME = 'sql10212300';
        try {
            return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8mb4', $DATABASE_USER, $DATABASE_PASS);
        } catch (PDOException $exception) {
            exit('Erreur de connexion : ' . $exception->getMessage());
        }
    }
	function template_header($title) {
		echo <<<EOT
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="utf-8">
				<title>$title</title>
				<link href="style.css" rel="stylesheet" type="text/css">
				<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
			</head>
			<body>
			<nav class="navtop">
				<div>
					<h1>GESTION ETUDIANTS</h1>
					<a href="index.php">
						<i class="fas fa-chart-bar"></i> Statistiques
					</a>
					<a href="read.php">
						<i class="fas fa-address-book"></i> Clients
					</a>
					<a href="deconnexion.php" >  
						<i class="fas fa-sign-out-alt"></i> Déconnexion
					</a>
				</div>
			</nav>
		EOT;
	}
	function template_footer() {
		echo <<<EOT
			</body>
		</html>
		EOT;
	}
?>
