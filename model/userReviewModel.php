<?php
require_once('db.php');

function addUserReview($user_email, $rating, $review, $content_title,$content_type) {
        $con = getConnection();
    
        $user_email = mysqli_real_escape_string($con, $user_email);
        $review = mysqli_real_escape_string($con, $review);
        $content_title = $content_title ? "'" . mysqli_real_escape_string($con, $content_title) . "'" : "NULL";
        $content_type = $content_type ? "'" . mysqli_real_escape_string($con, $content_type) . "'" : "NULL";

        $sql = "INSERT INTO user_review (user_email, rating, review, content_title,content_type)
                VALUES ('$user_email', $rating, '$review', $content_title,$content_type)";
        
        $result = mysqli_query($con, $sql);
        return $result;
}



function getReviewsByMovie($title) {
    $con = getConnection();

    $sql = "SELECT * FROM user_review WHERE content_title = '$title'";
    $result = mysqli_query($con, $sql);

    $reviews = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $reviews[] = $row;
    }
    return $reviews;
}

function getAverageRatingByMovieTitle($movie_title) {
        $con = getConnection();
        $movie_title = mysqli_real_escape_string($con, $movie_title);
    
        $sql = "SELECT AVG(rating) AS avg_rating FROM user_review WHERE content_title = '$movie_title'";
        $result = mysqli_query($con, $sql);
    
        if ($row = mysqli_fetch_assoc($result)) {
            return intval(round($row['avg_rating']));
        }
        return 0;
    }
    

function getReviewsByTVShow($title) {
    $con = getConnection();

    $sql = "SELECT * FROM user_review WHERE content_title = '$title'";
    $result = mysqli_query($con, $sql);

    $reviews = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $reviews[] = $row;
    }
    return $reviews;
}

?>
