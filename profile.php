<?php
// profile.php

// Démarrer la session pour accéder aux informations de l'utilisateur
session_start();

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Récupérer les informations de l'utilisateur depuis la session
$user = $_SESSION['user'];

// Afficher la page de profil
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .profile-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            margin-top: 50px;
        }
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    
<?php include('navbar.php'); ?>

<div class="container profile-container">
    <div class="text-center mb-4">
        <img src="uploads/<?php echo htmlspecialchars($user['photo']); ?>" alt="Profile Photo" class="profile-image img-fluid">
    </div>
    <h2 class="text-center"><?php echo htmlspecialchars($user['name']); ?></h2>
    <p class="text-center"><?php echo htmlspecialchars($user['email']); ?></p>

    <!-- Plus d'informations de profil ici -->
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
