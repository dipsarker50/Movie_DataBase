<?php
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
    $key = 'Login';
}else{
    $key = 'Profile';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Watchlist Manager</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #121212;
      color: #f5f5f5;
      padding: 20px;
    }
    .container {
      max-width: 800px;
      margin: auto;
      background: #1c1c1c;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0,0,0,0.8);
    }
    input, button, select {
      padding: 10px;
      margin-top: 10px;
      margin-right: 10px;
      border: none;
      border-radius: 3px;
      font-size: 16px;
    }
    input, select {
      background: #2c2c2c;
      color: #f5f5f5;
    }
    .watchlist {
      margin-top: 20px;
      background: #2c2c2c;
      padding: 10px;
      border-radius: 5px;
      position: relative;
    }
    .watchlist ul {
      list-style: none;
      padding: 0;
    }
    .watchlist li {
      padding: 8px;
      background: #3a3a3a;
      margin-bottom: 5px;
      border: 1px solid #444;
      cursor: move;
      border-radius: 3px;
    }
    .share-button {
      background: #f5c518;
      color: black;
      border: none;
      border-radius: 3px;
      padding: 8px 16px;
      cursor: pointer;
      margin-top: 10px;
      font-weight: bold;
    }
    .share-options {
      margin-top: 10px;
      display: none;
    }
    .share-options button {
      margin-right: 5px;
      background: #555;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 3px;
      cursor: pointer;
    }
    h2, h3 {
      color: #f5c518;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Watchlist Manager</h2>
  
  <input type="text" id="newListName" placeholder="New Watchlist Name">
  <button onclick="createWatchlist()" class="share-button">Create List</button>
  
  <div id="listsContainer"></div>

  <h2 style="margin-top:40px;">Add Movie to List</h2>
  <select id="listSelect">
    <option value="">Select Watchlist</option>
  </select>
  <input type="text" id="movieName" placeholder="Movie Title">
  <button onclick="addMovie()" class="share-button">Add Movie</button>
</div>

<script>
  var lists = {};

  function createWatchlist() {
    var name = document.getElementById('newListName').value.trim();
    if (name.length == 0) {
      alert('Enter a watchlist name.');
    } else if (lists[name]) {
      alert('This watchlist already exists.');
    } else {
      lists[name] = [];
      updateLists();
      document.getElementById('newListName').value = '';
    }
  }

  function updateLists() {
    var container = document.getElementById('listsContainer');
    var select = document.getElementById('listSelect');
    container.innerHTML = '';
    select.innerHTML = '<option value="">Select Watchlist</option>';
    for (var listName in lists) {
      var div = document.createElement('div');
      div.className = 'watchlist';
      div.innerHTML = 
        '<h3>' + listName + '</h3>' +
        '<ul id="ul-' + listName + '" ondragover="allowDrop(event)" ondrop="drop(event, \'' + listName + '\')"></ul>' +
        '<button class="share-button" onclick="toggleShareOptions(this)">Share List</button>' +
        '<div class="share-options">' +
          '<button>Facebook</button>' +
          '<button>Instagram</button>' +
          '<button>X</button>' +
        '</div>';
      container.appendChild(div);

      var option = document.createElement('option');
      option.value = listName;
      option.innerText = listName;
      select.appendChild(option);

      updateListItems(listName);
    }
  }

  function addMovie() {
    var listName = document.getElementById('listSelect').value;
    var movie = document.getElementById('movieName').value.trim();
    if (listName == '') {
      alert('Select a watchlist.');
    } else if (movie.length == 0) {
      alert('Enter a movie title.');
    } else {
      lists[listName].push(movie);
      updateListItems(listName);
      document.getElementById('movieName').value = '';
    }
  }

  function updateListItems(listName) {
    var ul = document.getElementById('ul-' + listName);
    if (ul) {
      ul.innerHTML = '';
      for (var i = 0; i < lists[listName].length; i++) {
        var li = document.createElement('li');
        li.innerText = lists[listName][i];
        li.draggable = true;
        li.id = listName + '-' + i;
        li.ondragstart = function(event) {
          event.dataTransfer.setData('text', event.target.id);
        }
        ul.appendChild(li);
      }
    }
  }

  function allowDrop(event) {
    event.preventDefault();
  }

  function drop(event, listName) {
    event.preventDefault();
    var data = event.dataTransfer.getData('text');
    var draggedIdParts = data.split('-');
    var index = parseInt(draggedIdParts[1]);
    var draggedItem = lists[listName][index];

    var target = event.target;
    if (target.tagName == 'LI') {
      var targetIdParts = target.id.split('-');
      var targetIndex = parseInt(targetIdParts[1]);

      if (index != targetIndex) {
        lists[listName].splice(index, 1);
        lists[listName].splice(targetIndex, 0, draggedItem);
        updateListItems(listName);
      }
    }
  }

  function toggleShareOptions(button) {
    var shareDiv = button.nextElementSibling;
    if (shareDiv.style.display == "none" || shareDiv.style.display == "") {
      shareDiv.style.display = "block";
    } else {
      shareDiv.style.display = "none";
    }
  }
</script>

</body>
</html>
