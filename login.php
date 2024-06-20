<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "currency_exchange";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $stmt->bind_result($userId, $hashedPassword, $role);
    $stmt->fetch();

    if (password_verify($inputPassword, $hashedPassword)) {
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $inputUsername;
        $_SESSION['role'] = $role;

        if ($role == 'admin') {
            header("Location: admin/admin_dashboard.php");
        } else {
            header("Location: index.php");
        }
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Échange de Monnaie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Connexion</h1>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Connexion</button>

            <div class="mb-3">
                <p>Vous êtes nouveau ? <a href="signin.php">S'inscrire ici</a></p>
            </div>
        </form>
    </div>
</body>
</html>
