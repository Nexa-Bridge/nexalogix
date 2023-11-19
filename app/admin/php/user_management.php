<?php
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include necessary files
require_once '../../includes/header.php';
require_once 'auth.php';
require_once 'database.php';

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
        <table class="table table-striped">
            <thead>
            <tr>
            <th>ID</th>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Role</th>
            </tr>
            </thead>
            <tbody id="userTableBody">
                <!-- Les utilisateurs seront chargés ici via AJAX -->
            </tbody>
        </table>
    </div>

    <!-- Le reste du code HTML pour la modal et le formulaire... -->
</div>

<!-- Inclusion de jQuery si ce n'est pas déjà fait -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Fonction pour charger et afficher les utilisateurs
    function loadUsers() {
        $.ajax({
            type: 'GET',
            url: 'get_user.php', // Assurez-vous que ce chemin est correct
            success: function(response) {
                let users = JSON.parse(response);
                let html = '';
                users.forEach(user => {
                    html += `<tr>
                                <td>${user.UserID}</td>
                                <td>${user.Username}</td>
                                <td>${user.Email}</td>
                                <td>${user.Role}</td>
                             </tr>`;
                });
                $('#userTableBody').html(html);
            },
            error: function() {
                alert("Erreur lors du chargement des utilisateurs.");
            }
        });
    }

    // Charger les utilisateurs au démarrage de la page
    loadUsers();

    // Ici, vous pouvez ajouter d'autres gestionnaires pour les actions de formulaire, etc.
});
</script>

<?php require_once '../../includes/footer.php'; ?>
