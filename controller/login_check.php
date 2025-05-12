<?php
session_start();
$_SESSION['status']=false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($username == "" || $password == "") {
        header('location:../view/login.html');
    } else if ($username == $password) {
        $_SESSION['status'] = true;
        header('location:../view/landing_page.php');
        exit();
    } else {
        echo "invalid user!";
    }
} else {
    header('location:../view/login.html');
    exit();
}
?>
