<?php
require_once __DIR__ . "/../../../config/database.php";

$query = "
SELECT 
    m.name, 
    AVG(r.rating) as rating, 
    AVG(r.score) as score,
    m.image_url, 
    m.id,
    CASE 
        WHEN AVG(r.score) > 0.5 THEN 'Positive'
        WHEN AVG(r.score) = 0.5 THEN 'Neutral'
        ELSE 'Negative'
    END AS sentiment
FROM movies AS m
INNER JOIN reviews AS r ON m.id = r.movie_id
GROUP BY m.id
ORDER BY rating DESC
";

$output = "";

$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $genres = "";
    $id = $row['id'];

    // Fetch genres
    $findGenre = $conn->query("SELECT g.name as genre FROM movie_genres mg
        INNER JOIN genres g ON g.id = mg.genre_id
        WHERE mg.movie_id = '$id'");

    while ($fetchedGenre = $findGenre->fetch_assoc()) {
        $genres .= "<span class='genre-tag'>{$fetchedGenre['genre']}</span>";
    }

    // One .movie-card per movie
    $output .= "
    <div class='movie-card text-center'>
        <a class='movie-link' href='/NumberCircled/app/controller/fetch/session_fetch.php?movie={$id}'>
            <img value='{$row['name']}' src='{$row['image_url']}' class='movie-poster' id='poster'/>
        </a>
        <h6 class='mt-2 mb-1 text-white'>{$row['name']}</h6>
        <div class='d-flex justify-content-center align-items-center gap-3 rating-row'>
            <span><i class='fas fa-thumbs-up text-danger me-1'></i>{$row['sentiment']}</span>
            <span><i class='fas fa-star text-warning me-1'></i>" . number_format($row['rating'], 1) . "</span>
        </div>
        <div class='d-flex justify-content-center gap-2 mt-2 flex-wrap'>{$genres}</div>
    </div>";
}
echo $output;
?>
