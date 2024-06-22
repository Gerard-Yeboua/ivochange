<?php
session_start();
include('config.php');

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender_id = $_SESSION['user_id'];
    $receiver_id = 1; // Supposons que 1 est l'ID de l'administrateur, à remplacer par l'ID réel ou à dynamiser
    $message_text = $_POST['message_text'];

    $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message_text) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $sender_id, $receiver_id, $message_text);

    if ($stmt->execute()) {
        echo "Message envoyé avec succès.";
    } else {
        echo "Erreur lors de l'envoi du message: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header('Location: user_messages.php'); // Redirection après envoi du message
}
?>
