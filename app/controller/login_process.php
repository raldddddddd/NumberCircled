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
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role_id'] = $user['role_id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];

        $userModel = new Users();
        $userModel->logLoginActivity($user['id']);

        // Handle LONGBLOB (convert to base64 string)
        if (!empty($user['profile_image'])) {
            $_SESSION['profile_image'] = 'data:image/jpeg;base64,' . base64_encode($user['profile_image']);
        } else {
            $_SESSION['profile_image'] = '/NumberCircled/assets/default-profile.jpeg';

        }
        echo $user['role_id'];
    } else {
        echo "Invalid Password";
    }
}
