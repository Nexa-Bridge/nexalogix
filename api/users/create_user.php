<?php
require '../db.php'; // Adjust the path as needed to your database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;

    // Password hashing
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query to insert new user
    $sql = "INSERT INTO Users (Username, PasswordHash, Email) VALUES (:username, :password, :email)";
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $passwordHash);
    $stmt->bindValue(':email', $email);

    // Execute the statement and check if it's successful
    if($stmt->execute()){
        echo "New user added successfully.";
    } else {
        echo "An error occurred.";
    }
}
?>