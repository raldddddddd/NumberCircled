<?php
require_once __DIR__ . "/../../../config/database.php";
$query = "SELECT m.name, r.sentiment_category, r.rating, m.image_url, m.id FROM movies as m
INNER JOIN reviews as r ON m.id = r.movie_id
ORDER BY rating DESC";

$output = "<!-- Chevron Previous -->
        <button class='btn-chevron-next'>
        <i class='fas fa-chevron-left fa-2x'></i>
        </button>";

$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $genres = "";
    $id = $row['id'];
    $findGenre = $conn->query("SELECT mg.movie_id, g.name as genre FROM movie_genres as mg
        INNER JOIN genres as g ON g.id = mg.genre_id
        WHERE mg.movie_id ='$id'");

    while($fetchedGenre = $findGenre->fetch_assoc()){
        $genres .= "<span class='genre-tag'>{$fetchedGenre['genre']}</span>";
    }

    $output .= "<div class='text-center'>
    <a class='movie-link' href='/NumberCircled/app/controller/fetch/session_fetch.php?movie={$row['id']}'>
    <img value='{$row['name']}' src='{$row['image_url']}' class='movie-poster' id='poster'/>
    </a>
    <h6 class='mt-2 mb-1'>{$row['name']}</h6>
        <div class='d-flex justify-content-center align-items-center gap-3 rating-row'>
            <span><i class='fas fa-thumbs-up text-danger me-1'></i>{$row['sentiment_category']}</span>
            <span><i class='fas fa-star text-warning me-1'></i>{$row['rating']}</span>
        </div>
    <div class='d-flex justify-content-center gap-2 mt-2 flex-wrap'>"
        .$genres."
    </div>
    </div>";
}

$output .= "<!-- Chevron next -->
        <button class='btn-chevron-next'>
          <i class='fas fa-chevron-right fa-2x'></i>
          </button>";
echo $output;
?>