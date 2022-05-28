

<?php
//identifier le nom de base de données
$database = "omnes_sante";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
//si le BDD existe, faire le traitement

session_start();

$type=$_POST["submit"];

//Il faut attribuer les bonnes valeurs à ces id
$id_client = $_SESSION['id_client'];

$id_medecin = isset($_POST["id_medecin"]) ? $_POST["id_medecin"] : "";

/*
$heure_debut_matin = "08:00:00";
$heure_fin_matin = "12:00:00";
$heure_debut_aprem = "13:00:00";
$heure_fin_aprem = "17:00:00";
$valid_date = true;
$valid_hour = false;
$disponible=true;*/



/*
$day = date("D", strtotime($date));

if ($day == 'Sat' || $day == 'Sun') {
    $valid_date = false;
}

//Output for testing purposes.
if ($valid_date) {
    echo $date . ' est un jour de semaine';
} else {
    echo $date . ' est un weekend';
}


$delai_bas = date("H:i", strtotime('-31 minutes', strtotime($heure)));
$delai_bas.=":00";

$delai_haut = date("H:i", strtotime('+31 minutes', strtotime($heure)));
$delai_haut.=":00";



if (((strtotime($heure) >= strtotime($heure_debut_matin)) && ((strtotime($heure) <= strtotime($heure_fin_matin))))
    || ((strtotime($heure) >= strtotime($heure_debut_aprem)) && ((strtotime($heure) <= strtotime($heure_fin_aprem))))
) {
    $valid_hour = true;
    //do some work
} else {
    echo "L heure n'est pas valide";
}



if (($valid_hour == true) && ($valid_date == true)) {

    

    if ($db_found) {

        //On récupère toute les rendez vous du médecin
        $sql = "SELECT * FROM reservation_client_medecin WHERE fk_medecin='$id_medecin'";
        $result = mysqli_query($db_handle, $sql);
        //regarder s'il y a des resultats
        if (mysqli_num_rows($result) == 0) {
            echo "Ce médecin n'a aucune réservation";
        } else {
            while ($data = mysqli_fetch_assoc($result)) {
                echo "date" . $data['date'];
                echo "heure" . $data['heure'];
                if ($date== $data['date'] && $heure==$data['heure']){
                    $disponible=false;
                }
                
            }
        }
        //Si le rendez vous est disponible
        if ($disponible==true){
            $_SESSION['date_rdv_medecin']=$date;
            $_SESSION['heure_rdv_medecin']=$heure;
            $_SESSION['id_rdv_medecin']=$id_medecin;
            $_SESSION['type']=$type;
            header('Location: payement.php');
            die;

        }
    } //end if
    //si le BDD n'existe pas
    else {
        echo "Database not found";
    } //end else
    //fermer la connection
    mysqli_close($db_handle);
} else {
    echo "Date ou heure non valide";
}*/
if ($db_found) {
$sql3="SELECT prenom FROM Client WHERE id_client= '$id_client'";
$result3 = mysqli_query($db_handle, $sql3);
$data3 = mysqli_fetch_assoc($result3);
$prenom= $data3['prenom'];
$nom= $data3['nom'];
$_SESSION['prenom_client']=$prenom;
$_SESSION['nom_client']=$nom;
$_SESSION['id_rdv_medecin']=$id_medecin;
$_SESSION['type']=$type;
 header('Location: payement.php');
die;} //end if
//si le BDD n'existe pas
else {
    echo "Database not found";
} //end else
//fermer la connection
mysqli_close($db_handle);

?>