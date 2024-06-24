<?php
 include('admin_check.php');

include('../config.php'); // Fichier de configuration de la base de données

// Vérifiez si l'administrateur est connecté


// Récupérer les messages pour l'administrateur
$sql = "SELECT messages.*, users.username AS sender_name 
        FROM messages 
        JOIN users ON messages.sender_id = users.user_id 
        WHERE receiver_id = ? 
        ORDER BY sent_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messagerie - Administrateur IVOCHANGE</title>
    <link href="../assets/Ivochange-removebg.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('sidebar-admin.php'); ?>
    <div class="content" id="content">
        <h1>Messages Utilisateurs</h1>
        <div class="messages-list">
            <h2>Messages reçus</h2>
            <?php if ($result->num_rows > 0) { ?>
                <ul class="list-group">
                    <?php while($row = $result->fetch_assoc()) { ?>
                        <li class="list-group-item">
                            <strong>De:</strong> <?php echo htmlspecialchars($row['sender_name']); ?><br>
                            <strong>Message:</strong> <?php echo htmlspecialchars($row['message_text']); ?><br>
                            <strong>Reçu le:</strong> <?php echo htmlspecialchars($row['sent_at']); ?>
                            <form action="reply_message.php" method="POST" class="mt-3">
                                <input type="hidden" name="receiver_id" value="<?php echo $row['sender_id']; ?>">
                                <div class="mb-3">
                                    <label for="reply_text" class="form-label">Réponse</label>
                                    <textarea class="form-control" id="reply_text" name="reply_text" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Répondre</button>
                            </form>
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
