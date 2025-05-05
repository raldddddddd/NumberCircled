<?php
require_once __DIR__ . "/../../../config/database.php";
$query = "";
if($_GET['page'] == "review_list"){
    $query = "SELECT mrs.id, u.first_name, m.name, mrc.rating, mrs.sentiment_category
    FROM movie_review_comments as mrc
    INNER JOIN users as u ON mrc.user_id = u.id
    INNER JOIN movies as m ON mrc.movie_id = m.id
    INNER JOIN movie_review_sentiments as mrs ON mrc.id = mrs.movie_review_comment_id";
} else if($_GET['page'] == "add_user"){
    $query = "SELECT u.id, u.first_name, u.last_name, u.email, u.password, u.role_id, u.created_at, al.login_time
    FROM users as u
    LEFT JOIN activity_logs as al ON u.id = al.user_id
    ";
} else {
    $query = "SELECT m.id, m.name, m.description, g.name, m.release_date, m.image_url
    FROM movie_genres as mg INNER JOIN movies as m ON mg.movie_id = m.id 
    INNER JOIN genres as g ON mg.genre_id = g.id; 
    ";
}

$output = "";
$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $resultData = $conn->query($query);
    $tableData = "";
    $tableButtons = "";
    while($fetchField = $resultData->fetch_field()){
        $tableData .="
        <td>{$row[$fetchField->name]}</td>";
        $tableButtons .="
        data-".$fetchField->name."='{$row[$fetchField->name]}'";
    }
    $output .= "
        <tr class='table-light'>
        ".$tableData."
            <td>
                <button class='btn btn-warning btn-sm editBtn' id='edit-btn'".$tableButtons.">Edit</button>
                <button class='btn btn-danger btn-sm deleteBtn' data-id='{$row['id']}'>Delete</button>
            </td>
        </tr>";
}
echo $output;
?>