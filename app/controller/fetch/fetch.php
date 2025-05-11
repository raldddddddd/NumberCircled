<?php
require_once __DIR__ . '/../../model/Table.php';

$page = $_GET['page'] ?? '';
$tableModel = new Table();
$output = "";

function buildTableRows($results) {
    $rows = "";
    while ($row = $results->fetch_assoc()) {
        $tds = "";
        $btnData = "";
        foreach ($row as $key => $value) {
            $tds .= "<td>{$value}</td>";
            $btnData .= " data-{$key}='{$value}'";
        }
        $rows .= "
        <tr class='table-light'>
            {$tds}
            <td>
                <button class='btn btn-warning btn-sm editBtn' id='edit-btn' {$btnData}>Edit</button>
                <button class='btn btn-danger btn-sm deleteBtn' data-id='{$row['id']}'>Delete</button>
            </td>
        </tr>";
    }
    return $rows;
}

switch ($page) {
    case 'reviews.php':
        $output = buildTableRows($tableModel->getAllReviews());
        break;
    case 'users.php':
        $output = buildTableRows($tableModel->getAllUsers());
        break;
    case 'movies.php':
        $output = buildTableRows($tableModel->getAllMovies());
        break;
    default:
        $output = "Invalid page parameter";
}

echo $output;
