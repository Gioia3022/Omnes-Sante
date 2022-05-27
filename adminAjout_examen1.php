<?php
session_start();
echo "<meta charset=\"utf-8\">";
$id_administrateur = $_SESSION['id_admin'];
$database = "omnes_sante";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found) {
    //commencer le query
    $sql = "SELECT * FROM admin WHERE id_admin= '$id_administrateur' ";

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
            $telephone = $data['telephone'];
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
        Omnès santé ajout examen
    </title>


    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="" rel="stylesheet" type="text/css" />
    <link href="css/ajout_examen.css " rel="stylesheet" type="text/css" />
</head>

<body>
    <form action="adminAjout_examen.php" method="post">
        <div id="header" style="height: 0px; font-size: 20px; width: 100%;">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <img src="../Omnes-Sante/images/logo.png" width="80" height="80" style="position: relative;" />
                    <label id="bigtitre" style="color: blue; font-size: 30px;"><b>Omnes Santé &emsp; </b></label> <br><br>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    </button>
                    <div class="collapse navbar-collapse justify-content_between" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="adminMenu.php">Accueil</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="parcourir.html" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Médecins
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="adminAjout_medecin1.php">Ajouter un médecin</a>
                                    </li>
                                    <li><a class="dropdown-item" href="adminChoix_medcin.php">Modifier un médecin</a>
                                    </li>
                                    <li><a class="dropdown-item" href="adminSuppression_medecin.php">Supprimer un médecin</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="parcourir.html" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Clients
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="adminChoix_client.php">Modifier un client</a>
                                    </li>
                                    <li><a class="dropdown-item" href="adminSuppression_client.php">Supprimer un client</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="parcourir.html" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Examens
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="adminAjout_examen1.php">Ajouter un examen</a>
                                    </li>
                                    <li><a class="dropdown-item" href="adminSuppression_examen.php">Supprimer un examen</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="menu.html">Déconnexion</a>
                            </li>
                            &emsp;
                            <li class="navbar-expand-lg" style="line-height: 0px;">
                                <img src="../Omnes-Sante/images/unknown.png" width="60" height="60" style="position: absolute; top: 18px;" />
                                <p style="font-size: 15px;"> &emsp;&emsp;&emsp;&emsp;&emsp; <?php echo $nom ?></p>
                                <p style="font-size: 15px; ">&emsp;&emsp;&emsp;&emsp;&emsp; <?php echo $prenom ?></p>
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
        <h1 id="titre"><b>Ajouter un examen</b></h1>
        <br><br>
        <div id="input">

            <table class="center">
                <tr>
                    <td>Laboratoire :</td>
                    <td><select name="id_lab" required>
                            <option></option>
                            <option value="1" name="1">Gueri</option>
                            <option value="2" name="2">Necker</option>
                        </select>

                </tr>

                <tr>
                    <td>Type d'examen :</td>
                    <td><select name="type_examen" required>
                            <option></option>
                            <option value="depistage covid-19" name="depistage covid-19">Dépistage covid-19</option>
                            <option value="biologie preventive" name="biologie preventive">Biologie préventive</option>
                            <option value="biologie de la femme enceinte" name="biologie de la femme enceinte">Biologie de la femme enceinte</option>
                            <option value="biologie de routine" name="biologie de routine">Biologie de routine</option>
                            <option value="cancerologie" name="cancerologie">Cancérologie</option>
                            <option value="gynecologie" name="gynecologie">Gynécologie</option>
                        </select>
                </tr>
                <tr>
                    <td> <br><br></td>
                </tr>
                <th colspan="2"><input type="submit" value="Valider" name="button_ajout_examen" style="font-size: 25px; margin-left: 33%; border-radius: 5px; background-color: blue; color: white; border-color: transparent; "></th>
            </table>
        </div>

    </form>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>