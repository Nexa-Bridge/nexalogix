<?php
$servername = "localhost";
$username = "easybiom_logix";
$password = "nozdu5-dupQeh-pokqex";
$dbname = "easybiom_nexalogix";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}
?>
