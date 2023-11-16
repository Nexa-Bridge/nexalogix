<?php
session_start();

// Activez l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'app/admin/php/database.php'; // Assurez-vous que ce chemin est correct

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username'], $_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if (empty($username) || empty($password)) {
            $error = 'Veuillez entrer votre nom d\'utilisateur et votre mot de passe.';
        } else {
            // Connexion à la base de données
            try {
                $pdo = new PDO('mysql:host=your_host;dbname=your_db', 'your_username', 'your_password');
                $stmt = $pdo->prepare('SELECT UserID, Username, PasswordHash FROM Users WHERE Username = :username');
                $stmt->execute(['username' => $username]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['PasswordHash'])) {
                    $_SESSION['user_id'] = $user['UserID'];
                    $_SESSION['username'] = $user['Username'];

                    // Vérifie si l'utilisateur est un administrateur
                    $stmt = $pdo->prepare('SELECT r.RoleName FROM Roles r INNER JOIN UserRoles ur ON r.RoleID = ur.RoleID WHERE ur.UserID = :userid');
                    $stmt->execute(['userid' => $user['UserID']]);
                    $roles = $stmt->fetchAll(PDO::FETCH_COLUMN);

                    if (in_array('Administrateur', $roles)) {
                        $_SESSION['is_admin'] = true;
                        header('Location: app/admin/index.php');
                        exit();
                    } else {
                        $_SESSION['is_admin'] = false;
                        header('Location: app/user_dashboard.php'); // Modifier selon le besoin
                        exit();
                    }
                } else {
                    $error = 'Nom d\'utilisateur ou mot de passe incorrect.';
                }
            } catch (PDOException $e) {
                $error = "Erreur de connexion à la base de données : " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion - NexaLogix</title>
    <link rel="stylesheet" type="text/css" href="path_to_bootstrap.css">
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
        <a href="app/admin/php/create_account.php" class="btn btn-info">Créer un Compte Administrateur</a>
    </div>

    <script src="path_to_jquery.js"></script>
    <script src="path_to_bootstrap.js"></script>
</body>
</html>
