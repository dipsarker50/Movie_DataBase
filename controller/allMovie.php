<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('../model/movieModel.php');
header('Content-Type: application/json');

$movies = getAllMovies();

$movieList = array_map(function($movie) {
    return [
        'title' => $movie['title'],
        'poster' => $movie['poster_url'],
        'genre' => $movie['genre'],
        'status' => $movie['status'],
        'release_date' => $movie['release_date']
    ];
}, $movies);

echo json_encode($movieList);
?>
