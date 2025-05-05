<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Page pour la borne d'orientation.">
    <meta name="author" content="Cavig">
    <link rel="icon" href="images/canard 3.jpg">

    <title>OI</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">


  </head>

  <body>

    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">A Propos</h4>
              <p class="text-muted">Ajoutez des informations sur l'album ci-dessous, sur l'auteur ou sur tout autre contexte. Faites quelques phrases pour que les gens puissent récupérer quelques informations informatives. Ensuite, associez-les à certains sites de réseaux sociaux ou à vos coordonnées.</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Contact</h4>
              <ul class="list-unstyled">

              <p class="text-muted">En cas de probleme veillez appeller ce numéro 04 91 14 01 40.</p>
                <li><a href="#" class="text-white">Mail</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            <strong>Orientation Info</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Les Différentes Filières</h1>
          <p class="lead text-muted">Ci-dessous sont represantées chaques filiaires en BTS du lycée du Rempart. Appuyez sur celle qui vous interesse pour connaître le chemin correspondant.</p>
          <h2 class="jumbotron-heading">Appuyez sur un des BTS</h2>
        </div>
      </section>
   
      <div class="album py-5 bg-light">
          <div class="container">

            
              <div class="buttons-container">
                <button style="background-image: url(images/btsciel.jpeg); width: 200px; height: 200px;" id="lien2" onclick="generateQR('https://btsorient.fr/CIEL.php')"> 
                    <input type="hidden" name="btn">
                </button>
                <button style="background-image: url(images/btsati.jpeg); width: 200px; height: 200px;" id="lien2" onclick="generateQR('https://btsorient.fr/ATI.php')"> 
                    <input type="hidden" name="btn">
                </button>  
                <button style="background-image: url(images/btsccst.jpeg); width: 200px; height: 200px;" id="lien3" onclick="generateQR('https://btsorient.fr/CCST.php')"> 
                    <input type="hidden" name="btn">
                </button>
                <button style="background-image: url(images/btscrsa.jpeg); width: 200px; height: 200px;" id="lien4" onclick="generateQR('https://btsorient.fr/CRSA.php')"> 
                    <input type="hidden" name="btn">
                </button>  
                <button style="background-image: url(images/et.jpeg); width: 200px; height: 200px;" id="lien3" onclick="generateQR('https://btsorient.fr/ET.php')"> 
                    <input type="hidden" name="btn">
                </button>
            <!--Recupere l'url pour que le qrcode renvoie sur le bonne page-->
              
                
           </div>
         </div>
        <div id="qr-wrapper" class="hidden">
            <div id="qr-image-container">
                <img src="" alt="" id="qrImage" />
            </div>
            <p>Scannez le QR code</p>
        </div>
    </div>
    <script> 
        let qrURL = "https://api.qrserver.com/v1/create-qr-code/?size=160x160&data="; 
          //Cette variable contient l'URL de base utilisée pour générer un code QR via l'API de qrserver.com. L'URL contient une partie fixe, et la donnée (data) à encoder dans le QR Code sera ajoutée à la fin de cette URL.
        let qrWrapper = document.getElementById("qr-wrapper");
        let qrImageContainer = document.getElementById("qr-image-container");
        let qrImage = document.getElementById("qrImage");
          // Ces variables récupèrent des éléments HTML à partir de l'ID. Ces éléments correspondent probablement à des parties de ton HTML où tu affiches le QR Code.
 
        let generateQR = (url) => { 
          // Cette fonction génère un QR code basé sur l'URL que je lui passes
            qrWrapper.classList.remove("hidden");
            qrImageContainer.classList.add("show-qr");
            //Rends visibles les éléments qui affichent le QR Code en retirant la classe hidden de qrWrapper et en ajoutant la classe show-qr à qrImageContainer.
            if (url.length > 0) {
                qrImage.src = qrURL + url;
                //Si l'URL fournie est valide (c'est-à-dire qu'elle n'est pas vide), elle met à jour la source de l'image du QR code (qrImage.src) en utilisant l'URL de l'API et en lui ajoutant l'URL à encoder.
                document.getElementById("text_QRCODE").textContent = 'Scannez le QR Code qui vient d\'apparaitre pour suivre l\'itinéraire';
                //Elle affiche également un message pour guider l'utilisateur à scanner le QR Code.
              } else {
                qrText.classList.add("error");
                setTimeout(() => {
                    qrText.classList.remove("error");
                }, 1000);
                //Si l'URL est vide, une erreur est affichée pendant 1 seconde grâce à l'ajout et la suppression de la classe error.
            }
        };
        function Redirection(){
          window.location.replace("accueil.html"); //renvoie la page accueil.html
}
       setInterval(Redirection,15000); //au bout de 15 secondes
        
    </script>
       </div>

    </main>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Back to top</a>
        </p>
        
        <p>Etudiant du de l'établisment du Rempart en Projet de seconde année du BTS CIEL <a href="https://www.site.ac-aix-marseille.fr/lyc-rempart/spip/">Visitez du site du Rempart</a> ou alors <a href="https://www.bourguette-autisme.org/">Visitez du site du client</a>.</p>
        <p>Site créé par Le_Cavig pour l'accueil et les chemins par Tony Barelli inspiré de Bootstrap &copy;</p><n/> En esperant qu'il vous serve bien.</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="magie.js"></script>
    <script src="magie.js"></script>
    <script src="magie.js"></script>
  </body>
</html>
