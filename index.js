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
  
        alert("Account Login Successfully!");
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
        return true;
}