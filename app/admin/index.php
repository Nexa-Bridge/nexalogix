<?php
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
    header('Location: /login.php');
    exit;
}
?>



    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">NexaLogix Admin</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_management.php">Gestion des Utilisateurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="role_management.php">Gestion des Rôles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="settings.php">Paramètres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logs.php">Journaux</a>
                    </li>
                    <!-- Add more menu items here -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Bienvenue dans l'Espace d'Administration de NexaLogix</h1>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestion des Utilisateurs</h5>
                        <p class="card-text">Gérez les comptes utilisateurs, assignez des rôles, et plus.</p>
                        <a href="user_management.php" class="btn btn-primary">Gérer</a>
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

