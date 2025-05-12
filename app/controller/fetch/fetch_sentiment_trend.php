<?php
require_once __DIR__ . '/../../model/Table.php';

header('Content-Type: application/json');

$movieId = $_GET['movie_id'] ?? 0;

$model = new Table();
echo json_encode($model->getSentimentTrend($movieId));
