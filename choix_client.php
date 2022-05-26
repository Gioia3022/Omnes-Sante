<?php
//Ordre Décroissant
echo "<meta charset=\"utf-8\">";
//identifier votre BDD
$database = "omnes_sante";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Omnès santé modif médecin
    </title>


    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="" rel="stylesheet" type="text/css" />
    <link href="css/menu.css " rel="stylesheet" type="text/css" />
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
                            <a class="nav-link" aria-current="page" href="menuAdmin.php">Accueil</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="parcourir.html" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Médecins
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="ajout_medecin.html">Ajouter un médecin</a>
                                </li>
                                <li><a class="dropdown-item" href="choix_medcin.php">Modifier un médecin</a>
                                </li>
                                <li><a class="dropdown-item" href="suppression_medecin.php">Supprimer un médecin</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="parcourir.html" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Clients
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="choix_client.php">Modifier un client</a>
                                </li>
                                <li><a class="dropdown-item" href="suppression_client.php">Supprimer un client</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="parcourir.html" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Examens
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="ajout_examen.html">Ajouter un examen</a>
                                </li>
                                <li><a class="dropdown-item" href="suppression_examen.php">Supprimer un examen</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="parcourir.php" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Compte 
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="adminCompte.html">Mon Compte</a>
                                </li>
                                <li><a class="dropdown-item" href="menu.html">Déconnexion</a>
                                </li>
                            </ul>
                        </li>
                        &emsp;
                        <li class="navbar-expand-lg" style="line-height: 0px;">
                            <img src="../Omnes-Sante/images/unknown.png" width="60" height="60" style="position: absolute; top: 18px;"/>
                            <p style="font-size: 15px;"> &emsp;&emsp;&emsp;&emsp;&emsp; de La Villardiere</p>
                            <p style="font-size: 15px; ">&emsp;&emsp;&emsp;&emsp;&emsp; Diego</p>
                            <p style="font-size: 10px; color: blue;">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Administrateur connecté</p>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    
    <br><br>  
    <br><br>
    <br><br>
    <h1 id="titre"><b>Modifier un client</b> </h1>
    <br><br>
        <table class="table table-hover">
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Adresse</th>
            </tr>
            <?php
            if ($db_found) {
                $sql1 = "SELECT * FROM Client";
                $result1 = mysqli_query($db_handle, $sql1);
                while ($data1 = mysqli_fetch_assoc($result1)) {
                    
                    echo "<tr>";
                    echo  "<td>" . $data1['id_client'] .  "</td>";
                    echo " <td class=nav-item><a class=nav-link href=modification_client.php?id_modif_client=" . $data1['id_client'] . ">" . $data1['nom'] . "</a></td>";
                    echo  "<td>" . $data1['prenom'] .  "</td>";
                    echo " <td>" . $data1['telephone'] .  "</td>";
                    echo  "<td>" . $data1['email'] .  "</td>";
                    echo  "<td>" . $data1['adresse'] . "</td>";
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
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>

</body>

</html>