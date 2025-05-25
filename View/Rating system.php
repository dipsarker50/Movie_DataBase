<?php
session_start();
$username = $_SESSION['username'] ?? '';
$key = (!isset($_SESSION['status']) || $_SESSION['status'] !== true) ? 'Login' : 'Profile';

$rating = "";
$ratingErr = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["rating"])) {
        $ratingErr = "Please select a rating.";
    } else {
        $rating = (int)$_POST["rating"];
        if ($rating < 1 || $rating > 5) {
            $ratingErr = "Invalid rating.";
        } else {
            $success = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Star Rating</title>
  <link rel="stylesheet" href="../Asset/Rating system.css">
</head>
<body>

<h2>Rate This Title</h2>

<form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="ratingForm">
  <div class="star-container" id="starContainer">
    <!-- Stars -->
    <?php for ($i = 1; $i <= 5; $i++): ?>
      <span class="star" data-value="<?= $i ?>">&#9733;</span>
    <?php endfor; ?>
  </div>

  <!-- Hidden field for selected rating -->
  <input type="hidden" name="rating" id="ratingValue">
  <span class="error"><?= $ratingErr ?></span><br><br>

  <button type="submit">Submit Rating</button>
</form>

<?php if ($success): ?>
  <div class="score-board">
    <h3>Your Rating: <?= $rating ?>/5</h3>
    <p>Thanks for rating!</p>
  </div>
<?php endif; ?>

<script>
  const stars = document.querySelectorAll('.star');
  const ratingValue = document.getElementById('ratingValue');
  let currentRating = 0;

  stars.forEach((star, index) => {
    star.addEventListener('mouseover', () => {
      highlightStars(index);
    });

    star.addEventListener('mouseout', () => {
      highlightStars(currentRating - 1);
    });

    star.addEventListener('click', () => {
      currentRating = index + 1;
      ratingValue.value = currentRating;
    });
  });

  function highlightStars(index) {
    stars.forEach((star, i) => {
      star.style.color = i <= index ? 'gold' : 'lightgray';
    });
  }
</script>

</body>
</html>
