<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST['amount'];
    $fromCurrency = $_POST['fromCurrency'];
    $toCurrency = $_POST['toCurrency'];

    // Appel à l'API de conversion de devises (par exemple, fixer.io, exchangeratesapi.io)
    // Exemple: https://api.exchangeratesapi.io/latest?base=USD&symbols=EUR
    $api_url = "https://api.exchangeratesapi.io/latest?base=$fromCurrency&symbols=$toCurrency";
    $response = file_get_contents($api_url);
    $data = json_decode($response, true);
    
    if (isset($data['rates'][$toCurrency])) {
        $rate = $data['rates'][$toCurrency];
        $convertedAmount = $amount * $rate;
        echo "Le montant converti est: " . $convertedAmount;
    } else {
        echo "Erreur lors de la conversion de la devise.";
    }
}
