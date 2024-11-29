
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
$pseudo = $_POST['pseudo'];
$password = $_POST['password'];


$sql = "INSERT INTO capital_risque (nom, prenom, cin, email, pseudo, pwd) 
        VALUES ('$nom', '$prenom', '$cin', '$email', '$pseudo', '$password')";

if ($conn->query($sql) === TRUE) {
    $id_capital_risque = $conn->insert_id;
    
    // Stocker l'ID du capital risque dans une variable de session
    session_start();
    $_SESSION['id_capital_risque'] = $id_capital_risque;
    
    // Rediriger vers la page de confirmation
    header("Location: confirmationajoutcap.php");
    exit();
} else {
    header("refresh:0;url=compte_existe_cap.html");
    exit();
}

$conn->close();
?>

