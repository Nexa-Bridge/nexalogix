<?php
require_once 'database.php'; // Assurez-vous que ce chemin est correct

/**
 * Vérifie si l'utilisateur est connecté.
 * 
 * @return bool Retourne vrai si l'utilisateur est connecté, sinon faux.
 */
function isUserLoggedIn() {
    return isset($_SESSION['userid']);
}

/**
 * Vérifie si l'utilisateur a le rôle spécifié.
 * 
 * @param int $userId ID de l'utilisateur.
 * @param string $role Rôle à vérifier.
 * @return bool Retourne vrai si l'utilisateur a le rôle, sinon faux.
 */
function checkUserRole($userId, $role) {
    global $pdo;

    // Requête pour vérifier le rôle de l'utilisateur
    $query = "SELECT RoleName FROM Roles INNER JOIN UserRoles ON Roles.RoleID = UserRoles.RoleID WHERE UserRoles.UserID = :userid";
    
    try {
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':userid', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $userRoles = $stmt->fetchAll();

        foreach ($userRoles as $userRole) {
            if ($userRole['RoleName'] == $role) {
                return true;
            }
        }
    } catch (PDOException $e) {
        // Gérer l'erreur ici
        return false;
    }

    return false;
}

/**
 * Vérifie si l'utilisateur se connecte pour la première fois.
 * 
 * @param int $userId ID de l'utilisateur.
 * @return bool Retourne vrai si c'est la première connexion, sinon faux.
 */
function isFirstLogin($userId) {
    global $pdo;

    // Ici, vous devez définir la logique pour déterminer si c'est la première connexion de l'utilisateur
    // Par exemple, vous pourriez avoir une colonne dans votre base de données indiquant si l'utilisateur a changé son mot de passe

    return false; // Changez ceci en fonction
