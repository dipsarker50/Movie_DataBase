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
<title>Rating System</title>
<link rel="stylesheet" href="../Asset/Rating system.css">
</head>
<body>

<h2>Rate This Title</h2>

<div class="stars" id="starContainer">
  <span data-star="1">&#9733;</span>
  <span data-star="2">&#9733;</span>
  <span data-star="3">&#9733;</span>
  <span data-star="4">&#9733;</span>
  <span data-star="5">&#9733;</span>
</div>

<button onclick="submitRating()" style="margin-top:20px;padding:10px 20px;">Submit Rating</button>

<div class="score-board" id="scoreBoard" style="display:none;">
  <h3>Audience Score: <span id="audienceScore">0</span>/5</h3>
</div>

<div class="demographics" id="demographics" style="display:none;">
  <h3>Demographic Breakdown</h3>
  <p>Male: <span id="malePercent">0</span>%</p>
  <p>Female: <span id="femalePercent">0</span>%</p>
</div>

<div class="compare-scores" id="compareScores" style="display:none;">
  <h3>Critic vs Audience Score</h3>
  <p>Critic Score: <span id="criticScore">0</span>/5</p>
  <p>Audience Score: <span id="audienceCompareScore">0</span>/5</p>
</div>

<script src="script.js"></script>
</body>
</html>
