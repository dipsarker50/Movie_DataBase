<?php
session_start();
$username = $_SESSION['username'] ?? '';
$key = (!isset($_SESSION['status']) || $_SESSION['status'] !== true) ? 'Login' : 'Profile';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Inaccuracy Reports</title>
  <link rel="stylesheet" href="../Asset/Inaccuracy reports.css">
</head>
<body>

<header>Inaccuracy Reports</header>

<nav>
  <button onclick="showSection('submission')">Submit Error</button>
  <button onclick="showSection('log')">My Corrections</button>
  <button onclick="showSection('moderator')">Moderator Dashboard</button>
</nav>

<p id="successMessage" class="success-message" style="display:none;"></p>

<div id="submission" class="section active">
  <h2>Submit an Inaccuracy</h2>
  <form id="inaccuracyForm">
    <div class="form-group">
      <label>Title:</label>
      <input type="text" name="title" id="title">
      <span class="error" id="titleErr"></span>
    </div>

    <div class="form-group">
      <label>Type:</label>
      <select name="type" id="type">
        <option value="">--Select--</option>
        <option value="Cast">Cast</option>
        <option value="Date">Date</option>
        <option value="Fact">Fact</option>
      </select>
      <span class="error" id="typeErr"></span>
    </div>

    <div class="form-group">
      <label>Description:</label>
      <textarea name="description" id="description"></textarea>
      <span class="error" id="descriptionErr"></span>
    </div>

    <button type="button" onclick="submitReport()">Submit</button>
  </form>
</div>

<div id="log" class="section">
  <h2>My Corrections</h2>
  <div id="reportDisplay"></div>
</div>

<div id="moderator" class="section">
  <h2>Moderator Dashboard</h2>
  <div id="moderatorDisplay"></div>
</div>

<script>
function showSection(id) {
  document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
  document.getElementById(id).classList.add('active');
}

function submitReport() {
  const title = document.getElementById("title").value.trim();
  const type = document.getElementById("type").value;
  const description = document.getElementById("description").value.trim();

  
  document.getElementById("titleErr").textContent = "";
  document.getElementById("typeErr").textContent = "";
  document.getElementById("descriptionErr").textContent = "";
  document.getElementById("successMessage").style.display = "none";

  let errors = false;
  if (!title) {
    document.getElementById("titleErr").textContent = "Title is required";
    errors = true;
  }
  if (!type) {
    document.getElementById("typeErr").textContent = "Type is required";
    errors = true;
  }
  if (!description) {
    document.getElementById("descriptionErr").textContent = "Description is required";
    errors = true;
  }

  if (!errors) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../Controller/inaccuracycontrol.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    const data = `title=${encodeURIComponent(title)}&type=${encodeURIComponent(type)}&description=${encodeURIComponent(description)}`;

    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        try {
          const response = JSON.parse(xhr.responseText);
          if (response.success) {
            document.getElementById("successMessage").style.display = "block";
            document.getElementById("successMessage").textContent = response.message;
            document.getElementById("inaccuracyForm").reset();
          } else {
            document.getElementById("successMessage").style.display = "block";
            document.getElementById("successMessage").textContent = response.message || "An error occurred.";
          }
        } catch (e) {
          document.getElementById("successMessage").style.display = "block";
          document.getElementById("successMessage").textContent = "Invalid JSON response from server.";
        }
      }
    };

    xhr.send(data);
  }
}
</script>

</body>
</html>
