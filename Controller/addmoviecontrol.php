<?php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $con = getConnection();

    $title  = mysqli_real_escape_string($con, $_POST["title"]);
    $genre  = isset($_POST["genre"]) ? implode(",", $_POST["genre"]) : "";
    $status = mysqli_real_escape_string($con, $_POST["status"]);
    $date   = mysqli_real_escape_string($con, $_POST["date"]);
    $poster = mysqli_real_escape_string($con, $_POST["poster"]);

    $sql = "INSERT INTO movie (title, genre, status, release_date, poster_url)
            VALUES ('$title', '$genre', '$status', '$date', '$poster')";

    if (mysqli_query($con, $sql)) {
        header("Location: addMovie.php?success=1");
        exit();
    } else {
        header("Location: addMovie.php?error=1");
        mysqli_close($con);
        exit();
    }

    
}
?>
