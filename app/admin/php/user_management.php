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

    Button to trigger modal for adding a new user 
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
        Add New User
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
            <tbody id="userTableBody"></tbody>
                <!-- Les utilisateurs seront chargés ici via AJAX -->
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                <!-- Form Fields for Username, Email, etc. -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addUser()">Save User</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Le reste du code HTML pour la modal et le formulaire... -->
</div>

<?php require_once '../../includes/footer.php'; ?>
