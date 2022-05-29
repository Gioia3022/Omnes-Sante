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


<!DOCTYPE html>
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
    <link href="css/menuClient.css " rel="stylesheet" type="text/css" />
</head>

<body>

<div id="image_back">
        <div class="container">
            <div class="row">
                <article class="col">
                    <h2 id="titre">Notre projet </h2>
                    <p>
                        Parce que votre santé c'est notre PROJET.
                        Omnes Santé,première plateforme de reservation de consultation en ligne d'après le choix des
                        médecins,
                        permet d'établir un lien patient médecin avant chaque consulation grâce à son système de
                        messagerie électronique.
                        électronique ultra performant . Omnes santé vous accompagne depuis maintenant plus de 10 ans
                        et vous assure une plateforme en ligne fiable et simple d'accès afin que vous ne focalisiez
                        que sur ce qui est le plus impotant: votre santé!

                    </p>
                </article>
            </div>
            <div class="row">

                <article class="col">
                    <h2 id="titre">Bulletin santé de la semaine</h2>
                    <p class="center_article_1">
                        Cette semaine on observe une forte hausse des gastros!!
                        Alors evitez de manger dans des restaurants à l'igiène douteuse!
                        Mais surtout n'oubliez pas de vous laver les mains pendant au moins 3 minutes.
                        Cela éliminera 99% des bactéries présentes sur celles-ci! N'oubliez pas la devise: le chaussettes de l'archiduchesses sont 
                        plus que sèches si elles sont archisèches.
                        <br>
                        <img src="../Omnes-Sante/images/photo_maladie1.png">
                        <img src="../Omnes-Sante/images/photo_maladie2.png">
                        <br>
                        N'oubliez pas de jeter vos plats ferrero/budoni si ils ont été acheté il y a un mois 
                        car des risques de contaminations salmonelliques sont présents.
                        <p>
                        A demain pour un autre bulletin santé.</p>
                        <br>
                        L'equipe Omnes santé
                    </p>

                </article>


                <article class="col">
                    <h2 id="titre">Nos spécialistes de la semaine</h2>
                    <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../Omnes-Sante/images/photo_medecin1.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="../Omnes-Sante/images/photo_medecin2.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="../Omnes-Sante/images/photo_medecin3.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="../Omnes-Sante/images/photo_medecin4.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="../Omnes-Sante/images/photo_medecin5.png" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </article>
            </div>
        </div>
    </div>
    <div id="header">
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
                        <li class="nav-item">
                            <a class="nav-link" href="chatroom.php">Chatroom</a>
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
                        <img src="../Omnes-Sante/images/<?php if (empty($photo)){ echo 'unknown.png';} else { echo $photo;}?>" 
                                width="60" height="60" style="position: absolute; top: 18px;" />
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
    <div id="footer">
        <p>Si vous avez un problème ou si vouz souhaitez nous contacter nous somme disponibles 7 jours sur septs aux
            adresses : omnessanteserviceclient@omnes.com<br>
            12 avenue des dieux de l'infos, Viroflay 78220 
        </p>
    </div>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>