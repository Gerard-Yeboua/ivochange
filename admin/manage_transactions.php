<?php include('admin_check.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Transactions - Échange de Monnaie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('sidebar-admin.php');     ?>

    <div class="content" id="content">
        <h1>Gestion des Transactions</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Utilisateur</th>
                    <th>Montant</th>
                    <th>De</th>
                    <th>À</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli('localhost', 'root', '', 'currency_exchange');
                if ($conn->connect_error) {
                    die("Connexion échouée : " . $conn->connect_error);
                }

                $sql = "SELECT transactions.id, users.username, transactions.amount, transactions.from_currency, transactions.to_currency, transactions.status
                        FROM transactions
                        JOIN users ON transactions.user_id = users.user_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['amount']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['from_currency']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['to_currency']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['status']) . '</td>';
                        echo '<td>
                                <a href="approve_transaction.php?id=' . $row['id'] . '" class="btn btn-success">Approuver</a>
                                <a href="reject_transaction.php?id=' . $row['id'] . '" class="btn btn-danger">Rejeter</a>
                              </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="7">Aucune transaction trouvée.</td></tr>';
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
