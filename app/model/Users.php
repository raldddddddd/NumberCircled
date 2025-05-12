<?php
require_once __DIR__ . '/../../config/database.php';

class Users
{
    function getUser($input_username)
    {
        global $conn;
        return $query = "SELECT * FROM users WHERE email='$input_username'";
    }

    function getRole($name)
    {
        global $conn;
        $query = $conn->query("SELECT * FROM users WHERE name='$name'");
        return $query['name'];
    }

    // function addUser($role_id, $first_name, $last_name, $email, $password)
    // {
    //     $hashedPassword = md5($password);
    //     global $conn;
    //     return $query = "INSERT INTO users (role_id, first_name, last_name, email, password) VALUES ('$role_id', '$first_name', '$last_name', '$email', '$hashedPassword')";
    // }

    function registerUser($first_name, $last_name, $email, $password)
    {
        global $conn;
        $hashedPassword = md5($password);
        $defaultImagePath = __DIR__ . '/../../assets/default-profile.jpeg';
        $imageData = file_get_contents($defaultImagePath);
        $imageEscaped = $conn->real_escape_string($imageData);
        return $query = "INSERT INTO users (role_id, first_name, last_name, email, password, profile_image) VALUES ('3', '$first_name', '$last_name', '$email', '$hashedPassword', '$imageEscaped')";
    }

    function emailExists($email)
    {
        global $conn;
        $query = "SELECT id FROM users WHERE email = '$email'";
        $result = $conn->query($query);
        return $result && $result->num_rows > 0;
    }

    // function deleteUser($id)
    // {
    //     global $conn;
    //     return $query = "DELETE FROM users WHERE id='$id'";
    // }

    public function logLoginActivity($user_id)
    {
        global $conn;

        $stmt = $conn->prepare("
        INSERT INTO activity_logs (user_id, login_time) 
        VALUES (?, NOW()) 
        ON DUPLICATE KEY UPDATE login_time = NOW()
    ");
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }
}
