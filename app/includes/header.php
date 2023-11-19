<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Espace Administration - NexaLogix</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/app/admin/css/custom.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Inclusion de userManagement.js après jQuery -->
    <script src="/app/admin/js/userManagement.js"></script>
</head>
<body>
<?php
// Detect if the current script is login.php
$isLoginPage = basename($_SERVER['PHP_SELF']) == 'login.php';

// Include navbar.php if it's not the login page
if (!$isLoginPage) {
    include 'navbar.php'; // Adjust the path if necessary
}
?>
    <header>
        <!-- Contenu de l'en-tête -->
    </header>
    <!-- Reste de votre contenu -->
