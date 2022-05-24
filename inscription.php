<?php

//saisir les données du  formulaires
$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
$password = isset($_POST["password"])? $_POST["password"] : "";
$email = isset($_POST["email"])? $_POST["email"] : "";
$date_naissance = isset($_POST["date_naissance"])? $_POST["date_naissance"] : "";
$genre = isset($_POST["genre"])? $_POST["genre"] : "";
$telephone = isset($_POST["telephone"])? $_POST["telephone"] : "";
$photo = isset($_POST["photo"])? $_POST["photo"] : "";
$adresse = isset($_POST["adresse"])? $_POST["adresse"] : "";
$ville = isset($_POST["ville"])? $_POST["ville"] : "";
$code_postal = isset($_POST["code_postal"])? $_POST["code_postal"] : "";
$pays = isset($_POST["pays"])? $_POST["pays"] : "";
$carte_vitale = isset($_POST["carte_vitale"])? $_POST["carte_vitale"] : "";


echo "nom :".$nom."<br>";
echo "prenom :".$prenom."<br>";
echo "password :".$password."<br>";
echo "email :".$email."<br>";
echo "date de naissance :".$date_naissance."<br>";
echo "genre :".$genre."<br>";
echo "telephone :".$telephone."<br>";
echo "photo :".$photo."<br>";
echo "Adresse :".$adresse."<br>";
echo "Ville :".$ville."<br>";
echo "Code Postal :".$code_postal."<br>";
echo "Pays :".$pays."<br>";
echo "Numero de Carte Vitale :".$carte_vitale."<br>";






//identifier le nom de base de données
$database = "omnes_sante";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
//si le BDD existe, faire le traitement

if (isset($_POST["access"])) {

if ($db_found) {
    
    $sql = "INSERT INTO Client(nom, prenom, password,  email, date_naissance, genre, telephone, photo, adresse, ville, code_postal, pays, carte_vitale)";
    $sql=$sql ." VALUES ( '$nom', '$prenom', '$password', '$email', '$date_naissance', '$genre', '$telephone', '$photo', '$adresse', '$ville', '$code_postal','$pays','$carte_vitale')";
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