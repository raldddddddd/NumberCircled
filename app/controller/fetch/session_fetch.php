<?php
session_start();
$movie = $_GET['movie'];
$_SESSION['movie_id'] = $movie;
header('Location: /NumberCircled/app/view/movie_review/movie_review_page.php');
exit;
?>


