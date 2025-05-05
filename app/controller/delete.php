<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../model/Users.php";

$user = new Users();
$id = $_POST['id'] ?? null;


if($id){
    $query = $user->deleteUser($id);
} 

if ($conn->query($query)) {
    echo "Arigato Jamal";
} else {
    echo "Error: " . $conn->error;
}

?>