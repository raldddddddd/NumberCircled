<?php
require_once __DIR__ . "/../../model/Users.php";
session_start();
$movie = $_GET['movie'];
$model = new Users();
$_SESSION['movie_id'] = $movie;
$_SESSION['existing_review'] = '1';
if($model->checkExisting($_SESSION['user_id'], $movie) == 0){
    $_SESSION['existing_review'] = "0";
}

header('Location: /NumberCircled/app/view/movie_review/movie_review_page.php');
exit;
?>


