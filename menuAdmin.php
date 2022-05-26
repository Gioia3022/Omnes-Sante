<?php
//Ordre Décroissant
echo "<meta charset=\"utf-8\">";
//identifier votre BDD
$database = "omnes_sante";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

//declaration des variables
$ID = isset($_POST["id_admin"]) ? $_POST["id_admin"] : "";
$nom = isset($_POST["nom_admin"]) ? $_POST["nom_admin"] : "";
$prenom = isset($_POST["prenom_admin"]) ? $_POST["prenom_admin"] : "";
$email = isset($_POST["email_admin"]) ? $_POST["email_admin"] : "";
$username = isset($_POST["username_admin"]) ? $_POST["username_admin"] : "";
$telephone = isset($_POST["telephone_admin"]) ? $_POST["telephone_admin"] : "";
$erreur = "";

if ($db_found) {
if (isset($_POST["button_menuAdmin"])) {
echo "<tr>";
echo  "<td>" . $ID .  "</td>";
echo " <td>". $nom  . "</td>";
echo  "<td>" . $prenom .  "</td>";
echo " <td>" . $email .  "</td>";
echo  "<td>" . $username .  "</td>";
echo  "<td>" . $telephone . "</td>";
echo "</tr>";
}
}
else {
    echo "<p>Database not found.</p>";
}
?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Omnès santé Menu Admin
    </title>


    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="" rel="stylesheet" type="text/css" />
    <link href="css/menu.css " rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="margin" style="background-color: rgb(250, 250, 250); width: 100%; height: 80px ; position: absolute; top: 0px ;"> <br><a class="navbar-brand" href="#"><img src="../Omnes-Sante/images/logo.png" width="80" height="80" style="object-position: 10px -25px ;"/></a></div>
    <div id="wrapper">
        <div id="header" style="background-color: rgb(250, 250, 250); height: 80px ; top: 0px ; font-size: 20px;">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
                    <label id="bigtitre" style="color: blue; font-size: 30px;"><b>Omnes Santé &emsp; </b></label> <br><br>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
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
                                <a class="nav-link dropdown-toggle" href="parcourir.html" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
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
                                <a class="nav-link dropdown-toggle" href="parcourir.php" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Compte
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="connexion.html">Connexion</a>
                                    </li>
                                    <li><a class="dropdown-item" href="inscription.html">Créer un compte</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class=row>
        <h2 id="titre">Gestions du personel médical: </h2>
        <form method="post">
        <div>
            <input type="submit" value="Ajouter un médecin" name="button_ajout_medecin" formaction="ajout_medecin.html">
            <br><br>       
            <input type="submit" value="Modifier un médecin" name="button_modification_medecin" formaction="choix_medcin.php">
            <br><br>
            <input type="submit" value="Suprimer un medecin" name="button_modification_client" formaction="choix_client.php">
            <br><br>
        </div>
        <h2 id="titre">Gestions des clients: </h2>
        <form method="post">
        <div>
            <input type="submit" value="Modifier un client" name="button_modification_client" formaction="choix_client.php">
            <br><br>
            
            <input type="submit" value="Suprimer un client" name="button_modification_client" formaction="choix_client.php">
            <br><br>
        </div>
        <h2 id="titre">Gestions des examens: </h2>
        <form method="post">
        <div>
            <input type="submit" value="Ajouter un examen" name="ajout_examen.html" formaction="choix_client.php">
            <br><br>
            <input type="submit" value="Modifier un examen" name="button_modification_client" formaction="choix_client.php">
            <br><br>
            <input type="submit" value="Suprimer un examen" name="button_modification_client" formaction="choix_client.php">
        </div> 
        
            <script src="js/bootstrap.js"></script>
            <script src="js/bootstrap.bundle.min.js"></script>
        </form>
    </div>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>

</body>

</html>                    