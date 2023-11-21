<?php
require '../db.php'; // Adjust the path as needed to your database connection file

// Enabling error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json'); // Set the content-type as JSON

// Function to handle user update
function updateUser($pdo) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect and sanitize input data
        $userId = isset($_POST['userId']) ? (int)trim($_POST['userId']) : null;
        $username = isset($_POST['username']) ? trim($_POST['username']) : null;
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $password = isset($_POST['password']) ? trim($_POST['password']) : null;

        // Prepare SQL query to update the user
        $sql = "UPDATE Users SET Username = :username, Email = :email";
        if (!empty($password)) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $sql .= ", PasswordHash = :password";
        }
        $sql .= " WHERE UserID = :userId";

        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindValue(':userId', $userId);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':email', $email);
        if (!empty($password)) {
            $stmt->bindValue(':password', $passwordHash);
        }

        // Execute the statement and check if it's successful
        if ($stmt->execute()) {
            echo json_encode(["message" => "User updated successfully."]);
        } else {
            $errorInfo = $stmt->errorInfo();
            echo json_encode(["error" => "Failed to update user.", "details" => $errorInfo[2]]);
        }
    } else {
        echo json_encode(["error" => "Invalid request method."]);
    }
}

// Call the function to update a user
updateUser($pdo);
?>
