<!-- reviews.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avis - Échange de Monnaie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .section-header {
            margin-top: 20px;
            font-size: 1.25rem;
            font-weight: bold;
        }
        /* Ensuring the form sections are styled distinctly */
        .form-section {
            padding: 25px;
            border: 1px solid #ddd;
            border-radius: 5px;
            border-color: gray;
            background-color: #f9f9f9;
            margin-top: 20px;
        }

        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star-rating input[type="radio"]:checked ~ label,
        .star-rating input[type="radio"]:hover ~ label {
            color: #f49b2e;
        }

        .star-rating input[type="radio"]:checked ~ label ~ label,
        .star-rating input[type="radio"]:hover ~ label ~ label {
            color: #ddd;
        }
    </style>
</head>
<body>
    <div class="menu-btn text-primary">
        <i class="bi bi-list"></i>
    </div>
    <!-- Sidebar -->
    <div class="sidebar">
        <?php include('sidebar.php'); ?>
    </div>
    <!-- Wrapper to contain sidebar and main content -->
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <?php include('sidebar.php'); ?>
        </div>
        
        <!-- Main Content -->
        <div class="content" id="content">
            <?php include('navbar.php'); ?>
            <div class="container mt-5">
                <h1 class="text-center">Vos avis</h1>
                <form action="submit_review.php" method="POST" class="mb-3">
                    <div class="mb-3">
                        <label for="username" class="form-label">Nom Utilisateur</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="review" class="form-label">Votre avis</label>
                        <textarea class="form-control" id="review" name="review" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Note</label>
                        <div class="star-rating">
                            <input type="radio" id="5-stars" name="rating" value="5" required />
                            <label for="5-stars" class="bi bi-star-fill"></label>
                            <input type="radio" id="4-stars" name="rating" value="4" />
                            <label for="4-stars" class="bi bi-star-fill"></label>
                            <input type="radio" id="3-stars" name="rating" value="3" />
                            <label for="3-stars" class="bi bi-star-fill"></label>
                            <input type="radio" id="2-stars" name="rating" value="2" />
                            <label for="2-stars" class="bi bi-star-fill"></label>
                            <input type="radio" id="1-star" name="rating" value="1" />
                            <label for="1-star" class="bi bi-star-fill"></label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Envoyer</button>
                </form>

        <!-- Afficher les avis -->
        <div class="list-group">
        <?php
           
           // Inclure la configuration de la base de données
           include('config.php');
           
           // Assurez-vous que la connexion est correcte
           if ($conn->connect_error) {
               die("La connexion a échoué: " . $conn->connect_error);
           }
           
           // Code pour gérer les avis (reviews)
           if ($_SERVER["REQUEST_METHOD"] == "POST") {
               // Traitement des avis soumis par les utilisateurs
               $name = $_POST['username'];
               $review = $_POST['review'];
               $rating = $_POST['rating'];
           
               // Préparation de la requête d'insertion
               $stmt = $conn->prepare("INSERT INTO reviews (username, review, rating) VALUES (?, ?, ?)");
               if ($stmt === false) {
                   die("Erreur de préparation de la requête: " . $conn->error);
               }
               $stmt->bind_param("ssd", $name, $review, $rating);
           
               if ($stmt->execute()) {
                   echo "Avis ajouté avec succès.";
               } else {
                   echo "Erreur lors de l'ajout de l'avis: " . $stmt->error;
               }
           
               // Fermer la requête préparée
               $stmt->close();
           }
           
            // Requête SQL pour récupérer les avis avec les détails de l'utilisateur
            $sql = "SELECT 
                        reviews.id AS review_id,
                        users.username AS user_name,
                        reviews.review,
                        reviews.rating,
                        reviews.created_at
                    FROM 
                        reviews
                    JOIN 
                        users ON reviews.user_id = users.user_id
                    ORDER BY 
                        reviews.created_at DESC";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='review'>";
                    echo "<h4>Numéro de reponse: " . htmlspecialchars($row['review_id']) . "</h4>";
                    echo "<h5>Nom utilisateur: " . htmlspecialchars($row['user_name']) . "</h5>";
                    echo "<p>Avis: " . htmlspecialchars($row['review']) . "</p>";
                    echo "<p>Note: " . htmlspecialchars($row['rating']) . "</p>";
                    echo "<p><em>Crée le : " . htmlspecialchars($row['created_at']) . "</em></p>";
                    echo "</div>";
                }
                } else {
                echo "<p>Aucun avis trouvé.</p>";
                }

                // Fermer la connexion
                $conn->close();
           ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript for toggling the sidebar on small screens
        document.addEventListener('DOMContentLoaded', function() {
            var sidebarToggle = document.querySelector('.sidebar-toggle');
            var body = document.querySelector('body');

            sidebarToggle.addEventListener('click', function() {
                body.classList.toggle('sidebar-active');
            });
        });
    </script>
    
</body>
</html>
