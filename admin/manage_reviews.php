<?php include('admin_check.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modération des Avis - Échange de Monnaie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('sidebar-admin.php'); ?>

    <div class="content" id="content">
        <h1>Modération des Avis</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Numéro de reponse</th>
                    <th>Utilisateur</th>
                    <th>Avis</th>
                    <th>Note</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli('localhost', 'root', '', 'currency_exchange');
                if ($conn->connect_error) {
                    die("Connexion échouée : " . $conn->connect_error);
                }

                // Requête SQL pour récupérer les avis avec les détails de l'utilisateur
                $sql = "SELECT 
                    reviews.id AS review_id,
                    users.username AS user_name,
                    reviews.review,
                    reviews.rating,
                    reviews.created_at
                FROM 
                    reviews
                JOIN 
                    users ON reviews.user_id = users.user_id
                ORDER BY 
                    reviews.created_at DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['review_id']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['user_name']) . '</td>';
                        echo '<td>'. htmlspecialchars($row['review']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['rating']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['created_at']) . '</td>';
                        echo '<td><a href="delete_review.php?id=' . $row['review_id'] . '" class="btn btn-danger">Supprimer</a></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">Aucun avis trouvé.</td></tr>';
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
