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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784//j6cY/iJTQU5i9i8x0KuX+VIFb2e7Z" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
        <h1>Bienvenue dans l'espace d'administration NexaLogix</h1>
        <p>Cette section est réservée aux administrateurs.</p>
        
        <!-- Navigation Menu -->
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
                        <!-- Add more menu links here -->
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <!-- You can add more admin interface elements here -->

    </div>

    <!-- Script JS (Bootstrap, jQuery) -->
    <!-- Bootstrap JS and its dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <?php
    // Inclusion du pied de page
    require_once '../includes/footer.php'; // Ajustez le chemin si nécessaire
    ?>
</body>
</html>
