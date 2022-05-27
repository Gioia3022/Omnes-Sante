<?php
session_start();
echo "<meta charset=\"utf-8\">";
$id_client = $_SESSION['id_client'];
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
    $sql = "SELECT * FROM Client WHERE id_client= '$id_client' ";

    $result = mysqli_query($db_handle, $sql);
    //regarder s'il y a des resultats
    if (mysqli_num_rows($result) == 0) {
        echo "<p>Ce client n'existe pas</p>";
    } else {
        while ($data = mysqli_fetch_assoc($result)) {
            //saisir les données du  formulaires
            $nom = $data['nom'];
            $prenom = $data['prenom'];
            $username = $data['username'];
            $password = $data['password'];
            $email = $data['email'];
            $date_naissance = $data['date_naissance'];
            $telephone = $data['telephone'];
            $photo = $data['photo'];
            $adresse = $data['adresse'];
            $ville = $data['ville'];
            $code_postal = $data['code_postal'];
            $pays = $data['pays'];
            $carte_vitale = $data['carte_vitale'];
        }
    }
} else {
    echo "<p>Database not found.</p>";
}
?>


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
    <link href="" rel="stylesheet" type="text/css" />
    <link href="css/parcourir.css " rel="stylesheet" type="text/css" />
</head>


<body>
    <div id="header">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <img src="../Omnes-Sante/images/logo.png" width="80" height="80" style="position: relative;" />
                <label id="bigtitre" style="color: blue; font-size: 30px;"><b>Omnes Santé &emsp; </b></label>
                <br><br>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                </button>
                <div class="collapse navbar-collapse justify-content_between" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="clientMenu.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="clientParcourir.php">Parcourir</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="clientParcourir.html" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Recherche
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="clientRecherche_medecin1.php">Recherche médecin</a>
                                </li>
                                <li><a class="dropdown-item" href="clientRecherche_examen1.php">Recherche laboratoire</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="clientParcourir.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Compte
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="clientModification.php">Mon Compte</a>
                                </li>
                                <li><a class="dropdown-item" href="menu.html">Déconnexion</a>
                                </li>
                            </ul>
                        </li>
                        &emsp;
                        <li class="navbar-expand-lg" style="line-height: 0px;">
                            <img src="../Omnes-Sante/images/unknown.png" width="60" height="60" style="position: absolute; top: 18px;" />
                            <p style="font-size: 15px;"> &emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $nom ?></p>
                            <p style="font-size: 15px; ">&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $prenom ?></p>
                            <p style="font-size: 10px; color: blue;">
                                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Client connecté</p>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div>
        <table class="table table-hover">
            <h1 id="titre"><b>Liste des médecins :</b></h1>
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Spécialité</th>
                <th>Email</th>
                <th>Cabinet</th>
            </tr>
            <?php
            if ($db_found) {
                $sql1 = "SELECT * FROM medecin";

                $sql3 = "SELECT * FROM examen";
                $result1 = mysqli_query($db_handle, $sql1);

                $result3 = mysqli_query($db_handle, $sql3);

                while ($data1 = mysqli_fetch_assoc($result1)) {
                    echo "<tr>";
                    echo  "<td>" . $data1['id_medecin'] .  "</td>";
                    echo " <td class=nav-item><a class=nav-link href=rdv_medecin.php?id_medecin=" . $data1['id_medecin'] . ">" . $data1['nom'] . "</a></td>";
                    echo  "<td>" . $data1['prenom'] .  "</td>";
                    echo " <td>" . $data1['type_medecin'] .  "</td>";
                    echo  "<td>" . $data1['email'] .  "</td>";
                    echo  "<td>" . $data1['cabinet'] . "</td>";
                    echo "</tr>";
                } //end while
            }
            //si le BDD n'existe pas
            else {
                echo "Database not found";
            } //end else

            ?>
        </table>
        <h1 id="titre"><b>Liste des examens :</b></h1>
        <table class="table table-hover">
            <tr>
                <th></th>
                <th>Type examen</th>
                <th>Laboratoire</th>
                <th>Adresse</th>
                <th>Email</th>
                <th>Telephone</th>
            </tr>
            <?php
            if ($db_found) {
                while ($data3 = mysqli_fetch_assoc($result3)) {
                    $sql4 = "SELECT * FROM laboratoire WHERE id_laboratoire =" . $data3['fk_laboratoire'];
                    $result4 = mysqli_query($db_handle, $sql4);
                    $data4 = mysqli_fetch_assoc($result4);
                    echo "<tr>";
                    echo "<td>" . $data3['id_examen'] . "</td>";
                    echo " <td class=nav-item><a class=nav-link href=ajout_medecin.php?id_reservation=" . $data3['id_examen'] . ">" . $data3['type_examen'] . "</a></td>";
                    echo "<td>" . $data4['nom'] . "</td>";
                    echo "<td>" . $data4['adresse'] . " " . $data4['ville'] . "</td>";
                    echo "<td>" . $data4['email'] . "</td>";
                    echo "<td>" . $data4['telephone'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "Database not found";
            }
            mysqli_close($db_handle);
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