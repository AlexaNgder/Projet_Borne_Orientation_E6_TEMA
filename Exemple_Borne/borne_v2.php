<?php 
$idpageCIEl = "xxxxxxxx";
$idpageATI = "yyyyyyyyy";
$idpageCCST = "zzzzzzzz";
$idpageCRSA = "wwwwwwww";
?>

<html lang="fr"> 
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formations</title>
    <link rel="stylesheet" href="Borne.css" />
</head>
<body>
    <header style="display: block;">
        <nav class="" style="box-shadow: 0 5px 5px rgba(0, 0, 0, .6); display: flex; flex-direction: row; justify-content: end;">
            <div>
                <h5 style="margin-right: 10px; color: white;">Accès administrateur</h5>
            </div>
            <div>
                <a href="../PG_ADMIN/index.html" class="btn btn-dark float-right" style="display: flex; flex-direction: row;">
                    <img src="../images/logo_connexion2.png" width="30" height="30" alt="">
                </a>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="form-container">
            <center>
                <h3 id="text_QRCODE">
                    <big>Bienvenue au<p> Lycée Général et Technologique du Rempart,</p></big>
                    <big> veuillez choisir une formation :</big>
                </h3>
            </center>
            <div class="content-container">
                <div class="buttons-container">
                    <button style="background-image: url(../images/BTSCIEL.png); text-color: white; text-decoration: none;" id="lien1" onclick="generateQR('http://btsrempart.go.yj.fr/serendreBTSCIEL.php?idpage=<?php echo $idpageCIEl; ?>')">
                        <input type="hidden" name="btn">BTS CIEL
                    </button>
                    <button style="background-image: url(../images/BTSATI.png); text-color: white; text-decoration: none;" id="lien2" onclick="generateQR('http://btsrempart.go.yj.fr/serendreBTSATI.php?idpage=<?php echo $idpageATI; ?>')">
                        <input type="hidden" name="btn">BTS ATI
                    </button>
                    <button style="background-image: url(../images/BTSCCST.png); text-color: white; text-decoration: none;" id="lien3" onclick="generateQR('http://btsrempart.go.yj.fr/serendreBTSCCST.php?idpage=<?php echo $idpageCCST; ?>')">
                        <input type="hidden" name="btn">BTS CCST
                    </button>
                    <button style="background-image: url(../images/BTSCRSA.png); text-color: white; text-decoration: none;" id="lien4" onclick="generateQR('http://btsrempart.go.yj.fr/serendreBTSCRSA.php?idpage=<?php echo $idpageCRSA; ?>')">
                        <input type="hidden" name="btn">BTS CRSA
                    </button>
                </div>
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
        let qrURL = "https://api.qrserver.com/v1/create-qr-code/?size=160x160&data="; // Partie JS Rédigé par Mohamed Laddel -->
        let qrWrapper = document.getElementById("qr-wrapper");
        let qrImageContainer = document.getElementById("qr-image-container");
        let qrImage = document.getElementById("qrImage");

        let generateQR = (url) => {
            qrWrapper.classList.remove("hidden");
            qrImageContainer.classList.add("show-qr");
            if (url.length > 0) {
                qrImage.src = qrURL + url;
                document.getElementById("text_QRCODE").textContent = 'Scannez le QR Code qui vient d\'apparaitre pour suivre l\'itinéraire';
            } else {
                qrText.classList.add("error");
                setTimeout(() => {
                    qrText.classList.remove("error");
                }, 1000);
            }
        };
        

        setInterval(() => {
            location.reload();
        }, 15000);
        
    </script>
</body>
</html>

<!-- 
                                            88@@@88@88
                              @@@@@@@@@8@@@@@@@@@@@@@@@@@@@@
                        @@@@@@@@@@@@@@@@@@@@@@@        8@@@@@@@@
                     8@@@@@@@@@@@@@@@@@@@@@@@@@@@@@8       8@@@@@@@
                  8@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@8      @@@@@@@
                 8@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@8     @@@@@@
               8@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@    @@@@@@8
              @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  @@@@@@8
             @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ @@@@@@
            @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@8 @@@@@@
           @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  @@ @@@@@@8
          8@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@    8@@@@  8 @@@@@@8
          @@@  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   8@8   @@@@ @@@@@@@
         8@@@88@@@@@@@@@@   @@@@@@@@@@@@@@@@@@  8@@@@    @ 8@@@@@@
       @@8@@@@@@@@@@@@@@@    @@@@@@@@@@@@@@@@8    @@@@    @@@@@@@
      @@  @@@@@@     8@@@@@@@@@@@@@@@@8    8@@8    88    @@@@@@8
    8@@   @@@@@        @@@@@@@@@@@@@@@@    @@@@@       8@@@@@@ 8@
   8@@    @@@@@   8@@8   @@@@@@@@@@@@@@@@@@@@@@@@    8@@@@@@8 @@@
   @@     @@@@@   8@@@   8@8    8@@@@@@@@@@@@@@@@@  @@@@@@@ 8@@@8
  @@@      @@C@@   @@@@   @     8  @@8           8@@@@@@@  @@@@@
 @@@        @@@@@   @@@@8 @@88@@8  @    8@@@@  8@@@@@@@  @@@@@@
 @@@        8@@@@@   8@@8  @@@@@@@8    @@@@  @@@@@@@@  @@8 8@@
8@@@8         @@@@@@        @@       8@@8O@@@@@@@@@   @@@@@@@
8@@@@          @@@@@@@     8@8      @  @@@@@@@@@8     @@@@@@
 @@@@@           @@@@@@@@@@@@@     8@@@@@@@@@@        @@@@
 @@@@@@8           @@@@@@@     8@@@@@@@@@@@         @@@@
  @@@@@@@@@          8   8@@@@@@@@@@@@@8       8@@@@@@
   @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@8        8@@@@@8
     @@@@@@@@@@@@@@@@@@@@@@@@@@   8@@@@@@@@@@8
                 8@@@@@@@@@@@@@@@@8
  @@@@@@@@   @@@                                   @@@    @@@
  @@@@@@@@@@ @@@                            @@@    @@@    @@@                   @@@
  @@@@  @@@@ @@@  @@@@@@@   @@@@@    @@@@   @@     @@@    @@@   @@@@@    @@@@@  @@@     @@@@    @@@
  @@@@  @@@@ @@@  @@@@@@@@ @@@@@@@@ @@@@@@  @@@@@@ @@@@@@@@@@  @@@@@@@  @@@@@   @@@@@@ @@@@@@   @@@@@
  @@@@@@@@@  @@@      @@@@ @@@  @@@ @@  @@@ @@@    @@@@@@@@@@  @@@ @@@ @@@      @@@    @@  @@@  @@@
  @@@@@@@@   @@@  @@@@@@@@ @@@  @@@ @@@ @@@ @@@    @@@    @@@  @@@ @@@  @@@@@   @@@    @@@ @@@  @@@
  @@@@       @@@ @@@@  @@@ @@@  @@@ @@@@@@@ @@@    @@@    @@@  @@@ @@@   @@@@@  @@@    @@@@@@@  @@@
  @@@@       @@@ @@@   @@@ @@@  @@@ @@@     @@@    @@@    @@@  @@@@@@@    @@@@  @@@    @@@      @@@
  @@@@       @@@  @@@@@@@  @@@  @@@  @@@@@@  @@@@  @@@    @@@   @@@@@  @@@@@@    @@@@   @@@@@@  @@@ 
-->
