<?php
session_start();
include('config.php'); // Fichier de configuration de la base de données

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirigez vers la page de connexion si non connecté
    exit;
}

$user_id = $_SESSION['user_id'];

// Récupérer les messages de l'utilisateur
$sql = "SELECT messages.*, users.username AS sender_name 
        FROM messages 
        JOIN users ON messages.sender_id = users.user_id 
        WHERE receiver_id = ? 
        ORDER BY sent_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie - IVOCHANGE</title>
    <link href="assets/Ivochange-removebg.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-5">
        <h1>Vos Messages</h1>
        <div class="mb-3">
            <h2>Envoyer un nouveau message</h2>
            <form action="send_message.php" method="POST">
                <div class="mb-3">
                    <label for="message_text" class="form-label">Message</label>
                    <textarea class="form-control" id="message_text" name="message_text" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>

        <div class="messages-list">
            <h2>Messages reçus</h2>
            <?php if ($result->num_rows > 0) { ?>
                <ul class="list-group">
                    <?php while($row = $result->fetch_assoc()) { ?>
                        <li class="list-group-item">
                            <strong>De:</strong> <?php echo htmlspecialchars($row['sender_name']); ?><br>
                            <strong>Message:</strong> <?php echo htmlspecialchars($row['message_text']); ?><br>
                            <strong>Reçu le:</strong> <?php echo htmlspecialchars($row['sent_at']); ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } else { ?>
                <p>Aucun message trouvé.</p>
            <?php } ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $stmt->close(); $conn->close(); ?>
