<?php include('admin_check.php'); ?>

<?php
if (isset($_GET['id'])) {
    $transactionId = $_GET['id'];
    $conn = new mysqli('localhost', 'root', '', 'currency_exchange');
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE transactions SET status = 'approved' WHERE id = ?");
    $stmt->bind_param("i", $transactionId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Transaction approuvée avec succès.";
    } else {
        echo "Erreur lors de l'approbation de la transaction.";
    }

    $stmt->close();
    $conn->close();
}
?>
<a href="manage_transactions.php" class="btn btn-primary">Retour à la Gestion des Transactions</a>
