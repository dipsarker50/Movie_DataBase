<?php
require_once('db.php');

function addMovie($movie) {
    $con = getConnection();
    $m = $movie[0];

    $title = mysqli_real_escape_string($con, $m['title']);
    $genre = mysqli_real_escape_string($con, $m['genre']); // e.g., "Action,Crime"
    $status = mysqli_real_escape_string($con, $m['status']); // "Released" or "Upcoming"
    $release_date = mysqli_real_escape_string($con, $m['release_date']);
    $poster_url = mysqli_real_escape_string($con, $m['poster_url']);

    $sql = "INSERT INTO movie (title, genre, status, release_date, poster_url)
            VALUES ('$title', '$genre', '$status', '$release_date', '$poster_url')";

    return mysqli_query($con, $sql);
}

function deleteMovie($id) {
    $con = getConnection();
    $id = mysqli_real_escape_string($con, $id);

    $sql = "DELETE FROM movie WHERE id='$id'";
    return mysqli_query($con, $sql);
}

function getMovieById($id) {
    $con = getConnection();
    $id = mysqli_real_escape_string($con, $id);

    $sql = "SELECT * FROM movie WHERE id='$id'";
    $result = mysqli_query($con, $sql);

    return ($result && mysqli_num_rows($result) === 1) ? mysqli_fetch_assoc($result) : null;
}

function getAllMovies() {
    $con = getConnection();
    $sql = "SELECT * FROM movie ORDER BY release_date DESC";
    $result = mysqli_query($con, $sql);

    $movies = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $movies[] = $row;
    }
    return $movies;
}
function getPosterById($id) {
    $con = getConnection();
    $id = mysqli_real_escape_string($con, $id);

    $sql = "SELECT poster_url FROM movie WHERE id='$id'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        return $row['poster_url'];
    }
    return null;
}

function setPosterById($id, $posterUrl) {
    $con = getConnection();
    $id = mysqli_real_escape_string($con, $id);
    $posterUrl = mysqli_real_escape_string($con, $posterUrl);

    $sql = "UPDATE movie SET poster_url='$posterUrl' WHERE id='$id'";
    return mysqli_query($con, $sql);
}

?>
