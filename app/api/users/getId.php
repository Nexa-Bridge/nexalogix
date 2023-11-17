<?php
require '/app/api/db.php';

$userid = $_GET['userid']; // ID de l'utilisateur passé en paramètre
$sql = "SELECT * FROM Users WHERE UserID = ?";
$stmt= $pdo->prepare($sql);
$stmt->execute([$userid]);
$user = $stmt->fetch();

echo $user['Username'];
?>
