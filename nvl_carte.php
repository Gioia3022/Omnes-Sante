<?php
//identifier le nom de base de données
$database = "omnes_sante";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
//si le BDD existe, faire le traitement
session_start();
$id_client=1;//=$_SESSION['id_client'];
$type = isset($_POST["type_carte"])? $_POST["type_carte"] : "";
$numero = isset($_POST["numero"])? $_POST["numero"] : "";
$code = isset($_POST["code"])? $_POST["code"] : "";
$date = isset($_POST["date"])? $_POST["date"] : "";

if (isset($_POST["button_nvl"])) {

if ($db_found) {
    $sql1="SELECT nom FROM Client Where id_client='$id_client'";
    $result1=mysqli_query($db_handle, $sql1);
    $data1 = mysqli_fetch_assoc($result1);
    $nom_client=$data1['nom'];
    $sql = "INSERT INTO carte_banquaire(fk_client, solde, type, numero,  nom, code, date)";
    $sql=$sql ." VALUES ( '$id_client', 3000,'$type', '$numero', '$nom_client', '$code', '$date')";
    $result =mysqli_query($db_handle, $sql);
    echo ' <script> alert("Carte enregistré");
    window.location = "http://localhost/PJ_WEB_2022-Abdelkefi_Carissan_Galiazzo_deLaVillardiere/omnes-sante/payement.php" </script>';
                   
} //end if
//si le BDD n'existe pas
else {
    echo "Database not found";
} //end else
//fermer la connection
mysqli_close($db_handle);
}
?>



<html>
    <!--Dependency et Proprietés-->
    <head> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/inscription.css" rel="stylesheet" type="text/css" />
        <!-- Titre de la page-->
        <title>
            Omnes Santé inscription client
        </title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/menu.css " rel="stylesheet" type="text/css" />
    </head>
    <!--Affichage-->
    <body>
        <form action="nvl_carte.php" method="post" enctype="multipart/form-data">
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
                                        <li><a class="dropdown-item" href="inscription.html">Inscription</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="input">
                <h1 id="titre"><b>Enregistrer une catre</b></h1>
                <table class="center">
                    <tr>
                        <td>
                            <label><br></label>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="type_carte">Type de carte:</label></td>
                        <td><select name="type_carte" id="type_carte" multiple required>
                            <option value="Visa">Visa</option>
                            <option value="MasterCard">MasterCard</option>
                            <option value="AmericanExpress">American Express</option>
                            <option value="PayPal">PayPal</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label><br></label></td>
                    </tr>
                    <tr>
                        <td><label>Numero de carte de crédit : </label></td>
                        <td><input type="text" id="numero" name="numero" required></td>
                    </tr>
                    <tr>
                    <tr>
                    <td><label>Code (à 3 chifre) : </label></td>
                    <td><input type="password" id="code" name="code" required></td>
                    </tr>
                    <tr>
                    <td><label>Date : </label></td>
                    <td><input type="date" id="date" name="date" required></td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label><br></label>
                        </td>
                    </tr>
                    <th colspan="2"><button type="submit" name="button_nvl" style="font-size: 25px; margin-left: 33%; border-radius: 5px;"> Valider </button></th>
                </table>
            </div>
        </div>
    </form>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>