<?php
session_start();
require_once('../model/userModel.php');

$_SESSION['status'] = false;
$_SESSION['loginError'] = '';
$_SESSION['username']='';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $user = [
        'email'    => $email,
        'password' => $password
    ];

    if (login($user)) {
        $_SESSION['status'] = true;
        $_SESSION['username'] = $email;
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['loginError'] = " Email and password do not match.";
        header('Location: ../view/login.php');
        exit();
    }

} else {
    header('Location: ../view/login.php');
    exit();
}
