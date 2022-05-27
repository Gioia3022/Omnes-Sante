<?php
$ID = $_GET['id_medecin'];

//identifier le nom de base de données
$database = "omnes_sante";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
//si le BDD existe, faire le traitement

if ($db_found) {
    //commencer le query
    $sql = "SELECT * FROM Medecin WHERE id_medecin= '$ID' ";
    $result = mysqli_query($db_handle, $sql);
    //regarder s'il y a des resultat
     while ($data = mysqli_fetch_assoc($result)) {
        //saisir les données du  formulaires
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
    }
 else {
    echo "<p>Database not found.</p>";
}

//header("Refresh:0");
?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Omnes Santé Recherche Examen
    </title>


    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="" rel="stylesheet" type="text/css" />
    <link href="css/type_medecin.css " rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="header" style="height: 30px; font-size: 20px; width: 100%;">
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
                                <li><a class="dropdown-item" href="connexion.html">Connexion</a>
                                </li>
                                <li><a class="dropdown-item" href="inscription.html">Inscription</a>
                                </li>
                            </ul>
                        </li>
                </div>
            </div>
        </nav>
    </div>
    <div class="profil">
        <h1 style = "font-family: Georgia, 'Times New Roman', Times, serif;text-align: center;color: blue;background-color: white;padding-top: 10%;"><b>Informations complémentaires</b></h1>
        <br><br>
        <?php echo '<img src=../Omnes-Sante/images/'. $image . ' height="240" width="200" > ';?>

        <table class="center">
            <tr>
                <td><label><b>Nom : </b> Dr <?php echo  $nom. "<br>" ; ?></td>
            </tr>
            <tr>
                <td><label><b>Prenom : </b> <?php echo  $prenom. "<br>" ; ?></td>
            </tr>
            <tr>
                <td><b>Genre : </b> <?php echo  $genre. "<br>" ; ?></td>
            </tr>
            <tr>
                <td><b>Date de naissance : </b> <?php echo  $date_naissance. "<br>" ; ?></td>
            </tr>
            <tr>
                <td><b>Médecine : </b> <?php echo  $type_medecin. "<br>" ; ?></td>
            </tr>
            <tr>
                <td><b>CV : </b> <?php echo  $CV. "<br>" ; ?></td>
            </tr>
            <tr>
                <td><b>Email : </b> <?php echo  $email. "<br>" ; ?></td>
            </tr>
            <tr>
                <td><b>Telephone : </b> <?php echo  $telephone. "<br>" ; ?></td>
            </tr>

            <tr>
                <td><b>Adresse cabinet : </b> <?php echo  $cabinet. "<br>" ; ?></td>
                
            </tr>
        </table>
    </div>

    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>

</body>


</html>