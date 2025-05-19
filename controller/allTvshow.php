<?php
require_once('../model/tvShowModel.php');
header('Content-Type: application/json');

$shows = getAllTVShows();

$tvList = array_map(function($show) {
    return [
        'title'        => $show['title'],
        'genre'        => $show['genre'],
        'status'       => $show['status'],
        'start_date'   => $show['start_date'],
        'end_date'     => $show['end_date'],
        'seasons'      => $show['seasons'],
        'poster_url'   => $show['poster_url']
    ];
}, $shows);

echo json_encode($tvList);
exit();
?>
