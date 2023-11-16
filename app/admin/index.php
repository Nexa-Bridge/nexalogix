<?php
session_start();
//include '../../includes/header.php'; // Assurez-vous que ce chemin est correct

// Vérifie si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: ../../login.php');
    exit();
}

// Connexion à la base de données pour récupérer des informations
$pdo = new PDO('mysql:host=your_host;dbname=your_db', 'your_username', 'your_password');

// Code pour récupérer des informations spécifiques, comme des statistiques, des journaux, etc.

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tableau de Bord Administrateur - NexaLogix</title>
    <!-- Assurez-vous que les chemins des fichiers CSS Bootstrap sont corrects -->
    <link rel="stylesheet" type="text/css" href="../../path_to_bootstrap.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenue dans le tableau de bord de l'administrateur</h1>
        
        <!-- Ici, ajoutez le contenu spécifique de votre tableau de bord -->
        <p>Ceci est la page d'accueil de l'administration de NexaLogix.</p>

        <!-- Exemple de contenu : statistiques, gestion des utilisateurs, etc. -->
        
        <!-- Lien pour créer un nouveau compte administrateur -->
        <a href="php/create_account.php" class="btn btn-info">Créer un Nouveau Compte Administrateur</a>

        <!-- Lien pour se déconnecter -->
        <a href="../../logout.php" class="btn btn-warning">Déconnexion</a>
    </div>

    <script src="../../path_to_jquery.js"></script>
    <script src="../../path_to_bootstrap.js"></script>
    <?php include '../../includes/footer.php'; ?>
</body>
</html>
