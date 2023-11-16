<?php
// Inclure le fichier d'authentification pour vérifier si l'administrateur est connecté
include_once 'php/auth.php';

// Vérifier si l'utilisateur demande la déconnexion
if (isset($_GET['logout'])) {
    logoutUser();
}

// Ici, vous pouvez ajouter du code pour gérer d'autres fonctionnalités d'administration
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administration - NexaLogix</title>
    <!-- Inclure le fichier CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="admin-container">
        <h1>Tableau de Bord Administrateur</h1>

        <!-- Contenu du tableau de bord de l'administrateur -->
        <p>Bienvenue dans l'espace d'administration de NexaLogix.</p>

        <!-- Lien de déconnexion -->
        <a href="?logout">Déconnexion</a>

        <!-- Ici, vous pouvez ajouter plus de contenu ou de fonctionnalités spécifiques à l'administrateur -->
    </div>
</body>
</html>
