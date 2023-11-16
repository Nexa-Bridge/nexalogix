<?php
session_start();
include 'app/includes/database.php'; // Ajustez ce chemin selon votre structure de dossiers

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['old_password'], $_POST['new_password'], $_POST['confirm_password'])) {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Vérifiez si l'ancien mot de passe est correct
        $pdo = new PDO('mysql:host=your_host;dbname=your_db', 'your_username', 'your_password');
        $stmt = $pdo->prepare('SELECT PasswordHash FROM Users WHERE UserID = :userid');
        $stmt->execute(['userid' => $_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($old_password, $user['PasswordHash'])) {
            if ($new_password === $confirm_password) {
                // Mettre à jour le mot de passe
                $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $update_stmt = $pdo->prepare('UPDATE Users SET PasswordHash = :new_password WHERE UserID = :userid');
                if ($update_stmt->execute(['new_password' => $new_password_hash, 'userid' => $_SESSION['user_id']])) {
                    $success = 'Mot de passe changé avec succès.';
                } else {
                    $error = 'Erreur lors de la mise à jour du mot de passe.';
                }
            } else {
                $error = 'Le nouveau mot de passe et la confirmation ne correspondent pas.';
            }
        } else {
            $error = 'Ancien mot de passe incorrect.';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Changer le Mot de Passe - NexaLogix</title>
    <link rel="stylesheet" type="text/css" href="path_to_bootstrap.css">
</head>
<body>
    <div class="container">
        <h2>Changer le Mot de Passe</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form action="change_password.php" method="post">
            <div class="form-group">
                <label for="old_password">Ancien Mot de Passe:</label>
                <input type="password" class="form-control" name="old_password" id="old_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">Nouveau Mot de Passe:</label>
                <input type="password" class="form-control" name="new_password" id="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmer le Nouveau Mot de Passe:</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Changer le Mot de Passe</button>
        </form>
    </div>

    <script src="path_to_jquery.js"></script>
    <script src="path_to_bootstrap.js"></script>
</body>
</html>
