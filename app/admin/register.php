<?php
include 'php/database.php'; // Assurez-vous que le chemin vers votre script de connexion à la base de données est correct

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // Ce mot de passe devrait être hashé avant d'être stocké
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Vérifiez si l'utilisateur existe déjà
    $checkUserSql = "SELECT * FROM Users WHERE Username = ?";
    $stmt = $conn->prepare($checkUserSql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Un utilisateur avec ce nom existe déjà.";
    } else {
        // Insérer le nouvel utilisateur dans la base de données
        $insertSql = "INSERT INTO Users (Username, PasswordHash) VALUES (?, ?)";
        if ($insertStmt = $conn->prepare($insertSql)) {
            $insertStmt->bind_param("ss", $username, $hashed_password);
            if ($insertStmt->execute()) {
                $success = "Compte créé avec succès. Vous pouvez maintenant vous connecter.";
            } else {
                $error = "Erreur lors de la création du compte.";
            }
            $insertStmt->close();
        }
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Compte</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .register-container {
            margin-top: 80px;
        }
        .register-form {
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="container register-container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center">Créer un Compte</h2>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                <form action="register.php" method="post" class="register-form">
                    <div class="form-group">
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
