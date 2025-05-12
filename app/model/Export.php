<?php
require_once __DIR__ . '/../../config/database.php';

class Export
{
    public function getSentimentData()
    {
        global $conn;
        $query = "
            SELECT 
                r.id AS review_id,
                m.name AS movie_name,
                CONCAT(u.first_name, ' ', u.last_name) AS user_name,
                r.rating,
                r.score,
                CASE 
                    WHEN r.score > 0.5 THEN 'positive'
                    WHEN r.score = 0.5 THEN 'neutral'
                    ELSE 'negative'
                END AS sentiment,
                r.created_at
            FROM reviews r
            JOIN movies m ON r.movie_id = m.id
            JOIN users u ON r.user_id = u.id;
        ";
        return $conn->query($query);
    }
}
