<?php include('admin_check.php'); ?>
<?php
    if (isset($_GET['id']) && isset($_GET['role'])) {
        $userId = $_GET['id'];
        $newRole = $_GET['role'];
        $conn = new mysqli('localhost', 'root', '', 'currency_exchange');
        if ($conn->connect_error) {
            die("Connexion échouée : " . $conn->connect_error);
        }

        $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->bind_param("si", $newRole, $userId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Rôle mis à jour avec succès.";
        } else {
            echo "Erreur lors de la mise à jour du rôle.";
        }

        $stmt->close();
        $conn->close();
    }
?>
<a href="manage_users.php" class="btn btn-primary">Retour à la Gestion des Utilisateurs</a>
