<?php
session_start();

// Assurez-vous que l'utilisateur est bien dans sa première connexion
// Sinon, redirigez-le vers la page de connexion ou d'accueil.

// Après la validation du formulaire de nouveau mot de passe
// Mettez à jour le mot de passe et redirigez l'utilisateur vers l'index

?>

<!DOCTYPE html>
<html>
<head>
    <title>Créer un Nouveau Mot de Passe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mt-5">Créer un Nouveau Mot de Passe</h2>
            <form action="" method="post">
                <!-- Formulaire de nouveau mot de passe -->
                <div class="form-group">
                    <label for="new_password">Nouveau mot de passe</label>
                    <input type="password" class="form-control" name="new_password" id="new_password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirmez le mot de passe</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary">Créer le mot de passe</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
