<?php
session_start();
$username = $_SESSION['username'] ?? '';
$key = (!isset($_SESSION['status']) || $_SESSION['status'] !== true) ? 'Login' : 'Profile';

$rating = "";
$review = "";
$ratingErr = $reviewErr = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["rating"])) {
        $ratingErr = "Please select a rating.";
    } else {
        $rating = (int)$_POST["rating"];
        if ($rating < 1 || $rating > 5) {
            $ratingErr = "Invalid rating.";
        }
    }

    if (empty($_POST["review"])) {
        $reviewErr = "Please enter your review.";
    } else {
        $review = htmlspecialchars($_POST["review"]);
    }

    if (empty($ratingErr) && empty($reviewErr)) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Reviews</title>
  <link rel="stylesheet" href="../Asset/user reviews.css">
</head>
<body>

<div class="container">
  <h2>Write a Review</h2>

  <form method="POST" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="reviewForm">
    <div class="stars" id="starRating">
      <?php for ($i = 1; $i <= 5; $i++): ?>
        <span class="star" data-value="<?= $i ?>">&#9733;</span>
      <?php endfor; ?>
    </div>
    <input type="hidden" name="rating" id="ratingValue">
    <span class="error"><?= $ratingErr ?></span>

    <textarea name="review" id="reviewText" placeholder="Your review..."><?= $review ?></textarea>
    <span class="error"><?= $reviewErr ?></span><br>

    <button type="submit">Submit Review</button>
  </form>

  <?php if ($success): ?>
    <h2 style="margin-top:40px;">User Reviews</h2>
    <div class="review-box">
      <strong><?= htmlspecialchars($username ?: "Anonymous") ?></strong>
      <p>Rating: <?= $rating ?>/5</p>
      <p><?= nl2br($review) ?></p>
    </div>
  <?php endif; ?>
</div>

<script>
  const stars = document.querySelectorAll('.star');
  const ratingInput = document.getElementById('ratingValue');
  let selected = 0;

  stars.forEach((star, index) => {
    star.addEventListener('mouseover', () => highlight(index));
    star.addEventListener('mouseout', () => highlight(selected - 1));
    star.addEventListener('click', () => {
      selected = index + 1;
      ratingInput.value = selected;
    });
  });

  function highlight(index) {
    stars.forEach((star, i) => {
      star.style.color = i <= index ? 'gold' : 'lightgray';
    });
  }
</script>

</body>
</html>
