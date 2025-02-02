<?php
// Vérifier si le formulaire a été soumis via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer l'email envoyé par POST
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "Inconnu";

    // Pour l'exemple, affichons l'email sur la page
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation d'inscription | Netflix</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #141414;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: rgba(0, 0, 0, 0.85);
            padding: 40px;
            border-radius: 12px;
            width: 400px;
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.2);
        }

        .logo {
            width: 150px;
            margin-bottom: 20px;
        }

        .btn {
            background: red;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            cursor: pointer;
            border-radius: 6px;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
            margin-top: 20px;
        }

        .btn:hover {
            background: darkred;
            transform: scale(1.05);
            box-shadow: 0 0 15px red;
        }

        /* Style pour l'écran de chargement */
        #loading-screen {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: #141414;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            font-weight: bold;
        }

        /* Masquer le contenu pendant le chargement */
        #content {
            display: none;
        }
    </style>
</head>
<body onload="startLoading()">

    <!-- Effet de chargement -->
    <div id="loading-screen">
        <p>Chargement en cours...</p>
    </div>

    <div id="content">
        <div class="container">
            <img src="https://upload.wikimedia.org/wikipedia/commons/7/7a/Logonetflix.png" alt="Netflix Logo" class="logo">
            <h2>Bienvenue sur Netflix, <?php echo $email; ?> !</h2>
            <p>Votre inscription a été réalisée avec succès. Vous pouvez maintenant profiter de votre abonnement.</p>
            <button class="btn" onclick="window.location.href='index.php'">Accéder à Netflix</button>
        </div>
    </div>

    <script>
        // Fonction pour gérer l'effet de chargement
        function startLoading() {
            setTimeout(() => {
                document.getElementById("loading-screen").style.display = "none";  // Masquer l'écran de chargement
                document.getElementById("content").style.display = "block";  // Afficher le contenu de confirmation
            }, 4000); // Affichage pendant 4 secondes
        }
    </script>

</body>
</html>
