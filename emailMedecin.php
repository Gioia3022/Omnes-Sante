<?php
require_once('PHPMailer/PHPMailerAutoload.php');
$mail=new PHPMailer();
$mail-> isSMTP();
$mail->SMTPAuth= true;
$mail->SMTPSecure= 'ssl';
$mail ->Host = 'smtp.gmail.com';
$mail->Port= '465';
$mail->isHTML();
$mail->Username= 'omnes.sante.ece@gmail.com';
$mail->Password= 'OmnesSante04';
$mail->SetFrom('omnes.sante.ece@gmail.com');

session_start();
$database = "omnes_sante";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

$id_client=isset($_POST["id_client"]) ? $_POST["id_client"] : "";
$nom = isset($_POST["nom_medecin"]) ? $_POST["nom_medecin"] : "";
$prenom = isset($_POST["prenom_medecin"]) ? $_POST["prenom_medecin"] : "";
$objet = isset($_POST["objet"]) ? $_POST["objet"] : "";
$enonce = isset($_POST["enonce"]) ? $_POST["enonce"] : "";

if ($db_found) {
    $sql="SELECT email from medecin WHERE nom='$nom' AND prenom='$prenom'";
    $resultat = mysqli_query($db_handle, $sql);
    $data = mysqli_fetch_assoc($resultat);

    $sql1="SELECT email from client WHERE id_client='$id_client'";
    $resultat1 = mysqli_query($db_handle, $sql1);
    $data1 = mysqli_fetch_assoc($resultat1);

    
    $mail->AddAddress($data1['email']);
    $mail->Subject=$objet;
    $mail->Body=$enonce. "<br><br>"."Mail envoyé par:<br> Dr. ".$nom. " ". $prenom."<br>".$data['email'];

    $mail->Send();
    header('Location: clientMenu.php');
    die;
}
else {
    echo "<p>Database not found.</p>";
}

?>