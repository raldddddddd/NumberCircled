<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../model/Users.php";

$first_name = $_POST['regis_first_name'];
$last_name = $_POST['regis_last_name'];
$email = $_POST['regis_email'];
$password = $_POST['regis_password'];
$conf_password = $_POST['regis_conf_password'];

if ($password !== $conf_password) {
    echo "Passwords do not match.";
    exit;
} else if (strlen($password) < 8) {
    echo "Password is too short.";
    exit;
}

$user = new Users();

if ($user->emailExists($email)) {
    echo "Email already registered!";
    exit;
}

$query = $user->registerUser($first_name, $last_name, $email, $password);

if ($conn->query($query)) {
    echo "User registered successfully!";
} else {
    echo "Error: " . $conn->error;
}

?>

