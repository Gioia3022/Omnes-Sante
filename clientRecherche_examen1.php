<?php
    session_start();
    $id_client=$_SESSION['id_client'];
    $database = "omnes_sante";
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

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
<!--Dependency et Proprietés-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/connexion.css" rel="stylesheet" type="text/css" />

    <!-- Titre de la page-->
    <title>
        Omnes Santé recherche
    </title>

    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/menu.css " rel="stylesheet" type="text/css" />
</head>
<!--Affichage-->

<body>
    <form action="clientRecherche_examen.php" method="post">
        <div id="header" style="height: 0px; font-size: 20px; width: 100%;">
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
                                <li><a class="dropdown-item" href="clientAnnuler.php">Rendez vous</a>
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
        <div id="input">
            <table class="center">
                <h1 id="titre"><b>Recherche laboratoire</b> </h1>
                <tr>
                    <td>
                        <label><br></label>
                    </td>
                </tr>
                <tr>
                    <td>Laboratoire :</td>
                    <td><select name="id_lab">
                            <option></option>
                            <option value="1" name="1">Gueri</option>
                            <option value="2" name="2">Necker</option>
                        </select>

                </tr>

                <tr>
                    <td>
                        <label><br></label>
                    </td>
                </tr>

                <tr>
                    <td>Type d'examen :</td>
                    <td><select name="type_examen">
                            <option></option>
                            <option value="depistage covid-19" name="depistage covid-19">Dépistage covid-19</option>
                            <option value="biologie preventive" name="biologie preventive">Biologie préventive</option>
                            <option value="biologie de la femme enceinte" name="biologie de la femme enceinte">Biologie
                                de la femme enceinte</option>
                            <option value="biologie de routine" name="biologie de routine">Biologie de routine</option>
                            <option value="cancerologie" name="cancerologie">Cancérologie</option>
                            <option value="gynecologie" name="gynecologie">Gynécologie</option>
                        </select>
                </tr>
                <tr>
                    <td>
                        <label><br><br></label>
                    </td>
                </tr>
                <th colspan="2"><button type="submit" name="button_recherche_examen"
                        style="font-size: 25px; margin-left: 33%; border-radius: 5px;">Valider</button></th>
            </table>

        </div>
        </div>
    </form>
</body>
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

</html>