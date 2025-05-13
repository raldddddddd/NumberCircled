<?php
require_once __DIR__ . "/../../model/Users.php";
$id = $_GET['movie'];
$model = new Users($conn);

$output = "";
$data =  $model->getReviewList($id);
while ($row = $data->fetch_assoc()) {
    $stars = "";
    for ($x = 1; $x <= $row['rating']; $x++) {
        $stars .=  "<i class='fas fa-star'></i>";
    }
     
    for ($x = 1; $x <= ceil($row['rating'])-floor($row['rating']); $x++) {
        $stars .=  "<i class='fas fa-star-half-alt'></i>";
    }

    $output .="<div class='col-md-6'>
                        <div class='review-box p-3'>
                            <div class='d-flex justify-content-between align-items-center mb-2'>
                                <div>
                                    <strong class='review-user'>{$row['first_name']} {$row['last_name']}</strong>
                                </div>
                                <div class='rating-stars d-flex align-items-center'>
                                    <span class='text-warning me-2 review-star'>"
                                    .$stars."
                                    </span>
                                    <span class='badge bg-dark-subtle text-white'>{$row['rating']}</span>
                                </div>
                            </div>
                            <p class='mb-0 review-comment'>{$row['comment']}</p>
                        </div>
                    </div>";
}       
echo $output;
?>


