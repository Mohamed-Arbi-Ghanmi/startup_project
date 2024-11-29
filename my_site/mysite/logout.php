<?php
session_start();

// Détruisez toutes les données de session
$_SESSION = array();

session_destroy();

// Redirigez l'utilisateur vers la page de connexion
header("Location: signin.html");
exit;
?>
