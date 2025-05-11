<?php
require_once __DIR__ . '/../../config/database.php';

class Dashboard {
    protected $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function getTotalUsers() {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM users");
        return $result->fetch_assoc()['total'] ?? 0;
    }

    public function getTotalReviews() {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM reviews");
        return $result->fetch_assoc()['total'] ?? 0;
    }

    public function getSentimentCounts() {
        $result = $this->conn->query("SELECT sentiment_category, COUNT(*) as count FROM reviews GROUP BY sentiment_category");
        $counts = ["positive" => 0, "negative" => 0, "neutral" => 0];
        while ($row = $result->fetch_assoc()) {
            $sentiment = strtolower($row['sentiment_category']);
            $counts[$sentiment] = (int)$row['count'];
        }
        return $counts;
    }

    public function getTopWords($sentiment) {
        $stmt = $this->conn->prepare("SELECT word, frequency FROM word_frequencies WHERE sentiment = ? ORDER BY frequency DESC LIMIT 5");
        $stmt->bind_param("s", $sentiment);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getTrendingMovies() {
        $sql = "SELECT m.name, COUNT(r.id) as recent_reviews, ROUND(AVG(r.rating),1) as avg_rating,
                       (SELECT sentiment_category FROM reviews WHERE movie_id = m.id ORDER BY created_at DESC LIMIT 1) as latest_sentiment
                FROM movies m
                JOIN reviews r ON m.id = r.movie_id
                WHERE r.created_at >= NOW() - INTERVAL 7 DAY
                GROUP BY m.id
                ORDER BY recent_reviews DESC LIMIT 5";
        return $this->conn->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public function getRecentActivities() {
        $result = $this->conn->query("SELECT * FROM (
            SELECT CONCAT('Movie edited: ', name) AS activity, last_edited_at AS date FROM movies WHERE last_edited_at IS NOT NULL
            UNION ALL
            SELECT CONCAT('User edited: ', first_name, ' ', last_name) AS activity, last_edited_at FROM users WHERE last_edited_at IS NOT NULL
            UNION ALL
            SELECT CONCAT('New user registered: ', first_name, ' ', last_name) AS activity, created_at FROM users
            UNION ALL
            SELECT CONCAT('New review submitted for: ', m.name) AS activity, r.created_at FROM reviews r JOIN movies m ON r.movie_id = m.id
            ORDER BY date DESC LIMIT 10
        ) AS activities ORDER BY date DESC");

        return $result->fetch_all(MYSQLI_ASSOC);
    }
} 