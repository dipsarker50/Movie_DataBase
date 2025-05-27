<?php
require_once('../model/db.php');

function addActor($actor) {
    $con = getConnection();

    $name = mysqli_real_escape_string($con, $actor['name']);
    $birth_year = isset($actor['birth_year']) ? (int)$actor['birth_year'] : "NULL";
    $biography = mysqli_real_escape_string($con, $actor['biography']);
    $profile_picture = mysqli_real_escape_string($con, $actor['profile_picture']);
    $filmography = mysqli_real_escape_string($con, $actor['filmography']);
    $costars = mysqli_real_escape_string($con, $actor['costars']);
    $awards = mysqli_real_escape_string($con, $actor['awards']);

    $birthYearValue = ($birth_year === "NULL") ? "NULL" : $birth_year;

    $query = "INSERT INTO actor_profiles (name, birth_year, biography, profile_picture, filmography, costars, awards)
              VALUES ('$name', $birthYearValue, '$biography', '$profile_picture', '$filmography', '$costars', '$awards')";

    return mysqli_query($con, $query);
}

function getActorById($id) {
    $con = getConnection();
    $id = mysqli_real_escape_string($con, $id);

    $sql = "SELECT * FROM actors WHERE id='$id'";
    $result = mysqli_query($con, $sql);

    return ($result && mysqli_num_rows($result) === 1) ? mysqli_fetch_assoc($result) : null;
}

function getActorByName($name) {
    $con = getConnection();
    $name = mysqli_real_escape_string($con, $name);

    $sql = "SELECT * FROM actors WHERE name='$name'";
    $result = mysqli_query($con, $sql);

    $actors = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $actors[] = $row;
    }
    return $actors;
}

function getAllActors($limit = 100) {
    $con = getConnection();
    $limit = (int)$limit;

    $sql = "SELECT * FROM actors ORDER BY name ASC LIMIT $limit";
    $result = mysqli_query($con, $sql);

    $actors = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $actors[] = $row;
    }
    return $actors;
}



function updateActorByName($oldName, $actor) {
    $con = getConnection();

    $oldName = mysqli_real_escape_string($con, $oldName);
    $name = mysqli_real_escape_string($con, $actor['name']);
    $birth_year = isset($actor['birth_year']) ? (int)$actor['birth_year'] : "NULL";
    $biography = mysqli_real_escape_string($con, $actor['biography']);
    $profile_picture = mysqli_real_escape_string($con, $actor['profile_picture']);
    $filmography = mysqli_real_escape_string($con, $actor['filmography']);
    $costars = mysqli_real_escape_string($con, $actor['costars']);
    $awards = mysqli_real_escape_string($con, $actor['awards']);

    $birthYearValue = ($birth_year === "NULL") ? "NULL" : $birth_year;

    $sql = "UPDATE actor_profiles
            SET name='$name', birth_year=" . ($birthYearValue === "NULL" ? "NULL" : $birthYearValue) . ", biography='$biography', 
                profile_picture='$profile_picture', filmography='$filmography', costars='$costars', awards='$awards' 
            WHERE name='$oldName'";

    return mysqli_query($con, $sql);
}



function deleteActorByName($name) {
    $con = getConnection();
    $name = mysqli_real_escape_string($con, $name);

    $sql = "DELETE FROM actor_profiles WHERE name='$name'";
    return mysqli_query($con, $sql);
}
