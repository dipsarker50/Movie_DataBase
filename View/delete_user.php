<?php 
require_once('../model/db.php');
require_once('../model/userModel.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Delete User</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Delete User by Email</h2>
  <form method="POST">
    <input type="email" name="email" placeholder="Enter User Email to Delete" required>
    <button type="submit" name="delete_user">Delete User</button>
  </form>

  <?php
  if (isset($_POST['delete_user'])) {
      $email = trim($_POST['email']);
      $user = getUserByEmail($email);

      if ($user) {
          $id = $user['id'];

          if (deleteUser($id)) {
              echo "<p>User with email <strong>$email</strong> deleted successfully.</p>";
          } else {
              echo "<p>Error deleting user.</p>";
          }
      } else {
          echo "<p>No user found with email <strong>$email</strong>.</p>";
      }
  }
  ?>
</body>
</html>
