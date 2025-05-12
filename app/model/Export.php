<?php
require_once __DIR__ . '/../../config/database.php';

class Export {
    public function getSentimentData() {
        global $conn;
        $query = "
            SELECT 
                m.name AS movie_name,
                r.comment,
                u.email,
                r.created_at
            FROM reviews AS r
            JOIN movies AS m ON r.movie_id = m.id
            JOIN users AS u ON r.user_id = u.id
        ";
        return $conn->query($query);
    }
}
