<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Projets du Capital Risque</title>
    <link rel="stylesheet" type="text/css" href="projets_de_cap.css">
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
  
    <h2>Liste des Projets </h2>
    <?php
    session_start();
    if (!isset($_SESSION['id_capital_risque'])) {
        echo "Vous devez vous connecter en tant que capital risque pour accéder à cette page.";
        exit;
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "projetpweb";
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id_capital_risque = $_SESSION['id_capital_risque'];

    // Requête SQL pour récupérer les projets du capital-risque avec les détails sur les actions achetées et le prix total
    $sql = "SELECT p.id_projet, p.titre, p.description, p.prix_action, c.nombre_actions_achetees, (p.prix_action * c.nombre_actions_achetees) AS investissement_total 
            FROM projet p
            INNER JOIN capital_risque_projet c ON p.id_projet = c.id_projet
            WHERE c.id_capital_risque = $id_capital_risque";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Titre du Projet</th><th>Description</th><th>Prix Action</th><th>Nombre Actions Achetées</th><th>Investissement Total</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['titre'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['prix_action'] . "</td>";
            echo "<td>" . $row['nombre_actions_achetees'] . "</td>";
            echo "<td>" . $row['investissement_total'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Aucun projet trouvé pour ce capital risque.";
    }

    $conn->close();
    ?>

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
