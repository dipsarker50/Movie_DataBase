<?php
require_once('../model/db.php');

function addMovie($movie) {
    $conn = getConnection();

    $title = mysqli_real_escape_string($conn, $movie['title']);
    $status = mysqli_real_escape_string($conn, $movie['status']);
    $date = mysqli_real_escape_string($conn, $movie['date']);
    $poster = mysqli_real_escape_string($conn, $movie['poster_url']);
    $overview = mysqli_real_escape_string($conn, $movie['overview']);
    $score = (int)$movie['user_score'];
    $trailer = mysqli_real_escape_string($conn, $movie['trailer_url']);
    $language = mysqli_real_escape_string($conn, $movie['language']);
    $budget = (int)$movie['budget'];
    $revenue = (int)$movie['revenue'];
    $keywords = mysqli_real_escape_string($conn, $movie['keywords']);
    $runtime = mysqli_real_escape_string($conn, $movie['runtime']);
    $genre = mysqli_real_escape_string($conn, implode(",", $movie['genre']));

    $query = "INSERT INTO movies (title, status, release_date, poster_url, overview, user_score, trailer_url, language, budget, revenue, keywords, runtime, genre) 
              VALUES ('$title', '$status', '$date', '$poster', '$overview', $score, '$trailer', '$language', $budget, $revenue, '$keywords', '$runtime', '$genre')";

    return mysqli_query($conn, $query);
}



function deleteMovieByTitle($title) {
    $con = getConnection();
    $title = mysqli_real_escape_string($con, $title);

    $sql = "DELETE FROM movies WHERE title='$title'";
    return mysqli_query($con, $sql);
}


function getMovieById($id) {
    $con = getConnection();
    $id = mysqli_real_escape_string($con, $id);

    $sql = "SELECT * FROM movies WHERE id='$id'";
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
function getPosterById($id) {
    $con = getConnection();
    $id = mysqli_real_escape_string($con, $id);

    $sql = "SELECT poster_url FROM movies WHERE id='$id'";
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

    $sql = "UPDATE movies SET poster_url='$posterUrl' WHERE id='$id'";
    return mysqli_query($con, $sql);
}

?>
