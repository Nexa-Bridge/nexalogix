<?php
session_start();
include 'app/includes/database.php'; // Assurez-vous que ce chemin mène à votre fichier de connexion à la base de données

// Vérifie si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    header('Location: app/admin/index.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = 'Veuillez entrer votre nom d\'utilisateur et votre mot de passe.';
    } else {
        // Connexion à la base de données
        $pdo = new PDO('mysql:host=your_host;dbname=your_db', 'your_username', 'your_password');
        $stmt = $pdo->prepare('SELECT UserID, Username, PasswordHash, FirstLogin FROM Users WHERE Username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['PasswordHash'])) {
            // L'utilisateur est authentifié
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['username'] = $user['Username'];

            if ($user['FirstLogin']) {
                header('Location: change_password.php'); // Redirige vers la page de changement de mot de passe
            } else {
                // Vérifie si l'utilisateur est un administrateur
                $stmt = $pdo->prepare('SELECT r.RoleName FROM Roles r INNER JOIN UserRoles ur ON r.RoleID = ur.RoleID WHERE ur.UserID = :userid');
                $stmt->execute(['userid' => $user['UserID']]);
                $roles = $stmt->fetchAll(PDO::FETCH_COLUMN);

                if (in_array('Administrateur', $roles)) {
                    header('Location: app/admin/index.php');
                } else {
                    header('Location: user_dashboard.php'); // Ou tout autre page pour les utilisateurs non-admin
                }
            }
            exit();
        } else {
            $error = 'Nom d\'utilisateur ou mot de passe incorrect.';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion - NexaLogix</title>
    <link rel="stylesheet" type="text/css" href="path_to_bootstrap.css">
    <!-- Inclure d'autres fichiers CSS si nécessaire -->
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
    </div>

    <script src="path_to_jquery.js"></script>
    <script src="path_to_bootstrap.js"></script>
</body>
</html>
