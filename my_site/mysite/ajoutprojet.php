<?php
session_start();

if(isset($_SESSION['id_startuper'])) {
    $id_startuper = $_SESSION['id_startuper'];
} else {
    header("Location: home_startuper.php");
    exit(); 
}

$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "projetpweb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $nombre_actions_a_vendre = $_POST['actions'];
    $prix_action = $_POST['valeur_action'];

    $nombre_actions_vendues = 0;

    $sql_insert_projet = "INSERT INTO projet (titre, description, nombre_actions_a_vendre, nombre_actions_vendues, prix_action, id_startuper) 
                          VALUES ('$titre', '$description', '$nombre_actions_a_vendre', '$nombre_actions_vendues', '$prix_action', '$id_startuper')";

    if ($conn->query($sql_insert_projet) === TRUE) {
        // Succès d'ajout - Rediriger vers la page de confirmation
        header("Location: confirmation.php?success=true");
        exit(); 
    } else {
        echo "Erreur: " . $sql_insert_projet . "<br>" . $conn->error;
    }
}

$conn->close();
?>
