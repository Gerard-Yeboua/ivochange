<!-- reviews.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avis - Échange de Monnaie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Inclure la barre de navigation -->
    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <h1>Vos avis</h1>
        <form action="submit_review.php" method="POST" class="mb-3">
            <div class="mb-3">
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="review" class="form-label">Votre avis</label>
                <textarea class="form-control" id="review" name="review" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>

        <!-- Afficher les avis -->
        <div class="list-group">
        <?php
            // Establish database connection
            $mysqli = new mysqli("localhost", "user", "password", "database");

            // Check the connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            // Updated query to join reviews and users table
            $query = "SELECT u.username, r.comment, r.rating 
                    FROM reviews r 
                    JOIN users u ON r.user_id = u.id";

            // Execute the query
            if ($result = $mysqli->query($query)) {
                // Fetch and display the results
                while ($row = $result->fetch_assoc()) {
                    echo "Username: " . $row['username'] . "<br>";
                    echo "Comment: " . $row['comment'] . "<br>";
                    echo "Rating: " . $row['rating'] . "<br><br>";
                }
                // Free the result set
                $result->free();
            } else {
                // Display an error message if the query fails
                echo "Error: " . $mysqli->error;
            }

            // Close the database connection
            $mysqli->close();
        ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
