<?php
require_once('../model/actormodel.php');

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uploadDir = "../assets/actors/";
    $uploadOk = true;
    $uploadedPath = "";

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === 0) {
        $fileName = basename($_FILES["profile_picture"]["name"]);
        $targetFile = $uploadDir . time() . "_" . $fileName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        if ($check === false) {
            $message = "❌ File is not an image.";
            $uploadOk = false;
        }

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedTypes)) {
            $message = "❌ Only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = false;
        }

        if ($uploadOk && move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
            $uploadedPath = str_replace("../", "", $targetFile);
        } else if ($uploadOk) {
            $message = "❌ Error uploading the image.";
            $uploadOk = false;
        }
    }

    if ($uploadOk) {
        $actor = [
            'name' => $_POST['name'],
            'birth_year' => $_POST['birth_year'] !== '' ? $_POST['birth_year'] : null,
            'biography' => $_POST['biography'],
            'profile_picture' => $uploadedPath,
            'filmography' => $_POST['filmography'],
            'costars' => $_POST['costars'],
            'awards' => $_POST['awards']
        ];

        if (addActor($actor)) {
            $message = "Actor added successfully!";
        } else {
            $message = "❌ Failed to add actor.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Actor</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
            background: #f0f2f5;
        }
        h2 {
            color: #333;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            margin-top: 15px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .message {
            margin-top: 20px;
            font-weight: bold;
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

    <h2>Add New Actor</h2>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Name *</label>
        <input type="text" name="name" required>

        <label for="birth_year">Birth Year</label>
        <input type="number" name="birth_year">

        <label for="biography">Biography</label>
        <textarea name="biography" rows="5"></textarea>

        <label for="profile_picture">Profile Picture (Image Upload)</label>
        <input type="file" name="profile_picture" accept="image/*" required>

        <label for="filmography">Filmography (comma-separated movie names)</label>
        <textarea name="filmography" rows="4"></textarea>

        <label for="costars">Co-stars (comma-separated names)</label>
        <textarea name="costars" rows="3"></textarea>

        <label for="awards">Awards (optional)</label>
        <textarea name="awards" rows="3"></textarea>

        <input type="submit" value="Add Actor">
    </form>

    <?php if ($message): ?>
        <div class="message <?= strpos($message, '❌') !== false ? 'error' : '' ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

</body>
</html>