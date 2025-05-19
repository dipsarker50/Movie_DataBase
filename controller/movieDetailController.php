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

// echo json_encode([
//     'title' => $movie['title'],
//     'genre' => $movie['genre'],
//     'status' => $movie['status'],
//     'release_date' => $movie['release_date'],
//     'poster' => $movie['poster_url']
// ]);


session_start();
$_SESSION['movie'] =$movie;

header("Location: ../view/movie_details.php?title=" . urlencode($movie['title']));


exit();
?>
