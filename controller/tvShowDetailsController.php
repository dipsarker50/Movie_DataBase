<?php
header('Content-Type: application/json');
require_once('../model/tvShowModel.php');

if (!isset($_GET['title'])) {
    echo json_encode(['error' => 'Tv title not provided']);
    exit();
}

$title = urldecode($_GET['title']);
$tvshow = getTVShowByTitle($title);

if (!$tvshow) {
    exit();
}

session_start();
$_SESSION['tvshow'] =$tvshow;

header("Location: ../view/tv_show_details.php?title=" . urlencode($tvshow['title']));


exit();
?>
