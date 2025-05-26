<?php
session_start();
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username)) {
        $errors['username'] = "Username is required";
    }
    if (empty($password)) {
        $errors['password'] = "Password is required";
    }

    if (empty($errors)) {
        // Save to session (in a real app this would go to a DB)
        $_SESSION['registered_user'] = [
            'username' => $username,
            'password' => $password, // Plaintext only for demo (insecure)
        ];
        $success = "Account created. You can now log in.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
</head>
<body>
<h2>Signup</h2>
<form method="POST">
    Username: <input type="text" name="username" value="<?= htmlspecialchars($username ?? '') ?>"><br>
    <span style="color:red"><?= $errors['username'] ?? '' ?></span><br>

    Password: <input type="password" name="password"><br>
    <span style="color:red"><?= $errors['password'] ?? '' ?></span><br>

    <input type="submit" value="Signup">
</form>
<p style="color:green"><?= $success ?></p>
<a href="login.php">Go to Login</a>
</body>
</html>
