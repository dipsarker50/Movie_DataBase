<?php
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
    $key = 'Login';
}else{
    $key = 'Profile';
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Movie (PHP)</title>
  <link rel="stylesheet" href="../Asset/addMovie.css">
</head>
<body>

  <h1>Add New Movie</h1>

  <form method="POST" id="addMovieForm" action="addMovieController.php">

    <label>Title:</label>
    <input type="text" name="title" id="title" required />

    <label>Genre:</label>
    <select name="genre[]" id="genre" multiple required>
      <option>Action</option>
      <option>Drama</option>
      <option>Crime</option>
      <option>Adventure</option>
      <option>Animation</option>
    </select>

    <label>Status:</label>
    <select name="status" id="status" required>
      <option>Released</option>
      <option>Upcoming</option>
    </select>

    <label>Release Date:</label>
    <input type="date" name="date" id="date" required />

    <label>Poster URL:</label>
    <input type="url" name="poster" id="poster" required />

    <button type="submit">Add Movie</button>
  </form>

  <h2>Movie Preview</h2>
  <div id="movieList">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $title = htmlspecialchars($_POST["title"]);
      $genre = $_POST["genre"];
      $status = htmlspecialchars($_POST["status"]);
      $date = htmlspecialchars($_POST["date"]);
      $poster = htmlspecialchars($_POST["poster"]);

      echo '<div class="movie-card">';
      echo '<img src="' . $poster . '" alt="' . $title . '" />';
      echo '<h3>' . $title . '</h3>';
      echo '<p><strong>Genre:</strong> ' . implode(", ", $genre) . '</p>';
      echo '<p><strong>Status:</strong> ' . $status . '</p>';
      echo '<p><strong>Date:</strong> ' . $date . '</p>';
      echo '</div>';
    }
    ?>
  </div>


  <script src="addMovie.js"></script>
</body>
</html>
