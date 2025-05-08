<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../model/Users.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = $_POST['login_email'];
    $input_pword = $_POST['login_password'];
    $hashed_input_pword = md5($input_pword);

    $user = new Users();
    $query = $user->getUser($input_username);
    $result = $conn->query($query);
    if ($result->num_rows == 0) {
        echo "No Account";
        exit;
    }

    $user = $result->fetch_assoc();
    if ($hashed_input_pword === $user['password']) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['role_id'] = $user['role_id'];
        echo $user['role_id'];
    } else {
        echo "Invalid Password";
    }
}