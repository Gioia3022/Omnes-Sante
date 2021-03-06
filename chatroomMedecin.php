<?php
session_start();
$id_medecin = $_SESSION['id_medecin'];
//Ordre Décroissant
echo "<meta charset=\"utf-8\">";
//identifier votre BDD
$database = "omnes_sante";

$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

//declaration des variables
$id_exam = isset($_POST["id_examen"]) ? $_POST["id_examen"] : "";
$type_examen = isset($_POST["type_examen"]) ? $_POST["type_examen"] : "";
$fk_laboratoir = isset($_POST["fk_laboratoire"]) ? $_POST["fk_laboratoire"] : "";
$ID = isset($_POST["id_medecin"]) ? $_POST["id_medecin"] : "";
$nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
$type_medecin = isset($_POST["type_medecin"]) ? $_POST["type_medecin"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$cabinet = isset($_POST["cabinet"]) ? $_POST["cabinet"] : "";
$ville = isset($_POST["ville"]) ? $_POST["ville"] : "";
$adresse = isset($_POST["adresse"]) ? $_POST["adresse"] : "";
$salle = isset($_POST["salle"]) ? $_POST["salle"] : "";
$telephone = isset($_POST["telephone"]) ? $_POST["telephone"] : "";
$type_examen = isset($_POST["type_examen"]) ? $_POST["type_examen"] : "";
$erreur = "";

if ($db_found) {
    //commencer le query
    $sql = "SELECT * FROM Medecin WHERE id_medecin= '$id_medecin' ";

    $result = mysqli_query($db_handle, $sql);
    //regarder s'il y a des resultats
    if (mysqli_num_rows($result) == 0) {
        echo "<p>Ce client n'existe pas</p>";
    } else {
        while ($data = mysqli_fetch_assoc($result)) {
            //saisir les données du  formulaires
            $nom = $data['nom'];
            $prenom = $data['prenom'];
            $photo=$data['photo'];
        }
    }
} else {
    echo "<p>Database not found.</p>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Omnes Santé
    </title>


    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/menuClient.css " rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
<div id="header" style="height: 0px; font-size: 20px; width: 100%;">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <img src="../Omnes-Sante/images/logo.png" width="80" height="80" style="position: relative;"/>
                <label id="bigtitre" style="color: blue; font-size: 30px;"><b>Omnes Santé &emsp; </b></label> <br><br>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                </button>
                <div class="collapse navbar-collapse justify-content_between" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="menuMedcin.php">Accueil</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Calendrier 
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="medecinConsultation.php">Futurs Consultations</a>
                                </li>
                                <li><a class="dropdown-item" href="medecinHistorique.php">Historiques</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="chatroomMedecin.php">Chatroom</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="menu.html">Déconnexion</a>
                        </li>
                        &emsp;
                        <li class="navbar-expand-lg" style="line-height: 0px;">
                        <img src="../Omnes-Sante/images/<?php if (empty($photo)){ echo 'unknown.png';} else { echo $photo;}?>" 
                                width="60" height="60" style="position: absolute; top: 18px;" />
                            <p style="font-size: 15px;"> &emsp;&emsp;&emsp;&emsp;&emsp; <?php echo $nom ?></p>
                            <p style="font-size: 15px; ">&emsp;&emsp;&emsp;&emsp;&emsp; <?php echo $prenom ?></p>
                            <p style="font-size: 10px; color: blue;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Médecin connecté</p>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div>
        <table class="table table-hover">
            <br><br><br><br>
            <h1 id="titre"><b>Liste des clients que vous pouvez contacter </b></h1>
            <br><br>
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
            </tr>
            <?php
            if ($db_found) {
                
                $sql1 = "SELECT * FROM client";

                $result1 = mysqli_query($db_handle, $sql1);

                while ($data1 = mysqli_fetch_assoc($result1)) {
                    echo "<tr>";
                    echo  "<td>" . $data1['id_client'] .  "</td>";
                    echo " <td class=nav-item><a class=nav-link href=envoyerEmailMedecin.php?id_client=" . $data1['id_client'] . "&nom=". $nom . "&prenom=". $prenom .">" . $data1['nom'] . "</a></td>";
                    echo " <td class=nav-item><a class=nav-link href=envoyerEmailMedecin.php?id_client=" . $data1['id_client'] ."&nom=". $nom . "&prenom=". $prenom. ">" . $data1['prenom'] . "</a></td>";
                    echo " <td class=nav-item><a class=nav-link href=envoyerEmailMedecin.php?id_client=" . $data1['id_client'] ."&nom=". $nom . "&prenom=". $prenom. ">" . $data1['email'] . "</a></td>";
                   
                    echo "</tr>";
                } //end while
            }
            //si le BDD n'existe pas
            else {
                echo "Database not found";
            } //end else

            ?>
        </table>

    </div>
    </div>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>