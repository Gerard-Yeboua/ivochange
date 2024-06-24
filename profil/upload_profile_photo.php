<?php
session_start();
include('config.php'); // Fichier de connexion à la base de données

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Vérifier si un fichier a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profilePhoto'])) {
    $target_dir = "uploads/profile_photos/";
    $target_file = $target_dir . basename($_FILES["profilePhoto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Vérifier si le fichier est une image
    $check = getimagesize($_FILES["profilePhoto"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }

    // Vérifier si le fichier existe déjà
    if (file_exists($target_file)) {
        echo "Désolé, le fichier existe déjà.";
        $uploadOk = 0;
    }

    // Vérifier la taille du fichier
    if ($_FILES["profilePhoto"]["size"] > 5000000) { // 5MB maximum
        echo "Désolé, votre fichier est trop grand.";
        $uploadOk = 0;
    }

    // Autoriser certains formats de fichier
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        $uploadOk = 0;
    }

    // Vérifier si $uploadOk est à 0 à cause d'une erreur
    if ($uploadOk == 0) {
        echo "Désolé, votre fichier n'a pas été téléchargé.";
    // Si tout est correct, essayer de télécharger le fichier
    } else {
        if (move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $target_file)) {
            // Mettre à jour le chemin de la photo de profil dans la base de données
            $sql = "UPDATE UserProfiles SET profile_photo = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $target_file, $user_id);
            $stmt->execute();

            echo "Le fichier ". htmlspecialchars(basename($_FILES["profilePhoto"]["name"])) . " a été téléchargé.";
            header('Location: profile.php'); // Redirection vers la page de profil
            exit();
        } else {
            echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    }
}
?>
