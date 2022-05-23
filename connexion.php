<?php

//identification de la BDD
$database = "omnes_sante";

//connection dans notre BDD
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//declaration des variables

$identifiant = isset($_POST["identifiant"])? $_POST["identifiant"] : "";
$mdp = isset($_POST["mdp"])? $_POST["mdp"] : "";

//detection des erreurs

$erreur = "";

if ($identifiant == "") {
$erreur .= "Le champ identifiant est vide. <br>";
}

if ($mdp == "") {
$erreur .= "Le champ Mot de passe est vide. <br>";
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
//if ( !isset($_POST['identifiant'], $_POST['Mot_de_passe']) ) {
	// Could not get the data that should have been sent.
//	exit('Merci de remplir les champs Utilisateurs et Mot de passe.');
//}

if ($db_found) {
    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    if ($stmt = $db_handle->prepare("select * from admin where identifiant=? and password=?;")) {
        
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $_POST['identifiant']);
        $stmt->execute();

        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($identifiant, $mdp);
            $stmt->fetch();
            
            // Account exists, now we verify the mdp.
            if ($_POST['mdp'] === $mdp) {
                // Verification success! User has logged-in!
                // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['identifiant'] = $identifiant;
                echo 'Bienvenue ' . $_SESSION['identifiant'] . '!';
            } else {
                // Incorrect mdp
                echo 'Incorrect username and/or mdp!';
            }
        } else {
            // Incorrect username
            echo 'Incorrect username and/or mdp!';
        }
        $stmt->close();
    }
}

//fermer la connection
mysqli_close($db_handle);

?>


