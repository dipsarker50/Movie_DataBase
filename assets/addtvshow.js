function previewTV() {
  const form = document.getElementById("addTVForm");
  const formData = new FormData(form);

  const title = formData.get("title");
  const genres = formData.getAll("genre[]");
  const status = formData.get("status");
  const date = formData.get("date");
  const score = formData.get("score");
  const runtime = formData.get("runtime");
  const overview = formData.get("overview");
  const fileInput = form.querySelector("input[name='poster']");
  const file = fileInput.files[0];

  const container = document.getElementById("previewContainer");
  container.innerHTML = ""; // clear old preview

  const reader = new FileReader();
  reader.onload = function(e) {
    const imgSrc = e.target.result;

    const previewHTML = `
      <div class="tv-card">
        <img src="${imgSrc}" alt="${title}" />
        <h3>${title}</h3>
        <p><strong>Genre:</strong> ${genres.join(", ")}</p>
        <p><strong>Status:</strong> ${status}</p>
        <p><strong>First Air Date:</strong> ${date}</p>
        <p><strong>Score:</strong> ${score}</p>
        <p><strong>Runtime:</strong> ${runtime}</p>
        <p><strong>Overview:</strong> ${overview}</p>
      </div>
    `;
    container.innerHTML = previewHTML;
  };

  if (file) {
    reader.readAsDataURL(file);
  } else {
    container.innerHTML = "<p style='color:red;'>Please select a poster image to preview.</p>";
  }
}
