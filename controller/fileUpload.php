<?php
session_start();

if (isset($_POST['save'])) {
    $src = $_FILES['uploadPic']['tmp_name'];
    $des = '../assets/' . $_FILES['uploadPic']['name'];

    if (move_uploaded_file($src, $des)) {
        $_SESSION['upload_status'] = "File Upload Success";
    } else {
        $_SESSION['upload_status'] = "File Upload Failed";
    }
} else {
    $_SESSION['upload_status'] = "Invalid Submission";
}

header('Location: ../view/profile.php');
exit;
?>