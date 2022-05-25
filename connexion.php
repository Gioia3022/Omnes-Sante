<?php

session_start();
//identification de la BDD
$database = "omnes_sante";

//connection dans notre BDD
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);

//declaration des variables

$email = isset($_POST["email"])? $_POST["email"] : "";
$password = isset($_POST["password"])? $_POST["password"] : "";

//detection des erreurs
$erreur = "";
if (isset($_POST["button_connexion"])) {
    if ($db_found) {
        //commencer le query
        $sql = "SELECT * FROM Client";
        if ($email != "") {
            //on recherche l'utilisateur par son email
            $sql .= " WHERE email LIKE '%$email%'";
            //on vérifie que le mdp est correct
            if ($password != "") {
                $sql .= " AND password LIKE '%$password%'";
            }
        }
        $result = mysqli_query($db_handle, $sql);
        
        //regarder s'il y a des resultats
        if (mysqli_num_rows($result) == 0) {
            $sql1 = "SELECT * FROM Admin";
            if ($email != "") {
                //on recherche l'utilisateur par son email
                $sql1 .= " WHERE email LIKE '%$email%'";
                //on vérifie que le mdp est correct
                if ($password != "") {
                    $sql1 .= " AND password LIKE '%$password%'";
                }
            }
            $result1 = mysqli_query($db_handle, $sql1);
            if (mysqli_num_rows($result1) == 0) {
                $sql2 = "SELECT * FROM Medecin";
                if ($email != "") {
                    //on recherche l'utilisateur par son email
                    $sql2 .= " WHERE email LIKE '%$email%'";
                    //on vérifie que le mdp est correct
                    if ($password != "") {
                        $sql2 .= " AND password LIKE '%$password%'";
                    }
                }
                $result2 = mysqli_query($db_handle, $sql2);
                if (mysqli_num_rows($result2) == 0) {
                    echo "<p>email et/ou mot de passe incorrect</p>";
                }
                else {
                    //afficher le resultat
                    while ($data = mysqli_fetch_assoc($result2)) {
                        echo "Vous etes un médecin: ". "<br>";
                        echo "<tr>";
                        echo "<td>" . $data['id_medecin'] . "</td>"."<br>";
                        echo "<td>" . $data['nom'] . "</td>"."<br>";
                        echo "<td>" . $data['prenom'] . "</td>"."<br>";
                        echo "<td>" . $data['username'] . "</td>"."<br>";
                        echo "<td>" . $data['type_medecin'] . "</td>"."<br>";
                        echo "<td>" . $data['date_naissance'] . "</td>"."<br>";
                        echo "<td>" . $data['email'] . "</td>"."<br>";
                        echo "<td>" . $data['genre'] . "</td>"."<br>";
                        echo "<td>" . $data['telephone'] . "</td>"."<br>";
                        $image = $data['photo'];
                        echo "<td>" . "<img src='$image' height='120' width='100'>" . "</td>"."<br>";
                        echo "<td>" . $data['cabinet'] . "</td>"."<br>";
                        echo "</tr>";

                        $_SESSION['id']=$data['id_medecin'];
                    }
                }
            }
            else {
                //afficher le resultat
                while ($data = mysqli_fetch_assoc($result1)) {
                    $id= $data['id_admin'];
                    $nom= $data['nom'];
                    $prenom = $data['prenom'];
                    $username = $data['username'];
                    $email = $data['email'];
                    $telephone = $data['telephone'];
                    $_SESSION['id']=$data['id_admin'];
                    echo '
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
                    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
                    <link href="css/menuAdmin.css " rel="stylesheet" type="text/css" />
                    <form action="ajout_medecin.html" method="post">
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
                        </div>
                        <div>
                            <input type="submit" value="Ajouter un médecin" name="button_ajout_medecin">
                        </div>
                        </form>'; 
                    echo "<br><br>";
                    echo '<form action="choix_medcin.php" method="post">
                        <div>
                            <input type="submit" value="Modifier un médecin" name="button_modification_medecin">
                        </div>
                        </div>
                            <script src="js/bootstrap.js"></script>
                            <script src="js/bootstrap.bundle.min.js"></script>
                        </form>';                  
                }
            }
        
        }
        else {
            //afficher le resultat
            while ($data = mysqli_fetch_assoc($result)) {
                echo "Vous etes un client: ". "<br>";
                echo "<tr>";
                echo "<td>" . $data['id_client'] . "</td>"."<br>";
                echo "<td>" . $data['nom'] . "</td>"."<br>";
                echo "<td>" . $data['prenom'] . "</td>"."<br>";
                echo "<td>" . $data['username'] . "</td>"."<br>";
                echo "<td>" . $data['date_naissance'] . "</td>"."<br>";
                echo "<td>" . $data['email'] . "</td>"."<br>";
                echo "<td>" . $data['genre'] . "</td>"."<br>";
                echo "<td>" . $data['telephone'] . "</td>"."<br>";
                $image = $data['photo'];
                echo "<td>" . "<img src='$image' height='120' width='100'>" . "</td>"."<br>";
                echo "</tr>";

                $_SESSION['id']=$data['id_client'];
            }
        }
    } else {
        echo "<p>Database not found.</p>";
    }


}



?>