<?php

//identification de la BDD
$database = "omnes_sante";

//connection dans notre BDD
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);

//declaration des variables

$username = isset($_POST["username"])? $_POST["username"] : "";
$password = isset($_POST["password"])? $_POST["password"] : "";

//detection des erreurs
$erreur = "";
echo "0";

if (isset($_POST["access"])) {
    echo "1";
    if ($db_found) {
        //commencer le query
        $sql = "SELECT * FROM Client";
        if ($username != "") {
            //on recherche le medecin par son nom
            $sql .= " WHERE username LIKE '%$username%'";
            //on recherche le medecin par son prenom
            if ($password != "") {
                $sql .= " AND password LIKE '%$password%'";
            }
        }
        $result = mysqli_query($db_handle, $sql);
        //regarder s'il y a des resultats
        if (mysqli_num_rows($result) == 0) {
            echo "<p>Ce Compte n'existe pas</p>";
        } else {
            //afficher le resultat
            while ($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $data['id_client'] . "</td>"."<br>";
                echo "<td>" . $data['nom'] . "</td>"."<br>";
                echo "<td>" . $data['prenom'] . "</td>"."<br>";
                echo "<td>" . $data['username'] . "</td>"."<br>";
                echo "<td>" . $data['date_naissance'] . "</td>"."<br>";
                echo "<td>" . $data['email'] . "</td>"."<br>";
                echo "<td>" . $data['genre'] . "</td>"."<br>";
                echo "<td>" . $data['telephone'] . "</td>"."<br>";
                $image = $data['photo'];
                echo "<td>" . "<img src='$image' height='120' width='100'>" . "</td>"."<br>";
                echo "</tr>";
            }
            echo "</table>";
        }
    } else {
        echo "<p>Database not found.</p>";
    }
}


?>