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
          <h3 class="logo"><a href="home_capitalrisque.html"> Capital Connect</a></h3>
          <ul class="nav-ul">
                <li><a href="home_capitalrisque.html">Accueil</a></li>
                <li><a href="caplisterprojets.php">Acheter un projet</a></li>
                <li><a href="capediterprofil0.php">Editer un profil</a></li>
                <li><a href="projets_de_cap.php">Lister mes projets</a></li>
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

$_SESSION['message'] = '';

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
        echo "<form action='' " . $_SERVER['PHP_SELF'] . " method='post' class='editprojet' >";
        echo "<input type='hidden' name='id_projet' value='" . $row['id_projet'] . "'>";
        echo "<label for='titre'>Titre:</label>";
        echo "<input type='text' id='titre' name='titre' value='" . $row['titre'] . "' readonly><br>";
        echo "<label for='description'>Description:</label>";
        echo "<textarea id='description' name='description' readonly>" . $row['description'] . "</textarea><br>";
        echo "<label for='nombre_actions_a_vendre'>Nombre actions à vendre:</label>";
        echo "<input type='text' id='nombre_actions_a_vendre' name='nombre_actions_a_vendre' value='" . $row['nombre_actions_a_vendre'] . "' readonly><br>";
        echo "<label for='nombre_actions_vendues'>Nombre actions vendues:</label>";
        echo "<input type='text' id='nombre_actions_vendues' name='nombre_actions_vendues' value='" . $row['nombre_actions_vendues'] . "' readonly><br>";
        echo "<label for='prix_action'>Prix action:</label>";
        echo "<input type='text' id='prix_action' name='prix_action' value='" . $row['prix_action'] . "' readonly><br>";
        echo "<label for='nombre_stocks_a_acheter'>Nombre de stocks à acheter:</label>";
        echo "<input type='number' id='nombre_stocks_a_acheter' name='nombre_stocks_a_acheter' step='1' min='0' oninput='calculateTotal()'><br>";
        echo "<label for='prix_total'>Prix total:</label>";
        echo "<input type='text' id='prix_total' name='prix_total' readonly><br>";

        echo "<input type='submit' class='buy-button' value='Acheter'>";
        echo "<a class='return-button' href='caplisterprojets.php'>Retour</a>";
        echo "</form>";

        echo "<script>";
        echo "function calculateTotal() {";
        echo "    var prixAction = parseFloat(document.getElementById('prix_action').value);";
        echo "    var nombreStocks = parseInt(document.getElementById('nombre_stocks_a_acheter').value);";
        echo "    var prixTotal = prixAction * nombreStocks;";
        echo "    document.getElementById('prix_total').value = prixTotal.toFixed(2);";
        echo "}";
        echo "</script>";

        // Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($_SESSION['message'])) {
    // Récupérer les données du formulaire
    $nombre_stocks_a_acheter = $_POST["nombre_stocks_a_acheter"];

    // Vérifier si le nombre d'actions à acheter est valide
    if ($nombre_stocks_a_acheter <= $row['nombre_actions_a_vendre']) {
        // Mettre à jour le nombre d'actions disponibles à la vente
        $nouveau_nombre_actions_a_vendre = $row['nombre_actions_a_vendre'] - $nombre_stocks_a_acheter;
        
        // Mettre à jour le nombre d'actions vendues
        $nouveau_nombre_actions_vendues = $row['nombre_actions_vendues'] + $nombre_stocks_a_acheter;

        // Exécuter la requête SQL pour mettre à jour les données du projet dans la base de données
        $sql_update = "UPDATE projet SET nombre_actions_a_vendre = $nouveau_nombre_actions_a_vendre, nombre_actions_vendues = $nouveau_nombre_actions_vendues WHERE id_projet = $id_projet";

        if ($conn->query($sql_update) === TRUE) {
            // Mettre à jour la table capital_risque_projet
            $id_capital_risque = $_SESSION['id_capital_risque']; 
            $nombre_actions_achetees = $nombre_stocks_a_acheter;
            
            // Vérifier si une entrée existe déjà pour ce projet et ce capital-risque
            $sql_check_entry = "SELECT * FROM capital_risque_projet WHERE id_projet = $id_projet AND id_capital_risque = $id_capital_risque";
            $result_check_entry = $conn->query($sql_check_entry);

            if ($result_check_entry->num_rows > 0) {
                // Mettre à jour le nombre d'actions achetées dans l'entrée existante
                $row_check_entry = $result_check_entry->fetch_assoc();
                $nombre_actions_achetees += $row_check_entry['nombre_actions_achetees'];
                $sql_update_entry = "UPDATE capital_risque_projet SET nombre_actions_achetees = $nombre_actions_achetees WHERE id_projet = $id_projet AND id_capital_risque = $id_capital_risque";
                $conn->query($sql_update_entry);
            } else {
                // Insérer une nouvelle entrée dans capital_risque_projet
                $sql_insert_entry = "INSERT INTO capital_risque_projet (id_projet, id_capital_risque, nombre_actions_achetees) VALUES ($id_projet, $id_capital_risque, $nombre_actions_achetees)";
                $conn->query($sql_insert_entry);
            }

            // Si l'achat réussit, définissez le message de succès
            $_SESSION['message'] = "Achat réussi !";
        } 
    } else {
        echo "<div class='echec-achat'>Le nombre d'actions à acheter dépasse le nombre d'actions disponibles à la vente.</div>";
    }
}

    } else {
        echo "Projet non trouvé.";
    }

    $conn->close();
} else {
    echo "ID du projet non spécifié.";
}
// Afficher le message de succès s'il est défini
if (!empty($_SESSION['message'])) {
    echo "<div class='message'>" . $_SESSION['message'] . "</div>";
    $_SESSION['message'] = '';
   // Redirection HTTP vers la même page 
   echo "<meta http-equiv='refresh' content='2;url=".$_SERVER['PHP_SELF']."?id=".$id_projet."'>";
}
?>
 

  </div>
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
