<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Éditer Projet</title>
  <link rel="stylesheet" type="text/css" href="edit_projet.css">
  <script src="https://kit.fontawesome.com/7777ad54d9.js"></script>

</head>
<body>
<header>
      <div class="navigation-div">
        <nav class="nav">
          <h3 class="logo"><a href="home_startuper_test.html"> Capital Connect</a></h3>
          <ul class="nav-ul">
                <li><a href="home_startuper_test.html">Accueil</a></li>
                <li><a href="ajoutprojet.html">Ajouter un projet</a></li>
                <li><a href="editerprofil0.php">Editer un profil</a></li>
                <li><a href="listerprojets.php">Lister mes projets</a></li>
                <!-- Barre de recherche -->
                <li>
                    <form>
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
    <h2>Éditer Projet</h2>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();

    // Vérifier si l'ID du projet a été transmis via GET
    if (isset($_GET['id'])) {
        $id_projet = $_GET['id'];

        $servername = "localhost";
        $username = "root";
        $password = ""; 
        $database = "projetpweb";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM projet WHERE id_projet = $id_projet";
        $result = $conn->query($sql);

        // Vérifier si le projet existe
        if ($result->num_rows > 0) {
            // Afficher les informations du projet dans un formulaire
            $row = $result->fetch_assoc();
            echo "<form action='update_project.php' method='post' class='editprojet' >";
            echo "<input type='hidden' name='id_projet' value='" . $row['id_projet'] . "'>";
            echo "<label for='titre'>Titre:</label>";
            echo "<input type='text' id='titre' name='titre' value='" . $row['titre'] . "' readonly><br>";
            echo "<label for='description'>Description:</label>";
            echo "<textarea id='description' name='description'readonly>" . $row['description'] . "</textarea><br>";
            echo "<label for='nombre_actions_a_vendre'>Nombre actions à vendre:</label>";
            echo "<input type='text' id='nombre_actions_a_vendre' name='nombre_actions_a_vendre' value='" . $row['nombre_actions_a_vendre'] . "' readonly><br>";
            echo "<label for='nombre_actions_vendues'>Nombre actions vendues:</label>";
            echo "<input type='text' id='nombre_actions_vendues' name='nombre_actions_vendues' value='" . $row['nombre_actions_vendues'] . "' readonly><br>";
            echo "<label for='prix_action'>Prix action:</label>";
            echo "<input type='text' id='prix_action' name='prix_action' value='" . $row['prix_action'] . "' readonly><br>";
            echo "<label for='montant_collecte'>Montant collecté:</label>";
            echo "<input type='text' id='montant_collecte' name='montant_collecte' value='" . ($row['nombre_actions_vendues'] * $row['prix_action']) . "' readonly><br>";
            echo "</form>";
            echo "<a class='return-button' href='listerprojets.php'>Retour</a>";

        } else {
            echo "Projet non trouvé.";
        }

        $conn->close();
    } else {
        echo "ID du projet non spécifié.";
    }
    ?>
  </div>
<footer>
        <div class="row">
            <div class="col">
                <a href="home_startuper_test.html"><p class="col-logo">Capital Connect</p></a>
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
                    <li><a href="home_startuper_test.html">Accueil</a></li>
                    <li><a href="ajoutprojet.html">Ajouter un projet</a></li>
                    <li><a href="editerprofil0.php">Editer un profil</a></li>
                    <li><a href="listerprojets.php">Lister mes projets</a></li>
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
