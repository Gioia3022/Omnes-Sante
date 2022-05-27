<?php
//Ordre Décroissant
echo "<meta charset=\"utf-8\">";
//identifier votre BDD
$database = "omnes_sante";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);


//Cette id devra etre passé en paramètre ici (et il devra aussi etre envoyé dans le fichier rdv_medecin_alt.php)
$id_medecin = $_GET['id_medecin'];


echo "L'id dans rdv_medecin: ".$id_medecin;

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
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <img src="../Omnes-Sante/images/logo.png" width="80" height="80" style="position: relative;" />
                    <label id="bigtitre" style="color: blue; font-size: 30px;"><b>Omnes Santé &emsp; </b></label> <br><br>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                                <a class="nav-link dropdown-toggle" href="parcourir.html" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                                <a class="nav-link dropdown-toggle" href="parcourir.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Compte
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="menu.html">Déconnexion</a>
                                    </li>
                                </ul>
                            </li>
                    </div>
                </div>
            </nav>
        </div>





        <br><br>
        <br><br>
        <br><br>
        <h1 id="titre"><b>Calendrier du médecin choisi</b></h1>
        <br><br>
        <table class="table table-hover">
            <tr>
                <th></th>
                <th>Date</th>
                <th>Heure</th>
            </tr>
            <?php
            if ($db_found) {
                $sql1 = "SELECT * FROM reservation_client_medecin WHERE fk_medecin='$id_medecin'";
                $result1 = mysqli_query($db_handle, $sql1);
                while ($data1 = mysqli_fetch_assoc($result1)) {

                    echo "<tr>";
                    echo  "<td>" . $data1['id_client_medecin'] .  "</td>";
                    echo " <td >" . $data1['date'] . "</td>";
                    echo  "<td>" . $data1['heure'] .  "</td>";
                } //end while

            }
            //si le BDD n'existe pas
            else {
                echo "Database not found";
            } //end else

            ?>
        </table>
        <form action="rdv_medecin_alt.php" method="post">
            <table>
                </tr>
                <input type="text" id="id_medecin" name="id_medecin" value= <?php echo $id_medecin?> hidden>
                <tr>
                <tr>
                    <td>Date: </td>
                    <td> <input type="date" id="date" name="date" required></td>
                </tr>
                <tr>
                    <td>Heure: </td>
                    <td> <input type="time" id="heure" name="heure" step="1800" min="08:00" max="17:00" value="08:00" required></td>
                </tr>

            </table>
            <div>
                <input type="submit" name="button_rdv_medecin" value="Valider">
            </div>

        </form>
    </div>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>

</body>

</html>