<?php

//declaration des variables

$Identifiant = isset($_POST["Identifiant"])? $_POST["Identifiant"] : "";
$Nom = isset($_POST["Nom"])? $_POST["Nom"] : "";
$Prenom = isset($_POST["Prenom"])? $_POST["Prenom"] : "";
$Date_de_naissance= isset($_POST["Date de naissance"])? $_POST["Date de naissance"] : "";
$Mot_de_passe = isset($_POST["Mot de passe"])? $_POST["Mot de passe"] : "";

//detection des erreurs

$erreur = "";

if ($Identifiant == "") {
$erreur .= "Le champ Identifiant est vide. <br>";
}

if ($Nom == "") {
$erreur .= "Le champ Nom est vide. <br>";
}

if ($Prenom == "") {
$erreur .= "Le champ Prénom est vide. <br>";
}

if ($Date_de_naissance == "") {
$erreur .= "Le champ Date de naissance est vide. <br>";
}

if ($Mot_de_passe == "") {
$erreur .= "Le champ Mot de passe est vide. <br>";
}

if ($erreur == "") {
echo "Formulaire valide.";
} else {
echo "Erreur: <br>" . $erreur;
}

?>