<?php
require_once('db.php');

function addMovie($movie) {
    $con = getConnection();

    $title = mysqli_real_escape_string($con, $movie['title']);
    $genre = mysqli_real_escape_string($con, $movie['genre']); 
    $status = mysqli_real_escape_string($con, $movie['status']);
    $release_date = mysqli_real_escape_string($con, $movie['release_date']);
    $poster_url = mysqli_real_escape_string($con, $movie['poster_url']);

    $sql = "INSERT INTO movies (title, genre, status, release_date, poster_url) 
            VALUES ('$title', '$genre', '$status', '$release_date', '$poster_url')";

    return mysqli_query($con, $sql);
}

function getMovieById($id) {
    $con = getConnection();
    $id = mysqli_real_escape_string($con, $id);

    $sql = "SELECT * FROM movies WHERE id='$id'";
    $result = mysqli_query($con, $sql);

    return ($result && mysqli_num_rows($result) === 1) ? mysqli_fetch_assoc($result) : null;
}

function getMovieByTitle($title) {
    $con = getConnection();
    $title = mysqli_real_escape_string($con, $title);

    $sql = "SELECT * FROM movies WHERE title='$title' LIMIT 1";
    $result = mysqli_query($con, $sql);

    return ($result && mysqli_num_rows($result) === 1) ? mysqli_fetch_assoc($result) : null;
}

function getAllMovies() {
    $con = getConnection();

    $sql = "SELECT * FROM movies ORDER BY release_date DESC";
    $result = mysqli_query($con, $sql);

    $movies = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $movies[] = $row;
    }
    return $movies;
}

function updateMovie($id, $movie) {
    $con = getConnection();

    $id = mysqli_real_escape_string($con, $id);
    $title = mysqli_real_escape_string($con, $movie['title']);
    $genre = mysqli_real_escape_string($con, $movie['genre']);
    $status = mysqli_real_escape_string($con, $movie['status']);
    $release_date = mysqli_real_escape_string($con, $movie['release_date']);
    $poster_url = mysqli_real_escape_string($con, $movie['poster_url']);

    $sql = "UPDATE movies 
            SET title='$title', genre='$genre', status='$status', 
                release_date='$release_date', poster_url='$poster_url'
            WHERE id='$id'";

    return mysqli_query($con, $sql);
}

function deleteMovie($id) {
    $con = getConnection();
    $id = mysqli_real_escape_string($con, $id);

    $sql = "DELETE FROM movies WHERE id='$id'";
    return mysqli_query($con, $sql);
}

function getTrendingMovies() {
    $con = getConnection();
    $sql = "SELECT * FROM movies ORDER BY views DESC LIMIT 3";
    $result = mysqli_query($con, $sql);

    $movies = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $movies[] = $row;
    }

    return $movies;
}



?>
