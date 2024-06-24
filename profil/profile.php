<?php
    session_start();

    // Inclure la configuration de la base de données
    include('../config.php');

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../login.php'); // Rediriger vers la page de login si non connecté
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // Récupérer les informations de profil
    $sql = "SELECT users.user_id AS userProfiles.user_id, role AS user_role, profile_photo, first_name, last_name 
        FROM users
        JOIN userProfiles ON user_id = user_id
        WHERE user_id = ?";
            
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $userProfile = $result->fetch_assoc();
            
            // Stocker les informations de profil dans la session
            $_SESSION['profile_photo'] = $userProfile['profile_photo'];
            $_SESSION['first_name'] = $userProfile['first_name'];
            $_SESSION['last_name'] = $userProfile['last_name'];
            $_SESSION['role'] = $userProfile['role']; // Stocker le rôle dans la session
            
            // Rediriger vers l'espace utilisateur ou l'espace admin en fonction du rôle de l'utilisateur
            if ($userProfile['role'] == 'admin') {
                header("Location: ../admin/admin_dashboard.php");
            } else {
                header("Location: ../index.php");
            }
        } else {
            // Aucun profil trouvé pour cet utilisateur
            echo "Aucun profil trouvé pour l'utilisateur.";
        }

        $stmt->close();
    } else {
        // Erreur lors de la préparation de la requête
        echo "Erreur lors de la préparation de la requête : " . $conn->error;
    }

    // Fermer la connexion
    $conn->close();

    exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur - IVOCHANGE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .profile-photo {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
        .form-label-left {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Votre Profil</h1>

        <div class="profile-header mb-4">
            <img src="<?php echo $userProfile['profile_photo']; ?>" alt="Photo de profil" class="profile-photo img-thumbnail">
            <div>
                <h2><?php echo htmlspecialchars($userProfile['first_name']) . ' ' . htmlspecialchars($userProfile['last_name']); ?></h2>
                <p><?php echo htmlspecialchars($userProfile['email']); ?></p>
            </div>
        </div>

        <!-- Formulaire pour mettre à jour la photo de profil -->
        <form action="upload_profile_photo.php" method="POST" enctype="multipart/form-data" class="mb-4">
            <div class="mb-3">
                <label for="profilePhoto" class="form-label">Changer la photo de profil</label>
                <input type="file" class="form-control" id="profilePhoto" name="profilePhoto" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour la photo</button>
        </form>

        <!-- Formulaire pour mettre à jour les informations de profil -->
        <form action="update_profile.php" method="POST">
            <div class="mb-3">
                <label for="firstName" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="firstName" name="first_name" value="<?php echo htmlspecialchars($userProfile['first_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Nom</label>
                <input type="text" class="form-control" id="lastName" name="last_name" value="<?php echo htmlspecialchars($userProfile['last_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($userProfile['address']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">Ville</label>
                <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($userProfile['city']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Pays</label>
                <input type="text" class="form-control" id="country" name="country" value="<?php echo htmlspecialchars($userProfile['country']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="zipCode" class="form-label">Code Postal</label>
                <input type="text" class="form-control" id="zipCode" name="zip_code" value="<?php echo htmlspecialchars($userProfile['zip_code']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Numéro de Téléphone</label>
                <input type="text" class="form-control" id="phoneNumber" name="phone_number" value="<?php echo htmlspecialchars($userProfile['phone_number']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour le profil</button>
        </form>
    </div>
</body>
</html>
