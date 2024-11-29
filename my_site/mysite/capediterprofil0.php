<?php
session_start();

// Vérifiez si l'ID du startuper est défini dans la session
if(isset($_SESSION['id_capital_risque'])) {
    // Récupérez l'ID du startuper à partir de la session
    $id_capital_risque = $_SESSION['id_capital_risque'];
} else {
    // Redirigez l'utilisateur vers la page de connexion si l'ID du startuper n'est pas défini dans la session
    header("Location: signin.php");
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

$sql_select_startuper = "SELECT * FROM capital_risque WHERE id_capital_risque = $id_capital_risque";
$result = $conn->query($sql_select_startuper);

if ($result->num_rows > 0) {
    $startuper_info = $result->fetch_assoc();
} else {
    echo "Information du capital risque introuvable.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription Startuper</title>
  <link rel="stylesheet" type="text/css" href="formstartuper.css">
  <script src="https://kit.fontawesome.com/7777ad54d9.js"></script>

</head>
<body>
<header>
      <div class="navigation-div">
        <nav class="nav">
          <h3 class="logo"><a href="home_capitalrisque.html"> Capital Connect</a></h3>
          <ul class="nav-ul">
                <li><a href="home_capitalrisque.html">Accueil</a></li>
                <li><a href="caplisterprojets.php">Acheter un projet</a></li>
                <li><a href="capediterprofil0.php">Editer un profil</a></li>
                <li><a href="projets_de_cap.php">Lister mes projets</a></li>
                <li>
                <form action="recherche.php" method="GET" class="form-inline my-2 my-lg-0">
                    <input type="text" name="keyword" placeholder="Rechercher un projet...">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </li>
                <li>
                  <a href="logout.php"><img src="logout.png" alt="logout" class="logout-img"></a>
                </li>
          </ul>
          
        </nav>
      </div>
    </header>
  
  <div class="container">
    <h2>Modifier Profil</h2>
    <form name="inscription" onsubmit="return validateForm()" method="post" action="capediterprofil.php" class="modifier-profil">
      <label for="nom">Nom:</label>
<input type="text" id="nom" name="nom" onblur="validateNom()" value="<?php echo $startuper_info['nom']; ?>">
<span id="nom-error" class="error"></span>

<label for="prenom">Prénom:</label>
<input type="text" id="prenom" name="prenom" onblur="validatePrenom()" value="<?php echo $startuper_info['prenom']; ?>">
<span id="prenom-error" class="error"></span>

<label for="cin">Numéro CIN (8 chiffres):</label>
<input type="text" id="cin" name="cin" onblur="validateCIN()" value="<?php echo $startuper_info['cin']; ?>">
<span id="cin-error" class="error"></span>

<label for="email">Email:</label>
<input type="text" id="email" name="email" onblur="validateEmail()" value="<?php echo $startuper_info['email']; ?>">
<span id="email-error" class="error"></span>


<label for="pseudo">Pseudo:</label>
<input type="text" id="pseudo" name="pseudo" value="<?php echo $startuper_info['pseudo']; ?>">

<label for="password">Mot de passe (8 caractères min, lettre, chiffre, $ ou # à la fin):</label>
<input type="password" id="password" name="password" onblur="validatePassword()" value="<?php echo $startuper_info['pwd']; ?>">
<span id="password-error" class="error"></span>

      
      <input type="submit" value="Modifier">
    </form>
  </div>
  <script src="formstartuper.js"></script>
  <footer>
        <div class="row">
            <div class="col">
                <a href="home_capitalrisque.html"><p class="col-logo">Capital Connect</p></a>
            </div>
            <div class="col">
                <h3>localisation <div class="underline"><span></span></div></h3>
                <p>rue liberte</p>
                <p>Tunis,Tunisie</p>
                <p class="email-id">mohamedghanmi011@gmail.com</p>
                <h4>28497803</h4>
            </div>
            <div class="col">
                <h3>Links <div class="underline"><span></span></div></h3>
                <ul>
                  <li><a href="home_capitalrisque.html">Accueil</a></li>
                  <li><a href="caplisterprojets.php">Acheter un projet</a></li>
                  <li><a href="capediterprofil0.php">Editer profil</a></li>
                  <li><a href="projets_de_cap.php">Lister mes projets</a></li>
                  <li><a href="">About us</a></li>
                  <li><a href="">Contact</a></li>

                </ul>
            </div>
            <div class="col">
                <h3>newsletter <div class="underline"><span></span></div></h3>
                <form>
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" placeholder="enter your email id" required >
                    <button type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                </form>
                <div class="social-icons">
                <i class="fa-brands fa-facebook-f"></i>
                <i class="fa-brands fa-x"></i>
                <i class="fa-brands fa-whatsapp"></i>
                <i class="fa-brands fa-instagram"></i>
                </div>
            </div>

        </div>
        <hr>
     </footer>   
   
</body>
</html>