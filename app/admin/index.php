<?php


echo "<pre>Session: "; print_r($_SESSION); echo "</pre>";
echo "isLoggedIn: " . (isLoggedIn() ? "true" : "false") . "<br>";
echo "isAdmin: " . (isAdmin() ? "true" : "false") . "<br>";

// Start the session
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include necessary files
require_once '../includes/header.php';
require_once 'php/auth.php';
require_once 'php/database.php';

// Check if the user is logged in and is an administrator
if (!isLoggedIn() || !isAdmin()) {
    header('Location: ../login.php');
    exit;
}
?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Bienvenue dans l'Espace d'Administration de NexaLogix</h1>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des Utilisateurs</h5>
                        <p class="card-text">Gérez les comptes utilisateurs, assignez des rôles, et plus.</p>
                        <a href="php/user_management.php" class="btn btn-primary">Gérer</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Vérification des Journaux</h5>
                        <p class="card-text">Consultez les journaux d'activités pour la maintenance et la sécurité.</p>
                        <a href="logs.php" class="btn btn-primary">Consulter</a>
                    </div>
                </div>
            </div>
            <!-- Add more cards/sections here -->
        </div>
    </div>
    <?php require_once '../includes/footer.php'; // Adjust the path as needed ?>
