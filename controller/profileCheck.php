<?php
session_start();
require_once('../model/userModel.php');

if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
    header('Location: ../view/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../view/profile.php');
    exit();
}


$name = trim($_POST['name']);
$phone = trim($_POST['phone']);
$image_path = $user['image_path'];


if (isset($_FILES['uploadPic']) && $_FILES['uploadPic']['error'] === UPLOAD_ERR_OK) {
        $src = $_FILES['uploadPic']['tmp_name'];
        $ext = explode('.', $_FILES['uploadPic']['name']);
        $des = '../assets/upload/' . $_SESSION['username'].'.'.$ext[1];
        
    if (move_uploaded_file($src, $des)) {
        $image_path = $des;
    }
}


updateUserProfile($_SESSION['username'], $name, $phone, $image_path); 

header('Location: ../view/profile.php');
exit();
