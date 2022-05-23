<?php

//identification de la BDD
$database = "omnes_sante";

//connection dans notre BDD
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);

//declaration des variables

$identifiant = isset($_POST["email"])? $_POST["email"] : "";
$mdp = isset($_POST["password"])? $_POST["password"] : "";

//detection des erreurs

$erreur = "";

if ($identifiant == "") {
$erreur .= "Le champ Identifiant est vide. <br>";
}

if ($mdp == "") {
$erreur .= "Le champ Mot de passe est vide. <br>";
}

if ($db_found) {
    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    if ($stmt = $db_handle->prepare("select * from admin where email=? and password=?;")) {
        
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $_POST['email']);
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
                //$_SESSION['loggedin'] = TRUE;
                //$_SESSION['identifiant'] = $identifiant;
                echo 'Bienvenue ' . $_SESSION['identifiant'] . '!';
            } else {
                // Incorrect mdp
                echo 'Identifiant et/ou mot de passe incorrect !';
            }
        } else {
            // Incorrect username
            echo 'Identifiant et/ou mot de passe incorrect !';
        }
        $stmt->close();
    }
}

//fermer la connection
mysqli_close($db_handle);

?>


