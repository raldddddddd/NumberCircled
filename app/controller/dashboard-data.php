<?php
require_once __DIR__ . "/../model/Dashboard.php";

header('Content-Type: application/json');

$model = new Dashboard($conn);

$response = [
    "totalUsers" => $model->getTotalUsers(),
    "totalMovies" => $model->getTotalMovies(),
    "totalReviews" => $model->getTotalReviews(),
    "totalGenres" => $model->getTotalGenres(),
    "sentimentDistribution" => $model->getSentimentCounts(),
    "positiveWords" => $model->getTopWords('positive'),
    "negativeWords" => $model->getTopWords('negative'),
    'reviewsPerProduct' => $model->getReviewCountsPerProduct(),
    "recentActivities" => $model->getRecentActivities(),
];

echo json_encode($response);
