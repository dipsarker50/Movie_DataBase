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

let movies = [];
      document.addEventListener("DOMContentLoaded", () => {
        fetch('../controller/allMovie.php')
          .then(response => response.json())
          .then(data => {
            loadMovies(data);
            movies = data;
            
          })
          .catch(error => {
            console.error('Error loading movies:', error);
          });
        loadMovies(movies); 
      });


</script>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Movies</title>
  <link rel="stylesheet" href="../assets/movie.css">
  <script src="../assets/index.js"></script>
</head>
<body>

        

<nav style="background-color: #f5c518; padding: 15px 30px; display: flex; align-items: center; justify-content: space-between; font-family: Arial, sans-serif;">
        <div class="logo">
            <a href="../index.php" style="font-weight: bold; font-size: 24px; text-decoration: none; color: black;">MovieDB</a>
        </div>

        <div class="menu" style="display: flex; align-items: center; gap: 20px;">
            <a href="../index.php" style="text-decoration: none; color: black; font-weight: bold; padding: 8px 12px; border-radius: 4px;">Home</a>
            <a href="#" style="text-decoration: none; color: black; font-weight: bold; padding: 8px 12px; border-radius: 4px;">Movies</a>
            <a href="tv_show.php" style="text-decoration: none; color: black; font-weight: bold; padding: 8px 12px; border-radius: 4px;">TV Shows</a>

            <?php if (strtolower($key) === 'profile'){ ?>
            <div class="dropdown" style="position: relative;">
            <a href="#" class="dropbtn" style="text-decoration: none; color: black; font-weight: bold; padding: 8px 12px; border-radius: 4px; cursor: pointer;"><?= $key ?></a>

            
                <div class="dropdown-content" style="display: none; position: absolute; top: 110%; right: 0; background-color: white; min-width: 160px; box-shadow: 0 4px 8px rgba(0,0,0,0.15); border-radius: 4px; z-index: 1000;">
                <a href="profile.php" style="display: block; padding: 10px 16px; text-decoration: none; color: black; font-weight: normal;"><?= htmlspecialchars($username) ?></a>
                <a href="#" style="display: block; padding: 10px 16px; text-decoration: none; color: black; font-weight: normal;">My watchList</a>
                <a href="controller/logout.php" style="display: block; padding: 10px 16px; text-decoration: none; color: black; font-weight: normal;">Logout</a>
                </div>

                <script>
                const dropdown = document.querySelector('.dropdown');
                const content = dropdown.querySelector('.dropdown-content');
                dropdown.addEventListener('mouseenter', () => {
                    content.style.display = 'block';
                });
                dropdown.addEventListener('mouseleave', () => {
                    content.style.display = 'none';
                });
                </script>
            <?php }else {; ?>
                <a href="login.php" style="text-decoration: none; color: black; font-weight: bold; padding: 8px 12px; border-radius: 4px;"><?= $key ?></a>
            <?php }; ?>
            </div>
        </div>
</nav>

<div class="search-bar">
  <input type="text" id="searchInput" placeholder="Search movie name...">
  <button onclick="applyFilters()">Search</button>
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

    <button onclick="applyFilters()">Apply Filter</button>
  </div>

  <div class="movies-grid" id="moviesGrid">
  </div>

</div>

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
