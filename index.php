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
    <title>Movie Landing Page</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/navbar.css">
    <link rel="stylesheet" href="assets/search.css">
    <script src="assets/index.js"></script>

</head>

<body>

<nav class="navbar">
    <div class="logo">
      <a href="index.php">MovieDB</a>
    </div>

    <div class="menu">
      <a href="#">Home</a>
      <a href="view/movie.php">Movies</a>
      <a href="view/tv_show.php">TV Shows</a>

      <?php if (strtolower($key) === 'profile') { ?>
        <div class="dropdown">
          <a href="#" class="dropbtn"><?= $key ?></a>
          <div class="dropdown-content">
            <a href="view/profile.php"><?= $username ?></a>
            <a href="view/Watchlist.php">My watchList</a>
            <a href="controller/logout.php">Logout</a>
          </div>
        </div>
      <?php } else { ?>
        <a href="view/login.php"><?= $key ?></a>
      <?php } ?>
    </div>
  </nav>





    <div class="banner">
    <h1>Welcome.</h1>
    <p>Millions of movies, TV shows, and people to discover. Explore now.</p>

    <div class="search-box" style="position: relative;">
        <input type="text" id="search-box" placeholder="Search for a movie, tv show" onkeyup="liveSearch()" autocomplete="off">
        <div id="live-suggestions" class="suggestions-dropdown"></div>
    </div>

    <p id="searcherror"></p>
    </div>


    <div class="trending-section" id="trending-section">
     <h2>Trending Movies</h2>
     <div class="movie-slider" id="movie-slider"></div>
    </div>

    <div class="trending-section" id="trending-section">
     <h2>Trending Tv Show</h2>
     <div class="movie-slider" id="tv-slider"></div>
    </div>


     <!-- Footer -->
     <footer style="background-color: #1a1a1a; color: white; padding: 40px 20px; margin-top: 50px;">
        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 40px; max-width: 1200px; margin: auto;">


            <div>
                <h4>The Basics</h4>
                <p>About MovieDB</p>
                <a href="view/contact.php">Contact Us</a><br><br>
                <a href="view/streamingLinks.php">Stream Link</a>
            </div>
            <div>
                <h4>Community</h4>
                <p>Discussions</p>
                <a href="view/Inaccuracy reports.php">Submit Report</a><br><br>
                <a href="view/trivia.html">Trivia</a>
            </div>


        </div>
    </footer> 



    <script>
                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', 'controller/allMovie.php', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send();
                xhttp.onreadystatechange = function () {
                    if (this.readyState === 4 && this.status === 200) {
                        let movies = JSON.parse(this.responseText);
                        const trending = movies.trending;
                        displayTrendingMovies(trending);
                        console.log(trending);
                    }
                };


                const xhttp1 = new XMLHttpRequest();
                xhttp1.open('POST', 'controller/allTvShow.php', true);
                xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp1.send();

                xhttp1.onreadystatechange = function () {
                    if (this.readyState === 4 && this.status === 200) {
                    const tvList = JSON.parse(this.responseText);
                    const trending = tvList.trending;
                    displayTrendingTVShows(trending);
                    }
                };







    </script>

</body>


</html>