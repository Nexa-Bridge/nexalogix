<?php
// Start the session
session_start();
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'includes/header.php'; // Adjust the path as necessary

// Check if the user is already logged in
if (isLoggedIn()) {
    header('Location: user_dashboard.php'); // Redirect to the dashboard if already logged in
    exit;
}

// Handle login logic here
// If login is successful, redirect to the dashboard or another page

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Connexion</h4>
                </div>
                <div class="card-body">
                    <form action="path_to_login_processing_script.php" method="POST">
                        <div class="form-group">
                            <label for="username">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Connexion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/includes/footer.php'; ?>
