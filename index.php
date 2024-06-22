<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Échange de Monnaie</title>
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
    </style>
</head>
<body>
    <!-- Bouton de Menu -->
    <div class="menu-btn text-primary">
        <i class="bi bi-list"></i>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <?php include('sidebar.php'); ?>
    </div>

    <!-- Contenu Principal -->
    <div class="content" id="content">
        <?php include('navbar.php'); ?>
        
        <!-- Contenu de la page d'accueil -->
        <div class="container mt-5">
            <h1>Bienvenue sur notre service d'échange de monnaie</h1>
            <p>Effectuez vos transactions de manière rapide et sécurisée.</p>

            <!-- Formulaire de transaction -->
            <form action="process_transaction.php" method="POST" class="text-center"> <!-- Ajout de la classe text-center -->
                <div class="row">
                    <!-- Section 1: Information de la transaction (Left) -->
                    <div id="div1" class="col-lg-6 form-section mb-4">
                        <h2 class="section-header">Information de la transaction</h2>
                        
                        <div class="mb-3">
                            <label for="fromCurrency" class="form-label">De</label>
                            <select class="form-select" id="fromCurrency" name="from_currency">
                                <option value="USD">USD - Dollar américain</option>
                                <option value="EUR">EUR - Euro</option>
                                <option value="GBP">RIA - USD</option>
                                <option value="FCFA">ORANGE MONEY - FCFA</option>
                                <option value="FCFA">MTN MONEY - FCFA</option>
                                <option value="FCFA">MOOV MONEY - FCFA</option>
                                <option value="FCFA">WAVE - FCFA</option>
                                <option value="FCFA">TRESORMONEY - FCFA</option>
                                <option value="EUR">VISA CARD</option>
                                <option value="EUR">MASTERCARD</option>
                                <option value="EUR">WESTERN UNION</option>
                                <option value="EUR">MONEYGRAM</option>
                                <option value="USD">PERFECT MONEY</option>
                                <option value="USD">BTC</option>
                                <option value="USD">USDT</option>
                                <option value="USD">ETH</option>
                                <option value="USD">BTC CASH</option>
                                <option value="USD">DOGE</option>
                                <option value="USD">LTC</option>
                                <option value="USD">SOL</option>
                                <option value="USD">TRX</option>
                                <option value="USD">XRP</option>
                                <option value="USD">XLM</option>
                                <option value="USD">XTZ</option>
                                    <!-- Options de devise -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Montant</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>

                        <div class="mb-3">
                            <label for="toCurrency" class="form-label">À</label>
                            <select class="form-select" id="toCurrency" name="to_currency">

                                <option value="USD">USD - Dollar américain</option>
                                <option value="EUR">EUR - Euro</option>
                                <option value="GBP">RIA - USD</option>
                                <option value="FCFA">ORANGE MONEY - FCFA</option>
                                <option value="FCFA">MTN MONEY - FCFA</option>
                                <option value="FCFA">MOOV MONEY - FCFA</option>
                                <option value="FCFA">WAVE - FCFA</option>
                                <option value="FCFA">TRESORMONEY - FCFA</option>
                                <option value="EUR">VISA CARD</option>
                                <option value="EUR">MASTERCARD</option>
                                <option value="EUR">WESTERN UNION</option>
                                <option value="EUR">MONEYGRAM</option>
                                <option value="USD">PERFECT MONEY</option>
                                <option value="USD">BTC</option>
                                <option value="USD">USDT</option>
                                <option value="USD">ETH</option>
                                <option value="USD">BTC CASH</option>
                                <option value="USD">DOGE</option>
                                <option value="USD">LTC</option>
                                <option value="USD">SOL</option>
                                <option value="USD">TRX</option>
                                <option value="USD">XRP</option>
                                <option value="USD">XLM</option>
                                <option value="USD">XTZ</option>
                                    <!-- Options de devise -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="receiverNumber" class="form-label">Numéro qui reçoit</label>
                            <input type="number" class="form-control" id="receiverNumber" name="receiverNumber" required>
                        </div>
                    </div>
                    
                    <!-- Section 2: Information de l'utilisateur (Right) -->
                    <div id="div2" class="col-lg-6 form-section mb-4">
                        <h2 class="section-header">Information de l'utilisateur</h2>
                        
                        <div class="mb-3">
                            <label for="username" class="form-label">Nom d'utilisateur</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Numéro de téléphone</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary mt-4 mx-auto">Échanger</button> <!-- Ajout de la classe mx-auto -->
            </form>
        </div>
    </div>

    <!-- Bootstrap JS et JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script pour le ChatBot (Kommunicate) -->
    <script>
        (function(d, m){
            var kommunicateSettings = {"appId":"YOUR_APP_ID","popupWidget":true,"automaticChatOpenOnNavigation":true};
            var s = document.createElement("script"); s.type = "text/javascript"; s.async = true;
            s.src = "https://widget.kommunicate.io/v2/kommunicate.app";
            var h = document.getElementsByTagName("head")[0]; h.appendChild(s);
            window.kommunicate = m; m._globals = kommunicateSettings;
        })(document, window.kommunicate || {});
    </script>
</body>
</html>
