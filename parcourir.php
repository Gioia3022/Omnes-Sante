<?php
//Ordre Décroissant
echo "<meta charset=\"utf-8\">";
//identifier votre BDD
$database = "omnes_sante";
//identifier votre serveur (localhost), utlisateur (root), mot de passe ("")
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

 //declaration des variables
 $ID = isset($_POST["ID"])? $_POST["ID"] : "";
 $nom = isset($_POST["nom"])? $_POST["nom"] : "";
 $prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
 $type_medecin = isset($_POST["type_medecin"])? $_POST["type_medecin"] : "";
 $email = isset($_POST["email"])? $_POST["email"] : "";
 $cabinet = isset($_POST["cabinet"])? $_POST["cabinet"] : "";
 $ville=isset($_POST["ville"])? $_POST["ville"] : "";
 $adresse =isset($_POST["adresse"])? $_POST["adresse"] : "";
 $salle =isset($_POST["salle"])? $_POST["salle"] : "";
 $telephone =isset($_POST["telephone"])? $_POST["telephone"] : "";
 $type_examen =isset($_POST["type_examen"])? $_POST["type_examen"] : "";
 $erreur = "";
 
if ($db_found) {
 $sql1 = "SELECT * FROM medecin";
 echo "Liste de médecins: ";
 echo "<br> <br> <br>";
 $result1 = mysqli_query($db_handle, $sql1);
 while ($data1 = mysqli_fetch_assoc($result1)) {
     echo "Nom:" . $data1['nom'] . '<br>';
     echo "Prenom: " . $data1['prenom'] . '<br>';
     echo "Type de médecin: " . $data1['type_medecin'] . '<br>';
     echo "Email: " . $data1['email'] . '<br>';
     echo "Cabinet: " . $data1['cabinet'] . '<br>';
     echo "<br> <br> <br>";
 } //end while
 $sql2 = "SELECT * FROM laboratoire";
 $result2 = mysqli_query($db_handle, $sql2);
 echo "Liste de laboratoirs: ";
 echo "<br> <br> <br>";
 while ($data2 = mysqli_fetch_assoc($result2)) {
     echo "Nom:" . $data2['nom'] . '<br>';
     echo "Adresse: " . $data2['adresse'] . ", ". $data2['ville'] . '<br>';
     echo "Email: " . $data2['email'] . '<br>';
     echo "Salle: " . $data2['salle'] . '<br>';
     echo "Numero de téléphone: " . $data2['telephone'] . '<br>';
     echo "<br> <br> <br>";
 } //end while
 $r1=mysqli_query($db_handle,$sql1);
 $r2=mysqli_query($db_handle,$sql2);
}
//si le BDD n'existe pas
else {
echo "Database not found";
} //end else
//fermer la connection
mysqli_close($db_handle);
 
?>