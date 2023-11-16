<?php
session_start();

// Activez l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'admin/php/database.php'; // Assurez-vous que ce chemin est correct

// Variables pour stocker les messages d'erreur/confirmation
$error = '';
$success = '';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Vérifier les identifiants de l'utilisateur
    if (validateUser($username, $password)) {
        // Identifiants valides, création de la session et redirection
        $_SESSION['userid'] = getUserId($username);
        header("Location: admin/index.php");
        exit;
    } else {
        $error = 'Identifiants incorrects.';
    }
}

/**
 * Valide les identifiants de l'utilisateur.
 *
 * @param string $username Nom d'utilisateur.
 * @param string $password Mot de passe.
 * @return bool Retourne vrai si les identifiants sont valides, sinon faux.
 */
function validateUser($username, $password) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("SELECT PasswordHash FROM Users WHERE Username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result && password_verify($password, $result['PasswordHash'])) {
            return true;
        }
    } catch (PDOException $e) {
        // Gérer l'erreur ici
    }

    return false;
}

/**
 * Obtient l'ID de l'utilisateur à partir du nom d'utilisateur.
 *
 * @param string $username Nom d'utilisateur.
 * @return int ID de l'utilisateur.
 */
function getUserId($username) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("SELECT UserID FROM Users WHERE Username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result['UserID'] ?? 0;
    } catch (PDOException $e) {
        // Gérer l'erreur ici
        return 0;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - NexaLogix</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Mettre à jour le chemin -->
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
    </div>
</body>
</html>
