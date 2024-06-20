<?php include('admin_check.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur - Échange de Monnaie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Barre de navigation spécifique à l'administrateur -->
    <?php include('navbar-admin.php');  ?>

    <div class="container mt-5">
        <h1>Tableau de Bord Administrateur</h1>
        <div class="row">
            <!-- Gestion des Transactions -->
            <div class="col-md-6">
                <h2>Gestion des Transactions</h2>
                <a href="manage_transactions.php" class="btn btn-primary">Voir les Transactions</a>
            </div>
            <!-- Maintenance des Taux de Change -->
            <div class="col-md-6">
                <h2>Maintenance des Taux de Change</h2>
                <a href="manage_rates.php" class="btn btn-primary">Mettre à Jour les Taux</a>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Modération des Avis -->
            <div class="col-md-6">
                <h2>Modération des Avis</h2>
                <a href="manage_reviews.php" class="btn btn-primary">Gérer les Avis</a>
            </div>
            <!-- Support Utilisateur -->
            <div class="col-md-6">
                <h2>Support Utilisateur</h2>
                <a href="support_users.php" class="btn btn-primary">Répondre aux Questions</a>
            </div>
        </div>
        <div class="row mt-4">
            <!-- Gestion des Accès -->
            <div class="col-md-6">
                <h2>Gestion des Accès</h2>
                <a href="manage_users.php" class="btn btn-primary">Gérer les Utilisateurs</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
