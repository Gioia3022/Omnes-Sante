<?php
$id_client = $_GET['id_modif_client'];



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
        Omnes Santé
    </title>


    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/modification_medecin.css " rel="stylesheet" type="text/css" />
</head>


<body>
    <div id="margin" style="background-color: rgb(250, 250, 250); width: 100%; height: 80px ; position: absolute; top: 0px ;"> <br><a class="navbar-brand" href="#"><img src="../Omnes-Sante/images/logo.png" width="80" height="80" style="object-position: 10px -25px ;" /></a></div>

    <div id="header" style="font-size: 20px; width: 100%;">
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
    <div id="wrapper">
        <?php
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


                    echo '<form action="adminModification_cli_alt.php" method="post" enctype="multipart/form-data">

<table class="table table-hover">
    <h1 id="titre">Nouvelles informations:</h1>
    <input type="text" id="id_client" name="id_client" value=' . $id_client . ' hidden>
    <tr>
        <td>Nom:</td>
        <td><input type="text" id="nom" name="nom" value=' . $nom . ' required></td>
    </tr>

    <tr>
        <td>Prenom:</td>
        <td><input type="text" id="prenom" name="prenom" value=' . $prenom . ' required></td>
    </tr>
    
    <tr>
        <td>Username :</td>
        <td><input type="text" id="username" name="username" value=' . $username . ' required></td>
    </tr>

    <tr>
        <td>Password :</td>
        <td><input type="password" id="password" name="password" value=' . $password . ' required></td>
    </tr>

   

    <tr>
        <td>email :</td>
        <td><input type="email" id="email" name="email" value=' . $email . '  required></td>
    </tr>

    <tr>
        <td>date de naissance :</td>
        <td><input type="date" id="date_naissance" name="date_naissance" value=' . $date_naissance . '  required></td>
    </tr>


    <tr>
        <td>telephone :</td>
        <td><input type="tel" id="telephone" name="telephone" value=' . $telephone . ' required></td>
    </tr>

    <tr>
        <td>photo :</td>
        <td><input type="file" id="photo" name="photo" value=' . $photo . ' ></td>
    </tr>

    <tr>
        <td>adresse :</td>
        <td><input type="text" id="adresse" name="adresse" value=' . $adresse . ' ></td>
    </tr>

    <tr>
        <td>ville :</td>
        <td><input type="text" id="ville" name="ville" value=' . $ville . ' required></td>
    </tr>


    <tr>
        <td>code postal :</td>
        <td><input type="text" id="code_postal" name="code_postal" value=' . $code_postal . ' ></td>
    </tr>

    <tr>
        <td>pays :</td>
        <td><input type="text" id="pays" name="pays" value=' . $pays . ' required></td>
    </tr>

    <tr>
        <td>carte vitale :</td>
        <td><input type="text" id="carte_vitale" name="carte_vitale" value=' . $carte_vitale . ' ></td>
    </tr>


</table>


<div>
    <button type="submit" class="btn btn-primary" name="button_modification_client">Valider</button>
</div>

</form>';
                }
            }
        } else {
            echo "<p>Database not found.</p>";
        }

        //header("Refresh:0");



        ?>


    </div>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>

</body>





</html>