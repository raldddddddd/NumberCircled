<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../model/Users.php";

$user = new Users();
$id = $_POST['id'] ?? null;
$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$role_id = $_POST['role'];
$query = "";

$hashedPassword = md5($password);

if($id){
    $query = $user->updateUser($role_id, $fname, $lname, $email, $hashedPassword, $id);
} else {
    $query = $user->addUser($role_id, $fname, $lname, $email, $hashedPassword);
}

if ($conn->query($query)) {
    echo "Arigato Jamal";
} else {
    echo "Error: " . $conn->error;
}

?>