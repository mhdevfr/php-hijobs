<?php
header("HTTP/1.0 404 Not Found");

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur 404 - Page non trouvée</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: #ff0000;
        }
        p {
            color: #555555;
        }
    </style>
</head>
<body>
    <h1>Erreur 404 - Page non trouvée</h1>
    <p>La page que vous avez demandée n'existe pas.</p>
    <p>Chemin : <?= htmlspecialchars($_SERVER['REQUEST_URI']); ?></p>
    <p><a href="index.php">Retourner à l'accueil</a></p>
</body>
</html>
