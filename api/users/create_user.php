<?php
require '../db.php'; // Database connection

// Get POST data and sanitize
$username = $_POST['username'];
$email = $_POST['email'];
// ... other fields

// SQL to insert user
$sql = "INSERT INTO Users (Username, Email, ...) VALUES (:username, :email, ...)";
$stmt = $pdo->prepare($sql);

// Bind parameters and execute
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
// ... other bindings

if($stmt->execute()) {
    echo json_encode(['success' => 'User created successfully']);
} else {
    echo json_encode(['error' => 'Failed to create user']);
}
?>
