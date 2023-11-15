<?php
session_start();

// Détruire toutes les données de session
$_SESSION = array();

// Si vous voulez détruire la session complètement, supprimez également le cookie de session.
// Note : Cela détruira la session, et pas seulement les données de session !
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalement, détruire la session.
session_destroy();

// Rediriger vers la page de connexion
header("Location: login.php");
exit();
?>
