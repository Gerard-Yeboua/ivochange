<?php include('admin_check.php'); ?>
<?php
if (isset($_GET['id'])) {
    $reviewId = $_GET['id'];
    $conn = new mysqli('localhost', 'root', '', 'currency_exchange');
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    $stmt = $conn->prepare("DELETE FROM reviews WHERE id = ?");
    $stmt->bind_param("i", $reviewId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Avis supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'avis.";
    }

    $stmt->close();
    $conn->close();
}
?>
<a href="manage_reviews.php" class="btn btn-primary">Retour à la Modération des Avis</a>
