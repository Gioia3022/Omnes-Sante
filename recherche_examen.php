<?php

//saisir les données du  formulaires
$id_lab = isset($_POST["id_lab"])? $_POST["id_lab"] : "";
$type_examen = isset($_POST["type_examen"])? $_POST["type_examen"] : "";

$err=$id_lab. $type_examen;
$char="";


//identifier le nom de base de données
$database = "omnes_sante";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
//si le BDD existe, faire le traitement

if (isset($_POST["button_recherche_examen"])) {
    if ($db_found) {
        //commencer le query
        $sql = "SELECT * FROM Examen";
        if ($err != "") {
            $sql .= " WHERE ";

            //on recherche le medecin par son nom
            if ($id_lab!=""){
            $sql .= " fk_laboratoire LIKE '%$id_lab%'";
            $char= " AND ";
            }
            //on recherche le medecin par son prenom
            if ($type_examen != "") {
                $sql .= $char." type_examen LIKE '%$type_examen%'";
                $char=" AND ";
            }
            
        }
        $result = mysqli_query($db_handle, $sql);
        //regarder s'il y a des resultats
        if (mysqli_num_rows($result) == 0) {
            echo "<p>Ce medecin n'existe pas</p>";
        } else {
            while ($data = mysqli_fetch_assoc($result)) {
                echo "ID: " . $data['id_examen'];
                echo "type d examen: " . $data['type_examen'];
                
            }
        }
    } else {
        echo "<p>Database not found.</p>";
    }
}


?>