<?php
session_start();
require_once('../model/userReviewModel.php');

if (!isset($_SESSION['status'])) {
    echo "You must be logged in to submit a review.";
    exit();
}

$user_email = $_SESSION['username'];

$review = isset($_POST['review']) ? trim($_POST['review']) : '';
$rating = isset($_POST['rating']) ? (int) $_POST['rating'] : 0;
$content_title = isset($_POST['content_title']) ? trim($_POST['content_title']) : '';
$content_type =($_POST['content_type']);

if (empty($review) || $rating < 1 || $rating > 10 || empty($content_title)) {
    echo "Invalid input. Please provide all required data.{$content_title}";
    exit();
}

$success = addUserReview($user_email, $rating, $review, $content_title,$content_type);

if ($success) {
        if($content_type==='movie')
        header('Location:movieDetailController.php?title=' . urlencode($content_title));
        else
        header('Location:tvShowDetailsController.php?title=' . urlencode($content_title));
        exit();
} else {
    echo "Failed to submit review. Please try again.";
}
