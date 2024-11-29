<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Projets</title>
  <link rel="stylesheet" type="text/css" href="listerprojets.css">
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
    <h2>Liste des Projets</h2><br>
    <div class="projects">
    <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$servername = "localhost";
$username = "root";
$password = ""; 
$database = "projetpweb"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['id_startuper'])) {
    $id_startuper = $_SESSION['id_startuper'];

    $sql = "SELECT * FROM projet WHERE id_startuper = $id_startuper";
    $result = $conn->query($sql);

    // Vérifier s'il existe des projets
    if ($result) {
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>Titre</th>";
            echo "<th>Description</th>";
            echo "<th>Nombre actions à vendre</th>";
            echo "<th>Nombre actions vendues</th>";
            echo "<th>Prix action</th>";
            echo "<th>Editer</th>";
            echo "<th>Supprimer</th>"; 
            echo "</tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['titre'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['nombre_actions_a_vendre'] . "</td>";
                echo "<td>" . $row['nombre_actions_vendues'] . "</td>";
                echo "<td>" . $row['prix_action'] . "</td>";
                echo "<td>";
                // Bouton editer
                echo "<a class='edit-button' href='edit_projet.php?id=" . $row["id_projet"] . "'>Éditer</a>";
                echo "</td>";

                echo "<td>";
                // Vérifier si le nombre d'actions vendues est égal à zéro
                if ($row['nombre_actions_vendues'] == 0) {
                    // Bouton de suppression actif
                    echo "<form class='suppression' method='post'>";
                    echo "<input type='hidden' name='id_projet' value='" . $row['id_projet'] . "'>";
                    echo "<button type='submit' name='delete_project' class='delete-button'>Supprimer</button>";
                    echo "</form>";
                } else {
                    // Bouton de suppression désactivé
                    echo "<button class='disabled' disabled>Supprimer</button>";
                }
                echo "</?td>";
                echo "</tr>";
            }

            echo "</table>";

        } else {
            echo "Aucun projet trouvé pour ce startuper.";
        }
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }
} else {
    echo "ID du startuper non défini dans la session.";
}
echo "<a class='return-button' href='home_startuper_test.html'>Retour</a>";


// Vérifier si le bouton de suppression a été cliqué
if (isset($_POST['delete_project'])) {
    $id_projet = $_POST['id_projet'];
    // Supprimer le projet de la base de données
    $sql_delete = "DELETE FROM projet WHERE id_projet = $id_projet";
    if ($conn->query($sql_delete) === TRUE) {
        // Rafraîchir la page
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "Erreur lors de la suppression du projet : " . $conn->error;
    }
}

$conn->close();
?>

    </div>
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
