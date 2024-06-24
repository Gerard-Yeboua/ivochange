<?php
session_start();
include('config.php'); // Fichier de connexion à la base de données

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Vérifier si les données du formulaire sont envoyées
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $zip_code = $_POST['zip_code'];
    $phone_number = $_POST['phone_number'];

    // Mettre à jour les informations de profil dans la base de données
    $sql = "UPDATE UserProfiles SET first_name = ?, last_name = ?, address = ?, city = ?, country = ?, zip_code = ?, phone_number = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $first_name, $last_name, $address, $city, $country, $zip_code, $phone_number, $user_id);
    $stmt->execute();

    echo "Votre profil a été mis à jour avec succès.";
    header('Location: profile.php'); // Redirection vers la page de profil
    exit();
}
?>
