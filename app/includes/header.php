<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Espace Administration - NexaLogix</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="nexalogix/app/admin/css/custom.css">
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



