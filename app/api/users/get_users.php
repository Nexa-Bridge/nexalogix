<?php
require '/app/api/db.php';

$stmt = $pdo->query("SELECT * FROM Users");
$users = $stmt->fetchAll();

foreach ($users as $user) {
    // Afficher les informations de l'utilisateur
    echo $user['Username'] . "<br>";
}
?>