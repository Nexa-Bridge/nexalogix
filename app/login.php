<?php
// Start the session
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'admin/php/auth.php';  // Adjust the path as necessary
require_once 'admin/php/database.php';  // Adjust the path as necessary

// If already logged in, redirect to user dashboard
if (isLoggedIn()) {
    header('Location: user_dashboard.php');
    exit;
}

$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Validate credentials
    if (!empty($username) && !empty($password)) {
        // Prepare a select statement to get user data and roles
        $sql = "SELECT Users.UserID, Users.Username, Users.PasswordHash, Roles.RoleName 
                FROM Users 
                LEFT JOIN UserRoles ON Users.UserID = UserRoles.UserID 
                LEFT JOIN Roles ON UserRoles.RoleID = Roles.RoleID 
                WHERE Users.Username = :username";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = $username;

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch();
                    $hashed_password = $row["PasswordHash"];
                    if (password_verify($password, $hashed_password)) {
                        session_start();
                        $_SESSION["loggedin"] = true;
                        $_SESSION["UserID"] = $row["UserID"];
                        $_SESSION["Username"] = $username;                            

                        // Check user's role and redirect accordingly
                        $userRole = $row["RoleName"];
                        // ... [After setting session variables in the login script]

                        // Redirect user based on role
                        if (isAdmin()) {
                            header("location: admin/index.php"); // Redirect to admin dashboard
                        } else {
                            header("location: user_dashboard.php"); // Redirect to user dashboard
                        }
                        exit;

                    } else {
                        $password_err = "The password you entered was not valid.";
                    }
                } else {
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    }
}

require_once 'includes/header.php';  // Adjust the path as necessary
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

<?php require_once 'includes/footer.php';  // Adjust the path as necessary ?>
