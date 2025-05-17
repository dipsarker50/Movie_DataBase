<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
    header('location: ../view/login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Actor Profile</title>
<link rel="stylesheet" href="../assets/actor_profile.css">
</head>
<body>

<h1>Actor Profile: Tom Hardy</h1>

<div class="section">
    <h2>Filmography Timeline</h2>
    <div class="timeline" id="timeline"></div>
</div>

<div class="section">
    <h2>Frequent Co-stars</h2>
    <div class="collab-map" id="collabMap"></div>
</div>

<div class="section">
    <h2>Award History</h2>
    <ul class="awards" id="awards"></ul>
</div>

<script>
const filmography = [
    { year: 2008, movie: 'Bronson' },
    { year: 2010, movie: 'Inception' },
    { year: 2012, movie: 'The Dark Knight Rises' },
    { year: 2015, movie: 'Mad Max: Fury Road' },
    { year: 2017, movie: 'Dunkirk' },
    { year: 2021, movie: 'Venom: Let There Be Carnage' }
];

const coStars = ['Leonardo DiCaprio', 'Charlize Theron', 'Cillian Murphy', 'Joseph Gordon-Levitt'];

const awards = [
    '2016 Oscar Nomination: Best Supporting Actor (The Revenant)',
    '2016 BAFTA Winner: Best Actor (Mad Max: Fury Road)',
    '2018 Oscar Nomination: Best Actor (Dunkirk)'
];

const careerGraphData = [1, 2, 3, 2, 4, 1]; 

const timelineDiv = document.getElementById('timeline');
filmography.forEach(item => {
    const div = document.createElement('div');
    div.className = 'timeline-item';
    div.textContent = `${item.year} - ${item.movie}`;
    timelineDiv.appendChild(div);
});

const collabDiv = document.getElementById('collabMap');
coStars.forEach(star => {
    const div = document.createElement('div');
    div.textContent = star;
    collabDiv.appendChild(div);
});

const awardsUl = document.getElementById('awards');
awards.forEach(award => {
    const li = document.createElement('li');
    li.textContent = award;
    awardsUl.appendChild(li);
});

const graph = document.getElementById('careerGraph');
const barWidth = 40;
careerGraphData.forEach((count, idx) => {
    const bar = document.createElement('div');
    bar.className = 'bar';
    bar.style.height = (count * 30) + 'px';
    bar.style.left = (idx * (barWidth + 10)) + 'px';
    bar.style.width = barWidth + 'px';
    graph.appendChild(bar);
});
</script>

</body>
</html>
