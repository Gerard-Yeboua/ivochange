<?php include('admin_check.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance des Taux de Change - Échange de Monnaie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('sidebar-admin.php'); ?>

    <div class="content" id="content">
        <h1>Maintenance des Taux de Change</h1>
        <form action="update_rates.php" method="POST">
            <div class="mb-3">
                <label for="currency" class="form-label">Devise</label>
                <input type="text" class="form-control" id="currency" name="currency" required>
            </div>
            <div class="mb-3">
                <label for="rate" class="form-label">Taux de Change</label>
                <input type="text" class="form-control" id="rate" name="rate" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à Jour le Taux</button>
        </form>

        <h2 class="mt-5">Taux de Change Actuels</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Devise</th>
                    <th>Taux</th>
                    <th>Mis à Jour le</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli('localhost', 'root', '', 'currency_exchange');
                if ($conn->connect_error) {
                    die("Connexion échouée : " . $conn->connect_error);
                }

                $sql = "SELECT * FROM exchange_rates";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . htmlspecialchars($row['from_currency']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['rate']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['updated_at']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">Aucun taux trouvé.</td></tr>';
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
