<?php
//identifier le nom de base de données
$database = "omnes_sante";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

$id_client_medecin= isset($_POST["id_client_medecin"]) ? $_POST["id_client_medecin"] : "";
$id_client_examen = isset($_POST["id_client_examen"]) ? $_POST["id_client_examen"] : "";


//si le BDD existe, faire le traitement
if ($db_found) {
    if (isset($_POST["button_suppression_rdv_medecin"])) {
        //saisir les données du  formulaires

        $sql1 = "DELETE FROM reservation_client_medecin  WHERE id_client_medecin='$id_client_medecin'";
        $resultat = mysqli_query($db_handle, $sql1);
    }

    if (isset($_POST["button_suppression_rdv_examen"])) {
        //saisir les données du  formulaires

        $sql1 = "DELETE FROM reservation_client_examen  WHERE id_client_examen='$id_client_examen'";
        $resultat = mysqli_query($db_handle, $sql1);
    }

    
} else {
    echo "<p>Database not found.</p>";
}

header('Location: clientMenu.php');
die;
?>