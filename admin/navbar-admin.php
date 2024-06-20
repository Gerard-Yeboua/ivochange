<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Échange de Monnaie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0; /* Positionnement à gauche */
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover {
            color: #f1f1f1;
        }
        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px; /* Position du bouton de fermeture */
            font-size: 36px;
        }
        .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: #111;
            color: white;
            border: none;
            position: absolute;
            left: 20px; /* Positionnement à gauche */
            top: 20px;
        }
        .openbtn:hover {
            background-color: #444;
        }
        #main {
            transition: margin-left .5s; /* Déplacement du contenu vers la droite */
            padding: 16px;
        }
    </style>
</head>
<body>
    <!-- Bouton pour ouvrir la Sidebar -->
    <div id="main">
        <button class="openbtn" onclick="openNav()">☰ Menu</button>

        <!-- Contenu Principal -->
        <div class="container mt-5">
            <h1>Admin Dashboard</h1>
            <p>Gestion des transactions et des utilisateurs.</p>
            <!-- Votre contenu principal ici -->
        </div>
    </div>

    <!-- Sidebar -->
    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="admin_dashboard.php">Tableau de Bord</a>
        <a href="manage_transactions.php">Transactions</a>
        <a href="manage_rates.php">Taux de Change</a>
        <a href="manage_reviews.php">Avis</a>
        <a href="support_users.php">Support</a>
        <a href="manage_users.php">Utilisateurs</a>
        <a href="logout.php">Déconnexion</a>
    </div>

    <!-- Bootstrap JS et JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script pour la Sidebar -->
    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px"; /* Déplacement vers la droite */
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0"; /* Retour à l'état initial */
        }
    </script>
</body>
</html>
