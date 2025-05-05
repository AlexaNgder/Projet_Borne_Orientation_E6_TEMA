<?php
session_start();
// Vérifier si l'utilisateur est déjà connecté
if(isset($_SESSION['login'])) {
    header("Location: statistiques.php");
    exit;
}

// Générer un token pour la protection CSRF
$token = sha1(session_id().'aKojhxè');
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="Images/logo connect.ico">
    <title>Se connecter</title>
    <link href="./css/signin.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <form class="form-signin" action="index.php" method="POST">
      <img src="Images/lycée_rempart_logo.jpeg" width="200" height="150">
      <h1 class="h3 mb-3 font-weight-normal">Connexion</h1><br>
      <?php if(isset($_POST['connexion']) && (empty($_POST['login']) || empty($_POST['mdp']))): ?>
        <div class="alert alert-danger">Veuillez remplir tous les champs</div>
      <?php endif; ?>
      <label for="inputLogin" class="sr-only">Identifiant</label><br>
      <input type="text" id="inputLogin" name="login" class="form-control" placeholder="Identifiant" required>
      <label for="inputPassword" class="sr-only">Mot de passe</label><br>
      <input type="password" id="inputPassword" name="mdp" class="form-control" placeholder="Mot de passe" required><br>
      <!-- Ajout du token CSRF -->
      <input type="hidden" name="token" value="<?php echo $token ?>">
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="connexion">Connexion</button>
    </form>
  </body>
</html>
<?php
if(isset($_POST['connexion'])){
    // Vérifier le token
    $postedToken = isset($_POST['token']) ? $_POST['token'] : null;
    $expectedToken = sha1(session_id().'aKojhxè');
    
    if($postedToken !== $expectedToken) {
        echo "<div class='alert alert-danger'>Session invalide, veuillez réessayer.</div>";
    }
    else if(!empty($_POST['login']) && !empty($_POST['mdp'])) {
        $Login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
        $MotDePasse = htmlentities($_POST['mdp'], ENT_QUOTES, "UTF-8");
        
        $mysqli = mysqli_connect("db5017496272.hosting-data.io", "dbu3592555", "illeraN13$84", "dbs14030942");
        if(!$mysqli){
            echo "<div class='alert alert-danger'>Erreur de connexion à la base de données.</div>";
        } else {
            $stmt = $mysqli->prepare("SELECT Login, MDP FROM Identification WHERE BINARY login = ? AND BINARY mdp = ?");
            $stmt->bind_param("ss", $Login, $MotDePasse);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if($result->num_rows == 0) {
                echo "<div class='alert alert-danger'>Le login ou le mot de passe est incorrect.</div>";
            } else {
                $_SESSION['login'] = $Login;
                header("Location: statistiques.php");
                exit;
            }
            $stmt->close();
        }
        mysqli_close($mysqli);
    }
}
?>