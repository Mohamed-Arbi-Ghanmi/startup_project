<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Startuper</title>
    <link rel="stylesheet" type="text/css" href="listerprojets.css"> 
    <script src="https://kit.fontawesome.com/7777ad54d9.js"></script>
    <script src="../custom-scripts.js" defer></script>
</head>
<body>

<header>
    <!-- Navigation list -->
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

<main>
    <?php
    $serveur = "localhost"; 
    $utilisateur = "root";
    $mot_de_passe = ""; 
    $base_de_donnees = "projetpweb";

    $connexion = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

    if ($connexion->connect_error) {
        die("Connexion échouée : " . $connexion->connect_error);
    }

    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];

        // Sélectionner les projets avec un titre ou une description contenant le terme de recherche
        $sql = "SELECT * FROM projet WHERE titre LIKE '%$keyword%' OR description LIKE '%$keyword%'";
        $result = $connexion->query($sql);

        // Afficher les résultats de la recherche
        if ($result->num_rows > 0) {
            echo "<table id='projetTable'>";
            echo "<tr>";
            echo "<th>Titre</th>";
            echo "<th>Description</th>";
            echo "<th>Nombre actions à vendre</th>";
            echo "<th>Prix action</th>";
            echo "<th>Éditer</th>"; 
            echo "<th>Acheter</th>";
            echo "</tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr class='caplisterprojets'>";
                echo "<td>" . $row['titre'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['nombre_actions_a_vendre'] . "</td>";
                echo "<td>" . $row['prix_action'] . "</td>";
                echo "<td>";
                echo "<a class='edit-button' href='capedit_projet.php?id=" . $row["id_projet"] . "'>Éditer</a>";
                echo "</td>";
                echo "<td>";
                echo "<a class='buy-button' href='acheterprojet.php?id=" . $row["id_projet"] . "'>Acheter</a>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Aucun projet trouvé avec le terme de recherche '$keyword'.";
        }
    }

    $connexion->close();
    ?>
</main>



<style>
    footer{
        bottom: 0;
    }
</style>


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
