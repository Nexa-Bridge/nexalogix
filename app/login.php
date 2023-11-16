<?php
// Inclure le fichier de connexion à la base de données
include_once 'admin/php/database.php';

session_start();

// Fonction pour connecter l'utilisateur
function loginUser($username, $password) {
    global $conn;

    $stmt = $conn->prepare("SELECT UserID, PasswordHash, RoleID, IsFirstLogin FROM Users WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['PasswordHash'])) {
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['is_admin'] = ($user['RoleID'] == 1); // Supposons que 1 est l'ID de l'administrateur

            if ($user['IsFirstLogin']) {
                header("Location: change-password.php"); // Rediriger vers une page de changement de mot de passe
            } else {
                header("Location: admin/index.php"); // Rediriger vers la page d'administration
            }
            exit();
        }
    }

    return false;
}

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!loginUser($username, $password)) {
        $error = "Identifiants incorrects";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion - NexaLogix</title>
    <!-- Inclure le fichier CSS ici si nécessaire -->
</head>
<body>
    <div class="login-container">
        <h2>Connexion</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <!-- Formulaire de connexion -->
        <form method="post">
            <div>
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Connexion</button>
        </form>
    </div>
</body>
</html>
