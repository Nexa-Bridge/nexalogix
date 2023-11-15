<?php
include 'php/database.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validation basique
    if (empty($username) || empty($password)) {
        $message = "Veuillez remplir tous les champs.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Requête d'insertion
        $sql = "INSERT INTO Users (Username, PasswordHash) VALUES (?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $username, $hashed_password);
            if ($stmt->execute()) {
                $message = "Compte créé avec succès. <a href='login.php'>Se connecter</a>";
            } else {
                $message = "Erreur : " . $conn->error; // Affiche les détails de l'erreur SQL
            }
            $stmt->close();
        } else {
            $message = "Erreur de préparation : " . $conn->error;
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <!-- Bootstrap CSS Bejnyz-0wifsy-syjsox  -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>
        <?php if (!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="register.php" method="post">
            <div class="form-group">
                <label>Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
    </div>
</body>
</html>
