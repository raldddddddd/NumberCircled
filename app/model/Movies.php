<?php
require_once __DIR__ . '/../../config/database.php';

class Movies
{
    protected $conn;
    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    function getMovie($id)
    {
        $query = "SELECT * FROM movies WHERE id='$id'";
        return $this->conn->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    function getGenre($id)
    {
        $query = "SELECT g.name as genre FROM movie_genres as mg
                INNER JOIN genres as g ON g.id = mg.genre_id
                WHERE mg.movie_id ='$id'";
        return $this->conn->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    function getReviewDetail($id)
    {
        $query = "
        SELECT 
            CASE 
                WHEN score > 0.5 THEN 'positive'
                WHEN score = 0.5 THEN 'neutral'
                ELSE 'negative'
            END AS sentiment
        FROM reviews
        WHERE movie_id = '$id'
    ";
        return $this->conn->query($query)->fetch_all(MYSQLI_ASSOC);
    }
}
