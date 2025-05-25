<?php
session_start();
$username = $_SESSION['username'] ?? '';
$key = (!isset($_SESSION['status']) || $_SESSION['status'] !== true) ? 'Login' : 'Profile';


$title = $status = $date = $poster = "";
$genre = [];
$errors = [];

if (isset($_SESSION['form_errors'])) {
    $errors = $_SESSION['form_errors'];
    unset($_SESSION['form_errors']);
}

if (isset($_SESSION['old_input'])) {
    $title = htmlspecialchars($_SESSION['old_input']['title'] ?? '');
    $status = htmlspecialchars($_SESSION['old_input']['status'] ?? '');
    $date = htmlspecialchars($_SESSION['old_input']['date'] ?? '');
    $poster = htmlspecialchars($_SESSION['old_input']['poster'] ?? '');
    $genre = $_SESSION['old_input']['genre'] ?? [];
    unset($_SESSION['old_input']);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Movie</title>
  <link rel="stylesheet" href="../Asset/addMovie.css">
  <style>
    .error { color: red; font-size: 14px; }
  </style>
</head>
<body>

<h1>Add New Movie</h1>

<?php if (isset($_GET['success'])): ?>
  <p style="color: green;">Movie added successfully!</p>
<?php elseif (isset($_GET['error'])): ?>
  <p style="color: red;">Failed to add movie. Please try again.</p>
<?php endif; ?>

<form method="POST" id="addMovieForm" action="addMovieController.php">

  <label>Title:</label>
  <input type="text" name="title" id="title" value="<?= $title ?>" required />
  <span class="error"><?= $errors['title'] ?? '' ?></span>

  <label>Genre:</label>
  <select name="genre[]" id="genre" multiple required>
    <?php
    $allGenres = ["Action", "Drama", "Crime", "Adventure", "Animation"];
    foreach ($allGenres as $g) {
      $selected = in_array($g, $genre) ? "selected" : "";
      echo "<option $selected>$g</option>";
    }
    ?>
  </select>
  <span class="error"><?= $errors['genre'] ?? '' ?></span>

  <label>Status:</label>
  <select name="status" id="status" required>
    <option value="Released" <?= ($status == "Released") ? "selected" : "" ?>>Released</option>
    <option value="Upcoming" <?= ($status == "Upcoming") ? "selected" : "" ?>>Upcoming</option>
  </select>
  <span class="error"><?= $errors['status'] ?? '' ?></span>

  <label>Release Date:</label>
  <input type="date" name="date" id="date" value="<?= $date ?>" required />
  <span class="error"><?= $errors['date'] ?? '' ?></span>

  <label>Poster URL:</label>
  <input type="url" name="poster" id="poster" value="<?= $poster ?>" required />
  <span class="error"><?= $errors['poster'] ?? '' ?></span>

  <button type="submit">Add Movie</button>
</form>

<h2>Movie Preview</h2>
<div id="movieList">
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && !$errors) {
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
