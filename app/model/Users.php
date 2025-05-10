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

    function updateUser($role_id, $fname, $lname, $email, $password, $id)
    {
        global $conn;
        return $query = "UPDATE users SET role_id='$role_id', first_name='$fname', last_name='$lname', email='$email', password='$password' WHERE id='$id'";
    }

    function addUser($role_id, $first_name, $last_name, $email, $password)
    {
        $hashedPassword = md5($password);
        global $conn;
        return $query = "INSERT INTO users (role_id, first_name, last_name, email, password) VALUES ('$role_id', '$first_name', '$last_name', '$email', '$hashedPassword')";
    }

    function registerUser($first_name, $last_name, $email, $password, $role_id)
    {
        global $conn;
        $hashedPassword = md5($password);
        $defaultImagePath = __DIR__ . '/../../assets/default-profile.jpeg'; 
        $imageData = file_get_contents($defaultImagePath);
        $imageEscaped = $conn->real_escape_string($imageData);

        global $conn;
        return $query = "INSERT INTO users (role_id, first_name, last_name, email, password, profile_image) VALUES ('$role_id', '$first_name', '$last_name', '$email', '$hashedPassword', '$imageEscaped')";
    }


    function deleteUser($id)
    {
        global $conn;
        return $query = "DELETE FROM users WHERE id='$id'";
    }
}
