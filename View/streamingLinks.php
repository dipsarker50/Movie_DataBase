<?php
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['status']) || $_SESSION['status'] !== true) {
    $key = 'Login';
}else{
    $key = 'Profile';
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Streaming Links</title>
<link rel="stylesheet" href="../Asset/streamingLinks.css">
</head>
<body>

  <h1>Streaming Availability</h1>

  <label for="countrySelect">Select your region:</label>
  <select id="countrySelect">
    <option value="US">United States</option>
    <option value="UK">United Kingdom</option>
    <option value="IN">Bangladesh</option>
    <option value="Other">Other</option>
  </select>

  <div id="regionAlert"></div>

  <h2>Available Streaming Services</h2>
  <ul id="streamList"></ul>

  <h2>Compare Subscription Costs</h2>
  <table>
    <tr><th>Service</th><th>Monthly Price</th></tr>
    <tr><td>Netflix</td><td>$15</td></tr>
    <tr><td>Amazon Prime</td><td>$9</td></tr>
    <tr><td>Disney+</td><td>$8</td></tr>
  </table>

  <h2>VPN Recommendation</h2>
  <p id="vpnSuggestion"></p>

  <script src="streamingLinks.js"></script>
</body>
</html>
