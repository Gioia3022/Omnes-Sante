<?php

//identifier le nom de base de données
$database = "omnes_sante";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
//si le BDD existe, faire le traitement
if ($db_found) {
    if (isset($_POST["button_modification_medecin"])) {
        //saisir les données du  formulaires
        $id_medecin=isset($_POST["id_medecin"]) ? $_POST["id_medecin"] : "";
        $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
        $prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
        $username = isset($_POST["username"]) ? $_POST["username"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $date_naissance = isset($_POST["date_naissance"]) ? $_POST["date_naissance"] : "";
        $telephone = isset($_POST["telephone"]) ? $_POST["telephone"] : "";
        $photo = isset($_POST["photo"]) ? $_POST["photo"] : "";
        $cv = isset($_POST["cv"]) ? $_POST["cv"] : "";
        $cabinet = isset($_POST["cabinet"]) ? $_POST["cabinet"] : "";

        if ($_FILES['photo']['size'] == 0){
            echo "Aucun fichier n'a été sélectionné";
          }
          else{
          $target_dir = "images/";
          $target_file = $target_dir . basename($_FILES["photo"]["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
          
          // Check if image file is a actual image or fake image
          if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if($check !== false) {
              echo "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
            } else {
              echo "File is not an image.";
              $uploadOk = 0;
            }
          }
          
          // Check if file already exists
          if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
          }
          
          // Check file size
          if ($_FILES["photo"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
          }
          
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
          }
          
          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
          // if everything is ok, try to upload file
          } else {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
              echo "The file ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " has been uploaded.";
              $photo=htmlspecialchars( basename( $_FILES["photo"]["name"]));
            } else {
              echo "Sorry, there was an error uploading your file.";
            }
          }
          }

        $sql1 = "UPDATE Medecin SET nom='$nom', prenom='$prenom', username='$username', password='$password', email='$email', date_naissance='$date_naissance', telephone='$telephone', ";
        $sql1 = $sql1 . " photo='$photo', cv='$cv', cabinet='$cabinet' WHERE id_medecin='$id_medecin'";

        $resultat = mysqli_query($db_handle, $sql1);
    }
} else {
    echo "<p>Database not found.</p>";
}
header('Location: adminMenu.php');
die;
?>