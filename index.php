<?php
$api_key = "09722286fb260138b336c6db8c32bf5b"; // clé API TMDb

// Fonction pour récupérer les données de l'API TMDb
function fetchMovies($endpoint) {
    global $api_key;
    $url = "https://api.themoviedb.org/3/$endpoint?api_key=$api_key&language=fr-FR&page=1";
    $response = file_get_contents($url);
    return json_decode($response, true)['results'];
}

// Récupération des films et séries
$films_populaires = fetchMovies("movie/popular");
$films_tendances = fetchMovies("trending/movie/week");
$series_populaires = fetchMovies("tv/popular");

// Recherche de films
$search_results = [];
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_query = urlencode($_GET['search']);
    $search_results = fetchMovies("search/movie&query=$search_query");
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Netflix Clone</title>
    <style>
        body { 
            background-color: #141414; 
            color: white; 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 0; 
        }

        .container { 
            width: 90%; 
            margin: auto; 
        }

        /* Style du logo Netflix */
        .logo {
            display: block; 
            margin: 20px auto;
            width: 250px; /* Largeur ajustée du logo */
        }

        /* Centrer les films */
        .movies { 
            display: flex; 
            overflow-x: auto; 
            gap: 15px; 
            padding: 20px; 
        }

        .movie { 
            min-width: 200px; 
            text-align: center; 
        }

        .movie img { 
            width: 100%; 
            border-radius: 8px; 
            transition: transform 0.3s; 
        }

        .movie img:hover { 
            transform: scale(1.1); 
        }

        /* Barre de recherche */
        .search-bar { 
            text-align: center; 
            margin: 20px 0; 
        }

        input[type="text"] { 
            width: 300px; 
            padding: 10px; 
            font-size: 16px; 
        }

        button { 
            padding: 10px; 
            background-color: red; 
            color: white; 
            border: none; 
            cursor: pointer; 
            font-size: 16px; 
            transition: background-color 0.3s ease;
        }

        button:hover { 
            background-color: darkred; 
        }
    </style>
</head>
<body>

<div class="container">
    <img src="https://upload.wikimedia.org/wikipedia/commons/7/7a/Logonetflix.png" alt="Netflix Logo" class="logo">

    <!-- Barre de recherche -->
    <div class="search-bar">
        <form method="GET">
            <input type="text" name="search" placeholder="Rechercher un film...">
            <button type="submit">🔍 Rechercher</button>
        </form>
    </div>

    <!-- Résultats de recherche -->
    <?php if (!empty($search_results)) { ?>
        <h2>Résultats de recherche :</h2>
        <div class="movies">
            <?php foreach ($search_results as $movie) { ?>
                <div class="movie">
                    <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster_path']; ?>" alt="<?= $movie['title']; ?>">
                    <h3><?= $movie['title']; ?></h3>
                    <p>⭐ <?= $movie['vote_average']; ?>/10</p>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

    <!-- Section Films Populaires -->
    <h2>🔥 Films Populaires</h2>
    <div class="movies">
        <?php foreach ($films_populaires as $movie) { ?>
            <div class="movie">
                <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster_path']; ?>" alt="<?= $movie['title']; ?>">
                <h3><?= $movie['title']; ?></h3>
                <p>⭐ <?= $movie['vote_average']; ?>/10</p>
            </div>
        <?php } ?>
    </div>

    <!-- Section Films en Tendance -->
    <h2>📈 Films en Tendance</h2>
    <div class="movies">
        <?php foreach ($films_tendances as $movie) { ?>
            <div class="movie">
                <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster_path']; ?>" alt="<?= $movie['title']; ?>">
                <h3><?= $movie['title']; ?></h3>
                <p>⭐ <?= $movie['vote_average']; ?>/10</p>
            </div>
        <?php } ?>
    </div>

    <!-- Section Séries Populaires -->
    <h2>📺 Séries Populaires</h2>
    <div class="movies">
        <?php foreach ($series_populaires as $serie) { ?>
            <div class="movie">
                <img src="https://image.tmdb.org/t/p/w500<?= $serie['poster_path']; ?>" alt="<?= $serie['name']; ?>">
                <h3><?= $serie['name']; ?></h3>
                <p>⭐ <?= $serie['vote_average']; ?>/10</p>
            </div>
        <?php } ?>
    </div>

</div>

</body>
</html>
