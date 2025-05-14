<?php
require_once __DIR__ . '/../../model/Dashboard.php'; // Use Dashboard instead of Table

header('Content-Type: application/json');

$movieId = $_GET['movie_id'] ?? 0;

$model = new Dashboard($conn); // Create a Dashboard instance
echo json_encode($model->getSentimentTrend($movieId)); // Call the method on Dashboard
