<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../model/Users.php";

$first_name = $_POST['regis_first_name'];
$last_name = $_POST['regis_last_name'];
$email = $_POST['regis_email'];
$password = $_POST['regis_password'];
$role_id = $_POST['regis_role'];

$user = new Users();
$query = $user->registerUser($first_name, $last_name, $email, $password, $role_id);

if ($conn->query($query)) {
    echo "User registered successfully!";
} else {
    echo "Error: " . $conn->error;
}

?>

