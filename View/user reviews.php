<?php
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
    $key = 'Login';
} else {
    $key = 'Profile';
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
    <div class="stars" id="starRating">
        <span data-value="1">&#9733;</span>
        <span data-value="2">&#9733;</span>
        <span data-value="3">&#9733;</span>
        <span data-value="4">&#9733;</span>
        <span data-value="5">&#9733;</span>
    </div>
    <textarea id="reviewText" placeholder="Your review..."></textarea><br>
    <button onclick="submitReview()">Submit Review</button>

    <h2 style="margin-top:40px;">User Reviews</h2>
    <div id="reviewsSection"></div>
</div>

<script src="user reviews.js"></script>

</body>
</html>
