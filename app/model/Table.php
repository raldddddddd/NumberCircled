<?php
require_once __DIR__ . "/../../config/database.php";

class Table {
    // Get all reviews
    public function getAllReviews() {
        global $conn;
        $query = "
            SELECT 
                r.id AS id,
                CONCAT(u.first_name, ' ', u.last_name) AS user_name,
                u.id AS user_id,
                m.name AS movie_name,
                m.id AS movie_id,
                r.comment,
                r.rating,
                r.score,
                r.sentiment_category,
                r.created_at,
                r.last_edited_at
            FROM reviews AS r
            INNER JOIN users AS u ON r.user_id = u.id
            INNER JOIN movies AS m ON r.movie_id = m.id;
        ";
        return $conn->query($query);
    }

    // Get all users
    public function getAllUsers() {
        global $conn;
        $query = "
            SELECT 
                u.id, 
                CONCAT(u.first_name, ' ', u.last_name) AS user_name,
                u.email, 
                u.created_at, 
                al.login_time
            FROM users AS u
            LEFT JOIN activity_logs AS al ON u.id = al.user_id;
        ";
        return $conn->query($query);
    }

    // Get all movies
    public function getAllMovies() {
        global $conn;
        $query = "
            SELECT 
                m.id, 
                m.name, 
                m.description, 
                g.name AS genre_name, 
                m.release_date, 
                m.image_url
            FROM movie_genres AS mg
            INNER JOIN movies AS m ON mg.movie_id = m.id
            INNER JOIN genres AS g ON mg.genre_id = g.id;
        ";
        return $conn->query($query);
    }
}
?>
