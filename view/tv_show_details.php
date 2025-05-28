<?php
session_start();
require_once('../model/tvShowModel.php');
require_once('../model/userReviewModel.php');
$tvshow_session = $_SESSION['tvshow'];
$tvshow=getTVShowByTitle($tvshow_session['title']);
$review=getReviewsByTVShow($tvshow['title']);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TvShow Details - <?= $tvshow['title'] ?></title>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/index.js"></script>
</head>

<body>
<button type="button" onclick="goTvShow()" style="margin-top: 10px;">Back</button>

    <div class="movie-header">
        <div class="poster">
            <img src="<?= $tvshow['poster_url'] ?>" alt="<?= $tvshow['title'] ?>">
        </div>

        <div class="movie-info">
            <h1><?= $tvshow['title'] ?></h1>
            <div class="sub-info">
                18+ | <?= $tvshow['release_date'] ?>  | <?= $tvshow['genre'] ?>  | 1h 45m
            </div>

            <div class="user-score">
                <div class="circle-score"><?= getAverageRatingByMovieTitle($tvshow_session['title'])?>%</div>
                <span>User Score</span>
            </div>

            <div style="margin-top: 20px;">
                <button style="padding:10px 20px; border:none; background:#f5c518; font-weight:bold; border-radius:5px; cursor:pointer;">
                    ▶ Play Trailer
                </button>
            </div>
        </div>
    </div>

    <script>
        const releaseDate = "<?= $tvshow['start_date'] ?> 00:00:00";
        console.log(releaseDate);
        updateCountdown(releaseDate);
        setInterval(() => updateCountdown(releaseDate), 1000); 

    </script>

    <div class="release-calendar" style="margin-top: 50px; text-align: center">
        <h2>Release Countdown</h2>
        <h3 id="countdown" style="font-size: 24px; margin-top: 20px;">Loading...</h3>
    </div>



    <div class="overview-section">
        <h2>Overview</h2>
        <p>When a drug heist swerves lethally out of control, a jaded cop fights his way through a corrupt city's criminal underworld to save a politician's son.</p>
    </div>

    <div class="main-content">
        <div class="left-content">
            <div class="cast-section">
                <h2>Casts</h2>
                <div class="cast-cards">
                    <div class="cast-card">
                        <img src=""
                        alt="Tom Hardy">
                        <p><strong>Tom Hardy</strong></p>
                        <p>Walker</p>
                    </div>

                    <div class="cast-card">
                        <img src=""
                        alt="Jessie Mei Li">
                        <p><strong>Jessie Mei Li</strong></p>
                        <p>Ellie</p>
                    </div>

                    <div class="cast-card">
                        <img src=""
                        alt="Timothy Olyphant">
                        <p><strong>Timothy Olyphant</strong></p>
                        <p>Vincent</p>
                    </div>
                </div>
            </div>

            <div class="review-section">
                <h2>Reviews</h2>
                <?php foreach ($review as $review): ?>
                <div class="review-box">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div style="width: 50px; height: 50px; background: #f5c518; color: black; font-weight: bold; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                            <?= strtoupper(substr($review['user_email'], 0, 1)) ?>
                        </div>
                        <div>
                            <h4 style="margin: 0;">A review by <?= explode('@', $review['user_email'])[0] ?></h4>
                            <p style="margin: 0; font-size: 14px; color: #777;">⭐ <?= $review['rating'] * 10 ?>% — Written on <?= date('F j, Y', strtotime($review['created_at'])) ?></p>
                        </div>
                    </div>

                    <p style="margin-top: 15px; font-size: 16px;">
                        <?= nl2br(htmlspecialchars($review['review'])) ?>
                    </p>
                </div>
                <?php endforeach; ?>

                <div style="margin-top: 40px;">
                        <h3>Write Your Review</h3>
                        <form action="../controller/userReviewController.php" method="POST">
                            <textarea name="review" placeholder="Write your thoughts about the TV Show..." style="width: 100%; height: 120px; padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc; margin-top: 10px;" required></textarea>

                            <div style="margin-top: 10px;">
                                <label for="rating" style="font-size: 16px;">Your Rating:</label>
                                <select name="rating" id="rating" style="padding: 8px; margin-left: 10px; font-size: 16px;" required>
                                    <option value="10">100%</option>
                                    <option value="9">90%</option>
                                    <option value="8">80%</option>
                                    <option value="7">70%</option>
                                    <option value="6">60%</option>
                                    <option value="5">50%</option>
                                    <option value="4">40%</option>
                                    <option value="3">30%</option>
                                    <option value="2">20%</option>
                                    <option value="1">10%</option>
                                </select>
                            </div>

                            <input type="hidden" name="content_title" value="<?= htmlspecialchars($tvshow['title']) ?>">
                            <input type="hidden" name="content_type" value="tv_show">

                            <button type="submit" style="margin-top: 20px; margin-bottom: 20px; background-color: #f5c518; border: none; padding: 10px 20px; border-radius: 5px; font-weight: bold; cursor: pointer;">
                            Submit Review
                            </button>

                            
                            
                        </form>
                    </div>

                </div>



            <div class="right-sidebar">
                <div class="sidebar-item">
                    <h4>Status</h4>
                    <p>Released</p>
                </div>
                <div class="sidebar-item">
                    <h4>Original Language</h4>
                    <p>English</p>
                </div>
                <div class="sidebar-item">
                    <h4>Budget</h4>
                    <p>$90,000,000</p>
                </div>
                <div class="sidebar-item">
                    <h4>Revenue</h4>
                    <p>-</p>
                </div>
                <div class="sidebar-item">
                    <h4>Keywords</h4>
                    <p>Detective, Winter, Shootout</p>
                </div>
            </div>



            
            
            


            <footer style="background-color: #1a1a1a; color: white; padding: 40px 20px; margin-top: 50px;">
        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 40px; max-width: 1200px; margin: auto;">


            <div>
                <h4>The Basics</h4>
                <p>About MovieDB</p>
                <p>Contact Us</p>
                <a href="streamingLinks.php">Stream Link</a>
            </div>
            <div>
                <h4>Community</h4>
                <p>Discussions</p>
                <a href="Inaccuracy reports.php">Submit Report</a><br><br>
                <a href="trivia.html">Trivia</a>
            </div>


        </div>
    </footer> 

        </div>




</body>

</html>