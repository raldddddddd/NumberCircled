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

    public function getTrendingMovies()
    {
        $sql = "
        SELECT 
            m.id,
            m.name,

            -- Total number of recent reviews
            (
                SELECT COUNT(*) 
                FROM reviews r 
                WHERE r.movie_id = m.id 
                AND r.created_at >= NOW() - INTERVAL 7 DAY
            ) AS recent_reviews,

            -- Overall rating for this movie
            (
                SELECT ROUND(AVG(r.rating), 1) 
                FROM reviews r 
                WHERE r.movie_id = m.id
            ) AS overall_rating,

            -- Rating in the last 7 days
            (
                SELECT ROUND(AVG(r.rating), 1) 
                FROM reviews r 
                WHERE r.movie_id = m.id 
                AND r.created_at >= NOW() - INTERVAL 7 DAY
            ) AS recent_rating,

            -- Rating difference
            (
                SELECT ROUND(
                    IFNULL((
                        SELECT AVG(r.rating) 
                        FROM reviews r 
                        WHERE r.movie_id = m.id 
                        AND r.created_at >= NOW() - INTERVAL 7 DAY
                    ), 0) 
                    -
                    IFNULL((
                        SELECT AVG(r.rating) 
                        FROM reviews r 
                        WHERE r.movie_id = m.id
                    ), 0)
                , 1)
            ) AS rating_diff,

            -- Sentiment counts
            (
                SELECT COUNT(*) 
                FROM reviews r 
                WHERE r.movie_id = m.id AND r.score > 0.05
                AND r.created_at >= NOW() - INTERVAL 7 DAY
            ) AS positive_count,

            (
                SELECT COUNT(*) 
                FROM reviews r 
                WHERE r.movie_id = m.id AND r.score = 0.05
                AND r.created_at >= NOW() - INTERVAL 7 DAY
            ) AS neutral_count,

            (
                SELECT COUNT(*) 
                FROM reviews r 
                WHERE r.movie_id = m.id AND r.score < 0.05
                AND r.created_at >= NOW() - INTERVAL 7 DAY
            ) AS negative_count

        FROM movies m
        ORDER BY recent_reviews DESC
        LIMIT 5
    ";

        return $this->conn->query($sql)->fetch_all(MYSQLI_ASSOC);
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
