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

        $sql1 = "UPDATE Medecin SET nom='$nom', prenom='$prenom', username='$username', password='$password', email='$email', date_naissance='$date_naissance', telephone='$telephone', ";
        $sql1 = $sql1 . " photo='$photo', cv='$cv', cabinet='$cabinet' WHERE id_medecin='$id_medecin'";

        $resultat = mysqli_query($db_handle, $sql1);
    }
} else {
    echo "<p>Database not found.</p>";
}
header('Location: menuAdmin.php');
die;
?>