<?php
    $servername = "localhost"; // Remplacer par le nom du serveur
    $username = "root"; // Remplacer par le nom d'utilisateur MySQL
    $password = ""; // Remplacer par le mot de passe MySQL
    $dbname = "currency_exchange"; // Nom de la base de données

    // Créer une connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }
?>
