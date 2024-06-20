<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $review = $_POST['review'];

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', '', 'currency_exchange');
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO reviews (username, review, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $username, $review);

    if ($stmt->execute()) {
        echo "Votre avis a été soumis.";
    } else {
        echo "Erreur lors de la soumission de votre avis.";
    }

    $stmt->close();
    $conn->close();
}
