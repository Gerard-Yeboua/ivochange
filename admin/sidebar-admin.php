<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Utilisateur - IVOCHANGE</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            overflow-x: hidden; /* Éviter le défilement horizontal lors de la transition de la sidebar */
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #F49B2E;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            z-index: 1000;
        }
        .sidebar.hide {
            transform: translateX(-100%);
        }
        .sidebar a {
            padding: 15px 10px;
            text-decoration: none;
            font-size: 18px;
            color: #333;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background-color: #007bff;
            color: #fff;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        .content.shifted {
            margin-left: 0;
        }
        .menu-btn {
            position: fixed;
            top: 10px;
            left: 10px;
            font-size: 24px;
            cursor: pointer;
            z-index: 1100;
        }
        .menu-btn i {
            transition: transform 0.3s ease;
        }
        .menu-btn.rotated {
            transform: rotate(90deg);
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 250px;
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .content {
                margin-left: 0;
                padding-top: 60px; /* Ajuster pour éviter le chevauchement avec le bouton du menu */
            }
            .menu-btn {
                left: 10px;
            }
        }
    </style>
</head>
<body>
    
    <!-- Bouton de Menu -->
    <div class="menu-btn text-primary">
        <i class="bi bi-list"></i>
    </div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="text-center mb-4">
            <a href="index.php"><img src="../assets/Ivochange-removebg.png" alt="Logo" class="img-fluid" width="100" height="50"></a>
        </div>
        <a href="admin_dashboard.php"><i class="bi bi-speedometer2"></i>&nbsp; Tableau de Bord</a>
        <a href="../profile.php"><i class="bi bi-person-circle"></i>&nbsp; Profil</a>
        <a href="settings.php"><i class="bi bi-gear"></i>&nbsp; Paramètres</a>
        <a href="manage_transactions.php"><i class="bi bi-currency-exchange"></i>&nbsp; Transactions</a>
        <a href="manage_rates.php"><i class="bi bi-chat-dots">Taux d'échange</i>&nbsp; </a>
        <a href="manage_reviews.php"><i class="bi bi-whatsapp"></i> &nbsp; Avis</a>
        <a href="manage_users.php"><i class="bi bi-telegram"></i> &nbsp; Utilisateurs</a>
        <a href="admin_messages.php"><i class="bi bi-facebook"></i> &nbsp; Support</a>
        <a href="../logout.php"><i class="bi bi-box-arrow-right"></i>&nbsp; Déconnexion</a>
    </div>

    

    <!-- Bootstrap JS et JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script pour gérer l'affichage de la sidebar
        const menuBtn = document.querySelector('.menu-btn');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('hide');
            content.classList.toggle('shifted');
            menuBtn.querySelector('i').classList.toggle('rotated');
        });
    </script>
</body>
</html>
