<?php
header('Content-Type: application/json');
require_once('../model/movieModel.php');
require_once('../model/db.php');
if (!isset($_GET['title'])) {
    echo json_encode(['error' => 'Movie title not provided']);
    exit();
}

$title = urldecode($_GET['title']);
$movie = getMovieByTitle($title);

$con = getConnection();
$title_safe = mysqli_real_escape_string($con, $title);
$sql = "UPDATE movies SET views = views + 1 WHERE title = '$title_safe'";
mysqli_query($con, $sql);

if (!$movie) {
    exit();
}

session_start();
$_SESSION['movie'] =$movie;

header("Location: ../view/movie_details.php?title=" . urlencode($movie['title']));


exit();
?>
