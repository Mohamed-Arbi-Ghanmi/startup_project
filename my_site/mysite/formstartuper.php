
<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "projetpweb"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$cin = $_POST['cin'];
$email = $_POST['email'];
$nom_entreprise = $_POST['entreprise'];
$adresse_entreprise=$_POST['adresse_entreprise'];
$numero_registre_commerce = $_POST['rc'];
$pseudo = $_POST['pseudo'];
$password = $_POST['password'];


$sql = "INSERT INTO startuper (nom, prenom, cin, email, nom_entreprise, adresse_entreprise, numero_registre_commerce, pseudo, pwd) 
        VALUES ('$nom', '$prenom', '$cin', '$email', '$nom_entreprise', '$adresse_entreprise', '$numero_registre_commerce', '$pseudo', '$password')";

if ($conn->query($sql) === TRUE) {
    // Obtenez l'ID du startuper nouvellement créé
    $id_startuper = $conn->insert_id;
    session_start();
    $_SESSION['id_startuper'] = $id_startuper;
    header("refresh:0;url=confirmerajoutstartuper.php");
    exit();
} else {
    header("refresh:0;url=compte_existe.html");
    exit();
}

$conn->close();
?>

