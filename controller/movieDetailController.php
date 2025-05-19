<?php
header('Content-Type: application/json');
require_once('../model/movieModel.php');

if (!isset($_GET['title'])) {
    echo json_encode(['error' => 'Movie title not provided']);
    exit();
}

$title = urldecode($_GET['title']);
$movie = getMovieByTitle($title);

if (!$movie) {
    exit();
}

session_start();
$_SESSION['movie'] =$movie;

header("Location: ../view/movie_details.php?title=" . urlencode($movie['title']));


exit();
?>
