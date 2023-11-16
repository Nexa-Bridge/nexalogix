<?php
// Démarrage de la session
session_start();

// Activez l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclusion des fichiers nécessaires
require_once '../includes/header.php';
require_once 'php/auth.php';
require_once 'php/database.php';

// Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
if (!isLoggedIn() || !isAdmin()) {
    header('Location: /login.php');
    exit;
}

// Contenu de la page d'administration
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Administration - NexaLogix</title>
    <link rel="stylesheet" href="../path_to_bootstrap.css"> <!-- Ajustez le chemin si nécessaire -->
</head>
<body>
    <div class="container mt-5">
        <h1>Bienvenue dans l'espace d'administration NexaLogix</h1>
        <p>Cette section est réservée aux administrateurs.</p>
        
        <!-- Ici, vous pouvez ajouter d'autres éléments de l'interface d'administration -->
        <!-- Par exemple, des liens vers d'autres pages d'administration, des tableaux de statistiques, etc. -->

    </div>

    <!-- Script JS (Bootstrap, jQuery) -->
    <script src="../path_to_jquery.js"></script> <!-- Ajustez le chemin si nécessaire -->
    <script src="../path_to_bootstrap.js"></script> <!-- Ajustez le chemin si nécessaire -->

    <?php
    // Inclusion du pied de page
    require_once '../includes/footer.php'; // Ajustez le chemin si nécessaire
    ?>
</body>
</html>
