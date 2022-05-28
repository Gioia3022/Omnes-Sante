<?php
/** create XML file */ 
$mysqli = new mysqli("localhost", "root", "", "omnes_sante");
/* check connection */
if ($mysqli->connect_errno) {
   echo "Connection failed ".$mysqli->connect_error;
   exit();
}
$query = "SELECT id_medecin, nom, prenom, username, type_medecin, email,date_naissance,genre,telephone,cabinet FROM medecin";
$medicArray = array();
if ($result = $mysqli->query($query)) {
    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
       array_push($medicArray, $row);
    }
  
    if(count($medicArray)){
         createXMLfile($medicArray);
    }
    /* free result set */
    $result->free();
}
/* close connection */
$mysqli->close();
function createXMLfile($medicArray){
  
   $filePath = 'medecins.xml';
   $dom     = new DOMDocument('1.0', 'utf-8'); 
   $root      = $dom->createElement('medecins'); 
   
   for($i=0; $i<count($medicArray); $i++){
     
     $medecinID        =  $medicArray[$i]['id_medecin'];  
     $medecinNom = htmlspecialchars($medicArray[$i]['nom']);
     $medecinPrenom    =  $medicArray[$i]['prenom']; 
     $medecinUsername     =  $medicArray[$i]['username']; 
     $medecinType     =  $medicArray[$i]['type_medecin']; 
     $medecinEmail  =  $medicArray[$i]['email']; 
     $medecinDateDeNaissance  =  $medicArray[$i]['date_naissance'];  
     $medecinGenre  =  $medicArray[$i]['genre'];  
     $medecinTelephone  =  $medicArray[$i]['telephone']; 
     $medecinCabinet  =  $medicArray[$i]['cabinet'];  
     
     $medecin = $dom->createElement('medecin');
     $medecin->setAttribute('id', $medecinID);
     $nom     = $dom->createElement('nom', $medecinNom); 
     $medecin->appendChild($nom); 
     $prenom   = $dom->createElement('prenom', $medecinPrenom); 
     $medecin->appendChild($prenom); 
     $username   = $dom->createElement('username', $medecinUsername); 
     $medecin->appendChild($username);
     $type_medecin   = $dom->createElement('type_medecin', $medecinType); 
     $medecin->appendChild($type_medecin);
     $email   = $dom->createElement('email', $medecinEmail); 
     $medecin->appendChild($email);
     $date_naissance   = $dom->createElement('date_naissance', $medecinDateDeNaissance); 
     $medecin->appendChild($date_naissance);
     $genre   = $dom->createElement('genre', $medecinGenre); 
     $medecin->appendChild($genre);
     $telephone   = $dom->createElement('telephone', $medecinTelephone); 
     $medecin->appendChild($telephone);
     $cabinet   = $dom->createElement('cabinet', $medecinCabinet); 
     $medecin->appendChild($cabinet);
     

 
     $root->appendChild($medecin);
    }
   $dom->appendChild($root); 
   $dom->save($filePath); 
 } 