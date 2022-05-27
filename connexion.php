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
$id_admin= isset($_POST["id_admin_mod"]) ? $_POST["id_admin_mod"] : "";
//detection des erreurs
$erreur = "";
if (isset($_POST["button_connexion"])) {
    if ($db_found) {
        //commencer le query
        $sql = "SELECT * FROM Client";
        if ($email != "") {
            //on recherche l'utilisateur par son email
            $sql .= " WHERE email = '$email'";
            //on vérifie que le mdp est correct
            if ($password != "") {
                $sql .= " AND password = '$password'";
            }
        }
        $result = mysqli_query($db_handle, $sql);
        
        //regarder s'il y a des resultats
        if (mysqli_num_rows($result) == 0) {
            $sql1 = "SELECT * FROM Admin";
            if ($email != "") {
                //on recherche l'utilisateur par son email
                $sql1 .= " WHERE email = '$email'";
                //on vérifie que le mdp est correct
                if ($password != "") {
                    $sql1 .= " AND password = '$password'";
                }
            }
            $result1 = mysqli_query($db_handle, $sql1);
            if (mysqli_num_rows($result1) == 0) {
                $sql2 = "SELECT * FROM Medecin";
                if ($email != "") {
                    //on recherche l'utilisateur par son email
                    $sql2 .= " WHERE email = '$email'";
                    //on vérifie que le mdp est correct
                    if ($password != "") {
                        $sql2 .= " AND password = '$password'";
                    }
                }
                $result2 = mysqli_query($db_handle, $sql2);
                if (mysqli_num_rows($result2) == 0) {
                    /*
                    echo ' <script> alert("After this goes away, I will be redirected via JavaScript");
                    window.location = "http://localhost/PJ_WEB_2022-Abdelkefi_Carissan_Galiazzo_deLaVillardiere/omnes-sante/connexion.html" </script>';
                   */ header('Location: connexion.html');
                    die;
                }
                else {
                    //afficher le resultat

                    while ($data = mysqli_fetch_assoc($result2)) {
                        $id= $data['id_medecin'];
                        $nom= $data['nom'];
                        $prenom = $data['prenom'];
                        $username = $data['username'];
                        $email = $data['email'];
                        $telephone = $data['telephone'];
                        $type_medecin = $data['type_medecin'];
                        $genre = $data['genre'];
                        $date_naissance = $data['date_naissance'];
                        $image = $data['photo'];
                        $cabinet = $data['cabinet'];

                        $_SESSION['id']=$data['id_medecin'];
                        $_SESSION['id_medecin']=$data['id_medecin'];
                        $_SESSION['type']="Medecin";
    
                        echo '<form action="menuMedecin.php" method="post">
                        <input type="text" id="id_medecin" name="id_medecin" value=' . $id . ' hidden>
                        <input type="text" id="nom" name="nom" value=' . $nom . ' hidden>
                        <input type="text" id="prenom" name="prenom" value=' . $prenom . ' hidden>
                        <input type="text" id="username" name="username" value=' . $username . ' hidden>
                        <input type="text" id="email" name="email" value=' . $email . ' hidden>
                        <input type="text" id="telephone" name="telephone" value=' . $telephone . ' hidden>
                        <input type="text" id="type_medecin" name="type_medecin" value=' . $type_medecin . ' hidden>
                        <input type="text" id="genre" name="genre" value=' . $genre . ' hidden>
                        <input type="text" id="date_naissance" name="date_naissance" value=' . $date_naissance . ' hidden>
                        <input type="text" id="image" name="image" value=' . $image . ' hidden>
                        <input type="text" id="cabinet" name="cabinet" value=' . $cabinet . ' hidden>
                        </form>';
                        header('Location: menuMedcin.php');
                        die;

                        
                         
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
                    $_SESSION['id']=$id;
                    $_SESSION['id_admin']=$id;
                    $_SESSION['type']="Admin";

                    echo '<form action="menuAdmin.php" method="post">
                    <input type="text" id="id_admin" name="id_admin" value=' . $id . ' hidden>
                    <input type="text" id="nom_admin" name="nom_admin" value=' . $nom . ' hidden>
                    <input type="text" id="prenom_admin" name="prenom_admin" value=' . $prenom . ' hidden>
                    <input type="text" id="username_admin" name="username_admin" value=' . $username . ' hidden>
                    <input type="text" id="email_admin" name="email_admin" value=' . $email . ' hidden>
                    <input type="text" id="telephone_admin" name="telephone_admin" value=' . $telephone . ' hidden>
                    </form>';
                    header('Location: adminMenu.php');
                    die;
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
                $_SESSION['id_client']=$data['id_client'];
                $_SESSION['type']="Client";
                header("Location: clientMenu.php");
            }
        }
    } else {
        echo "<p>Database not found.</p>";
    }


}



?>