<?php
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
    $key = 'Login';
} else {
    $key = 'Profile';
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
  
  <input type="text" id="newListName" placeholder="New Watchlist Name">
  <button onclick="createWatchlist()" class="share-button">Create List</button>
  
  <div id="listsContainer"></div>

  <h2 style="margin-top:40px;">Add Movie to List</h2>
  <select id="listSelect">
  <option value="">Select Watchlist</option>
  </select>
  <input type="text" id="movieName" placeholder="Movie Title">
  <button onclick="addMovie()" class="share-button">Add Movie</button>
</div>

<script src="watchlist.js"></script>
</body>
</html>
