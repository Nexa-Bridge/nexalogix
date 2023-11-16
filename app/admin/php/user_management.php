<?php
// Start the session and include necessary files
session_start();
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../includes/header.php'; // Correct the path as needed
require_once 'auth.php'; // Correct the path as needed
require_once 'database.php'; // Correct the path as needed

// Check if the user is logged in and is an administrator
if (!isLoggedIn() || !isAdmin()) {
    header('Location: /login.php');
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Email</th>
                    <th>Actions</th>
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
<?php require_once '../../includes/footer.php'; // Correct the path as needed ?>