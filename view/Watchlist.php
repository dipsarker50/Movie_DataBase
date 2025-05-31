<?php
session_start();
require_once '../model/db.php';               
require_once '../model/UserWatchlistModel.php';  


$userEmail = $_SESSION['username'];
if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
  $key = 'Login';
}else{
  $key = 'Profile';
}

$listName = $movieName = "";
$listErr = $movieErr = "";
$success = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['createList'])) {
        if (empty($_POST["newListName"])) {
            $listErr = "List name is required.";
        } elseif (empty($userEmail)) {
            $listErr = "You must be logged in to create a list.";
        } else {
            $listName = htmlspecialchars($_POST["newListName"]);
            
            if (addToWatchlist($listName, 'Placeholder', 'movie', $userEmail)) {
                $success = "List '$listName' created successfully.";
            } else {
                $listErr = "Failed to create list.";
            }
        }
    }

    if (isset($_POST['addMovie'])) {
        if (empty($_POST["movieName"])) {
            $movieErr = "Movie title is required.";
        } elseif (empty($_POST["listSelect"])) {
            $movieErr = "Select a watchlist to add the movie.";
        } elseif (empty($userEmail)) {
            $movieErr = "You must be logged in to add a movie.";
        } else {
            $movieName = htmlspecialchars($_POST["movieName"]);
            $selectedList = htmlspecialchars($_POST["listSelect"]);
            if (addToWatchlist($selectedList, $movieName, 'movie', $userEmail)) {
                $success = "Movie '$movieName' added to list '$selectedList'.";
            } else {
                $movieErr = "Failed to add movie to watchlist.";
            }
        }
    }
}


$lists = !empty($userEmail) ? getUserLists($userEmail) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Watchlist Manager</title>
  <link rel="stylesheet" href="../assets/watchlist.css">
  <style>
    .error { color: red; }
  </style>
</head>
<body>

<div class="container">
  <h2>Watchlist Manager</h2>

  <?php if (empty($userEmail)): ?>
    <p style="color: red;">You must be logged in to manage your watchlists.</p>
  <?php endif; ?>

  <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="text" name="newListName" placeholder="New Watchlist Name" value="<?= htmlspecialchars($listName) ?>">
    <span class="error"><?= $listErr ?></span>
    <br>
    <button type="submit" name="createList" class="share-button">Create List</button>
  </form>

  <h2 style="margin-top:40px;">Add Movie to List</h2>
  <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <select name="listSelect">
      <option value="">Select Watchlist</option>
      <?php foreach ($lists as $list):
          if ($list === 'Placeholder') continue; 
      ?>
        <option value="<?= htmlspecialchars($list) ?>"><?= htmlspecialchars($list) ?></option>
      <?php endforeach; ?>
    </select>
    <input type="text" name="movieName" placeholder="Movie Title" value="<?= htmlspecialchars($movieName) ?>">
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
