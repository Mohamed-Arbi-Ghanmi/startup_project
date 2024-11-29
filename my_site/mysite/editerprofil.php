<?php
session_start();

// Vérifiez si l'ID du startuper est défini dans la session
if(isset($_SESSION['id_startuper'])) {
    $id_startuper = $_SESSION['id_startuper'];
} else {
    header("Location: signin.php");
    exit(); 

$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "projetpweb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_select_startuper = "SELECT * FROM startuper WHERE id_startuper = $id_startuper";
$result = $conn->query($sql_select_startuper);

if ($result->num_rows > 0) {
    // Startuper's information found
    $startuper_info = $result->fetch_assoc();
} else {
    echo "Information du startuper introuvable.";
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $cin = $_POST['cin'];
    $email = $_POST['email'];
    $nom_entreprise = $_POST['entreprise'];
    $adresse_entreprise=$_POST['adresse_entreprise'];
    $numero_registre_commerce = $_POST['rc'];
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

    $sql_update_startuper = "UPDATE startuper SET nom='$nom', prenom='$prenom', cin='$cin', email='$email', nom_entreprise='$nom_entreprise', adresse_entreprise='$adresse_entreprise', numero_registre_commerce='$numero_registre_commerce' , pseudo='$pseudo' , pwd='$password' WHERE id_startuper=$id_startuper";
    
    if ($conn->query($sql_update_startuper) === TRUE) {
        header("Location: confirmation_edit.php?success=true");
        exit();
    } else {
        echo "Erreur: " . $sql_update_startuper . "<br>" . $conn->error;
    }
}

$conn->close();
?>
