<?php
//Ordre Décroissant
echo "<meta charset=\"utf-8\">";
//identifier votre BDD
$database = "omnes_sante";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);


//Cette id devra etre passé en paramètre ici (et il devra aussi etre envoyé dans le fichier rdv_examen_alt.php)
$id_examen = $_GET['id_examen'];
$id_du_client = $_GET['id_client'];
$sql3 = "SELECT * FROM Client WHERE id_client= '$id_du_client'";
$result3 = mysqli_query($db_handle, $sql3);
$data3 = mysqli_fetch_assoc($result3);
$prenom_du_client = $data3['prenom'];
$nom_du_client = $data3['nom'];

echo "<br>HEREEEE";
?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Omnès santé rendez vous
    </title>


    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="" rel="stylesheet" type="text/css" />
    <link href="css/menu.css " rel="stylesheet" type="text/css" />
    <link href="css/timetableExamen.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <div id="header" style="background-color: rgb(250, 250, 250); height: 80px ; top: 0px ; font-size: 20px;">
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
                        <li class="nav-item">
                            <a class="nav-link" href="chatroom.php">Chatroom</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="clientParcourir.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Compte
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="clientModification.php">Mon Compte</a>
                                </li>
                                <li><a class="dropdown-item" href="clientHistorique.php">Mon Historique</a>
                                </li>
                                <li><a class="dropdown-item" href="clientAnnuler.php">Rendez vous</a>
                                </li>
                                <li><a class="dropdown-item" href="menu.html">Déconnexion</a>
                                </li>
                            </ul>
                        </li>
                        &emsp;
                        <li class="navbar-expand-lg" style="line-height: 0px;">
                            <img src="../Omnes-Sante/images/unknown.png" width="60" height="60" style="position: absolute; top: 18px;" />
                            <p style="font-size: 15px;"> &emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $nom_du_client ?></p>
                            <p style="font-size: 15px; ">&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $prenom_du_client ?></p>
                            <p style="font-size: 10px; color: blue;">
                                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Client connecté</p>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <br>
    <br>
    <?php
    $ID = $_GET['id_examen'];
    if ($db_found) {
        //commencer le query
        $sql = "SELECT * FROM Examen WHERE id_examen= '$ID' ";
        $result = mysqli_query($db_handle, $sql);
        //regarder s'il y a des resultat
        while ($data = mysqli_fetch_assoc($result)) {
            $sql2 = "SELECT * FROM laboratoire WHERE id_laboratoire=" . $data['fk_laboratoire'];
            $result2 = mysqli_query($db_handle, $sql2);
            $data2 = mysqli_fetch_assoc($result2);
            //saisir les données du  formulaires
            $type_examen = $data['type_examen'];
            $nom = $data2['nom'];
            $adresse = $data2['adresse'];
            $ville = $data2['ville'];
            $salle = $data2['salle'];
            $email = $data2['email'];
            $telephone = $data2['telephone'];
        }
    } else {
        echo "<p>Database not found.</p>";
    }
    ?>
    <h1 id="titre"><b>Calendendrier pour l'examen : <?php echo $nom . " ". $type_examen?> </b></h1>
    <br>
    <br>
    <br>
    <form action="rdv_examen_alt.php" method="post">
        <input type="text" id="id_examen" name="id_examen" value=<?php echo $id_examen ?> hidden>
        <TABLE class="myTimetable">
            <THEAD>
                <TR>
                    <TH></TH>
                    <TH>Monday</TH>
                    <TH>Tuesday</TH>
                    <TH>Wednesday</TH>
                    <TH>Thursday</TH>
                    <TH>Friday</TH>
                </TR>
            </THEAD>
            <TBODY>
                <?php
                for ($j = 8; $j <= 17; $j++) {
                    $cpt = -1;
                ?>
                    <TR>
                        <TD>
                            <?php
                            echo $j;
                            echo "-";
                            echo $j + 1;
                            echo "h";
                            ?>
                        </TD>
                        <?php
                        for ($h = 1; $h <= 5; $h++) {
                            $cpt = -1;
                            if ($h == 1) {
                                $valeur = "2022-05-30";
                            }
                            if ($h == 2) {
                                $valeur = "2022-05-31";
                            }
                            if ($h == 3) {
                                $valeur = "2022-06-01";
                            }
                            if ($h == 4) {
                                $valeur = "2022-06-02";
                            }
                            if ($h == 5) {
                                $valeur = "2022-06-03";
                            }
                            $query = "Select * from reservation_client_examen where fk_examen='$id_examen'";
                            $result = mysqli_query($db_handle, $query);
                            while ($data = mysqli_fetch_assoc($result)) {
                                if ($data["date"] == $valeur and $data["heure"] == $j) {
                                    $cpt = 1;
                        ?>
                                    <TD class="break">Réservé</TD>
                                <?php
                                }
                            }
                            if ($j == 12) {
                                $cpt = 1;
                                ?>
                                <TD class="break">Pause midi</TD>
                            <?php
                            }
                            if ($cpt != 1) {
                            ?>
                                <TD> <button class="button2" type="submit" name="submit" value="<?php echo $valeur ?> <?php echo $j . ":00:00" ?> " style="width:100%;height:100%;color: black;background-color: bsky lue"> Réserver </button> </TD>

                    <?php
                            }
                        }
                        echo "</TR>";
                    } ?>

            </TBODY>
        </TABLE>
    </form>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>

</body>

</html>