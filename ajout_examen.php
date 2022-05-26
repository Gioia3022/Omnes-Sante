<?php

//saisir les données du  formulaires
$type_examen = isset($_POST["type_examen"])? $_POST["type_examen"] : "";
$fk_laboratoire = isset($_POST["id_lab"])? $_POST["id_lab"] : "";



//identifier le nom de base de données
$database = "omnes_sante";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
//si le BDD existe, faire le traitement

if (isset($_POST["button_ajout_examen"])) {

if ($db_found) {

    $sql0="SELECT * FROM Examen WHERE type_examen='$type_examen' AND fk_laboratoire='$fk_laboratoire'";
    $resultat =mysqli_query($db_handle, $sql0);
    if (mysqli_num_rows($resultat) == 0) {
        $sql = "INSERT INTO Examen(type_examen, fk_laboratoire) VALUES ('$type_examen', '$fk_laboratoire')";
    $result =mysqli_query($db_handle, $sql);
    } else {
        echo "Ce type d'examen dans ce laboratoire existe déja.";
    }

} //end if
//si le BDD n'existe pas
else {
    echo "Database not found";
} //end else
//fermer la connection
mysqli_close($db_handle);
}

?>

      