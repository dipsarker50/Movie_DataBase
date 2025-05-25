<?php
require_once('../model/movieModel.php');
require_once('../model/tvShowModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['query'])) {
    $query = trim($_POST['query']);
    $con = getConnection();
    $qSafe = mysqli_real_escape_string($con, $query);

    $movies = [];
    $tv_shows = [];

    $sql1 = "SELECT title, poster_url FROM movies WHERE title LIKE '%$qSafe%'";
    $res1 = mysqli_query($con, $sql1);
    while ($row = mysqli_fetch_assoc($res1)) {
        $movies[] = [
            'title' => $row['title'],
            'poster' => ltrim($row['poster_url'], '../'),
            'is_tv' => false
        ];
    }

    $sql2 = "SELECT title, poster_url FROM tv_shows WHERE title LIKE '%$qSafe%'";
    $res2 = mysqli_query($con, $sql2);
    while ($row = mysqli_fetch_assoc($res2)) {
        $tv_shows[] = [
            'title' => $row['title'],
            'poster' => ltrim($row['poster_url'], '../'),
            'is_tv' => true
        ];
    }

    header('Content-Type: application/json');
    echo json_encode([
        'movies' => $movies,
        'tv_shows' => $tv_shows
    ]);
    exit();
}
?>
