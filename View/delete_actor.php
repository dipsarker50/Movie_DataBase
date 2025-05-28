<?php
require_once('../model/actormodel.php');

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);

    if (!empty($name)) {
        if (deleteActorByName($name)) {
            $message = "Actor '$name' has been deleted successfully.";
        } else {
            $message = "Failed to delete actor. Please check the name and try again.";
        }
    } else {
        $message = "Please enter a valid actor name.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Actor</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
            background: #f8f9fa;
        }
        h2 {
            color: #333;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            margin-top: 15px;
            padding: 10px 20px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .message {
            margin-top: 20px;
            font-weight: bold;
        }
        .message.success {
            color: green;
        }
        .message.error {
            color: red;
        }
    </style>
</head>
<body>

    <h2>Delete Actor by Name</h2>

    <form method="POST">
        <label for="name">Actor Name *</label>
        <input type="text" name="name" required placeholder="Enter actor's full name">

        <input type="submit" value="Delete Actor">
    </form>

    <?php if ($message): ?>
        <div class="message <?= strpos($message, '') !== false ? 'success' : 'error' ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

</body>
</html>
