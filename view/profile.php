<?php
session_start();
//if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
    //header('location: ../view/login.html');
    //exit();
//}

// $status = '';
// if (isset($_SESSION['upload_status'])) {
//     $status = $_SESSION['upload_status'];
//     unset($_SESSION['upload_status']); 
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Profile</title>
  <link rel="stylesheet" href="../assets/style.css" />
  <script src="../assets/index.js"></script>
</head>
<body class="profile_body">
  <div class="profile_container">
    <h2>User Profile</h2>

    <form action="../controller/fileUpload.php" method="post" enctype="multipart/form-data">
      <p id="error"><?= htmlspecialchars($status) ?></p>


      <div class="profile_picture_section">
        <img id="profilePic" src="default-profile.png" alt="Profile Picture" />
        <input type="file" id="uploadPic" name="uploadPic" accept="image/*" onchange="previewProfilePic()" />
      </div>
   
    <div class="profile_fields">
      <label>Name:</label>
      <input type="text" id="name" value="John Doe" disabled />

      <label>Email:</label>
      <input type="email" id="email" value="john@example.com" disabled />

      <label>Phone:</label>
      <input type="text" id="phone" value="0123456789" disabled />
    </div>

    <button id="toggleBtn" onclick="toggleEdit()" name="">Edit</button>
  </div>
  </form>
</body>
</html>
