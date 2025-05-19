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
  <title>Inaccuracy Reports (Simple)</title>
  <link rel="stylesheet" href="../Asset/Inaccuracy reports.css">
</head>
<body>

<header>Inaccuracy Reports</header>

<nav>
  <button onclick="showSection('submission')">Submit Error</button>
  <button onclick="showSection('log')">My Corrections</button>
  <button onclick="showSection('moderator')">Moderator Dashboard</button>
</nav>

<div id="submission" class="section active">
  <h2>Submit an Inaccuracy</h2>
  <div class="form-group">
    <label>Title:</label>
    <input type="text" id="title">
  </div>
  <div class="form-group">
    <label>Type:</label>
    <select id="type">
      <option>Cast</option>
      <option>Date</option>
      <option>Fact</option>
    </select>
  </div>
  <div class="form-group">
    <label>Description:</label>
    <textarea id="description"></textarea>
  </div>
  <button onclick="submitReport()">Submit</button>
</div>

<div id="log" class="section">
  <h2>My Corrections</h2>
  <div id="reportDisplay"></div>
</div>

<div id="moderator" class="section">
  <h2>Moderator Dashboard</h2>
  <div id="moderatorDisplay"></div>
</div>

<script src="script.js"></script>
</body>
</html>
