<!--This PHP code snippet is checking if the current request method is POST. If it is a POST request, it
retrieves the amount, fromCurrency, and toCurrency values from the POST data. It then constructs a
URL to call an API for currency conversion using the provided fromCurrency and toCurrency values. -->

<?php
    //if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //$amount = $_POST['amount'];
        //$fromCurrency = $_POST['fromCurrency'];
        //$toCurrency = $_POST['toCurrency'];

        // Appel à l'API de conversion de devises (par exemple, fixer.io, exchangeratesapi.io)
        // Exemple: https://api.exchangeratesapi.io/latest?base=USD&symbols=EUR
        //$api_url = "https://api.exchangeratesapi.io/latest?base=$fromCurrency&symbols=$toCurrency";
        //$response = file_get_contents($api_url);
        //$data = json_decode($response, true);
        
        //if (isset($data['rates'][$toCurrency])) {
            //$rate = $data['rates'][$toCurrency];
            //$convertedAmount = $amount * $rate;
            //echo "Le montant converti est: " . $convertedAmount;
        //} else {
           // echo "Erreur lors de la conversion de la devise.";
        //}
    //}   
?>

<?php
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
?>
