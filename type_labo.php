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
    <link href="css/recherche_examen.css " rel="stylesheet" type="text/css" />
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
    <div>
        
            <?php
$ID = $_GET['id_examen'];

//identifier le nom de base de données
$database = "omnes_sante";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
//si le BDD existe, faire le traitement

if ($db_found) {
    //commencer le query
    $sql = "SELECT * FROM Examen WHERE id_examen= '$ID' ";
    $result = mysqli_query($db_handle, $sql);
    //regarder s'il y a des resultat
     while ($data = mysqli_fetch_assoc($result)) {
        $sql2= "SELECT * FROM laboratoire WHERE id_laboratoire=" . $data['fk_laboratoire'];
        $result2 = mysqli_query($db_handle, $sql2);
        $data2 = mysqli_fetch_assoc($result2);
        //saisir les données du  formulaires
        $type_examen = $data['type_examen'];
        $nom = $data2['nom'];
        $adresse = $data2['adresse'];
        $ville = $data2['ville'];
        $salle = $data2['salle'];
        $email = $data2['email'];
        $telephone = $data2['telephone'];

        echo "<br><br><br><br><br>" ;
        echo  $type_examen. "<br>" ;
        echo  $nom. "<br>" ;
        echo  $adresse. "<br>" ;
        echo  $ville. "<br>" ;
        echo  $salle. "<br>" ;
        echo  $email. "<br>" ;
        echo  $telephone. "<br>" ;

            
        }
    }
 else {
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