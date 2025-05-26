<?php
session_start();
require_once('../model/db.php');

if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
    header('location: ../view/login.html');
    exit();
}

if (!isset($_GET['name'])) {
    echo "Actor name not specified.";
    exit();
}

$con = getConnection();
$actorName = mysqli_real_escape_string($con, $_GET['name']);

$sql = "SELECT * FROM actor_profiles WHERE name='$actorName'";
$result = mysqli_query($con, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "Actor not found.";
    exit();
}

$actor = mysqli_fetch_assoc($result);

// Parse JSON fields
$filmography = json_decode($actor['filmography'], true);
$costars = json_decode($actor['costars'], true);
$awards = json_decode($actor['awards'], true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($actor['name']) ?> - Profile</title>
  <link rel="stylesheet" href="../assets/actor_profile.css">
</head>
<body>

<h1>Actor Profile: <?= htmlspecialchars($actor['name']) ?></h1>

<?php if (!empty($actor['profile_picture'])): ?>
  <img src="../<?= $actor['profile_picture'] ?>" alt="<?= $actor['name'] ?>" style="width: 120px; height: auto; border-radius: 10px;">
<?php endif; ?>

<p><strong>Born:</strong> <?= htmlspecialchars($actor['birth_year']) ?></p>
<p><?= nl2br(htmlspecialchars($actor['biography'])) ?></p>

<div class="section">
  <h2>Filmography Timeline</h2>
  <ul>
    <?php foreach ($filmography as $item): ?>
      <li><?= $item['year'] ?> - <?= htmlspecialchars($item['movie']) ?></li>
    <?php endforeach; ?>
  </ul>
</div>

<div class="section">
  <h2>Frequent Co-stars</h2>
  <ul>
    <?php foreach ($costars as $star): ?>
      <li><?= htmlspecialchars($star) ?></li>
    <?php endforeach; ?>
  </ul>
</div>

<div class="section">
  <h2>Award History</h2>
  <ul>
    <?php foreach ($awards as $award): ?>
      <li><?= htmlspecialchars($award) ?></li>
    <?php endforeach; ?>
  </ul>
</div>

</body>
</html>
