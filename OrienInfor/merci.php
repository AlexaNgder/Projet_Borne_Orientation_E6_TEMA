<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Remerciement</title>
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<div id="wrapper" class="container mt-5" style="background-color: #ffffffcc; padding: 20px; border-radius: 8px;">
			<div id="mainContent" class="py-5">
				<?php
					if ($_SERVER['REQUEST_METHOD'] === 'POST') {
						$nom = isset($_POST['Nom']) ? htmlspecialchars($_POST['Nom']) : '';
						$prenom = isset($_POST['Prenom']) ? htmlspecialchars($_POST['Prenom']) : '';
						$email = isset($_POST['Email']) ? htmlspecialchars($_POST['Email']) : '';
						$telephone = isset($_POST['Telephone']) ? htmlspecialchars($_POST['Telephone']) : '';
						$adresse = isset($_POST['Adresse']) ? htmlspecialchars($_POST['Adresse']) : '';
						$departement = isset($_POST['Department']) ? htmlspecialchars($_POST['Department']) : '';
						$codePostal = isset($_POST['Code']) ? htmlspecialchars($_POST['Code']) : '';

						echo "<h1 id='pageID' class='text-center'>Merci, $prenom $nom, pour votre inscription !</h1>";
						echo "<p class='text-center'>Nous avons bien reçu vos informations.</p>";
					} else {
						header('Location: contact.html');
						exit();
					}
				?>
				<?php
			include 'functions.php';

			$pdo = pdo_connect_mysql();
			$msg = '';

			if (!empty($_POST)) {
				$Nom = isset($_POST['Nom']) ? $_POST['Nom'] : '';
				$Prenom = isset($_POST['Prenom']) ? $_POST['Prenom'] : '';

				$filiere_array = [];
				if (isset($_POST['CIEL'])) $filiere_array[] = 'CIEL';
				if (isset($_POST['ATI'])) $filiere_array[] = 'ATI';
				if (isset($_POST['CCST'])) $filiere_array[] = 'CCST';
				if (isset($_POST['CRSA'])) $filiere_array[] = 'CRSA';
				if (isset($_POST['ET'])) $filiere_array[] = 'ET';
				if (isset($_POST['Pour_tous'])) $filiere_array[] = 'Pour tous';

				$Filiere = implode(', ', $filiere_array);

				$Email = isset($_POST['Email']) ? $_POST['Email'] : '';
				$Telephone = isset($_POST['Telephone']) ? $_POST['Telephone'] : '';
				$Adresse = isset($_POST['Adresse']) ? $_POST['Adresse'] : '';
				$Departement = isset($_POST['Department']) ? $_POST['Department'] : '';
				$Code = isset($_POST['Code']) ? $_POST['Code'] : '';

				try {
					$stmt = $pdo->prepare('INSERT INTO Clients (Nom, Prenom, Filiere, Email, Telephone, Adresse, Departement, Code_Postal) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
					$stmt->execute([$Nom, $Prenom, $Filiere, $Email, $Telephone, $Adresse, $Departement, $Code]);
				} catch (PDOException $e) {
					$msg = 'Erreur lors de la création : ' . $e->getMessage();
				}
			}
		?>
			<?php
			use PHPMailer\PHPMailer\PHPMailer;
			use PHPMailer\PHPMailer\SMTP;
			use PHPMailer\PHPMailer\Exception;
			require './PHPMailer/src/Exception.php';
			require './PHPMailer/src/PHPMailer.php';
			require './PHPMailer/src/SMTP.php';

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$nom = isset($_POST['Nom']) ? htmlspecialchars($_POST['Nom']) : '';
				$prenom = isset($_POST['Prenom']) ? htmlspecialchars($_POST['Prenom']) : '';
				$email = isset($_POST['Email']) ? htmlspecialchars($_POST['Email']) : '';
				
				$filiere_array = [];
				if (isset($_POST['CIEL'])) $filiere_array[] = 'CIEL';
				if (isset($_POST['ATI'])) $filiere_array[] = 'ATI';
				if (isset($_POST['CCST'])) $filiere_array[] = 'CCST';
				if (isset($_POST['CRSA'])) $filiere_array[] = 'CRSA';
				if (isset($_POST['ET'])) $filiere_array[] = 'ET';
				if (isset($_POST['Pour_tous'])) $filiere_array[] = 'Pour tous';
				$filiere = implode(', ', $filiere_array);
			}
			function envoie_mail($from_name, $from_email, $subject, $nom, $prenom, $to_email, $filiere) {
				$mail = new PHPMailer();
				$mail->isSMTP();
				$mail->SMTPDebug = 0;
				$mail->SMTPSecure = 'tls';
				$mail->Host = 'smtp.ionos.fr';
				$mail->SMTPAuth = true;     
				$mail->Username = 'exemple@gmail.com';
				$mail->Password = 'Password';  
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
				$mail->Port = 465;
				
				$mail->setFrom('lycee-lgt.rempart@btsorient.fr', 'Lycee-Rempart-Vinci');
				$mail->addAddress($to_email, $prenom . ' ' . $nom);
				$mail->isHTML(true);
				$mail->Subject = "Voici le programme du BTS que vous avez choisi : " . $filiere;
				$mail->Body = "Bonjour,\n" . $prenom . " " . $nom . ", voici le programme du BTS que vous avez choisi : \n" . $filiere;
				$mail->setLanguage('fr', '/optional/path/to/language/directory/');
				
				$formations = explode(', ', $filiere);
				for ($i = 0; $i < count($formations); $i++) {
					$mail->addAttachment(__DIR__ . '/Plaquette_BTS/plaquette_' . $formations[$i] . '.pdf');
				}
				
				return $mail->send();
			}
			if (envoie_mail($nom, $email, "Programme BTS", $nom, $prenom, $email, $filiere)) {
				echo '<center><h1>Email envoyé avec succès !</h1></center>';
			} else {
				echo '<center><h1>Une erreur s\'est produite lors de l\'envoi du mail</h1></center>';
			}
			?>
				<h1 id="pageID" class="text-center">Merci !</h1>
				<div id="mainArticle" class="text-center">
					<h1>Nous vous contacterons très bientôt !</h1>
					<br><br>
					<p>Pour plus d'information, vous avez à votre disposition <a href="https://www.site.ac-aix-marseille.fr/lyc-rempart/spip/">le site</a> de notre établissement. Merci pour votre participation à cette journée portes ouvertes, nous espérons de tout coeur vous retrouver l'année prochaine.<br/></p>
				</div>
			</div>
		</div>
		<br><br>
		<div id="footer" class="container py-3" style="background-color: #ffffffcc; padding: 20px; border-radius: 8px;">
			<div class="row">
				<div id="footerMenu" class="col-md-6 text-center">
					<h3><a href="https://www.site.ac-aix-marseille.fr/lyc-rempart/spip/" id="lien">Site de l'établissement</a></h3>
					<ul id="quickNav" class="list-unstyled">
						<li><a href="https://www.site.ac-aix-marseille.fr/lyc-rempart/spip/spip.php?article23" id="lien">BTS ATI</a></li>
						<li><a href="https://www.site.ac-aix-marseille.fr/lyc-rempart/spip/spip.php?article27" id="lien">BTS CIEL</a></li>
						<li><a href="https://www.site.ac-aix-marseille.fr/lyc-rempart/spip/spip.php?article24" id="lien">BTS CCST</a></li>
						<li><a href="https://www.site.ac-aix-marseille.fr/lyc-rempart/spip/spip.php?article25" id="lien">BTS CRSA</a></li>
						<li><a href="https://www.site.ac-aix-marseille.fr/lyc-rempart/spip/spip.php?article26" id="lien">BTS ET</a></li>
					</ul>
				</div>
				<div id="footerBody" class="col-md-6 text-center">
					<h1 id="footer">Lycée Polyvalent Rempart-Vinci</h1>
					<p id="footer">8 Rue du Rempart</p>
					<h2 id="footer">04 91 14 01 40</h2>
				</div>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		<style>
			#footer{
			color: #005266;
			font-weight: bold;
			}
			#lien {
			color: #005266;
			text-decoration: none;
			font-weight: bold;
			}
			body {
				background-image: url('/Images/Rempart.jpg');
				background-size: cover;
				background-position: center;
				background-repeat: no-repeat;
				background-attachment: fixed;
			}
		</style>
	</body>
</html>
