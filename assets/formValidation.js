const form = document.getElementById("movieForm");
const title = document.getElementById("title");
const year = document.getElementById("year");
const genre = document.getElementById("genre");

const titleError = document.getElementById("titleError");
const yearError = document.getElementById("yearError");
const genreError = document.getElementById("genreError");
const successMessage = document.getElementById("formSuccess");

title.addEventListener("input", validateTitle);
year.addEventListener("input", validateYear);
genre.addEventListener("input", validateGenre);

form.addEventListener("submit", function (e) {
  e.preventDefault();
  const validTitle = validateTitle();
  const validYear = validateYear();
  const validGenre = validateGenre();

  if (validTitle && validYear && validGenre) {
    successMessage.textContent = "Movie submitted successfully!";
    form.reset();
  } else {
    successMessage.textContent = "";
  }
});

function validateTitle() {
  if (title.value.trim() === "") {
    titleError.textContent = "Title is required.";
    return false;
  } else {
    titleError.textContent = "";
    return true;
  }
}

function validateYear() {
  const yearValue = parseInt(year.value);
  if (!year.value || yearValue < 1900 || yearValue > new Date().getFullYear()) {
    yearError.textContent = "Enter a valid year.";
    return false;
  } else {
    yearError.textContent = "";
    return true;
  }
}

function validateGenre() {
  if (genre.value.trim() === "") {
    genreError.textContent = "Genre is required.";
    return false;
  } else {
    genreError.textContent = "";
    return true;
  }
}
