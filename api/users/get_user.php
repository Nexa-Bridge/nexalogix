<?php
require '../db.php'; 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


header('Content-Type: application/json'); // Définir le content-type comme JSON

try {
    $stmt = $pdo->query("SELECT UserID, Username, Email FROM Users"); // Sélectionner les colonnes nécessaires
    $users = $stmt->fetchAll();

    echo json_encode($users); // Convertir les données en JSON et les envoyer
} catch (PDOException $e) {
    // En cas d'erreur, renvoyer un message d'erreur en JSON
    echo json_encode(['error' => $e->getMessage()]);
}
?>
