function showDetail(type) {
    const details = document.getElementById("details");
    details.textContent = "Showing more details for " + type + ".";
  }
  
  function quickAction(action) {
    const details = document.getElementById("details");
    details.textContent = "Quick action performed: " + action + ".";
  }
  