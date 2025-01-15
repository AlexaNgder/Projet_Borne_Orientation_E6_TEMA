<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (empty($_FILES["image_file"]["tmp_name"])){
            header("Location:index.php?message=er");
        }
        $file_basename = pathinfo($_FILES["image_file"]["name"],PATHINFO_FILENAME);
        $file_extension = pathinfo($_FILES["image_file"]["name"],PATHINFO_EXTENSION);
        $new_image_name = $file_basename .'_'.date("Ymd_His").'.'.$file_extension;


        $servername = "127.0.0.1:3306";
        $username = "root";
        $password = "";
        $dbname = "images";

        $conn = new mysqli($servername,$username,$password,$dbname);

        if ($conn ->connect_error){
            dir("La connexion à la base  de données a échoué : ".$conn->connect_error);
        }
        $new_image_name = $conn->real_escape_string($new_image_name);// sa protege contre les injections
        $sql ="INSERT INTO image (libelle VALUES ('$new_image_name')";
        if ($conn->query($sql) === TRUE){
            $target_directory = "images/";
            $target_path = $target_directory.$new_image_name;
            if (!move_uploaded_file($_FILES["image_file"]["tmp_name"],$target_path)){
                header("Location:index.php?message=er");
            }
            header("Location:index.php?message=ok");
        }else{
            header("Location:index.php?message=no");
        }
        $conn->close();
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="alert sucess">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            L'insertion de l'image dans la bdd  a réussi !
        </div>
        <div class="alert fail">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            L'insertion de l'image dans la bdd a échoué !
        </div>
        <label for="images" class="drop-container" id="dropcontainer">
            <span class="drop-title">Déposez les fichiers ici</span>
            ou
            <input type="file" name="image_file" id="images" accept="image/*" required>
        </label>
        <button type="submit" id="submitBtn">Enregister l'image</button>
    </form>
    <script src="script.js"></script>
</body>
</html>
