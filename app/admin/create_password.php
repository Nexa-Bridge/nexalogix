<?php
session_start();
include 'php/database.php'; // Assurez-vous que le chemin est correct

// Assurez-vous que l'utilisateur est bien dans sa première connexion
if (!isset($_SESSION['is_first_login']) || !$_SESSION['is_first_login']) {
    header('Location: login.php');
    exit();
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password == $confirm_password) {
        // Hash du nouveau mot de passe
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Mise à jour du mot de passe dans la base de données
        $sql = "UPDATE Users SET PasswordHash = ? WHERE UserID = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("si", $hashed_password, $_SESSION['user_id']);
            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                // Réinitialisez la variable de session is_first_login
                $_SESSION['is_first_login'] = false;
                header('Location: index.php');
                exit();
            } else {
                $error = "Erreur lors de la mise à jour du mot de passe.";
            }

            $stmt->close();
        }
    } else {
        $error = "Les mots de passe ne correspondent pas.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Créer un Nouveau Mot de Passe</title>
    <!-- Inclure Bootstrap ici si nécessaire -->
</head>
<body>
    <div>
        <h2>Créer un Nouveau Mot de Passe</h2>
        <?php if (!empty($error)) echo "<p>$error</p>"; ?>
        <form action="create_password.php" method="post">
            <div>
                <label>Nouveau mot de passe:</label>
                <input type="password" name="new_password" required>
            </div>
            <div>
                <label>Confirmer le mot de passe:</label>
                <input type="password" name="confirm_password" required>
            </div>
            <div>
                <button type="submit">Modifier le mot de passe</button>
            </div>
        </form>
    </div>
</body>
</html>
