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
    <script src="assets/index.js"></script>
</head>

<body onload="load">

        <nav style="background-color: #f5c518; padding: 15px 30px; display: flex; align-items: center; justify-content: space-between; font-family: Arial, sans-serif;">
        <div class="logo">
            <a href="index.php" style="font-weight: bold; font-size: 24px; text-decoration: none; color: black;">MovieDB</a>
        </div>

        <div class="menu" style="display: flex; align-items: center; gap: 20px;">
            <a href="#" style="text-decoration: none; color: black; font-weight: bold; padding: 8px 12px; border-radius: 4px;">Home</a>
            <a href="view/movie.php" style="text-decoration: none; color: black; font-weight: bold; padding: 8px 12px; border-radius: 4px;">Movies</a>
            <a href="view/tv_show.php" style="text-decoration: none; color: black; font-weight: bold; padding: 8px 12px; border-radius: 4px;">TV Shows</a>

            <?php if (strtolower($key) === 'profile'){ ?>
            <div class="dropdown" style="position: relative;">
            <a href="#" class="dropbtn" style="text-decoration: none; color: black; font-weight: bold; padding: 8px 12px; border-radius: 4px; cursor: pointer;"><?= $key ?></a>

            
                <div class="dropdown-content" style="display: none; position: absolute; top: 110%; right: 0; background-color: white; min-width: 160px; box-shadow: 0 4px 8px rgba(0,0,0,0.15); border-radius: 4px; z-index: 1000;">
                <a href="view/profile.php" style="display: block; padding: 10px 16px; text-decoration: none; color: black; font-weight: normal;"><?= htmlspecialchars($username) ?></a>
                <a href="view/Watchlist.html" style="display: block; padding: 10px 16px; text-decoration: none; color: black; font-weight: normal;">My watchList</a>
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
                <a href="view/login.php" style="text-decoration: none; color: black; font-weight: bold; padding: 8px 12px; border-radius: 4px;"><?= $key ?></a>
            <?php }; ?>
            </div>
        </div>
        </nav>





    <div class="banner">
        <h1>Welcome.</h1>
        <p>Millions of movies, TV shows, and people to discover. Explore now.</p>
        <div class="search-box">
            <input type="text" id="search-box" placeholder="Search for a movie, tv show, person...">
            <button onclick="searchBoxVaild()">Search</button> 
            
        </div>
        <p id="searcherror"></p>
    </div>

    <div class="trending-section">
        <h2>Trending Movies</h2>
        <div class="movie-slider">

            <a href="../view/movie_details.php" style="text-decoration: none; color: inherit;">
            <div class="movie-card">
                <div class="movie-image-wrapper">
                    <img src="https://image.tmdb.org/t/p/w500/8YFL5QQVPy3AgrEQxNYVSgiPEbe.jpg" alt="Movie 1">
                </div>
                <p>Movie Title 1</p>
            </div>
            <a href="../view/movie_details.php" style="text-decoration: none; color: inherit;">
            <div class="movie-card">
                <div class="movie-image-wrapper">
                    <img src="https://image.tmdb.org/t/p/w500/8YFL5QQVPy3AgrEQxNYVSgiPEbe.jpg" alt="Movie 2">
                </div>
                <p>Movie Title 2</p>
            </div>

            <a href="../view/movie_details.php" style="text-decoration: none; color: inherit;">
            <div class="movie-card">
                <div class="movie-image-wrapper">
                    <img src="https://image.tmdb.org/t/p/w500/q719jXXEzOoYaps6babgKnONONX.jpg" alt="Movie 3">
                </div>
                <p>Movie Title 3</p>
            </div>

            <a href="../view/movie_details.php" style="text-decoration: none; color: inherit;">
            <div class="movie-card">
                <div class="movie-image-wrapper">
                    <img src="https://image.tmdb.org/t/p/w500/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg" alt="Movie 4">
                </div>
                <p>Movie Title 4</p>
            </div>

            <a href="../view/movie_details.php" style="text-decoration: none; color: inherit;">
            <div class="movie-card">
                <div class="movie-image-wrapper">
                    <img src="https://image.tmdb.org/t/p/w500/8YFL5QQVPy3AgrEQxNYVSgiPEbe.jpg" alt="Movie 2">
                </div>
                <p>Movie Title 2</p>
            </div>

            <a href="../view/movie_details.php" style="text-decoration: none; color: inherit;">
            <div class="movie-card">
                <div class="movie-image-wrapper">
                    <img src="https://image.tmdb.org/t/p/w500/q719jXXEzOoYaps6babgKnONONX.jpg" alt="Movie 3">
                </div>
                <p>Movie Title 3</p>
            </div>

            <a href="../view/movie_details.php" style="text-decoration: none; color: inherit;">
            <div class="movie-card">
                <div class="movie-image-wrapper">
                    <img src="https://image.tmdb.org/t/p/w500/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg" alt="Movie 4">
                </div>
                <p>Movie Title 4</p>
            </div>
        </div>
    </div>


    <div class="trending-section">
        <h2>Trending TV Shows</h2>
        <div class="movie-slider">
            <!-- TV Shows -->
            <a href="./controller/movie_details.php" style="text-decoration: none; color: inherit;">
            <div class="movie-card">
                <div class="movie-image-wrapper">
                    <img src="https://image.tmdb.org/t/p/w500/6kbAMLteGO8yyewYau6bJ683sw7.jpg" alt="TV Show 1">
                </div>
                <p>TV Show Title 1</p>
            </div>
            <div class="movie-card">
                <div class="movie-image-wrapper">
                        <a href="../view/movie_details.php" style="text-decoration: none; color: inherit;"></a>
                    <img src="https://image.tmdb.org/t/p/w500/epGV5lIMN0E6ay2xbYl9bB5WhzF.jpg" alt="TV Show 2">
                </div>
                <p>TV Show Title 2</p>
            </div>

            <a href="../view/movie_details.php" style="text-decoration: none; color: inherit;"></a>
            <div class="movie-card">
                <div class="movie-image-wrapper">
                    <img src="https://image.tmdb.org/t/p/w500/uGy4DCmM33I7l86W7iCskNkvmLD.jpg" alt="TV Show 3">
                </div>
                <p>TV Show Title 3</p>
            </div>
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
                <a href="view/trivia.html">Discussions</a>
                <p>Leaderboard</p>
            </div>


        </div>
    </footer> 


</body>

</html>