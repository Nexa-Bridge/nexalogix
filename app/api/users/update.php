<?php
require '/app/api/db.php';

$userid = $_GET['userid']; // ID de l'utilisateur à mettre à jour
$newEmail = $_POST['email'];

$sql = "UPDATE Users SET Email = ? WHERE UserID = ?";
$stmt= $pdo->prepare($sql);
$stmt->execute([$newEmail, $userid]);

echo "Email mis à jour avec succès.";
?>
