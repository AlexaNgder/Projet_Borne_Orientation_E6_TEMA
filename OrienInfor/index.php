<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if(isset($_SESSION['login'])) {
    header("Location: statistiques.php");
    exit;
}

// Traitement du formulaire
if(isset($_POST['connexion'])){
    // Vérifier le token
    $postedToken = isset($_POST['token']) ? $_POST['token'] : null;
    $expectedToken = sha1(session_id().'aKojhxè');
    
    if($postedToken !== $expectedToken) {
        $error = "Session invalide, veuillez réessayer.";
    }
    else if(empty($_POST['login']) || empty($_POST['mdp'])) {
        $error = "Veuillez remplir tous les champs";
    }
    else {
        $Login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
        $MotDePasse = htmlentities($_POST['mdp'], ENT_QUOTES, "UTF-8");
        
        $mysqli = mysqli_connect("db5017496272.hosting-data.io", "dbu3592555", "illeraN13$84", "dbs14030942");

        $mysqli = mysqli_connect("localhost", "root", "", "dbs14030942");
        if(!$mysqli){
            $error = "Erreur de connexion à la base de données.";
        } else {
            $stmt = $mysqli->prepare("SELECT Login, MDP FROM Identification WHERE BINARY login = ? AND BINARY mdp = ?");
            $stmt->bind_param("ss", $Login, $MotDePasse);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if($result->num_rows == 0) {
                $error = "Le login ou le mot de passe est incorrect.";
            } else {
                $_SESSION['login'] = $Login;
                header("Location: statistiques.php");
                exit;
            }
            $stmt->close();
            mysqli_close($mysqli);
        }
    }
}

// Générer un token pour la protection CSRF
$token = sha1(session_id().'aKojhxè');
?>
<!doctype html>
<html lang="fr">
  <head>
    <div>
    <meta charset="utf-8">
    <link rel="icon" href="/OrienInfor/Images/logo connect.ico">
    <title>Se connecter</title>
    <link href="/OrienInfor/css/signin.css" rel="stylesheet">
    <link href="/OrienInfor/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <form class="form-signin" action="index.php" method="POST">
      <img src="/OrienInfor/Images/lycée_rempart_logo.jpeg" width="200" height="150">
      <h1 class="h3 mb-3 font-weight-normal">Connexion</h1><br>
      <label for="inputLogin" class="sr-only">Identifiant</label><br>
      <input type="text" id="inputLogin" name="login" class="form-control" placeholder="Identifiant" required>
      <label for="inputPassword" class="sr-only">Mot de passe</label><br>
      <input type="password" id="inputPassword" name="mdp" class="form-control" placeholder="Mot de passe" required><br>
      <input type="hidden" name="token" value="<?php echo $token ?>">
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="connexion">Connexion</button><br>
      <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    </form>
  </body>
</html>