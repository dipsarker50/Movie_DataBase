<?php
require_once('db.php');

function login($user) {
    $con = getConnection();
    $email = mysqli_real_escape_string($con, $user['email']);
    $password = $user['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        return password_verify($password, $row['password']); 
    }

    return false;
}

function getUserById($id) {
    $con = getConnection();
    $id = mysqli_real_escape_string($con, $id);

    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($con, $sql);

    return ($result && mysqli_num_rows($result) === 1) ? mysqli_fetch_assoc($result) : null;
}

function getAllUser() {
    $con = getConnection();
    $sql = "SELECT * FROM users";
    $result = mysqli_query($con, $sql);

    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    return $users;
}

function deleteUser($id) {
    $con = getConnection();
    $id = mysqli_real_escape_string($con, $id);

    $sql = "DELETE FROM users WHERE id='$id'";
    return mysqli_query($con, $sql);
}

function addUser($user) {
    $con = getConnection();
    $u = $user[0];

    $name = mysqli_real_escape_string($con, $u['name']);
    $email = mysqli_real_escape_string($con, $u['email']);
    $password    = password_hash($u['password'], PASSWORD_DEFAULT);
    $image_path = mysqli_real_escape_string($con, $u['image_path']);

    $sql = "INSERT INTO users (name, email, password, image_path)
            VALUES ('$name', '$email', '$password', '$image_path')";

    return mysqli_query($con, $sql);
}

function getImageById($id) {
    $con = getConnection();
    $id = mysqli_real_escape_string($con, $id);

    $sql = "SELECT image_path FROM users WHERE id='$id'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        return $row['image_path'];
    }
    return null;
}

function setImageById($id, $path) {
    $con = getConnection();
    $id = mysqli_real_escape_string($con, $id);
    $path = mysqli_real_escape_string($con, $path);

    $sql = "UPDATE users SET image_path='$path' WHERE id='$id'";
    return mysqli_query($con, $sql);
}

function emailExists($email) {
        $con = getConnection();
        $email = mysqli_real_escape_string($con, $email);
    
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $sql);
    
        return mysqli_num_rows($result) > 0;
}
    
?>
