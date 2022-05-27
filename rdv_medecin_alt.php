

<?php

$heure_debut_matin = "08:00:00";
$heure_fin_matin = "12:00:00";
$heure_debut_aprem = "13:00:00";
$heure_fin_aprem = "17:00:00";
$valid_date = true;
$valid_hour = false;
$disponible=true;

//Il faut attribuer les bonnes valeurs à ces id
$id_client = 3;
$id_medecin = 2;

$date = isset($_POST["date"]) ? $_POST["date"] : "";
$heure = isset($_POST["heure"]) ? $_POST["heure"] : "";





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


if (((strtotime($heure) >= strtotime($heure_debut_matin)) && ((strtotime($heure) <= strtotime($heure_fin_matin))))
    || ((strtotime($heure) >= strtotime($heure_debut_aprem)) && ((strtotime($heure) <= strtotime($heure_fin_aprem))))
) {
    $valid_hour = true;
    //do some work
} else {
    echo "L heure n'est pas valide";
}



if (($valid_hour == true) && ($valid_date == true)) {

    //identifier le nom de base de données
    $database = "omnes_sante";
    //connectez-vous dans votre BDD
    //Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);
    //si le BDD existe, faire le traitement

    if ($db_found) {

        //On récupère toute les rendez vous du médecin
        $sql = "SELECT * FROM reservation_client_medecin WHERE fk_medecin='$id_medecin'";
        $result = mysqli_query($db_handle, $sql);
        //regarder s'il y a des resultats
        if (mysqli_num_rows($result) == 0) {
            echo "Ce médecin n'a aucun examen";
        } else {
            while ($data = mysqli_fetch_assoc($result)) {
                echo "date" . $data['date'];
                echo "heure" . $data['heure'];
                if ($date== $data['date'] && $heure==$data['heure']){
                    $disponible=false;
                }
            }

            //Si le rendez vous est disponible
            if ($disponible==true){
                $sql1 = "INSERT INTO reservation_client_medecin(fk_client, fk_medecin, date, heure) VALUES ('$id_client','$id_medecin', '$date','$heure' )";
        $resultat = mysqli_query($db_handle, $sql1);

            }
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
}

?>