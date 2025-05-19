<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>

  <h1>Welcome to the Dashboard, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

  <div id="summary">
    <div class="widget" onclick="showDetail('Movies')">Total Movies: 120</div>
    <div class="widget" onclick="showDetail('Users')">Total Users: 35</div>
    <div class="widget" onclick="showDetail('Reviews')">Total Reviews: 210</div>
  </div>

  <h2>Quick Actions</h2>
  <button onclick="quickAction('Add Movie')">Add Movie</button>
  <button onclick="quickAction('Manage Users')">Manage Users</button>
  <button onclick="quickAction('View Reports')">View Reports</button>

  <div id="details"></div>

  <script>
    
    function showDetail(type) {
      let detailsDiv = document.getElementById("details");
      detailsDiv.innerHTML = `<h3>${type} Details</h3><p>Here you can see details about ${type}.</p>`;
    }

    
    function quickAction(action) {
      let detailsDiv = document.getElementById("details");
      detailsDiv.innerHTML = `<h3>${action}</h3><p>Performing the action: ${action}. More options will be added here.</p>`;
    }
  </script>

  <script src="dashboard.js"></script>
</body>
</html>
