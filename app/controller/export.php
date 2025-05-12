<?php
require_once __DIR__ . '/../model/Export.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=sentiment_data.csv');

$model = new Export();
$results = $model->getSentimentData();

$output = fopen('php://output', 'w');
fputcsv($output, ['Review ID', 'Movie Name', 'User Name', 'Rating', 'Comment' ,'Score', 'Sentiment', 'Created At','Last Edited At']);

while ($row = $results->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit;   
