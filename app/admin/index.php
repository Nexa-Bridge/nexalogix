<?php
session_start();
include '../../includes/header.php'; // Assurez-vous que ce chemin est correct

// Vérifie si l'utilisateur est connecté et est un administrateur


// Vous pouvez ajouter ici une logique supplémentaire pour vérifier si l'utilisateur est un administrateur

// Connexion à la base de données pour récupérer des informations, si nécessaire
$pdo = new PDO('mysql:host=your_host;dbname=your_db', 'your_username', 'your_password');

// Code pour récupérer des informations spécifiques, comme des statistiques, des journaux, etc.

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tableau de Bord Administrateur - NexaLogix</title>
    <!-- Header inclut déjà les liens Bootstrap -->
</head>
<body>
    <div class="container">
        <h1>Bienvenue dans le tableau de bord de l'administrateur</h1>

        <!-- Ici, vous pouvez ajouter le contenu spécifique de votre tableau de bord -->
        <p>Ceci est la page d'accueil de l'administration de NexaLogix.</p>

        <!-- Vous pouvez inclure des statistiques, des liens vers d'autres pages d'administration, etc. -->
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>
