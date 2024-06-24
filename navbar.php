
<!-- Barre de navigation -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IVOCHANGE</title>
    <link href="assets/Ivochange-removebg.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ajustement de la taille du logo et centrage vertical */
        .navbar-brand img {
            height: 50px;
            width: 100px;
        }
        /* Ajustements supplémentaires pour centrer le contenu */
        .navbar-nav {
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: center;
            background-color: azure;
        }
    </style>
</head>
<body>
   <!-- navbar.php -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="assets/Ivochange.jpg" alt="Logo" class="img-fluid"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="news.php">Actualité</a></li>
                    <li class="nav-item"><a class="nav-link" href="reviews.php">Avis</a></li>
                    <li class="nav-item"><a class="nav-link" href="rates.php">Taux</a></li>
                    <li class="nav-item"><a class="nav-link" href="faq.php">FAQ</a></li>
                </ul>
            </div>
            <div class="d-flex align-items-center">
                <?php if (isset($_SESSION['user'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($_SESSION['user']['photo']); ?>" alt="Profile Photo" class="img-fluid rounded-circle" width="40" height="40">
                    <span class="ms-2"><?php echo htmlspecialchars($_SESSION['user']['name']); ?></span>
                    <a class="nav-link" href="logout.php">Déconnexion</a>
                <?php else: ?>
                    <a class="nav-link" href="signin.php">Sign in</a> &nbsp; &nbsp;&nbsp;&nbsp;
                    <a class="nav-link" href="login.php">Sign up</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
