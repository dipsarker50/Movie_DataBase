<?php
session_start();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $errors['general'] = "Username and password are required";
    } elseif (!isset($_SESSION['registered_user'])) {
        $errors['general'] = "No user registered. Please sign up first.";
    } else {
        $storedUser = $_SESSION['registered_user'];
        if ($username === $storedUser['username'] && $password === $storedUser['password']) {
            // Login success — store session values used in all features
            $_SESSION['username'] = $username;
            $_SESSION['status'] = true;

            header("Location: dashboard.php"); // Replace with your landing page
            exit;
        } else {
            $errors['general'] = "Invalid username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<form method="POST">
    Username: <input type="text" name="username" value="<?= htmlspecialchars($username ?? '') ?>"><br>
    Password: <input type="password" name="password"><br>
    <span style="color:red"><?= $errors['general'] ?? '' ?></span><br>
    <input type="submit" value="Login">
</form>
<a href="signup.php">Don't have an account? Sign up</a>
</body>
</html>
