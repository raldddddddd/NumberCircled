<?php
require_once __DIR__ . "/../../model/Movies.php";
header('Content-Type: application/json');

if (!isset($_GET['movie'])) {
    echo json_encode([
        "error" => "Missing 'movie' parameter.",
        "movie" => [],
        "genre" => [],
        "review_detail" => []
    ]);
    exit;
}

$id = $_GET['movie'];
$model = new Movies($conn);
$data = [
    "movie" => $model->getMovie($id),
    "genre" => $model->getGenre($id),
    "review_detail" => $model->getReviewDetail($id)
];

echo json_encode($data);
?>


