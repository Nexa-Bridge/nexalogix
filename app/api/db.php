<?php
$host = 'localhost';
$db   = 'easybiom_nexalogix';
$user = 'easybiom_logix';
$pass = 'LogixPsW'; 
$charset = 'utf8mb4'; 

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $password, $email]);
    echo "Utilisateur créé avec succès.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>