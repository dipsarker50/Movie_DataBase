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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Rating System</title>
  <style>
    body {
      background-color: #121212;
      color: #fff;
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    h2 {
      color: #f5c518;
    }
    .stars {
      display: flex;
      cursor: pointer;
      font-size: 40px;
      color: #555;
      margin-top: 10px;
    }
    .stars span {
      margin-right: 8px;
    }
    .stars .selected {
      color: #f5c518;
    }
    .score-board, .demographics, .compare-scores {
      margin-top: 30px;
      background: #1f1f1f;
      padding: 15px;
      border-radius: 10px;
    }
  </style>
</head>
<body>

<h2>Rate This Title</h2>

<div class="stars" id="starContainer">
  <span data-star="1">&#9733;</span>
  <span data-star="2">&#9733;</span>
  <span data-star="3">&#9733;</span>
  <span data-star="4">&#9733;</span>
  <span data-star="5">&#9733;</span>
</div>

<button onclick="submitRating()" style="margin-top:20px;padding:10px 20px;">Submit Rating</button>

<div class="score-board" id="scoreBoard" style="display:none;">
  <h3>Audience Score: <span id="audienceScore">0</span>/5</h3>
</div>

<div class="demographics" id="demographics" style="display:none;">
  <h3>Demographic Breakdown</h3>
  <p>Male: <span id="malePercent">0</span>%</p>
  <p>Female: <span id="femalePercent">0</span>%</p>
</div>

<div class="compare-scores" id="compareScores" style="display:none;">
  <h3>Critic vs Audience Score</h3>
  <p>Critic Score: <span id="criticScore">0</span>/5</p>
  <p>Audience Score: <span id="audienceCompareScore">0</span>/5</p>
</div>

<script>
  var selectedStars = 0;

  var stars = document.querySelectorAll('#starContainer span');
  stars.forEach(function(star) {
    star.addEventListener('click', function() {
      selectedStars = parseInt(this.getAttribute('data-star'));
      highlightStars(selectedStars);
    });
  });

  function highlightStars(count) {
    stars.forEach(function(star, index) {
      if (index < count) {
        star.classList.add('selected');
      } else {
        star.classList.remove('selected');
      }
    });
  }

  function submitRating() {
    if (selectedStars == 0) {
      alert('Please select a star rating.');
      return;
    }

    document.getElementById('scoreBoard').style.display = 'block';
    document.getElementById('audienceScore').innerText = selectedStars;

    
    var male = Math.floor(Math.random() * 50) + 50; 
    var female = 100 - male;

    document.getElementById('demographics').style.display = 'block';
    document.getElementById('malePercent').innerText = male;
    document.getElementById('femalePercent').innerText = female;

    
    var criticScore = Math.floor(Math.random() * 5) + 1; 
    document.getElementById('compareScores').style.display = 'block';
    document.getElementById('criticScore').innerText = criticScore;
    document.getElementById('audienceCompareScore').innerText = selectedStars;
  }
</script>

</body>
</html>
