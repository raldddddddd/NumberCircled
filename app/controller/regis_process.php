<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../model/Users.php";

$email = $_POST['regis_email'];
$name = $_POST['regis_name'];
$password = $_POST['regis_password'];
$role_id = $_POST['regis_role'];

$user = new Users();
$query = $user->registerUser($email, $name, $password);

if ($conn->query($query)) {
    echo "User registered successfully!";
} else {
    echo "Error: " . $conn->error;
}
?>