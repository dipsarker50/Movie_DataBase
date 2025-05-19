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