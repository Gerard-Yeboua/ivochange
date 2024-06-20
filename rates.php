<!-- rates.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taux - Échange de Monnaie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Inclure la barre de navigation -->
    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <h1>Taux de change actuels</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Devise</th>
                    <th>Taux d'achat</th>
                    <th>Taux de vente</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Exemple de connexion à une API pour obtenir les taux
                // Vous devrez utiliser une vraie API de taux de change pour les données actuelles
                $exchangeRates = [
                    ['currency' => 'USD', 'buy' => 1.10, 'sell' => 1.12],
                    ['currency' => 'EUR', 'buy' => 0.90, 'sell' => 0.92]
                    // Ajouter plus de taux de change si nécessaire
                ];

                foreach ($exchangeRates as $rate) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($rate['currency']) . '</td>';
                    echo '<td>' . htmlspecialchars($rate['buy']) . '</td>';
                    echo '<td>' . htmlspecialchars($rate['sell']) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
