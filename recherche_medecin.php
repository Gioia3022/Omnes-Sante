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


?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Omnes Santé Recherche Examen
    </title>


    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="" rel="stylesheet" type="text/css" />
    <link href="css/menu.css " rel="stylesheet" type="text/css" />
</head>
<body>
<div id="margin" style="background-color: rgb(250, 250, 250); width: 100%; height: 80px ; position: absolute; top: 0px ;"> <br><a class="navbar-brand" href="#"><img src="../Omnes-Sante/images/logo.png" width="80" height="80" style="object-position: 10px -25px ;"/></a></div>
    <div id="wrapper">
        <div id="header" style="background-color: rgb(250, 250, 250); height: 80px ; top: 0px ; font-size: 20px;">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <label id="bigtitre" style="color: blue; font-size: 30px;"><b>Omnes Santé &emsp; </b></label> <br><br>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    </button>
                    <div class="collapse navbar-collapse justify-content_between" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="menu.html">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="parcourir.php">Parcourir</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="parcourir.html" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Recherche
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="recherche_medecin.html">Recherche médecin</a>
                                    </li>
                                    <li><a class="dropdown-item" href="recherche_examen.html">Recherche laboratoire</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="parcourir.php" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Compte
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="connexion.html">Connexion</a>
                                    </li>
                                    <li><a class="dropdown-item" href="inscription.html">Créer un compte</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <table class="table table-strip">
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Spécialité</th>
                <th>Email</th>
                <th>Cabinet</th>
            </tr>
            <?php


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
            echo "<br> <br> ";
            echo "<p>Ce type d'examen n'existe pas</p>";
            echo "<br> <br> ";
            echo "<tr>";
                echo "<td>" . " " . "</td>";
                echo "<td>" . "-" . "</td>";
                echo "<td>" . "-" . "</td>";
                echo "<td>" . "-" . "</td>";
                echo "<td>" . "-" . "</td>";
                echo "<td>" . "-" . "</td>";
                echo "</tr>";
        } else {
            echo "<br> <br> ";
                echo "Liste des medecins: ";
                echo "<br> ";
            while ($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                    echo  "<td>" . $data['id_medecin'] .  "</td>";
                    echo  "<td>" . $data['nom'] .  "</td>";
                    echo  "<td>" . $data['prenom'] .  "</td>";
                    echo " <td>" . $data['type_medecin'] .  "</td>";
                    echo  "<td>" . $data['email'] .  "</td>";
                    echo  "<td>" . $data['cabinet'] . "</td>";
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
</table>

</div>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>

</body>

</html>