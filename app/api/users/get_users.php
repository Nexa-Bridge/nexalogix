<?php
require '/app/api/db.php';

try {
    $stmt = $pdo->query("SELECT * FROM Users");
    $users = $stmt->fetchAll();

    foreach ($users as $user) {
        echo htmlspecialchars($user['Username']) . "<br>";
    }
} catch (PDOException $e) {
    echo "Erreur de base de données : " . $e->getMessage();
}
?>
