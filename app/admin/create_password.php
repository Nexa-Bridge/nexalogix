<?php
session_start();
include 'php/database.php';

// Assurez-vous que l'utilisateur est bien dans sa première connexion
// ...

// HTML et Bootstrap pour la mise en page
?>
<!DOCTYPE html>
<html>
<head>
    <title>Changement de Mot de Passe</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Changer le Mot de Passe</h2>
        <form action="create_password.php" method="post">
            <!-- Formulaire de changement de mot de passe -->
            <button type="submit" class="btn btn-primary">Changer le Mot de Passe</button>
        </form>
    </div>
</body>
</html>
