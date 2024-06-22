<?php include('admin_check.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--Gestion des utilisateurs -->
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs - Échange de Monnaie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('sidebar-admin.php'); ?>

    <div class="content" id="content">
        <h1>Gestion des Utilisateurs</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'Utilisateur</th>
                    <th>Rôle</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli('localhost', 'root', '', 'currency_exchange');
                if ($conn->connect_error) {
                    die("Connexion échouée : " . $conn->connect_error);
                }

                $sql = "SELECT user_id, username, role FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['user_id'] . '</td>';
                        echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['role']) . '</td>';
                        echo '<td><a href="change_role.php?id=' . $row['user_id'] . '&role=' . ($row['role'] == 'admin' ? 'user' : 'admin') . '" class="btn btn-warning">' . ($row['role'] == 'admin' ? 'Rendre Utilisateur' : 'Rendre Administrateur') . '</a></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">Aucun utilisateur trouvé.</td></tr>';
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
