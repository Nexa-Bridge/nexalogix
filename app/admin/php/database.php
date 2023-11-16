<?php
// Informations de connexion à la base de données
$servername = "localhost:3360";
$username = "easybiom_logix";
$password = "LogixPsW";
$dbname = "easybiom_nexalogix";

try {
    // Création de la connexion PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Définition du mode d'erreur PDO sur Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion réussie"; // Décommentez pour tester la connexion
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
