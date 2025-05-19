<?php
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
    $key = 'Login';
}else{
    $key = 'Profile';
}



?>

<script>
let tv=[];
      document.addEventListener("DOMContentLoaded", () => {
        fetch('../controller/allTvShow.php')
        .then(response => response.json())
        .then(data => {
          console.log("TV Shows:", data);
          loadTvShows(data); 
          tv = data;
        })
        .catch(error => {
          console.error("Error fetching TV shows:", error);
        });

        loadTvShows(tv);
     });


</script>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>TV show</title>
  <link rel="stylesheet" href="../assets/movie.css">
  <link rel="stylesheet" href="../assets/navbar.css">
  <script src="../assets/index.js"></script>
</head>
<body >

        

<nav class="navbar">
  <div class="logo">
    <a href="../index.php">MovieDB</a>
  </div>

  <div class="menu">
    <a href="../index.php">Home</a>
    <a href="movie.php">Movies</a>
    <a href="#">TV Shows</a>

    <?php if (strtolower($key) === 'profile') { ?>
      <div class="dropdown">
        <a href="#" class="dropbtn"><?= $key ?></a>
        <div class="dropdown-content">
          <a href="profile.php"><?= $username ?></a>
          <a href="#">My watchList</a>
          <a href="controller/logout.php">Logout</a>
        </div>
      </div>
    <?php } else { ?>
      <a href="login.php"><?= $key ?></a>
    <?php } ?>
  </div>
</nav>

<div class="search-bar">
  <input type="text" id="searchInput" placeholder="Search tvshow name...">
  <button onclick="applyFiltersTv()">Search</button>
</div>

<div class="main-content">
  
  <div class="filters">
    <h3>Genres</h3>
    <label><input type="checkbox" value="Action"> Action</label>
    <label><input type="checkbox" value="Adventure"> Adventure</label>
    <label><input type="checkbox" value="Animation"> Animation</label>
    <label><input type="checkbox" value="Comedy"> Comedy</label>
    <label><input type="checkbox" value="Drama"> Drama</label>
    <label><input type="checkbox" value="Sci-Fi"> Sci-Fi</label>

    <h3>Status</h3>
    <label><input type="radio" name="status" value="All" checked> All</label>
    <label><input type="radio" name="status" value="Released"> Released</label>
    <label><input type="radio" name="status" value="Upcoming"> Upcoming</label>

    <h3>Release Date</h3>
    <input type="date" id="fromDate">
    <input type="date" id="toDate">

    <button onclick="applyFiltersTv()">Apply Filter</button>
  </div>

  <div class="movies-grid" id="moviesGrid">
  </div>

</div>
<!-- Footer -->
<footer style="background-color: #1a1a1a; color: white; padding: 40px 20px; margin-top: 50px;">
        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 40px; max-width: 1200px; margin: auto;">

            <div>
                <h3 style="color: #f5c518;">MovieDB</h3>
                <p style="margin-top: 10px;">
                    <button style="background: white; color: #1a1a1a; font-weight: bold; padding: 10px 20px; border-radius: 5px; border: none; cursor: pointer;">
                        JOIN THE COMMUNITY
                    </button>
                </p>
            </div>

            <div>
                <h4>The Basics</h4>
                <p>About MovieDB</p>
                <p>Contact Us</p>
                <p>Support Forums</p>
            </div>

            <div>
                <h4>Get Involved</h4>
                <p>Add New Movie</p>
                <p>Add New TV Show</p>
            </div>

            <div>
                <h4>Community</h4>
                <p>Discussions</p>
                <p>Leaderboard</p>
            </div>


        </div>
    </footer> 

</body>
</html>
