<?php
// Ici, vous devrez intégrer la logique PHP pour vérifier la connexion
// et si c'est la première connexion de l'utilisateur.

session_start();

// Simulons une vérification de l'utilisateur
$isFirstLogin = false; // Changez cette variable en fonction de la logique de vérification

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Après la validation du formulaire de connexion
// Si c'est la première connexion, redirigez vers la page de création de mot de passe
if ($isFirstLogin) {
    header('Location: create_password.php');
    exit();
}

// Ici, ajoutez la logique de connexion
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion - Administration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mt-5">Connexion</h2>
            <form action="" method="post">
                <!-- Formulaire de connexion -->
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
