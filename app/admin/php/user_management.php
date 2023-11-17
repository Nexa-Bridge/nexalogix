

<?php
// Start the session and include necessary files
session_start();
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//require_once '../../includes/header.php';


require_once 'auth.php';
require_once 'database.php';

// Check if the user is logged in and is an administrator
if (!isLoggedIn() || !isAdmin()) {
    header('Location: /login.php');
    exit;
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Espace Administration - NexaLogix</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/custom.css">
</head>
<body>
<?php


// Detect if the current script is login.php
$isLoginPage = basename($_SERVER['PHP_SELF']) == 'login.php';

// Include navbar.php if it's not the login page
if (!$isLoginPage) {
    include 'navbar.php'; // Adjust the path if necessary
}

// Rest of your header content (like loading CSS, etc.)
?>

    <header>
        
    </header>


<div class="container mt-5">
    <h1 class="mb-4">Gestion des Utilisateurs</h1>

    <!-- Button to trigger modal for adding a new user -->
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#userModal">
        Ajouter un utilisateur
    </button>
    <button id="loadUsersButton" class="btn btn-primary">Load Users</button>


    <!-- User Table -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th onclick="sortTable('UserID')">ID</th>
                <th onclick="sortTable('Username')">Nom d'utilisateur</th>
                <th onclick="sortTable('Email')">Email</th>
                <th onclick="sortTable('Role')">Role</th>
            </tr>
            </thead>
            <tbody id="userTableBody">
                <!-- Users will be loaded here via AJAX -->
            </tbody>
        </table>
    </div>

    <!-- User Modal (for adding/editing) -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Ajouter un utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding or editing a user -->
                    <form id="userForm">
                        <div class="form-group">
                            <label for="username">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <input type="hidden" id="userId" name="userId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary" form="userForm">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once '../../includes/footer.php'; ?>