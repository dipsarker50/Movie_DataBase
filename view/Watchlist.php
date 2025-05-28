<?php
session_start();
$username = $_SESSION['username'] ?? '';
$key = (!isset($_SESSION['status']) || $_SESSION['status'] !== true) ? 'Login' : 'Profile';

$listName = $movieName = "";
$listErr = $movieErr = "";
$watchlists = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['createList'])) {
        if (empty($_POST["newListName"])) {
            $listErr = "List name is required.";
        } else {
            $listName = htmlspecialchars($_POST["newListName"]);
            $watchlists[] = $listName;
            $success = "List '$listName' created successfully.";
        }
    }

    if (isset($_POST['addMovie'])) {
        if (empty($_POST["movieName"])) {
            $movieErr = "Movie title is required.";
        } elseif (empty($_POST["listSelect"])) {
            $movieErr = "Select a watchlist to add the movie.";
        } else {
            $movieName = htmlspecialchars($_POST["movieName"]);
            $selectedList = htmlspecialchars($_POST["listSelect"]);
            $success = "Movie '$movieName' added to list '$selectedList'.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Watchlist Manager</title>
  <link rel="stylesheet" href="../Asset/watchlist.css">
</head>
<body>

<div class="container">
  <h2>Watchlist Manager</h2>

  <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="text" name="newListName" placeholder="New Watchlist Name" value="<?= $listName ?>">
    <span class="error"><?= $listErr ?></span>
    <br>
    <button type="submit" name="createList" class="share-button">Create List</button>
  </form>

  <h2 style="margin-top:40px;">Add Movie to List</h2>
  <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <select name="listSelect">
      <option value="">Select Watchlist</option>
      <?php
      if (!empty($listName)) {
          echo "<option selected>$listName</option>";
      }
      ?>
    </select>
    <input type="text" name="movieName" placeholder="Movie Title" value="<?= $movieName ?>">
    <span class="error"><?= $movieErr ?></span>
    <br>
    <button type="submit" name="addMovie" class="share-button">Add Movie</button>
  </form>

  <?php if ($success): ?>
    <p style="color: green; margin-top: 20px;"><?= $success ?></p>
  <?php endif; ?>
</div>

</body>
</html>