const movies = [
    { title: "Inception", genre: "Action" },
    { title: "The Hangover", genre: "Comedy" },
    { title: "The Godfather", genre: "Drama" },
    { title: "Die Hard", genre: "Action" },
    { title: "Superbad", genre: "Comedy" },
    { title: "The Shawshank Redemption", genre: "Drama" }
  ];
  
  const searchInput = document.getElementById("search");
  const filterInputs = document.querySelectorAll("#filters input[type='checkbox']");
  const resultsContainer = document.getElementById("results");
  
  searchInput.addEventListener("input", updateResults);
  filterInputs.forEach(input => input.addEventListener("change", updateResults));
  
  function updateResults() {
    const query = searchInput.value.toLowerCase();
    const activeGenres = Array.from(filterInputs)
      .filter(input => input.checked)
      .map(input => input.value);
  
    const filtered = movies.filter(movie => {
      const matchesSearch = movie.title.toLowerCase().includes(query);
      const matchesFilter = activeGenres.length === 0 || activeGenres.includes(movie.genre);
      return matchesSearch && matchesFilter;
    });
  
    displayResults(filtered);
  }
  
  function displayResults(list) {
    resultsContainer.innerHTML = "";
    if (list.length === 0) {
      resultsContainer.textContent = "No results found.";
      return;
    }
    list.forEach(movie => {
      const div = document.createElement("div");
      div.className = "result-item";
      div.textContent = `${movie.title} (${movie.genre})`;
      resultsContainer.appendChild(div);
    });
  }
  
  // Initial display
  updateResults();
  