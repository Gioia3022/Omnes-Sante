<?php
//saisir les données du  formulaires
$nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
$type_medecin = isset($_POST["type_medecin"]) ? $_POST["type_medecin"] : "";
$err = $nom . $prenom . $type_medecin;
$char = "";


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
                $nom_client = $data['nom'];
                $prenom_client = $data['prenom'];
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
    <link href="css/recherche_medecin.css " rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="header" style="height: 30px; font-size: 20px; width: 100%;">
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
                            <img src="../Omnes-Sante/images/unknown.png" width="60" height="60"
                                style="position: absolute; top: 18px;" />
                            <p style="font-size: 15px;"> &emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $nom_client ?></p>
                            <p style="font-size: 15px; ">&emsp;&emsp;&emsp;&emsp;&emsp;<?php echo $prenom_client ?></p>
                            <p style="font-size: 10px; color: blue;">
                                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Client connecté</p>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div>
        <table class="table table-strip">
            <h1 id="titre"><b>Recherche des médecins</b> </h1> <br><br>
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Spécialité</th>
                <th>Email</th>
                <th>Cabinet</th>
            </tr>
            <?php


            if (isset($_POST["button_recherche_medecin"])) {
                if ($db_found) {
                    //commencer le query
                    $sql = "SELECT * FROM Medecin";
                    if ($err != "") {
                        $sql .= " WHERE ";

                        //on recherche le medecin par son nom
                        if ($nom != "") {
                            $sql .= " nom LIKE '%$nom%'";
                            $char = " AND ";
                        }
                        //on recherche le medecin par son prenom
                        if ($prenom != "") {
                            $sql .= $char . " prenom LIKE '%$prenom%'";
                            $char = " AND ";
                        }
                        //on recherche le medecin par son type
                        if ($type_medecin != "") {
                            $sql .= $char . "type_medecin LIKE '%$type_medecin%'";
                        }
                    }
                    $result = mysqli_query($db_handle, $sql);

                    //regarder s'il y a des resultats
                    if (mysqli_num_rows($result) == 0) {
                        echo "<br> <br> ";
                        echo "<p>Ce type d'examen n'existe pas</p>";
                        echo "<br> <br> ";
                        echo "<tr>";
                        echo "<td>" . " " . "</td>";
                        echo "<td>" . "-" . "</td>";
                        echo "<td>" . "-" . "</td>";
                        echo "<td>" . "-" . "</td>";
                        echo "<td>" . "-" . "</td>";
                        echo "<td>" . "-" . "</td>";
                        echo "</tr>";
                    } else {
                        while ($data = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo  "<td>" . $data['id_medecin'] .  "</td>";
                            echo " <td class=nav-item><a class=nav-link href=rdv_medecin.php?id_medecin=" . $data['id_medecin']  . "&id_client=". $id_client. ">" . $data['nom'] . "</a></td>";
                            echo  "<td>" . $data['prenom'] .  "</td>";
                            echo " <td>" . $data['type_medecin'] .  "</td>";
                            echo  "<td>" . $data['email'] .  "</td>";
                            echo  "<td>" . $data['cabinet'] . "</td>";
                            $image = $data['photo'];
                            echo '<td>  <img src=../Omnes-Sante/images/' . $image . ' height="120" width="100">  </td>';
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                } else {
                    echo "<p>Database not found.</p>";
                }
            }

            ?>
        </table>

    </div>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>

</body>

</html>