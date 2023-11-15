<?php 
include 'session_check.php'; // Inclure le script de vérification de session
include 'php/database.php'; // Inclure la connexion à la base de données

// Vous pouvez ajouter ici d'autres logiques PHP nécessaires

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord de l'Administration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
        }
        .container {
            max-width: 1200px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tableau de Bord de l'Administration</h1>
        <p>Bienvenue dans le système de gestion d'entrepôt.</p>

        <!-- Ici, vous pouvez ajouter du contenu spécifique à l'administration, comme des statistiques, des tableaux, etc. -->
        <div>
            <a href="logout.php" class="btn btn-danger">Déconnexion</a>
        </div>
    </div>

    <!-- Scripts Bootstrap (JQuery, Popper.js, et Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
