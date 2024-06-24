<?php
include('config.php');

if (isset($_GET['amount'], $_GET['from'], $_GET['to'])) {
    $amount = $_GET['amount'];
    $fromCurrency = $_GET['from'];
    $toCurrency = $_GET['to'];

    // Échapper les entrées utilisateur pour éviter les injections SQL
    $fromCurrency = $conn->real_escape_string($fromCurrency);
    $toCurrency = $conn->real_escape_string($toCurrency);

    // Requête pour obtenir le taux de change
    $sql = "SELECT rate FROM exchange_rates WHERE from_currency = '$fromCurrency' AND to_currency = '$toCurrency'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Récupérer le taux de change
        $row = $result->fetch_assoc();
        $rate = $row['rate'];
        $convertedAmount = $amount * $rate;

        // Retourner la réponse en JSON
        echo json_encode(['success' => true, 'convertedAmount' => $convertedAmount]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Taux de change non trouvé.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Paramètres manquants.']);
}

$conn->close();
?>
