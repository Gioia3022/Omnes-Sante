

<?php


session_start();

echo $_GET['id_modif_medecin'];

$id_medecin = $_GET['id_modif_medecin'];
//identifier le nom de base de données
$database = "omnes_sante";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
//si le BDD existe, faire le traitement

if ($db_found) {
    //commencer le query
    $sql = "SELECT * FROM Medecin WHERE id_medecin= '$id_medecin' ";

    $result = mysqli_query($db_handle, $sql);
    //regarder s'il y a des resultats
    if (mysqli_num_rows($result) == 0) {
        echo "<p>Ce medecin n'existe pas</p>";
    } else {
        while ($data = mysqli_fetch_assoc($result)) {
            //saisir les données du  formulaires
            $nom = $data['nom'];
            $prenom = $data['prenom'];
            $username = $data['username'];
            $password = $data['password'];
            $email = $data['email'];
            $type_medecin=$data['type_medecin'];
            $date_naissance = $data['date_naissance'];
            $telephone = $data['telephone'];
            $genre=$data['genre'];
            $photo = $data['photo'];
            $cv = $data['cv'];
            $cabinet = $data['cabinet'];



            echo '<form action="modification_medecin.php" method="post">

<table>
    <tr>
        <td>Nom:</td>
        <td><input type="text" id="nom" name="nom" value='.$nom .' required></td>
    </tr>

    <tr>
        <td>Prenom:</td>
        <td><input type="text" id="prenom" name="prenom" value='.$prenom.' required></td>
    </tr>
    
    <tr>
        <td>Username :</td>
        <td><input type="text" id="username" name="username" value='.$username.' required></td>
    </tr>

    <tr>
        <td>Password :</td>
        <td><input type="password" id="password" name="password" value='.$password.' required></td>
    </tr>


    <tr>
                    <td>type medecin (ancien '.$type_medecin.' ):</td>
                    <td><select class="combo" name="type_medecin">
                        <option value="generaliste" name="generaliste">Generaliste</option>
                        <option value="addictologie" name="addictologie">Addictologue</option>
                        <option value="andrologie" name="andrologie">Andrologue</option>
                        <option value="cardiologie" name="cardiologie">Cardiologue</option>
                        <option value="dermatologie" name="dermatologie">Dermatologue</option>
                        <option value="gastro-hepato-enterologie" name="gastro-hepato-enterologie">Gastro-Hépato-Entérologue</option>
                        <option value="i.s.t" name="i.s.t">I.S.T</option>
                        <option value="osteopathie" name="osteopathie">Osthéopathe</option></select>
                        
                </tr>

   

    <tr>
        <td>email :</td>
        <td><input type="email" id="email" name="email" value='.$email.'  required></td>
    </tr>

    <tr>
        <td>date de naissance :</td>
        <td><input type="date" id="date_naissance" name="date_naissance" value='.$date_naissance.'  required></td>
    </tr>

    <tr>
                    
                    <td>genre ('.$genre.' ):</td>
                    <td><select class="combo" id="genre" name="genre" >
                        <option value="homme" name="homme">Homme</option>
                        <option value="femme" name="femme">Femme</option></select>
                        
    </tr>


    <tr>
        <td>telephone :</td>
        <td><input type="tel" id="telephone" name="telephone" value='.$telephone.' required></td>
    </tr>

    <tr>
        <td>photo :</td>
        <td><input type="text" id="photo" name="photo" value='.$photo.' ></td>
    </tr>

    <tr>
        <td>cv :</td>
        <td><input type="text" id="cv" name="cv" value='.$cv.' ></td>
    </tr>

    <tr>
        <td>salle de cabinet :</td>
        <td><input type="text" id="cabinet" name="cabinet" value='.$cabinet.' required></td>
    </tr>

</table>


<div>
    <input type="submit" value="Valider" name="button_modification_medecin">
</div>

</form>';

            if (isset($_POST["button_modification_medecin"])) {
                //saisir les données du  formulaires
$nom = isset($_POST["nom"])? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
$username= isset($_POST["username"])? $_POST["username"] : "";
$password = isset($_POST["password"])? $_POST["password"] : "";
$email = isset($_POST["email"])? $_POST["email"] : "";
$date_naissance = isset($_POST["date_naissance"])? $_POST["date_naissance"] : "";
$type_medecin = isset($_POST["type_medecin"])? $_POST["type_medecin"] : "";
$telephone = isset($_POST["telephone"])? $_POST["telephone"] : "";
$photo = isset($_POST["photo"])? $_POST["photo"] : "";
$cv = isset($_POST["cv"])? $_POST["cv"] : "";
$cabinet = isset($_POST["cabinet"])? $_POST["cabinet"] : "";
$genre = isset($_POST["genre"])? $_POST["genre"] : "";



$sql1 = "UPDATE Medecin SET nom='$nom', username='$username', password='$password',  type_medecin='$type_medecin', genre='$genre', email='$email', date_naissance='$date_naissance', telephone='$telephone', ";
    $sql1=$sql1 ." photo='$photo', cv='$cv', cabinet='$cabinet' WHERE id_medecin='$id_medecin'";

    $resultat =mysqli_query($db_handle, $sql1);


            }
        }
    }
} else {
    echo "<p>Database not found.</p>";
}

//header("Refresh:0");


?>


      