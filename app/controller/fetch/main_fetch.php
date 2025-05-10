<?php
require_once __DIR__ . "/../../../config/database.php";
$query = "SELECT m.name, r.sentiment_category, r.rating, g.name AS genre, m.image_url FROM movies as m
INNER JOIN reviews as r ON m.id = r.movie_id
INNER JOIN movie_genres as mg ON m.id = mg.movie_id
INNER JOIN genres as g ON mg.genre_id = g.id
ORDER BY rating DESC";

$output = "<!-- Chevron Previous -->
        <button class='btn-chevron-next'>
        <i class='fas fa-chevron-left fa-2x'></i>
        </button>";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $output .= "<div class='text-center'>
    <img src='{$row['image_url']}' class='movie-poster'/>
    <h6 class='mt-2 mb-1'>{$row['name']}</h6>
        <div class='d-flex justify-content-center align-items-center gap-3 rating-row'>
            <span><i class='fas fa-thumbs-up text-danger me-1'></i>{$row['sentiment_category']}</span>
            <span><i class='fas fa-star text-warning me-1'></i>{$row['rating']}</span>
        </div>
    <div class='d-flex justify-content-center gap-2 mt-2 flex-wrap'>
        <span class='genre-tag'>{$row['genre']}</span>
    </div>
</div>";
}

$output .= "<!-- Chevron next -->
        <button class='btn-chevron-next'>
          <i class='fas fa-chevron-right fa-2x'></i>
          </button>";
echo $output;
?>