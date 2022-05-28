<?php
//Ordre Décroissant
echo "<meta charset=\"utf-8\">";
//identifier votre BDD
$database = "omnes_sante";

$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

//declaration des variables
$id_medecin = $_GET['id_medecin'];
$nom = $_GET['nom'];
$prenom= $_GET['prenom'];
$erreur = "";

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
    <div id="header">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <img src="../Omnes-Sante/images/logo.png" width="80" height="80" style="position: relative;" />
                <label id="bigtitre" style="color: blue; font-size: 30px;"><b>Omnes Santé &emsp; </b></label>
                <br><br>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
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
                            <a class="nav-link dropdown-toggle" href="clientParcourir.html" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                            <a class="nav-link" aria-current="page" href="chatroom.php">Chatroom</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="clientParcourir.php" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Compte
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="clientModification.php">Mon Compte</a>
                                </li>
                                <li><a class="dropdown-item" href="clientHistorique.php">Mon Historique</a>
                                </li>
                                <li><a class="dropdown-item" href="clientAnnuler.php">Annuler un rendez vous</a>
                                </li>
                                <li><a class="dropdown-item" href="menu.html">Déconnexion</a>
                                </li>
                            </ul>
                        </li>
                        &emsp;
                        <li class="navbar-expand-lg" style="line-height: 0px;">
                            <img src="../Omnes-Sante/images/unknown.png" width="60" height="60"
                                style="position: absolute; top: 18px;" />
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
    <br><br><br><br>
    <h1 id="titre"><b>Saisir le contenue de votre mail </b></h1>
    <br><br>
    <h3><b>Objet</b><h3>
    <?php
     echo '<form action="emailClient.php" method="post">
     <input type="text" id="nom_client" name="nom_client" value=' . $nom . ' hidden>
     <input type="text" id="prenom_client" name="prenom_client" value=' . $prenom . ' hidden>
     <input type="text" id="id_medecin" name="id_medecin" value=' . $id_medecin . ' hidden>
     
     <td><input type="text" id="objet" name="objet" required></td>
     <br><br>
    <h3><b>Enoncé</b><h3>
    <td><input type="text" style="height: 30%; width:60%" id="enonce" name="enonce" required></td>
    <br><br><br>
    <button type="submit" name="envoie_mail" style="font-size: 25px; margin-left: 80%; border-radius: 5px;"> Valider </button>
     </form>';
    ?>

    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>