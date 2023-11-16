<?php
// Inclure le fichier de connexion à la base de données
include_once 'admin/php/database.php';

session_start();

// Redirection si l'utilisateur n'est pas connecté ou n'est pas dans son premier login
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_first_login']) || !$_SESSION['is_first_login']) {
    header("Location: login.php");
    exit();
}

// Traitement du formulaire de changement de mot de passe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword == $confirmPassword) {
        // Hash le nouveau mot de passe
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe dans la base de données
        $stmt = $conn->prepare("UPDATE Users SET PasswordHash = ?, IsFirstLogin = 0 WHERE UserID = ?");
        $stmt->bind_param("si", $hashedPassword, $_SESSION['user_id']);
        $stmt->execute();

        // Rediriger vers la page d'administration après la mise à jour
        header("Location: admin/index.php");
        exit();
    } else {
        $error = "Les mots de passe ne correspondent pas.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Changer Mot de Passe - NexaLogix</title>
    <!-- Inclure le fichier CSS ici si nécessaire -->
</head>
<body>
    <div class="change-password-container">
        <h2>Changer le mot de passe</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <!-- Formulaire de changement de mot de passe -->
        <form method="post">
            <div>
                <label for="newPassword">Nouveau mot de passe:</label>
                <input type="password" id="newPassword" name="newPassword" required>
            </div>
            <div>
                <label for="confirmPassword">Confirmer le mot de passe:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
            </div>
            <button type="submit">Changer le mot de passe</button>
        </form>
    </div>
</body>
</html>
