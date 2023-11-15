<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Si aucune session "user_id" n'est active, redirigez vers la page de connexion
    header('Location: login.php');
    exit;
}
?>
