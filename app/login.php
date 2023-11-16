<?php
session_start();
include 'app/admin/php/database.php'; // Assurez-vous que ce chemin est correct

// Redirige l'utilisateur déjà connecté vers le tableau de bord de l'administration
if (isset($_SESSION['user_id']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
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
        $stmt = $pdo->prepare('SELECT UserID, Username, PasswordHash FROM Users WHERE Username = :username');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['PasswordHash'])) {
            // L'utilisateur est authentifié
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['username'] = $user['Username'];

            // Vérifie si l'utilisateur est un administrateur
            $stmt = $pdo->prepare('SELECT r.RoleName FROM Roles r INNER JOIN UserRoles ur ON r.RoleID = ur.RoleID WHERE ur.UserID = :userid');
            $stmt->execute(['userid' => $user['UserID']]);
            $roles = $stmt->fetchAll(PDO::FETCH_COLUMN);

            $_SESSION['is_admin'] = in_array('Administrateur', $roles);
            if ($_SESSION['is_admin']) {
                header('Location: app/admin/index.php');
                exit();
            } else {
                // Redirection pour les utilisateurs non-admin
                header('Location: app/user_dashboard.php'); // Modifiez selon le besoin
                exit();
            }
        } else {
            $error = 'Nom d\'utilisateur ou mot de passe incorrect.';
        }
    }
}
?>
