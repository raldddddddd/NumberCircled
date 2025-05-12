<?php
require_once __DIR__ . '/../model/Table.php';

$tableModel = new Table();
$page = $_POST['page'] ?? '';
$result = false;

switch ($page) {
    case 'users.php':
        if ($_FILES['profile_image']['tmp_name']) {
            $profileImageData = file_get_contents($_FILES['profile_image']['tmp_name']);
        } else {
            $profileImageData = null;
        }

        if (empty($_POST['id'])) {
            $result = $tableModel->addUser($_POST['role_id'], $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $profileImageData);
        } else {
            $result = $tableModel->updateUser($_POST['id'], $_POST);
        }
        break;

    case 'genres.php':
        if (empty($_POST['id'])) {
            $result = $tableModel->addGenre($_POST['name']);
        } else {
            $result = $tableModel->updateGenre($_POST['id'], $_POST);
        }
        break;

    case 'movies.php':
        if (empty($_POST['id'])) {
            $movieId = $tableModel->addMovie($_POST['name'], $_POST['description'], $_POST['release_date'], $_POST['image_url']);
            if (!empty($_POST['genre_ids'])) {
                $tableModel->addMovieGenres($movieId, $_POST['genre_ids']);
            }
            $result = true;
        } else {
            $result = $tableModel->updateMovie($_POST['id'], $_POST);
        }
        break;

    default:
        echo "Invalid page";
        exit;
}

echo $result === true ? "Record saved successfully" : $result;
