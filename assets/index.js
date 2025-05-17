let name; 
let email;
let password;
let confirmPassword;
let error;

function email_validate() {
        email = document.getElementById("email").value;
        error = document.getElementById("error");

        if (email === "") {
                error.innerHTML = "Email cannot be empty!";
                return false;
        }

        if (email.indexOf("@") <= 0 || email.indexOf("@") === email.length - 1) {
                error.innerHTML = "Invalid email! '@' must be in the middle.";
                error.style.color = "red"; 
                return false;
        }

        let at = email.indexOf("@");
        let dot = email.lastIndexOf(".");
        if (dot <= at + 1 || dot === email.length - 1) {
                error.innerHTML = "Invalid email! '.' must come after '@' and not at the end.";
                error.style.color = "red"; 
                return false;
        }

        return true;
}

function password_vaildate(){
        password = document.getElementById("password").value;
        if (password.length < 8) {
                return false;
        }
        return true;
        
}

function validateSignInForm() {  
        email = document.getElementById("email").value;
        password = document.getElementById("password").value;
        error = document.getElementById("error"); 

        error.textContent = "";
        if (!email || !password) {
          error.textContent = "Please fill in all fields.";
          error.style.color = "red"; 
          return false;
        }
  
        if(!email_validate()){
          error.textContent = "Invalid email address.";
          error.style.color = "red"; 
          return false;
        }
  
        if (!password_vaildate()) {
          error.textContent = "Password must be at least 8 characters long.";
          error.style.color = "red"; 
          return false;
        }
        error.textContent="";
  
        return true;
}

function validateSignUpForm() {
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("repassword").value;
        const error = document.getElementById("error");
  
        error.textContent = "";
  
        if (!name || !email || !password || !confirmPassword) {
          error.textContent = "Please fill in all fields.";
          error.style.color = "red"; 
          return false;
        }

        else if(!email_validate()){
                error.textContent = "Invalid email address.";
                error.style.color = "red"; 
                return false;
        }
  
        else if (!password_vaildate()) {
          error.textContent = "Password must be at least 8 characters long.";
          error.style.color = "red"; 
          return false;
        }
  
        else if (password !== confirmPassword) {
          error.textContent = "Passwords do not match.";
          error.style.color = "red"; 
          return false;
        }
        error.textContent="";
        alert("Account created successfully!");
        return true;
}

function validateForgetPassForm(){
        email = document.getElementById("email").value;
        error = document.getElementById("error");
        if(!email){
                error.textContent = "Please fill in all fields.";
                error.style.color = "red"; 
                return false;
        }
        if(!email_validate()){
                error.textContent = "Invalid email address.";
                error.style.color = "red"; 
                return false;
        }
        error.textContent = "";
        window.location.href = "reset_password.html";
        return true;
}

function vaildateResetPass(){
        password = document.getElementById("password").value;
        confirmPassword = document.getElementById("renewpassword").value;
        error =document.getElementById("error");
        if(!password || !confirmPassword){
                error.textContent = "Please fill in all fields.";
                error.style.color = "red"; 
                return false;

        }
        if(!password_vaildate()){
                error.textContent = "Password must be at least 8 characters long.";
                error.style.color=red;
                return false;
        }
        else if(password!==confirmPassword){
                error.innerHTML="Password not Matched";
                error.style.color=red;
                return false;

        }
        error.innerHTML="";
        return true;
}

function toggleEdit() {
        const isDisabled = document.getElementById("name").disabled;
        const fields = ["name", "email", "phone"];
        const button = document.getElementById("toggleBtn");
        const fileInput = document.getElementById("uploadPic");
      
        fields.forEach(id => {
          document.getElementById(id).disabled = !isDisabled;
        });
      
        fileInput.style.display = isDisabled ? "block" : "none";
        button.textContent = isDisabled ? "Save" : "Edit";
        document.getElementsByName("name")[0].value = isDisabled ? "save" : "";
      
        if (!isDisabled) {
          alert("Profile saved!");
        }
      }
      

function previewProfilePic() {
        const fileInput = document.getElementById('uploadPic');
        const profilePic = document.getElementById('profilePic');
      
        const file = fileInput.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function (e) {
            profilePic.src = e.target.result;
          };
          reader.readAsDataURL(file);
        }
}

function searchBoxVaild(){
        value = document.getElementById("search-box").value;
        error = document.getElementById("searcherror");
        if(!value){
                error.innerHTML="Fill the search box!"
                error.style.color="red";
                return false;
        }
        error.innerHTML="";
        return true;
}

     const movies = [
        { title: "A Working Man", genre: ["Action", "Drama"], status: "Released", date: "2025-03-26", poster: "https://image.tmdb.org/t/p/w500/8YFL5QQVPy3AgrEQxNYVSgiPEbe.jpg" },
        { title: "Havoc", genre: ["Action", "Crime"], status: "Released", date: "2025-04-25", poster: "https://image.tmdb.org/t/p/w500/q719jXXEzOoYaps6babgKnONONX.jpg" },
        { title: "Minecraft Movie", genre: ["Animation", "Adventure"], status: "Upcoming", date: "2025-03-31", poster: "https://image.tmdb.org/t/p/w500/q719jXXEzOoYaps6babgKnONONX.jpg" },
        { title: "Bullet Train Explosion", genre: ["Action"], status: "Released", date: "2025-04-23", poster: "https://image.tmdb.org/t/p/w500/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg" },
        { title: "In the Lost Lands", genre: ["Adventure", "Action"], status: "Released", date: "2025-02-27", poster: "https://image.tmdb.org/t/p/w500/q719jXXEzOoYaps6babgKnONONX.jpg" }
      ];
      
      // Load movies on page
      function loadMovies(list = movies) {
        const grid = document.getElementById('moviesGrid');
        grid.innerHTML = '';
      
        list.forEach(movie => {
          grid.innerHTML += `
                <a href="movie_details.php?title=${encodeURIComponent(movie.title)}" style="text-decoration:none; color:inherit;">
            <div class="movie-card">
              <img src="${movie.poster}" alt="${movie.title}">
              <p>${movie.title}</p>
            </div>
          `;
        });
      }
      
      function applyFilters() {
        const searchText = document.getElementById('searchInput').value.toLowerCase();
        const selectedGenres = Array.from(document.querySelectorAll('input[type="checkbox"]:checked')).map(checkbox => checkbox.value);
        const selectedStatus = document.querySelector('input[name="status"]:checked').value;
        const fromDate = document.getElementById('fromDate').value;
        const toDate = document.getElementById('toDate').value;
      
        let filteredMovies = movies.filter(movie => {
          if (searchText && !movie.title.toLowerCase().includes(searchText)) {
            return false;
          }
          if (selectedGenres.length > 0 && !selectedGenres.some(genre => movie.genre.includes(genre))) {
            return false;
          }
          if (selectedStatus !== "All" && movie.status !== selectedStatus) {
            return false;
          }
          if (fromDate && movie.date < fromDate) {
            return false;
          }
          if (toDate && movie.date > toDate) {
            return false;
          }
          return true;
        });
      
        loadMovies(filteredMovies);
      }
      
      // Initial Load
      document.addEventListener('DOMContentLoaded', () => {
        loadMovies();
      });


      function updateCountdown() {
        const releaseDate = new Date("May 29, 2025 00:00:00").getTime(); // Release Time
        const now = new Date().getTime();
        const distance = releaseDate - now;

        if (distance < 0) {
            document.getElementById("countdown").innerHTML = "Released!";
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("countdown").innerHTML =
            `${days}d ${hours}h ${minutes}m ${seconds}s`;
    }

    setInterval(updateCountdown, 1000);
          