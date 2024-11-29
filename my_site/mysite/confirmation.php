<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation d'Ajout</title>
    <link rel="stylesheet" type="text/css" href="confirmation.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['success']) && $_GET['success'] == "true") {
            echo "<h2>Projet ajouté avec succès !</h2>";
        } else {
            echo "<h2>Échec d'ajout du projet.</h2>";
        }
        ?>
    </div>

    <script>
        // Redirection vers la page d'accueil après 5 secondes
        setTimeout(function() {
            window.location.href = "home_startuper_test.html";
        }, 3000); // 5000 millisecondes = 5 secondes
    </script>
</body>
</html>
