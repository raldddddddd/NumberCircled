<?php
require_once __DIR__ . '/../../config/database.php';

class Dashboard
{
    protected $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    public function getTotalUsers()
    {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM users");
        return $result->fetch_assoc()['total'] ?? 0;
    }

    public function getTotalMovies()
    {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM movies");
        return $result->fetch_assoc()['total'] ?? 0;
    }

    public function getTotalReviews()
    {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM reviews");
        return $result->fetch_assoc()['total'] ?? 0;
    }
    public function getTotalGenres()
    {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM genres");
        return $result->fetch_assoc()['total'] ?? 0;
    }

    public function getSentimentCounts()
    {
        $result = $this->conn->query("
        SELECT 
            CASE 
                WHEN r.score > 0.5 THEN 'positive'
                WHEN r.score = 0.5 THEN 'neutral'
                ELSE 'negative'
            END AS sentiment_category,
            COUNT(*) as count
        FROM reviews as r
        GROUP BY sentiment_category
    ");

        $counts = ["positive" => 0, "negative" => 0, "neutral" => 0];
        while ($row = $result->fetch_assoc()) {
            $sentiment = strtolower($row['sentiment_category']);
            $counts[$sentiment] = (int)$row['count'];
        }
        return $counts;
    }
    public function getTopWords($sentiment)
    {
        $stmt = $this->conn->prepare("
        SELECT w.word, SUM(rw.frequency) AS frequency
        FROM words w
        JOIN review_words rw ON w.id = rw.word_id
        WHERE w.sentiment = ?
        GROUP BY w.word
        ORDER BY frequency DESC
        LIMIT 5
    ");
        $stmt->bind_param("s", $sentiment);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Number of reviews per product
    public function getReviewCountsPerProduct()
    {
        $sql = "SELECT m.name, COUNT(r.id) AS review_count
            FROM movies m
            LEFT JOIN reviews r ON m.id = r.movie_id
            GROUP BY m.id";
        return $this->conn->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public function getSentimentTrend($movieId)
    {
        global $conn;
        $stmt = $conn->prepare("
        SELECT 
            DATE(created_at) AS date,
            SUM(CASE WHEN score > 0.5 THEN 1 ELSE 0 END) AS positive,
            SUM(CASE WHEN score = 0.5 THEN 1 ELSE 0 END) AS neutral,
            SUM(CASE WHEN score < 0.5 THEN 1 ELSE 0 END) AS negative
        FROM reviews
        WHERE movie_id = ?
        GROUP BY DATE(created_at)
        ORDER BY date ASC
    ");
        $stmt->bind_param("i", $movieId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getRecentActivities()
    {
        $result = $this->conn->query("SELECT * FROM (
        SELECT CONCAT('Movie edited: ', name) AS activity, last_edited_at AS date FROM movies WHERE last_edited_at IS NOT NULL
        UNION ALL
        SELECT CONCAT('New movie added: ', name) AS activity, created_at FROM movies
        UNION ALL
        SELECT CONCAT('User edited: ', first_name, ' ', last_name) AS activity, last_edited_at FROM users WHERE last_edited_at IS NOT NULL
        UNION ALL
        SELECT CONCAT('New user registered: ', first_name, ' ', last_name) AS activity, created_at FROM users
        UNION ALL
        SELECT CONCAT('New review submitted for: ', m.name) AS activity, r.created_at FROM reviews r JOIN movies m ON r.movie_id = m.id
        UNION ALL
        SELECT CONCAT('Review edited for: ', m.name) AS activity, r.last_edited_at FROM reviews r JOIN movies m ON r.movie_id = m.id WHERE r.last_edited_at IS NOT NULL
        ORDER BY date DESC LIMIT 10
    ) AS activities ORDER BY date DESC");

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
