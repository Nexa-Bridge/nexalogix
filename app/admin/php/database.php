<?php
$servername = "localhost:3306";
$username = "easybiom_logix";
$password = "nozdu5-dupQeh-pokqex";
$dbname = "easybiom_nexalogix";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
