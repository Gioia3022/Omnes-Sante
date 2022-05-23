<?php
session_start();
//Ordre Décroissant
echo "<meta charset=\"utf-8\">";
//identifier votre BDD
$database = "omnes_sante";
//identifier votre serveur (localhost), utlisateur (root), mot de passe ("")
$db_handle = mysqli_connect('localhost', 'root', '');
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$db_found = mysqli_select_db($db_handle, $database);

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['nom']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the fields!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
$sql="SELECT nom, id_medecin,type_medecin,email, prenom FROM medecins WHERE nom = ?";
echo '1';
if ($stmt = $db_handle->prepare($sql)) {
    
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['nom']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($nom);
        $stmt->fetch();
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['nom'];
            $_SESSION['id'] = $id_medecin;
            $_SESSION['t_m'] = $type_medecin;
            $_SESSION['pre'] = $prenom;
            $_SESSION['mail'] = $email;
            echo 'Welcome ' . $_SESSION['name'] . '!';
            echo $_SESSION['id'] . $_SESSION['t_m'] . $_SESSION['pre'] . $_SESSION['mail'];
        } 
     else {
        // Incorrect username
        echo 'Incorrect username and/or password!';
    }

	$stmt->close();
}
?>