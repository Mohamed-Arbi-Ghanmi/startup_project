<?php
session_start();

$serveur = "localhost"; 
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "projetpweb";

$connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

if ($connexion->connect_error) {
    die("Connexion échouée : " . $connexion->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = $_POST["pseudo"];
    $mot_de_passe = $_POST["mot_de_passe"];

    // Requête SQL pour vérifier si les données existent dans la table startuper
    $requete_startuper = "SELECT id_startuper FROM startuper WHERE pseudo = '$pseudo' AND pwd = '$mot_de_passe'";
    $resultat_startuper = $connexion->query($requete_startuper);

    // Requête SQL pour vérifier si les données existent dans la table capital_risque
    $requete_capital_risque = "SELECT id_capital_risque FROM capital_risque WHERE pseudo = '$pseudo' AND pwd = '$mot_de_passe'";
    $resultat_capital_risque = $connexion->query($requete_capital_risque);

    if ($resultat_startuper->num_rows > 0) {
        // Authentification réussie en tant que startuper
        $row_startuper = $resultat_startuper->fetch_assoc();
        $_SESSION['id_startuper'] = $row_startuper['id_startuper'];
        
        header("Location: home_startuper_test.html");
        exit(); 
    } else if ($resultat_capital_risque->num_rows > 0) {
        // Authentification réussie en tant que capital risque
        $row_capital_risque = $resultat_capital_risque->fetch_assoc();
        // Stocker l'ID du capital risque dans une variable de session
        $_SESSION['id_capital_risque'] = $row_capital_risque['id_capital_risque'];
        
        header("Location: home_capitalrisque.html");
        exit();
    } else {
        // Authentification échouée
        header("location: utilisateur_introuvable.html");   
        exit();     
    }

    $connexion->close();
}
?>
