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
        
        <!-- Menu de navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Admin Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user_management.php">Gestion des Utilisateurs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="role_management.php">Gestion des Rôles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="settings.php">Paramètres Système</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logs.php">Journaux d'Audit</a>
                        </li>
                        <!-- Ajoutez d'autres liens de menu ici -->
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Contenu de la page -->
        <!-- Ici, vous pouvez ajouter d'autres éléments de l'interface d'administration -->

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
