<?php

session_start();
$id_client=$_SESSION['id_client'];
$nom_du_client=$_SESSION['nom_client'];
$prenom_du_client=$_SESSION['prenom_client'];

$type_carte = isset($_POST["type_carte"])? $_POST["type_carte"] : "";
$numero = isset($_POST["numero"])? $_POST["numero"] : "";
$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$code = isset($_POST["code"])? $_POST["code"] : "";
$date = isset($_POST["date"])? $_POST["date"] : "";


$type=$_SESSION['type'];
$separate=explode(' ', $type);

$date_rdv_med=$separate[0];
$heure_rdv_med=$separate[1];

$id_medecin=0;
$id_examen=0;
if ($_SESSION['bool_examen_medecin'] == 0) {
    $id_medecin = $_SESSION['id_rdv_medecin'];
}

if ($_SESSION['bool_examen_medecin'] == 1) {
    $id_examen = $_SESSION['id_rdv_examen'];
}

$database = "omnes_sante";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

if (isset($_POST["button_payement"])) {
    if ($db_found) {
        //commencer le query{
        $sql = "SELECT * FROM carte_banquaire";
        if ($type_carte != "") {
            //on recherche l'utilisateur par son email
            $sql .= " WHERE type = '$type_carte'";
            //on vérifie que le mdp est correct
            if ($numero != "") {
                $sql .= " AND numero = '$numero'";

                if($nom!= ""){
                    $sql .= " AND nom = '$nom'";

                    if($code!=""){
                        $sql .= " AND code = '$code'";

                        if($date!=""){
                            $sql .= " AND date = '$date'";
                        }
                    }
                }
            }
        }
        $result = mysqli_query($db_handle, $sql);
        if (mysqli_num_rows($result) == 0) {
            header('Location: payement.php');
            die;
        } 
        else {
            while ($data = mysqli_fetch_assoc($result)) {
                $ID_carte=$data['id_carte'];
                $solde=$data['solde'];
                $nouveau_solde=$solde-30;
                $sql1 = "UPDATE carte_banquaire SET solde='$nouveau_solde' WHERE id_carte='$ID_carte'";
                $resultat1 = mysqli_query($db_handle, $sql1);

                if ($_SESSION['bool_examen_medecin'] == 0) {
                    $sql2 = "INSERT INTO reservation_client_medecin(fk_client, fk_medecin, date, heure) VALUES ('$id_client','$id_medecin', '$separate[0]','$separate[1]' )";
                    $resultat2 = mysqli_query($db_handle, $sql2);
                }

                if ($_SESSION['bool_examen_medecin'] == 1) {
                    $sql2 = "INSERT INTO reservation_client_examen(fk_client, fk_examen, date, heure) VALUES ('$id_client','$id_examen', '$separate[0]','$separate[1]' )";
                    $resultat2 = mysqli_query($db_handle, $sql2);
                }
                
                $_SESSION['id_rdv_client']=$id_client;  
                $_SESSION['date_rdv_medecin']=$date_rdv_med;
                $_SESSION['heure_rdv_medecin']=$heure_rdv_med;
                $_SESSION['id_rdv_medecin']=$id_medecin;  

                echo ' <script> alert("Payment éffectué");
                window.location = "http://localhost/PJ_WEB_2022-Abdelkefi_Carissan_Galiazzo_deLaVillardiere/omnes-sante/email.php" </script>';
            }
        }
        
    } else {
        echo "<p>Database not found.</p>";
    }
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
        Omnes Santé connexion
    </title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/menu.css " rel="stylesheet" type="text/css" />
</head>

<!--Affichage-->
<body>
    <form action="payement.php" method="post">
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
    
        <div id="input">
            <table class="center">
                <h1 id="titre"><b>Payement</b> </h1>
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
                    <td>
                        <label><br></label>
                    </td>
                </tr>
                <tr>
                    <td><label>Numero de carte de crédit : </label></td>
                    <td><input type="text" id="numero" name="numero" required></td>
                </tr>
                <tr>
                    <td><label>Nom : </label></td>
                    <td><input type="text" id="nom" name="nom" required></td>
                </tr>
                <tr>
                    <td><label>Code (à 3 chifre) : </label></td>
                    <td><input type="password" id="code" name="code" required></td>
                </tr>
                <tr>
                    <td><label>Date : </label></td>
                    <td><input type="date" id="date" name="date" required></td>
                </tr>

                <th colspan="2"><a href="nvl_carte.php"><label name="nvl_carte" style="font-size: 12px ;color: black;"> <u>Enregistrer une catre</u> </label></a></th>
                <tr>
                    <td>
                        <label><br></label>
                    </td>
                </tr>
                
                <th colspan="2"><button type="submit" name="button_payement" style="font-size: 25px; margin-left: 33%; border-radius: 5px;"> Se connecter </button></th>
            </table>
        </div>
    </div>
    </form>



    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
