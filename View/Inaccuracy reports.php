<?php
session_start();
$username = $_SESSION['username'] ?? '';
$key = (!isset($_SESSION['status']) || $_SESSION['status'] !== true) ? 'Login' : 'Profile';

$title = $type = $description = "";
$titleErr = $typeErr = $descriptionErr = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hasError = false;

    // Title
    if (empty($_POST["title"])) {
        $titleErr = "Title is required";
        $hasError = true;
    } else {
        $title = htmlspecialchars($_POST["title"]);
    }

    // Type
    if (empty($_POST["type"])) {
        $typeErr = "Type is required";
        $hasError = true;
    } else {
        $type = htmlspecialchars($_POST["type"]);
    }

    // Description
    if (empty($_POST["description"])) {
        $descriptionErr = "Description is required";
        $hasError = true;
    } else {
        $description = htmlspecialchars($_POST["description"]);
    }

    if (!$hasError) {
        $success = "Report submitted successfully!";
        // Here you can insert the data into the database or store it
        $title = $type = $description = ""; // clear form
    }
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

<?php if ($success): ?>
  <p class="success-message"><?= $success ?></p>
<?php endif; ?>

<div id="submission" class="section active">
  <h2>Submit an Inaccuracy</h2>
  <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">
      <label>Title:</label>
      <input type="text" name="title" value="<?= htmlspecialchars($title) ?>">
      <span class="error"><?= $titleErr ?></span>
    </div>

    <div class="form-group">
      <label>Type:</label>
      <select name="type">
        <option value="">--Select--</option>
        <option <?= $type == "Cast" ? "selected" : "" ?>>Cast</option>
        <option <?= $type == "Date" ? "selected" : "" ?>>Date</option>
        <option <?= $type == "Fact" ? "selected" : "" ?>>Fact</option>
      </select>
      <span class="error"><?= $typeErr ?></span>
    </div>

    <div class="form-group">
      <label>Description:</label>
      <textarea name="description"><?= htmlspecialchars($description) ?></textarea>
      <span class="error"><?= $descriptionErr ?></span>
    </div>

    <button type="submit">Submit</button>
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
  const sections = document.querySelectorAll('.section');
  sections.forEach(s => s.classList.remove('active'));
  document.getElementById(id).classList.add('active');
}
</script>

</body>
</html>
