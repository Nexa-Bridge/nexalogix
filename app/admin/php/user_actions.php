<?php
$_POST['action'] = 'read';
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
            $sql = "SELECT UserID, Username, Email FROM Users";
$result = $mysqli->query($sql); // or use PDO method if you're using PDO

if ($result) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
    echo "<pre>"; print_r($users); echo "</pre>";
} else {
    echo "Error: " . $mysqli->error;
}
        

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

$mysqli->close();
?>
