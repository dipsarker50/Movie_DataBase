const form = document.getElementById("addMovieForm");
const movieList = document.getElementById("movieList");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  const title = document.getElementById("title").value;
  const genreSelect = document.getElementById("genre");
  const genre = Array.from(genreSelect.selectedOptions).map(opt => opt.value);
  const status = document.getElementById("status").value;
  const date = document.getElementById("date").value;
  const poster = document.getElementById("poster").value;

  const movie = {
    title: title,
    genre: genre,
    status: status,
    date: date,
    poster: poster
  };

  displayMovie(movie);
  form.reset();
});

function displayMovie(movie) {
  const card = document.createElement("div");
  card.className = "movie-card";

  card.innerHTML = `
    <img src="${movie.poster}" alt="${movie.title}" />
    <h3>${movie.title}</h3>
    <p><strong>Genre:</strong> ${movie.genre.join(", ")}</p>
    <p><strong>Status:</strong> ${movie.status}</p>
    <p><strong>Date:</strong> ${movie.date}</p>
  `;

  movieList.appendChild(card);
}
