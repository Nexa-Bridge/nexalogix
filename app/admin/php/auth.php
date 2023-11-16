<?php
// Inclure le fichier de connexion à la base de données
include_once "database.php";

// Démarrer la session
session_start();

// Fonction pour vérifier si l'utilisateur est un administrateur et connecté
function isAdminLoggedIn() {
    return isset($_SESSION['user_id']) && $_SESSION['is_admin'];
}

// Rediriger vers la page de connexion
function redirectToLogin() {
    header("Location: /app/index.php");
    exit();
}

// Fonction pour connecter l'utilisateur
function loginUser($username, $password) {
    global $conn;

    // Préparation de la requête pour chercher l'utilisateur
    $stmt = $conn->prepare("SELECT UserID, PasswordHash, RoleID FROM Users WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Vérifier le mot de passe
        if (password_verify($password, $user['PasswordHash'])) {
            // Créer la session
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['is_admin'] = ($user['RoleID'] == 1); // Supposons que 1 est l'ID de l'administrateur

            return true;
        }
    }
    return false;
}

// Fonction pour déconnecter l'utilisateur
function logoutUser() {
    session_destroy();
    redirectToLogin();
}

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isAdminLoggedIn()) {
    redirectToLogin();
}
?>
