<?php include('admin_check.php'); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currency = $_POST['currency'];
    $rate = $_POST['rate'];

    $conn = new mysqli('localhost', 'root', '', 'currency_exchange');
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO exchange_rates (from_currency, rate, updated_at) VALUES (?, ?, NOW()) ON DUPLICATE KEY UPDATE rate = VALUES(rate), updated_at = VALUES(updated_at)");
    $stmt->bind_param("sd", $currency, $rate);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Taux de change mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du taux de change.";
    }

    $stmt->close();
    $conn->close();
}
?>
<a href="manage_rates.php" class="btn btn-primary">Retour à la Maintenance des Taux de Change</a>
