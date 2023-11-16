<?php
// Start the session
session_start();
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'admin/php/auth.php';  // Path to your auth.php file
require_once 'admin/php/database.php';  // Path to your database.php file

// If already logged in, redirect to user dashboard
if (isLoggedIn()) {
    header('Location: user_dashboard.php');
    exit;
}

$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... [Previous code remains unchanged]

    if (!empty($username) && !empty($password)) {
        // ... [Previous code remains unchanged]

        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                if ($row = $stmt->fetch()) {
                    $hashed_password = $row["PasswordHash"];
                    if (password_verify($password, $hashed_password)) {
                        // Password is correct, start a new session
                        session_start();
                        
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["UserID"] = $row["UserID"];
                        $_SESSION["Username"] = $username;

                        // Check if user is admin
                        // This is a placeholder. You need to replace this with your actual admin check.
                        $isAdmin = $row["IsAdmin"]; // Assuming 'IsAdmin' is a column in your Users table
                        
                        // Redirect user based on role
                        if ($isAdmin) {
                            header("location: admin/index.php");
                        } else {
                            header("location: user_dashboard.php");
                        }
                        exit;
                    } else {
                        $password_err = "The password you entered was not valid.";
                    }
                }
            } else {
                $username_err = "No account found with that username.";
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
}

require_once 'includes/header.php';  // Path to your header.php file
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Connexion</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group">
                            <label for="username">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Connexion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php';  // Path to your footer.php file ?>
