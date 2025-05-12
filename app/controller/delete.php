<?php
require_once __DIR__ . '/../model/Table.php';

$id = $_POST['id'] ?? null;
$page = $_POST['page'] ?? '';

if (!$id || !$page) {
    echo "Missing ID or page parameter";
    exit;
}

$tableModel = new Table();

switch ($page) {
    case 'reviews.php':
        $result = $tableModel->deleteReview($id);
        break;
    case 'users.php':
        $result = $tableModel->deleteUser($id);
        break;
    case 'movies.php':
        $result = $tableModel->deleteMovie($id);
        break;
    case 'genres.php':
        $result = $tableModel->deleteGenre($id);
        break;
    default:
        echo "Invalid page parameter";
        exit;
}

echo $result ? "Record deleted successfully." : "Failed to delete record.";
