<?php
// Démarrage de la session
session_start();

// Activez l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclusion des fichiers nécessaires
require_once '../includes/header.php';
require_once 'php/auth.php';
require_once '../php/database.php';

// Vérifier si l'utilisateur est connecté et a le rôle d'administrateur
if (!isset($_SESSION['userid']) || !checkUserRole($_SESSION['userid'], 'admin')) {
    header('Location: /login.php');
    exit;
}

// Vérifier si l'utilisateur se connecte pour la première fois
if (isFirstLogin($_SESSION['userid'])) {
    header('Location: /change-password.php');
    exit;
}

// Contenu de la page d'administration
?>

<div class="container mt-5">
    <h1>Bienvenue dans l'espace d'administration NexaLogix</h1>
    <p>Cette section est réservée aux administrateurs.</p>
    
    <!-- Autres éléments de l'interface d'administration -->

</div>

<?php
// Inclusion du pied de page
require_once '../includes/footer.php';
?>
