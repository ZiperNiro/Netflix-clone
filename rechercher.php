<?php
// Activer l'affichage des erreurs
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$servername = "localhost";
$username = "ilies"; // Ton nom d'utilisateur MySQL
$password = ""; // Ton mot de passe MySQL
$dbname = "netflix_clone"; // Nom de ta base de données

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("❌ Connexion échouée : " . $conn->connect_error);
}

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Afficher les données envoyées via POST (pour déboguer)
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Vérification que tous les champs sont présents
    if (!isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['card-number']) || !isset($_POST['expiry']) || !isset($_POST['cvv'])) {
        echo "❌ Tous les champs sont obligatoires !<br>";
    } else {
        // Récupérer les données du formulaire
        $email = $_POST['email'];
        $password = $_POST['password'];
        $card_number = $_POST['card-number'];
        $expiry = $_POST['expiry'];
        $cvv = $_POST['cvv'];

        // Préparation de la requête SQL pour insérer les données dans la base
        $stmt = $conn->prepare("INSERT INTO users (email, password, card_number, expiry, cvv) VALUES (?, ?, ?, ?, ?)");

        if ($stmt === false) {
            die("❌ Erreur de préparation de la requête SQL : " . $conn->error);
        }

        // Lier les paramètres à la requête SQL
        $stmt->bind_param("sssss", $email, $password, $card_number, $expiry, $cvv);

        
        // Exécution de la requête
        if ($stmt->execute()) {
            // ✅ Rediriger vers la page de confirmation
            header("Location: confirmation.php?email=" . urlencode($email));
            exit(); // 🔴 Important : Arrêter le script après la redirection
        } else {
            echo "❌ Erreur d'exécution : " . $stmt->error . "<br>";
        }

        
        // Fermer la requête après l'exécution
        $stmt->close();
    }
}

// Fermer la connexion après le traitement
$conn->close();
?>
