<?php
require '../db.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash du mot de passe
$email = $_POST['email'];

$sql = "INSERT INTO Users (Username, PasswordHash, Email) VALUES (?, ?, ?)";
$stmt= $pdo->prepare($sql);
$stmt->execute([$username, $password, $email]);

echo "Utilisateur créé avec succès.";
?>
