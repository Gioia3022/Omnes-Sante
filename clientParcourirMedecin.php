<?php
session_start();
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
$id_client = $_GET['id_client'];
    $sql2 = "SELECT * FROM Client WHERE id_client= '$id_client' ";
    $result2 = mysqli_query($db_handle, $sql2);
    $data2 = mysqli_fetch_assoc($result2);
    $nom_client = $data2['nom'];
    $prenom_client = $data2['prenom'];
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
    <link href="css/medecinProfil.css " rel="stylesheet" type="text/css" />


    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

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
                        <img src="../Omnes-Sante/images/<?php if (empty($photo)){ echo 'unknown.png';} else { echo $photo;}?>" 
                                width="60" height="60" style="position: absolute; top: 18px;" />
                            <p style="font-size: 15px;"> &emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $nom_client ?></p>
                            <p style="font-size: 15px; ">&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $prenom_client ?></p>
                            <p style="font-size: 10px; color: blue;">
                                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Client connecté</p>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="box">
        <table class="table table-hover">
            <h1 id="titre"><b>Liste des médecins </b></h1>
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
                    echo " <td class=nav-item><a class=nav-link href=clientParcourirMedecin.php?id_medecin=" . $data1['id_medecin'] . "&id_client=".$id_client. ">" . $data1['nom'] . "</a></td>";
                    echo " <td class=nav-item><a class=nav-link href=clientParcourirMedecin.php?id_medecin=" . $data1['id_medecin'] . "&id_client=".$id_client.">" . $data1['prenom'] . "</a></td>";
                    echo " <td class=nav-item><a class=nav-link href=clientParcourirMedecin.php?id_medecin=" . $data1['id_medecin'] . "&id_client=".$id_client.">" . $data1['type_medecin'] . "</a></td>";
                    echo " <td class=nav-item><a class=nav-link href=clientParcourirMedecin.php?id_medecin=" . $data1['id_medecin'] . "&id_client=".$id_client.">" . $data1['email'] . "</a></td>";
                    echo " <td class=nav-item><a class=nav-link href=clientParcourirMedecin.php?id_medecin=" . $data1['id_medecin'] ."&id_client=".$id_client. ">" . $data1['cabinet'] . "</a></td>";
                    /*
                    echo  "<td>" . $data1['prenom'] .  "</td>";
                    echo " <td>" . $data1['type_medecin'] .  "</td>";
                    echo  "<td>" . $data1['email'] .  "</td>";
                    echo  "<td>" . $data1['cabinet'] . "</td>";*/
                    echo "</tr>";
                } //end while
            }
            //si le BDD n'existe pas
            else {
                echo "Database not found";
            } //end else

            ?>
        </table>
        <br>
        <h1 id="titre"><b>Liste des examens</b></h1>
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
                    echo " <td class=nav-item><a class=nav-link href=clientParcourirLabo.php?id_examen=" . $data3['id_examen']. "&id_client=".$id_client . ">" . $data3['type_examen'] . "</a></td>";
                    echo " <td class=nav-item><a class=nav-link href=clientParcourirLabo.php?id_examen=" . $data3['id_examen']. "&id_client=".$id_client . ">" . $data4['nom'] . "</a></td>";
                    echo " <td class=nav-item><a class=nav-link href=clientParcourirLabo.php?id_examen=" . $data3['id_examen']. "&id_client=".$id_client . ">" . $data4['adresse'] . "</a></td>";
                    echo " <td class=nav-item><a class=nav-link href=clientParcourirLabo.php?id_examen=" . $data3['id_examen']. "&id_client=".$id_client . ">" . $data4['email'] . "</a></td>";
                    echo " <td class=nav-item><a class=nav-link href=clientParcourirLabo.php?id_examen=" . $data3['id_examen']. "&id_client=".$id_client . ">" . $data4['telephone'] . "</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "Database not found";
            }
            ?>
        </table>

    </div>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <?php
    $ID = $_GET['id_medecin'];
    if ($db_found) {
        //commencer le query
        $sql = "SELECT * FROM Medecin WHERE id_medecin= '$ID' ";
        $result = mysqli_query($db_handle, $sql);
        //regarder s'il y a des resultat
        while ($data = mysqli_fetch_assoc($result)) {
            $nom = $data['nom'];
            $prenom = $data['prenom'];
            $type_medecin = $data['type_medecin'];
            $email = $data['email'];
            $date_naissance = $data['date_naissance'];
            $genre = $data['genre'];
            $telephone = $data['telephone'];
            $image = $data['photo'];
            $cabinet = $data['cabinet'];
            $CV = $data['cv'];
        }
    } else {
        echo "<p>Database not found.</p>";
    } 
    $id_medecin = $_GET['id_medecin'];
    
    mysqli_close($db_handle);
    ?>
    <div class="overlay ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-radius: 16px;">
                            <div class="well profile col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                    <figure>
                                        <img src="http://www.localcrimenews.com/wp-content/uploads/2013/07/default-user-icon-profile.png" alt="" class="img-circle" style="width:75px;" id="user-img">
                                    </figure>
                                    <h5 style="text-align:center;"><strong id="user-name"><?php echo  $nom . "<br>"; ?></strong></h5>
                                    <p style="text-align:center;font-size: smaller;" id="user-frid"><?php echo  $prenom . "<br>"; ?> </p>
                                    <p style="text-align:center;font-size: smaller;"><strong>Spécialité : </strong><span class="tags" id="user-status"><?php echo  $type_medecin . "<br>"; ?></span></p>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 divider text-center"></div>
                                    <p style="text-align:center;font-size: smaller;overflow-wrap: break-word;" id="user-email"><?php echo  $email . "<br>"; ?> </p>
                                    <p style="text-align:center;font-size: smaller;"><strong><?php echo  $telephone . "<br>"; ?></strong></p>
                                    <p style="text-align:center;font-size: smaller;" id="user-role">Cabinet : <?php echo  $cabinet . "<br>"; ?></p>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 divider text-center"></div>
                                    <div class=" col-lg-12 left" style="text-align:center;overflow-wrap: break-word;">
                                        <h4>
                                            <p style="text-align: center;"><strong id="user-college-rank">30 $</strong></p>
                                        </h4>
                                        <p> <small class="label label-warning">Prix</small></p>
                                        <!-- <button class="btn btn-info btn-block"><span class="fa fa-user"></span> View Profile </button>-->
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 divider text-center"></div>
                                    <div class="col-lg-6 left" style="text-align:center;overflow-wrap: break-word;">
                                    <a class="btn btn-primary"href="clientParcourir.php" style="background-color:red;">Annuler</a>
                                    </div>
                                    <div class=" col-lg-6 left" style="text-align:center;overflow-wrap: break-word;">
                                    <a class="btn btn-primary" href="rdv_medecin.php?id_medecin=<?php echo $id_medecin ;?>&id_client=<?php echo $id_client; ?>">Reserver</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>