<?php
//saisir les données du  formulaires
$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
$type_medecin = isset($_POST["type_medecin"])? $_POST["type_medecin"] : "";

$err=$nom. $prenom. $type_medecin;
$char="";


//identifier le nom de base de données
$database = "omnes_sante";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
//si le BDD existe, faire le traitement

if (isset($_POST["button_recherche_medecin"])) {
    if ($db_found) {
        //commencer le query
        $sql = "SELECT * FROM Medecin";
        if ($err != "") {
            $sql .= " WHERE ";

            //on recherche le medecin par son nom
            if ($nom!=""){
            $sql .= " nom LIKE '%$nom%'";
            $char= " AND ";
            }
            //on recherche le medecin par son prenom
            if ($prenom != "") {
                $sql .= $char." prenom LIKE '%$prenom%'";
                $char=" AND ";
            }
            //on recherche le medecin par son type
            if ($type_medecin != "") {
                $sql .= $char. "type_medecin LIKE '%$type_medecin%'";
            }
        }
        $result = mysqli_query($db_handle, $sql);
        //regarder s'il y a des resultats
        if (mysqli_num_rows($result) == 0) {
            echo "<p>Ce medecin n'existe pas</p>";
        } else {
            //on trouve le livre
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>" . "ID" . "</th>";
            echo "<th>" . "Nom" . "</th>";
            echo "<th>" . "Prenom" . "</th>";
            echo "<th>" . "Genre" . "</th>";
            echo "<th>" . "Date de naissance" . "</th>";
            echo "<th>" . "type medecin" . "</th>";
            echo "<th>" . "email" . "</th>";
            echo "<th>" . "telephone" . "</th>";
            echo "<th>" . "cabinet" . "</th>";
            echo "<th>" . "photo" . "</th>";
            //afficher le resultat
            while ($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $data['id_medecin'] . "</td>";
                echo "<td>" . $data['nom'] . "</td>";
                echo "<td>" . $data['prenom'] . "</td>";
                echo "<td>" . $data['genre'] . "</td>";
                echo "<td>" . $data['date_naissance'] . "</td>";
                echo "<td>" . $data['type_medecin'] . "</td>";
                echo "<td>" . $data['email'] . "</td>";
                echo "<td>" . $data['telephone'] . "</td>";
                echo "<td>" . $data['cabinet'] . "</td>";
                $image = $data['photo'];
                echo "<td>" . "<img src='$image' height='120' width='100'>" . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    } else {
        echo "<p>Database not found.</p>";
    }
}


?>