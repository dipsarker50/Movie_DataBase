<?php
session_start();
require_once('../model/db.php');
require_once('../model/userModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];

    if (emailExists($email)) {
        $_SESSION['signup_error'] = "Email already exists.";
        header("Location: ../view/signup.php");
        exit();
    }

    $user = [
        0 => [
            'name'        => $_POST['name'],
            'email'       => $email,
            'password'    => $_POST['password'],
            'image_path'  => ''
        ]
    ];

    if (addUser($user)) {
        header("Location: ../view/login.html");
        exit();
    }
}
?>
