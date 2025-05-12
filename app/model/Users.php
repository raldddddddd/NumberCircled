<?php
require_once __DIR__ . '/../../config/database.php';

class Users
{
    function getUser($input_username)
    {
        global $conn;
        return $query = "SELECT * FROM users WHERE email='$input_username'";
    }


    function getRole($name)
    {
        global $conn;
        $query = $conn->query("SELECT * FROM users WHERE name='$name'");
        return $query['name'];
    }

    function registerUser($first_name, $last_name, $email, $password)
    {
        global $conn;
        $hashedPassword = md5($password);
        $defaultImagePath = __DIR__ . '/../../assets/default-profile.jpeg';
        $imageData = file_get_contents($defaultImagePath);
        $imageEscaped = $conn->real_escape_string($imageData);
        return $query = "INSERT INTO users (role_id, first_name, last_name, email, password, profile_image) VALUES ('3', '$first_name', '$last_name', '$email', '$hashedPassword', '$imageEscaped')";
    }

    function emailExists($email)
    {
        global $conn;
        $query = "SELECT id FROM users WHERE email = '$email'";
        $result = $conn->query($query);
        return $result && $result->num_rows > 0;
    }

    function addUserReview($rating, $movie_id, $user_id, $comment){
        global $conn;
        $query = "INSERT INTO reviews (movie_id, user_id, comment, rating, score) VALUES
                    ($movie_id, $user_id, '$comment', $rating, 1.0)";
        return $conn->query($query);
    }

    function checkExisting($user_id, $movie_id){
        global $conn;
        $query = "SELECT * FROM reviews WHERE user_id='$user_id' AND movie_id='$movie_id'";
        $result = $conn->query($query);
        return $result->num_rows;
    }

    function getExisting($user_id, $movie_id){
        global $conn;
        $query = "SELECT * FROM reviews WHERE user_id='$user_id' AND movie_id='$movie_id'";
        $result = $conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function updateExisting($user_id, $movie_id, $comment, $rating){
        global $conn;
        $query = "UPDATE reviews SET comment='$comment', rating='$rating', score='1.0'
                WHERE user_id = '$user_id' AND movie_id = '$movie_id'";
        $result = $conn->query($query);
        return $result;
    }

    function deleteExisting($user_id, $movie_id){
        global $conn;
        $query = "DELETE FROM reviews WHERE user_id = '$user_id' AND movie_id = '$movie_id'";
        $result = $conn->query($query);
        return $result;
    }

    function getReviewList($movie_id){
        global $conn;
        $query = "SELECT u.first_name, u.last_name, r.comment, r.rating FROM reviews as r
                    INNER JOIN users as u ON r.user_id = u.id
                    WHERE r.movie_id='$movie_id'";
        $result = $conn->query($query);
        return $result;
    }

    // function deleteUser($id)
    // {
    //     global $conn;
    //     return $query = "DELETE FROM users WHERE id='$id'";
    // }

    function checkExistingWord($word){
        global $conn;
        $query = "SELECT * FROM words WHERE word='$word'";
        $result = $conn->query($query);
        return $result->num_rows >= 1;
    }

    function checkExistingReviewWord($review_id, $word_id){
        global $conn;
        $query = "SELECT * FROM review_words WHERE word_id='$word_id' AND review_id='$review_id'";
        $result = $conn->query($query);
        return $result->num_rows >= 1;
    }
    

    function addWord($word, $sentiment){
        global $conn;
        $query = "INSERT INTO words(word, sentiment) VALUES('$word', '$sentiment')";
        $result = $conn->query($query);
        return $result;
    }

    function addReviewWord($review_id, $word_id){
        global $conn;
        $query = "INSERT INTO review_words (review_id, word_id, frequency) VALUES('$review_id', '$word_id', 1)";
        $result = $conn->query($query);
        return $result;
    }

    function updateReviewWord($word_id, $review_id){
        global $conn;
        $query = "UPDATE review_words SET frequency = frequency + 1 WHERE word_id='$word_id' AND review_id='$review_id'";
        $result = $conn->query($query);
        return $result;
    }

    function updateReviewScore($user_id, $movie_id,$score){
        global $conn;
        $query = "UPDATE reviews SET score='$score' WHERE user_id='$user_id' AND movie_id='$movie_id'";
        $result = $conn->query($query);
        return $result;
    }

    function getReviewID($user_id, $movie_id)
    {
        global $conn;
        $query = "SELECT id FROM reviews WHERE user_id='$user_id' AND movie_id='$movie_id'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        return $row['id'];
    }

    function getWordID($word){
        global $conn;
        $query = "SELECT id FROM words WHERE word='$word'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        return $row['id'];
    }

    function deleteReviewWord($review_id){
        global $conn;
        $query="DELETE FROM review_words WHERE review_id='$review_id'";
        $result = $conn->query($query);
        return $result;
    }

    public function logLoginActivity($user_id)
    {
        global $conn;

        $stmt = $conn->prepare("
        INSERT INTO activity_logs (user_id, login_time) 
        VALUES (?, NOW()) 
        ON DUPLICATE KEY UPDATE login_time = NOW()
    ");
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }
}
