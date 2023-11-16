<?php
session_start();ß
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
        Lien pour créer un compte administrateur, affiché seulement si nécessaire
        <a href="app/admin/php/create_account.php" class="btn btn-info">Créer un Compte Administrateur</a>
    </div>

    <script src="path_to_jquery.js"></script>
    <script src="path_to_bootstrap.js"></script>
</body>
</html>