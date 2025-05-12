<?php
require_once __DIR__ . '/../../model/Table.php';

header('Content-Type: application/json');

$type = $_GET['type'] ?? '';
$model = new Table();

switch ($type) {
    // case 'roles':
    //     $data = $model->getRoles();
    //     break;
    case 'genres':
        $data = $model->getGenres();
        break;
    default:
        echo json_encode([]);
        exit;
}

echo json_encode($data);
