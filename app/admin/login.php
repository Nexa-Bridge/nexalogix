<?php
session_start();
include 'php/database.php'; // Assurez-vous que le chemin est correct

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT UserID, PasswordHash, isFirstLogin FROM Users WHERE Username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['PasswordHash'])) {
                $_SESSION['user_id'] = $row['UserID'];

                if ($row['isFirstLogin']) {
                    $_SESSION['is_first_login'] = true;
                    header('Location: create_password.php');
                    exit();
                } else {
                    header('Location: index.php');
                    exit();
                }
            } else {
                $error = "Mot de passe incorrect.";
            }
        } else {
            $error = "Nom d'utilisateur incorrect.";
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion - Administration</title>
    <!-- Inclure Bootstrap ici si nécessaire -->
</head>
<body>
    <div>
        <h2>Connexion</h2>
        <?php if (!empty($error)) echo "<p>$error</p>"; ?>
        <form action="login.php" method="post">
            <div>
                <label>Nom d'utilisateur:</label>
                <input type="text" name="username" required>
            </div>
            <div>
                <label>Mot de passe:</label>
                <input type="password" name="password" >
            </div>
            <div>
                <button type="submit">Connexion</button>
            </div>
        </form>
    </div>
</body>
</html>
