<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'easybiom_nexalogix'; 
$username = 'easybiom_logix';
$password = 'LogixPsW';   

// Créer une connexion
$conn = new mysqli($host, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}

// Gestion des actions
$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'read':
        // Exemple de requête pour lire les données utilisateur
        $sql = "SELECT * FROM VotreTableUtilisateur"; // Remplacez par votre requête SQL
        $result = $conn->query($sql);

        if ($result) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($users);
        } else {
            echo "Erreur: " . $conn->error;
        }
        break;

    // Vous pouvez ajouter ici des cas pour 'create', 'update', 'delete', etc.
    // Assurez-vous de sécuriser ces actions et de valider les données reçues.
}

// Fermer la connexion
$conn->close();
?>
