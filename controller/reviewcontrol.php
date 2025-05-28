<?php
session_start();
$username = $_SESSION['username'] ?? 'Anonymous';

$rating = $_POST['rating'] ?? '';
$review = $_POST['review'] ?? '';
$rating = (int)$rating;

if (!$rating || $rating < 1 || $rating > 5) {
    echo "Please select a valid rating.";
    exit;
}

if (empty($review)) {
    echo "Please enter your review.";
    exit;
}


echo "<div class='review-box'>";
echo "<strong>" . htmlspecialchars($username) . "</strong><br>";
echo "Rating: " . $rating . "/5<br>";
echo nl2br(htmlspecialchars($review));
echo "</div>";
?>