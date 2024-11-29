<?php
session_start();

if(isset($_SESSION['id_capital_risque'])) {
    $id_capital_risque = $_SESSION['id_capital_risque'];
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



// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $cin = $_POST['cin'];
    $email = $_POST['email'];
    $pseudo = $_POST['pseudo'];
    $password = $_POST['password'];

    $sql_update_startuper = "UPDATE capital_risque SET nom='$nom', prenom='$prenom', cin='$cin', email='$email', pseudo='$pseudo' , pwd='$password' WHERE id_capital_risque=$id_capital_risque";
    
    if ($conn->query($sql_update_startuper) === TRUE) {
        header("Location: confirmationcapedit.php?success=true");
        exit();
    } else {
        echo "Erreur: " . $sql_update_startuper . "<br>" . $conn->error;
    }
}

$conn->close();
?>
