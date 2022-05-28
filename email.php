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

$id_client=$_SESSION['id_rdv_client'];
$date = $_SESSION['date_rdv_medecin'];
$heure = $_SESSION['heure_rdv_medecin'];

echo $heure;
if ($db_found) {
    $sql="SELECT email from client WHERE id_client='$id_client'";
    $resultat = mysqli_query($db_handle, $sql);
    $data = mysqli_fetch_assoc($resultat);

    $mail->AddAddress($data['email']);
    $mail->Subject='RDV medical';
    $mail->Body='Bonjour, voici votre mail de confirmation de payement pour le rdv du '. $date . ' a '. $heure;
    
    $mail->Send();
    header('Location: clientMenu.php');
            die;
}
else {
    echo "<p>Database not found.</p>";
}

?>