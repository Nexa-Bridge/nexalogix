<?php
require '../db.php'; // Adjust the path as needed to your database connection file

// Enabling error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json'); // Set the content-type as JSON

// Function to handle user creation
function createUser($pdo) {
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect and sanitize input data
        $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
        $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
        $email = !empty($_POST['email']) ? trim($_POST['email']) : null;

        // Password hashing
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query to insert new user
        $sql = "INSERT INTO Users (Username, PasswordHash, Email) VALUES (:username, :'password', :email)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $passwordHash);
        $stmt->bindValue(':email', $email);

        // Execute the statement and check if it's successful
        if ($stmt->execute()) {
            echo json_encode(["message" => "New user added successfully."]);
        } else {
            // Fetching error information
            $errorInfo = $stmt->errorInfo();
            echo json_encode(["error" => "Failed to create user.", "details" => $errorInfo[2]]);
        }
    } else {
        echo json_encode(["error" => "Invalid request method."]);
    }
}

// Call the function to create a user
createUser($pdo);
?>
