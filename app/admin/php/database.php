<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$db_name = 'easybiom_logix'; // Remplacer par le nom de votre base de données
$username = 'LogixPsW'; // Remplacer par votre nom d'utilisateur de la base de données
$password = 'easybiom_nexalogix'; // Remplacer par votre mot de passe de la base de données

try {
    // Création d'une instance PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);

    // Définir le mode d'erreur PDO sur Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optionnel : Définir le mode de récupération par défaut
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Affichage d'un message de succès de connexion (à des fins de débogage, peut être supprimé en production)
    echo "Connexion à la base de données réussie!";
} catch (PDOException $e) {
    // Gestion des erreurs de connexion
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}
?>
