<?php
require_once __DIR__ . '/../../model/Table.php';

$page = $_GET['page'] ?? '';
$tableModel = new Table();
$output = "";

function buildTableRows($results, $page)
{
    session_start();
    $currentUserRole = $_SESSION['role_id'];
    $currentUserId = $_SESSION['user_id'];
    $rows = "";

    while ($row = $results->fetch_assoc()) {
        $tds = "";
        $btnData = "";
        $canEdit = true;
        $canDelete = true;

        if ($page === 'users.php') {
            $targetUserId = $row['id'];
            $targetUserRole = $row['user_role'];
            if ($currentUserRole == 2) {
                if ($targetUserRole === "Super Admin") {
                    $canEdit = false;
                    $canDelete = false;
                } elseif ($targetUserId == $currentUserId) {
                    $canEdit = true;
                    $canDelete = false;
                } elseif ($targetUserRole === "Admin") {
                    $canEdit = false;
                    $canDelete = false;
                }
            } elseif ($targetUserId == $currentUserId) {
                $canDelete = false;
            }
        }

        foreach ($row as $key => $value) {
            if ($key === 'profile_image' && $value !== null) {
                $imageSrc = 'data:image/jpeg;base64,' . base64_encode($value);
                $tds .= "<td><img src='{$imageSrc}' alt='Profile' style='width: 50px; height: 50px; object-fit: cover;'></td>";
            } else {
                $tds .= "<td>{$value}</td>";
                if ($key !== 'profile_image') {
                    $btnData .= " data-{$key}='" . htmlspecialchars($value, ENT_QUOTES) . "'";
                }
            }
        }

        $editBtn = ($canEdit && $page !== 'reviews.php')
            ? "<button class='btn btn-warning btn-sm editBtn' {$btnData}>Edit</button>"
            : "";

        $deleteBtn = $canDelete
            ? "<button class='btn btn-danger btn-sm deleteBtn' data-id='{$row['id']}'>Delete</button>"
            : "";

        $rows .= "
<tr class='table-light'>
    {$tds}
    <td>
        {$editBtn}
        {$deleteBtn}
    </td>
</tr>";
    }
    return $rows;
}



switch ($page) {
    case 'reviews.php':
        $output = buildTableRows($tableModel->getAllReviews(), $page);
        break;
    case 'users.php':
        $output = buildTableRows($tableModel->getAllUsers(), $page);
        break;
    case 'movies.php':
        $output = buildTableRows($tableModel->getAllMovies(), $page);
        break;
    case 'genres.php':
        $output = buildTableRows($tableModel->getAllGenres(), $page);
        break;
    default:
        $output = "Invalid page parameter";
}

echo $output;
