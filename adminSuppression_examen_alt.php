<?php
//identifier le nom de base de données
$database = "omnes_sante";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$ID = isset($_POST["id_examen"]) ? $_POST["id_examen"] : "";

//si le BDD existe, faire le traitement
if ($db_found) {
    if (isset($_POST["button_suppression_examen"])) {
        //saisir les données du  formulaires

        $sql1 = "DELETE FROM Examen  WHERE id_examen='$ID'";

        $resultat = mysqli_query($db_handle, $sql1);
    }
} else {
    echo "<p>Database not found.</p>";
}

header('Location: adminMenu.php');
die;
?>