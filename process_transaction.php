<!-- </* This PHP code snippet is a script that handles a currency conversion transaction based on user
input. Here's a breakdown of what it does: */
?php
// Inclure la configuration de la base de données
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez que les champs requis existent dans $_POST
    if (isset($_POST['amount'], $_POST['from_urrency'], $_POST['toCurrency'])) {
        $amount = $_POST['amount'];
        $fromCurrency = $_POST['fromCurrency'];
        $toCurrency = $_POST['toCurrency'];

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

            // Préparation de la requête d'insertion
            $stmt = $conn->prepare("INSERT INTO transactions (amount, from_currency, to_currency, rate, converted_amount) VALUES (?, ?, ?, ?, ?)");
            if ($stmt === false) {
                echo "Erreur de préparation de la requête: " . $conn->error;
                exit;
            }
            $stmt->bind_param("dssdd", $amount, $fromCurrency, $toCurrency, $rate, $convertedAmount);

            if ($stmt->execute()) {
                echo "Transaction réussie. Le montant converti est: " . $convertedAmount;
            } else {
                echo "Erreur lors de l'insertion de la transaction: " . $stmt->error;
            }

            // Fermer la requête préparée
            $stmt->close();
        } else {
            echo "Taux de change non trouvé pour cette conversion.";
        }
    } else {
        echo "Tous les champs sont requis.";
    }

    // Fermer la connexion
    $conn->close();
} else {
    echo "Méthode de requête non valide.";
}
?> -->
<?php
// Inclure la configuration de la base de données
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez que les champs requis existent dans $_POST
    if (isset($_POST['amount'], $_POST['from_currency'], $_POST['to_currency'], $_POST['username'], $_POST['email'], $_POST['phoneNumber'])) {
        $amount = $_POST['amount'];
        $fromCurrency = $_POST['from_currency'];
        $toCurrency = $_POST['to_currency'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];

        // Échapper les entrées utilisateur pour éviter les injections SQL
        $fromCurrency = $conn->real_escape_string($fromCurrency);
        $toCurrency = $conn->real_escape_string($toCurrency);
        $username = $conn->real_escape_string($username);
        $email = $conn->real_escape_string($email);
        $phoneNumber = $conn->real_escape_string($phoneNumber);

        // Calculer les frais (1% de frais)
        $feeRate = 0.01;
        $amountWithFees = $amount * (1 - $feeRate);

        // Requête pour obtenir le taux de change
        $sql = "SELECT rate FROM exchange_rates WHERE from_currency = '$fromCurrency' AND to_currency = '$toCurrency'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            // Récupérer le taux de change
            $row = $result->fetch_assoc();
            $rate = $row['rate'];
            $convertedAmount = $amountWithFees * $rate;

            // Préparation de la requête d'insertion
            $stmt = $conn->prepare("INSERT INTO transactions (amount, from_currency, to_currency, rate, converted_amount, username, email, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                echo "Erreur de préparation de la requête: " . $conn->error;
                exit;
            }
            $stmt->bind_param("dssdssss", $amount, $fromCurrency, $toCurrency, $rate, $convertedAmount, $username, $email, $phoneNumber);

            if ($stmt->execute()) {
                echo "Transaction réussie. Le montant converti est: " . $convertedAmount;
            } else {
                echo "Erreur lors de l'insertion de la transaction: " . $stmt->error;
            }

            // Fermer la requête préparée
            $stmt->close();
        } else {
            echo "Taux de change non trouvé pour cette conversion.";
        }
    } else {
        echo "Tous les champs sont requis.";
    }

    // Fermer la connexion
    $conn->close();
} else {
    echo "Méthode de requête non valide.";
}
?>
