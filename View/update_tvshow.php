<?php
session_start();
require_once("../model/tvShowModel.php");

$con = getConnection();
$titleParam = $_GET['title'] ?? null;

if (!$titleParam) {
    // No title provided — show list of TV shows to select from
    $result = mysqli_query($con, "SELECT title FROM tv_shows ORDER BY title");

    echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Select TV Show</title></head><body>";
    echo "<h1>Select a TV Show to Update</h1><ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        $title = urlencode($row['title']);
        echo "<li><a href='update_tvshow.php?title=$title'>" . htmlspecialchars($row['title']) . "</a></li>";
    }
    echo "</ul></body></html>";
    exit;
}

// If title is provided, run your existing update logic

$title_safe = mysqli_real_escape_string($con, $titleParam);

$result = mysqli_query($con, "SELECT * FROM tv_shows WHERE title='$title_safe' LIMIT 1");
if (!$result || mysqli_num_rows($result) == 0) {
    die("TV Show not found.");
}

$tvshow = mysqli_fetch_assoc($result);
$original_title = $tvshow['title'];

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim(htmlspecialchars($_POST['title'] ?? ''));
    $genre = $_POST['genre'] ?? [];
    if (!is_array($genre)) $genre = [];
    $status = htmlspecialchars($_POST['status'] ?? '');
    $start_date = htmlspecialchars($_POST['start_date'] ?? '');
    $end_date = htmlspecialchars($_POST['end_date'] ?? '');
    $seasons = (int)($_POST['seasons'] ?? 1);
    $existingPoster = $tvshow['poster_url'];

    if (empty($title)) $errors['title'] = "Title is required.";
    if (empty($genre)) $errors['genre'] = "Select at least one genre.";
    if (empty($status)) $errors['status'] = "Status is required.";
    if (empty($start_date)) $errors['start_date'] = "Start date is required.";
    if ($seasons < 1) $errors['seasons'] = "Seasons must be at least 1.";

    if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['poster']['tmp_name'];
        $fileName = $_FILES['poster']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = '../assets/image/';
            if (!is_dir($uploadFileDir)) mkdir($uploadFileDir, 0755, true);
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $poster_url = $dest_path;
                if ($existingPoster && file_exists($existingPoster)) {
                    @unlink($existingPoster);
                }
            } else {
                $errors['poster'] = 'Error moving the uploaded file.';
                $poster_url = $existingPoster;
            }
        } else {
            $errors['poster'] = 'Allowed file types: ' . implode(', ', $allowedfileExtensions);
            $poster_url = $existingPoster;
        }
    } else {
        $poster_url = $existingPoster;
    }

    if (!$errors) {
        $genreString = implode(",", $genre);
        $showData = [
            'title' => $title,
            'genre' => $genreString,
            'status' => $status,
            'start_date' => $start_date,
            'end_date' => $end_date ?: null,
            'seasons' => $seasons,
            'poster_url' => $poster_url,
        ];

        if (updateTVShowByTitle($original_title, $showData)) {
            $success = true;
            $tvshow = $showData;
        } else {
            $errors['general'] = "Failed to update the TV show.";
        }
    }
} else {
    $title = $tvshow['title'];
    $genre = explode(',', $tvshow['genre'] ?? '');
    $status = $tvshow['status'];
    $start_date = $tvshow['start_date'];
    $end_date = $tvshow['end_date'];
    $seasons = $tvshow['seasons'];
    $poster_url = $tvshow['poster_url'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Update TV Show</title>
  <link rel="stylesheet" href="../assets/update_tvshow.css" />
</head>
<body>
  <h1>Update TV Show</h1>

  <?php if ($success): ?>
    <p class="success">TV Show updated successfully!</p>
  <?php elseif (!empty($errors)): ?>
    <p class="error"><?= htmlspecialchars($errors['general'] ?? 'Please fix the errors below.') ?></p>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <label>Title:</label><br />
    <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" required />
    <br /><span class="error"><?= htmlspecialchars($errors['title'] ?? '') ?></span>

    <label>Genre:</label><br />
    <div class="genre-container">
      <?php
      $allGenres = ["Action", "Drama", "Crime", "Adventure", "Animation"];
      foreach ($allGenres as $g):
          $checked = in_array($g, $genre) ? "checked" : "";
      ?>
      <label class="genre-checkbox">
        <input type="checkbox" name="genre[]" value="<?= htmlspecialchars($g) ?>" <?= $checked ?> /> <?= htmlspecialchars($g) ?>
      </label>
      <?php endforeach; ?>
    </div>
    <span class="error"><?= htmlspecialchars($errors['genre'] ?? '') ?></span>

    <label>Status:</label><br />
    <select name="status" required>
      <option value="">Select Status</option>
      <option value="Ongoing" <?= ($status === "Ongoing") ? "selected" : "" ?>>Ongoing</option>
      <option value="Completed" <?= ($status === "Completed") ? "selected" : "" ?>>Completed</option>
    </select>
    <br /><span class="error"><?= htmlspecialchars($errors['status'] ?? '') ?></span>

    <label>Start Date:</label><br />
    <input type="date" name="start_date" value="<?= htmlspecialchars($start_date) ?>" required />
    <br /><span class="error"><?= htmlspecialchars($errors['start_date'] ?? '') ?></span>

    <label>End Date (optional):</label><br />
    <input type="date" name="end_date" value="<?= htmlspecialchars($end_date) ?>" />
    <br />

    <label>Seasons:</label><br />
    <input type="number" name="seasons" value="<?= htmlspecialchars($seasons) ?>" min="1" />
    <br /><span class="error"><?= htmlspecialchars($errors['seasons'] ?? '') ?></span>

    <label>Current Poster:</label><br />
    <?php if ($poster_url && file_exists($poster_url)): ?>
      <img src="<?= htmlspecialchars(str_replace('../', '', $poster_url)) ?>" alt="Poster" style="max-width:150px;" />
    <?php else: ?>
      <p>No poster uploaded.</p>
    <?php endif; ?>

    <label>Upload New Poster (optional):</label><br />
    <input type="file" name="poster" accept="image/*" />
    <br /><span class="error"><?= htmlspecialchars($errors['poster'] ?? '') ?></span>

    <br />
    <button type="submit">Update TV Show</button>
  </form>

  <script src="../assets/update_tvshow.js"></script>
</body>
</html>
