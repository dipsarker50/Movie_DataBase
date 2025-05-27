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

    if (index !== targetIndex) {
      lists[listName].splice(index, 1);
      lists[listName].splice(targetIndex, 0, draggedItem);
      updateListItems(listName);
    }
  }
}

function toggleShareOptions(button) {
  var shareDiv = button.nextElementSibling;
  if (shareDiv.style.display === "none" || shareDiv.style.display === "") {
    shareDiv.style.display = "block";
  } else {
    shareDiv.style.display = "none";
  }
}
