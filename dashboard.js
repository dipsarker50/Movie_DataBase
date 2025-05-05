function showDetail(type) {
    const details = document.getElementById("details");
    details.textContent = "Showing more details for " + type + ".";
  }

  function profile(type) {
    window.location.href = "profile.html";
  } 
  
  function quickAction(action) {
    const details = document.getElementById("details");
    details.textContent = "Quick action performed: " + action + ".";
  }
  