<?php
session_start();
$username = $_SESSION['username'] ?? 'Anonymous';
$key = (!isset($_SESSION['status']) || $_SESSION['status'] !== true) ? 'Login' : 'Profile';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Reviews</title>
  <link rel="stylesheet" href="../Asset/user-reviews.css">
</head>
<body>

<div class="container">
  <h2>Write a Review</h2>

  <form id="reviewForm">
    <div class="stars" id="starRating">
      <?php for ($i = 1; $i <= 5; $i++): ?>
        <span class="star" data-value="<?= $i ?>">&#9733;</span>
      <?php endfor; ?>
    </div>
    <input type="hidden" name="rating" id="ratingValue">
    <span class="error" id="ratingErr"></span>

    <textarea name="review" id="reviewText" placeholder="Your review..."></textarea>
    <span class="error" id="reviewErr"></span><br>

    <button type="submit">Submit Review</button>
  </form>

  <div id="reviewResult" style="margin-top: 20px;"></div>
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
    highlight(index);
  });
});

function highlight(index) {
  stars.forEach((star, i) => {
    star.style.color = i <= index ? 'gold' : 'lightgray';
  });
}

document.getElementById("reviewForm").onsubmit = function(e) {
  e.preventDefault();

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../Controller/reviewcontrol.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  const rating = document.getElementById("ratingValue").value;
  const review = document.getElementById("reviewText").value;

  let errors = false;
  document.getElementById("ratingErr").textContent = "";
  document.getElementById("reviewErr").textContent = "";

  if (!rating) {
    document.getElementById("ratingErr").textContent = "Please select a rating.";
    errors = true;
  }

  if (!review.trim()) {
    document.getElementById("reviewErr").textContent = "Please enter your review.";
    errors = true;
  }

  if (errors) return;

  xhr.onload = function() {
    if (xhr.status == 200) {
      document.getElementById("reviewResult").innerHTML = xhr.responseText;
      document.getElementById("reviewForm").reset();
      highlight(-1);
      selected = 0;
    }
  };

  xhr.send("rating=" + encodeURIComponent(rating) + "&review=" + encodeURIComponent(review));
};
</script>

</body>
</html>
