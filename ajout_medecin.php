<?php
//saisir les données du  formulaires
$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
$username= isset($_POST["username"])? $_POST["username"] : "";
$password = isset($_POST["password"])? $_POST["password"] : "";
$type_medecin = isset($_POST["type_medecin"])? $_POST["type_medecin"] : "";
$email = isset($_POST["email"])? $_POST["email"] : "";
$date_naissance = isset($_POST["date_naissance"])? $_POST["date_naissance"] : "";
$genre = isset($_POST["genre"])? $_POST["genre"] : "";
$telephone = isset($_POST["telephone"])? $_POST["telephone"] : "";
$photo = isset($_POST["photo"])? $_POST["photo"] : "";
$cv = isset($_POST["cv"])? $_POST["cv"] : "";
$cabinet = isset($_POST["cabinet"])? $_POST["cabinet"] : "";

$boolean_type=0;
if ($type_medecin == "generaliste")
$boolean_type=0;
else
$boolean_type=1;


echo "nom :".$nom."<br>";
echo "prenom :".$prenom."<br>";
echo "username :".$username."<br>";
echo "password :".$password."<br>";
echo "type_medecin :".$type_medecin."<br>";
echo "email :".$email."<br>";
echo "date de naissance :".$date_naissance."<br>";
echo "genre :".$genre."<br>";
echo "telephone :".$telephone."<br>";
echo "photo :".$photo."<br>";
echo "cv :".$cv."<br>";
echo "cabinet :".$cabinet."<br>";
echo "bool: ".$boolean_type;






//identifier le nom de base de données
$database = "omnes_sante";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
//si le BDD existe, faire le traitement

if (isset($_POST["button_ajout_medecin"])) {

if ($db_found) {
    
    $sql = "INSERT INTO Medecin(nom, prenom, username, password, type_medecin, boolean_type, email, date_naissance, genre, telephone, photo, cv, cabinet)";
    $sql=$sql ." VALUES ( '$nom', '$prenom', '$username', '$password', '$type_medecin', '$boolean_type', '$email', '$date_naissance', '$genre', '$telephone', '$photo', '$cv', '$cabinet')";
    $result =mysqli_query($db_handle, $sql);
    echo "<p>Add successful.</p>";
    echo "DONE!!!";
    

} //end if
//si le BDD n'existe pas
else {
    echo "Database not found";
} //end else
//fermer la connection
mysqli_close($db_handle);
}

?>

      