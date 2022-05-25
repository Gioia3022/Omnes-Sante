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
        <?php

session_start();

$id_medecin = 1;
//identifier le nom de base de données
$database = "omnes_sante";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
//si le BDD existe, faire le traitement

if ($db_found) {
    //commencer le query
    $sql = "SELECT * FROM Medecin WHERE id_medecin= '$id_medecin' ";

    $result = mysqli_query($db_handle, $sql);
    //regarder s'il y a des resultats
    if (mysqli_num_rows($result) == 0) {
        echo "<p>Ce medecin n'existe pas</p>";
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
            $cv = $data['cv'];
            $cabinet = $data['cabinet'];


            echo '<form action="modification_medecin.php" method="post">

<table class="table table-hover">
    <tr> 
        <h2>Nouvelles informations:</h2>
    </tr>  
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
        <td><input type="text" id="photo" name="photo" value=' . $photo . ' ></td>
    </tr>

    <tr>
        <td>cv :</td>
        <td><input type="text" id="cv" name="cv" value=' . $cv . ' ></td>
    </tr>

    <tr>
        <td>salle de cabinet :</td>
        <td><input type="text" id="cabinet" name="cabinet" value=' . $cabinet . ' required></td>
    </tr>

</table>


<div>
    <button type="submit" class="btn btn-primary" name="button_modification_medecin">Valider</button>
</div>

</form>';

            if (isset($_POST["button_modification_medecin"])) {
                //saisir les données du  formulaires
                $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
                $prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
                $username = isset($_POST["username"]) ? $_POST["username"] : "";
                $password = isset($_POST["password"]) ? $_POST["password"] : "";
                $email = isset($_POST["email"]) ? $_POST["email"] : "";
                $date_naissance = isset($_POST["date_naissance"]) ? $_POST["date_naissance"] : "";
                $telephone = isset($_POST["telephone"]) ? $_POST["telephone"] : "";
                $photo = isset($_POST["photo"]) ? $_POST["photo"] : "";
                $cv = isset($_POST["cv"]) ? $_POST["cv"] : "";
                $cabinet = isset($_POST["cabinet"]) ? $_POST["cabinet"] : "";



                $sql1 = "UPDATE Medecin SET nom='$nom', username='$username', password='$password', email='$email', date_naissance='$date_naissance', telephone='$telephone', ";
                $sql1 = $sql1 . " photo='$photo', cv='$cv', cabinet='$cabinet' WHERE id_medecin='$id_medecin'";

                $resultat = mysqli_query($db_handle, $sql1);
            }
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