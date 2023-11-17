<?php
require '/app/api/db.php';

$userid = $_GET['userid']; // ID de l'utilisateur à supprimer

$sql = "DELETE FROM Users WHERE UserID = ?";
$stmt= $pdo->prepare($sql);
$stmt->execute([$userid]);

echo "Utilisateur supprimé avec succès.";
?>
