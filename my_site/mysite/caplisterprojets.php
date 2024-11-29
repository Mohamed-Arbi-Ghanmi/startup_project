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
      <!--Navigation list-->
      <div class="navigation-div">
        <nav class="nav">
          <h3 class="logo"><a href="home_capitalrisque.html"> Capital Connect</a></h3>
          <ul class="nav-ul">
                <li><a href="home_capitalrisque.html">Accueil</a></li>
                <li><a href="caplisterprojets.php">Acheter un projet</a></li>
                <!-- <li><a href="capedit_projet.php">Editer un projet</a></li> -->
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
    <h2>Liste des Projets</h2><br>
    <div class="projects">
    <?php
    
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $database = "projetpweb"; 

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM projet WHERE nombre_actions_a_vendre > 0";
    $result = $conn->query($sql);

    // Vérifier s'il existe des projets
    if ($result) {
        if ($result->num_rows > 0) {
            // Afficher le début du tableau
            echo "<table ";
            echo "<tr>";
            echo "<th>Titre</th>";
            echo "<th>Description</th>";
            echo "<th>Nombre actions à vendre</th>";
            echo "<th>Prix action</th>";
            echo "<th>Éditer</th>"; 
            echo "<th>Acheter</th>";
            echo "</tr>";

            // Afficher les données de chaque projet dans une ligne du tableau
            while($row = $result->fetch_assoc()) {
                echo "<tr class='caplisterprojets' >";
                echo "<td>" . $row['titre'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['nombre_actions_a_vendre'] . "</td>";
                echo "<td>" . $row['prix_action'] . "</td>";
                echo "<td>";
                // Bouton Editer
                echo "<a class='edit-button' href='capedit_projet.php?id=" . $row["id_projet"] . "'>Éditer</a>";
                echo "</td>";
                // Bouton Acheter
                echo "<td>";
                echo "<a class='buy-button' href='acheterprojet.php?id=" . $row["id_projet"] . "'>Acheter</a>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Aucun projet trouvé avec un nombre d'actions à vendre supérieur à zéro.";
        }
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }

    $conn->close();
    ?>
    </div>
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
