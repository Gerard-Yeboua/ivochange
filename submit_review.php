<?php
    // Inclure la configuration de la base de données
    include('config.php');
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $review = $_POST['review'];
        $rating = $_POST['rating'];
    
        // Récupérer l'ID de l'utilisateur à partir du nom d'utilisateur
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $user_id = $user['user_id'];
    
            // Insertion de l'avis dans la base de données
            $stmt = $conn->prepare("INSERT INTO reviews (user_id, review, rating, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("isd", $user_id, $review, $rating);
    
            if ($stmt->execute()) {
                echo "Votre avis a été soumis.";
                header("Location: reviews.php");
            } else {
                echo "Erreur lors de la soumission de votre avis: " . $stmt->error;
            }
        } else {
            echo "Nom d'utilisateur introuvable.";
        }
    
        $stmt->close();
        $conn->close();
    }
    
?>
