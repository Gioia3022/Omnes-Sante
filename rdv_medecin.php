<?php
//Ordre Décroissant
echo "<meta charset=\"utf-8\">";
//identifier votre BDD
$database = "omnes_sante";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);


//Cette id devra etre passé en paramètre ici (et il devra aussi etre envoyé dans le fichier rdv_medecin_alt.php)
$id_medecin = $_GET['id_medecin'];

?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Omnès santé rendez vous
    </title>


    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="" rel="stylesheet" type="text/css" />
    <link href="css/menu.css " rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="wrapper">
        <div id="header">
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
                                    <li><a class="dropdown-item" href="menu.html">Déconnexion</a>
                                    </li>
                                </ul>
                            </li>
                    </div>
                </div>
            </nav>
        </div>

        <br><br>
        <br><br>
        <br><br>
        <h1 id="titre"><b>Calendrier du médecin </b></h1>
        <br><br>
        
        <form action="rdv_medecin_alt.php" method="post">
        <input type="text" id="id_medecin" name="id_medecin" value= <?php echo $id_medecin?> hidden>
            <table>
                <thead>
                    <tr>
                        <th> Horraie </th>
                        <th> Lundi </th>
                        <th> Mardi </th>
                        <th> Mercredi </th>
                        <th> Jeudi </th>
                        <th> Vendredi </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($j=8; $j <= 17; $j++){
                        $cpt=-1;
                        ?>
                        <tr>
                            <td> <?php echo $j; echo "-"; echo $j+1; echo "h"; ?> </td>
                            <?php
                            for ($h = 1 ; $h <= 5 ; $h++){
                                $cpt=-1;
                                if($h==1){
                                    $valeur = "2022-05-30";
                                }
                                if($h==2){
                                    $valeur = "2022-05-31";
                                }
                                if($h==3){
                                    $valeur = "2022-06-01";
                                }
                                if($h==4){
                                    $valeur = "2022-06-02";
                                }
                                if($h==5){
                                    $valeur = "2022-06-03";
                                }
                                $query="Select * from reservation_client_medecin where fk_medecin='$id_medecin'"; 
                                $result=mysqli_query($db_handle,$query);
                                while ($data = mysqli_fetch_assoc($result)) {
                                    if($data["date"]==$valeur AND $data["heure"]==$j){
                                        $cpt =1;
                                        ?>
                                        <td> <button class="button2" type="button" id="button"  disabled style="width:100%;height:100%;background-color: gray;"> Réserver  </button></td>
                                        <?php
                                    }
                                }
                                if($cpt!=1){
                                    ?>
                                    <td> <button class="button2" type="submit" name="submit" value="<?php echo $valeur ?> <?php echo $j.":00:00" ?> "  style="width:100%;height:100%"> Réserver </button> </td>
                                    <?php

                                }
                            }
                            echo "</tr>";
                            }
                            ?>
                </tbody>
            </table>
        </form>
    </div>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>

</body>

</html>