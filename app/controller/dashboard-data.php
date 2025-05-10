<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../model/DashboardModel.php";

header('Content-Type: application/json');

$model = new DashboardModel($conn);

$response = [
    "totalUsers" => $model->getTotalUsers(),
    "totalReviews" => $model->getTotalReviews(),
    "sentimentDistribution" => $model->getSentimentCounts(),
    "positiveWords" => $model->getTopWords('positive'),
    "negativeWords" => $model->getTopWords('negative'),
    "trendingMovies" => $model->getTrendingMovies(),
    "recentActivities" => $model->getRecentActivities(),
];

echo json_encode($response);