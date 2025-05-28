<?php
session_start();
$errors = [];
$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $message = trim($_POST["message"] ?? '');
    $captcha = trim($_POST["captcha"] ?? '');

    if (empty($name)) $errors['name'] = "Name is required";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = "Valid email is required";
    if (empty($message)) $errors['message'] = "Message cannot be empty";
    if (empty($captcha) || strtolower($captcha) !== strtolower($_SESSION['captcha_code'])) {
        $errors['captcha'] = "CAPTCHA verification failed";
    }

    if (empty($errors)) {
        $to = $email;
        $subject = "We received your inquiry!";
        $body = "Hi $name,\n\nThank you for reaching out! Our team will contact you shortly.\n\nYour Message:\n$message\n\nRegards,\nSupport Team";
        $headers = "From: support@yourdomain.com";

        mail($to, $subject, $body, $headers);
        $successMessage = "Thank you for your message! A confirmation email has been sent.";
        unset($_SESSION['captcha_code']);
    }
}

function generateCaptcha() {
    $code = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 5);
    $_SESSION['captcha_code'] = $code;
    return $code;
}

$captchaCode = generateCaptcha();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Contact Us</title>
  <link rel="stylesheet" href="../Asset/contact.css">
</head>
<body>
<div class="container">
  <h2>Contact Us</h2>

  <?php if ($successMessage): ?>
    <p class="success"><?= $successMessage ?></p>
  <?php else: ?>
    <form method="POST" action="">
      <label>Name:</label>
      <input type="text" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
      <span class="error"><?= $errors['name'] ?? '' ?></span>

      <label>Email:</label>
      <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
      <span class="error"><?= $errors['email'] ?? '' ?></span>

      <label>Message:</label>
      <textarea name="message"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
      <span class="error"><?= $errors['message'] ?? '' ?></span>

      <label>CAPTCHA: <?= $captchaCode ?></label>
      <input type="text" name="captcha">
      <span class="error"><?= $errors['captcha'] ?? '' ?></span>

      <button type="submit">Send</button>
    </form>
  <?php endif; ?>
</div>
</body>
</html>
