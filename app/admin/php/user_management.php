<?php
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include necessary files
require_once '../../includes/header.php';
require_once 'auth.php';

// Check if the user is logged in and is an administrator
if (!isLoggedIn() || !isAdmin()) {
    header('Location: ../../login.php');
    exit;
}
?>

<div class="container mt-5">
    <h1 class="mb-4">Gestion des Utilisateurs</h1>

    <!-- Button to trigger modal for adding a new user -->
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#userModal">
        Ajouter un utilisateur
    </button>

    <!-- User Table -->
    <div class="table-responsive">
        <table class="table table-striped" id="usersTable">
            <thead>
            <tr>
            <th>ID</th>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Role</th>
            </tr>
            </thead>
            <tbody>
                <!-- Les utilisateurs seront chargés ici via AJAX -->
            </tbody>
        </table>
    </div>

    <!-- Le reste du code HTML pour la modal et le formulaire... -->
</div>

<!-- Inclusion du fichier JavaScript pour la gestion des utilisateurs -->
<script src="../js/userManagement.js"></script>

<?php require_once '../../includes/footer.php'; ?>
