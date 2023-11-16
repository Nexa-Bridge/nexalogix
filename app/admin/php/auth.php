<?php

include 'database.php'; // Assurez-vous que le chemin d'accès au fichier database.php est correct

function isLoggedIn() {
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}

function isAdmin() {
    // This is an example; adjust according to how you store admin status
    return isset($_SESSION['role']) && $_SESSION['role'] === 'Admin';
}

function login($username, $password) {
    global $pdo;

    $stmt = $pdo->prepare('SELECT UserID, PasswordHash FROM Users WHERE Username = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['PasswordHash'])) {
        $_SESSION['user_id'] = $user['UserID'];

        // Vérifie si l'utilisateur est un administrateur
        $adminCheckStmt = $pdo->prepare('SELECT RoleID FROM UserRoles WHERE UserID = :userid AND RoleID = (SELECT RoleID FROM Roles WHERE RoleName = "Admin")');
        $adminCheckStmt->execute(['userid' => $user['UserID']]);
        $_SESSION['is_admin'] = $adminCheckStmt->fetch(PDO::FETCH_ASSOC) ? true : false;

        return true;
    }

    return false;
}

function logout() {
    session_destroy();
}
?>
