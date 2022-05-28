

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

$id_examen = isset($_POST["id_examen"]) ? $_POST["id_examen"] : "";

if ($db_found) {
$sql3="SELECT nom, prenom FROM Client WHERE id_client= '$id_client'";
$result3 = mysqli_query($db_handle, $sql3);
$data3 = mysqli_fetch_assoc($result3);
$prenom= $data3['prenom'];
$nom= $data3['nom'];

$_SESSION['prenom_client']=$prenom;
$_SESSION['nom_client']=$nom;
$_SESSION['id_rdv_examen']=$id_examen;
$_SESSION['type']=$type;
$_SESSION['bool_examen_medecin']=1;

header('Location: payement.php');
die;} //end if
//si le BDD n'existe pas
else {
    echo "Database not found";
} //end else
//fermer la connection
mysqli_close($db_handle);

?>