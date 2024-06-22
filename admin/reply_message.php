<?php
session_start();
include('config.php');

// Vérifiez si l'administrateur est connecté
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sender_id = $_SESSION['admin_id'];
    $receiver_id = $_POST['receiver_id'];
    $reply_text = $_POST['reply_text'];

    $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message_text) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $sender_id, $receiver_id, $reply_text);

    if ($stmt->execute()) {
        echo "Message envoyé avec succès.";
    } else {
        echo "Erreur lors de l'envoi du message: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header('Location: admin_messages.php'); // Redirection après envoi du message
}
?>
