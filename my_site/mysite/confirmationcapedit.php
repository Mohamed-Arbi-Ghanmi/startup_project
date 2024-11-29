<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de mise a jour</title>
    <link rel="stylesheet" type="text/css" href="confirmation.css">
</head>
<body>
    <div class="container">
        <?php
        // Vérifier si le succès est défini dans l'URL
        if (isset($_GET['success']) && $_GET['success'] == "true") {
            echo "<h2>Profil mis a avec succès !</h2>";
        } else {
            echo "<h2>Échec de mise a jour du profil.</h2>";
        }
        ?>
        <p>Vous allez être redirigé vers la page d'accueil dans quelques secondes...</p>
    </div>

    <script>
        // Redirection vers la page d'accueil après 5 secondes
        setTimeout(function() {
            window.location.href = "home_capitalrisque.html";
        }, 5000); // 5000 millisecondes = 5 secondes
    </script>
</body>
</html>
