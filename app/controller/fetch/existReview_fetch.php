<?php
require_once __DIR__ . "/../../model/Users.php";

$movie_id = $_POST['movie_id'];
$user_id = $_POST['user_id'];

$model = new Users();
$state = $model->getExisting($user_id, $movie_id);

echo json_encode($state);

?>