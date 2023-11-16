<?php
include '../../includes/database.php'; // Ajustez le chemin d'accès selon votre structure de dossiers

session_start();

// Vérifie si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
    exit();
}

// Vous pouvez ajouter ici une logique supplémentaire pour vérifier si l'utilisateur est un administrateur

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    if (empty($username) || empty($password) || empty($email)) {
        $error = 'Veuillez remplir tous les champs.';
    } else {
        // Connexion à la base de données
        $pdo = new PDO('mysql:host=your_host;dbname=your_db', 'your_username', 'your_password');

        // Vérifiez d'abord si l'utilisateur existe déjà
        $stmt = $pdo->prepare('SELECT * FROM Users WHERE Username = :username OR Email = :email');
        $stmt->execute(['username' => $username, 'email' => $email]);
        if ($stmt->fetch()) {
            $error = 'Un utilisateur avec ce nom d\'utilisateur ou cet e-mail existe déjà.';
        } else {
            // Hash du mot de passe
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Insertion du nouvel utilisateur
            $stmt = $pdo->prepare('INSERT INTO Users (Username, PasswordHash, Email) VALUES (:username, :password, :email)');
            if ($stmt->execute(['username' => $username, 'password' => $passwordHash, 'email' => $email])) {
                $success = 'Le compte a été créé avec succès.';
            } else {
                $error = 'Erreur lors de la création du compte.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Création de Compte - NexaLogix</title>
    <link rel="stylesheet" type="text/css" href="../../path_to_bootstrap.css">
    <!-- Inclure d'autres fichiers CSS si nécessaire -->
</head>
<body>
    <div class="container">
        <h2>Création de Compte</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>
        <form action="create_account.php" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>

    <script src="../../path_to_jquery.js"></script>
    <script src="../../path_to_bootstrap.js"></script>
</body>
</html>
