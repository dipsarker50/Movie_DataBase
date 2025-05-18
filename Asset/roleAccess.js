const roleSelect = document.getElementById("role");
const navBar = document.getElementById("nav-bar");
const adminPanel = document.getElementById("admin-panel");
const assignResult = document.getElementById("assign-result");

roleSelect.addEventListener("change", updateRole);

function updateRole() {
  const role = roleSelect.value;
  navBar.innerHTML = "";

  if (role === "Admin") {
    navBar.innerHTML = '<a href="#">Dashboard</a> <a href="#">Manage Users</a>';
    adminPanel.style.display = "block";
  } else if (role === "Editor") {
    navBar.innerHTML = '<a href="#">Edit Movies</a> <a href="#">Submit Review</a>';
    adminPanel.style.display = "none";
  } else {
    navBar.innerHTML = '<a href="#">Browse Movies</a> <a href="#">Write Review</a>';
    adminPanel.style.display = "none";
  }
}

function assignRole() {
  const user = document.getElementById("assign-user").value;
  const newRole = document.getElementById("assign-role").value;

  if (user && newRole) {
    assignResult.textContent = `Assigned ${newRole} role to ${user}.`;
  } else {
    assignResult.textContent = "Please enter username and select role.";
  }
}
