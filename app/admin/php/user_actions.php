<?php
require_once 'database.php'; // Adjust this path as needed

// Function to sanitize input for basic security
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$action = isset($_POST['action']) ? sanitizeInput($_POST['action']) : '';

switch ($action) {
    case 'create':
        // Assuming you're receiving username, email, and password
        $username = sanitizeInput($_POST['username']);
        $email = sanitizeInput($_POST['email']);
        $password = sanitizeInput($_POST['password']); // Consider hashing the password

        $sql = "INSERT INTO Users (username, email, password) VALUES (?, ?, ?)";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("sss", $username, $email, $password);
            if ($stmt->execute()) {
                echo "User created successfully";
            } else {
                echo "Error: " . $mysqli->error;
            }
            $stmt->close();
        }
        break;

        case 'read':
            $sql = "SELECT UserID, Username, Email, Role FROM Users";
            $users = [];
            if ($result = $mysqli->query($sql)) {
                while ($row = $result->fetch_assoc()) {
                    $users[] = $row;
                }
                echo json_encode($users);
            } else {
                echo "Error: " . $mysqli->error;
            }
            break;
        

    case 'update':
        // Assuming you're receiving user ID, email, and password
        $id = sanitizeInput($_POST['id']);
        $email = sanitizeInput($_POST['email']);
        $password = sanitizeInput($_POST['password']); // Consider hashing the password

        $sql = "UPDATE Users SET email = ?, password = ? WHERE id = ?";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("ssi", $email, $password, $id);
            if ($stmt->execute()) {
                echo "User updated successfully";
            } else {
                echo "Error: " . $mysqli->error;
            }
            $stmt->close();
        }
        break;

    case 'delete':
        $id = sanitizeInput($_POST['id']);

        $sql = "DELETE FROM Users WHERE id = ?";
        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo "User deleted successfully";
            } else {
                echo "Error: " . $mysqli->error;
            }
            $stmt->close();
        }
        break;

    default:
        echo "Invalid Action";
        break;
}

$action = 'read';

$mysqli->close();
?>
