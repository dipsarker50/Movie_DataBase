<?php
session_start();
$username = $_SESSION['username'] ?? 'Anonymous';
$key = (!isset($_SESSION['status']) || $_SESSION['status'] !== true) ? 'Login' : 'Profile';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Streaming Links</title>
  <link rel="stylesheet" href="../assets/streamingLinks.css">
</head>
<body>

<h1>Streaming Availability</h1>

<label for="countrySelect">Select your region:</label>
<select id="countrySelect">
  <option value="US">United States</option>
  <option value="UK">United Kingdom</option>
  <option value="BD">Bangladesh</option>
  <option value="Other">Other</option>
</select>

<div id="regionAlert"></div>

<h2>Available Streaming Services</h2>
<ul id="streamList"></ul>

<h2>Compare Subscription Costs</h2>
<table id="priceTable">
  <tr><th>Service</th><th>Monthly Price</th></tr>
</table>

<h2>VPN Recommendation</h2>
<p id="vpnSuggestion"></p>

<script>
const services = {
  US: {
    prices: {
      Netflix: "$15",
      "Amazon Prime": "$9",
      "Disney+": "$8"
    },
    vpn: "Try NordVPN for full US catalog access."
  },
  UK: {
    prices: {
      Netflix: "£12",
      "Amazon Prime": "£8",
      "Disney+": "£7"
    },
    vpn: "Use Exord VPN to explore more UK-based content."
  },
  BD: {
    prices: {
      Netflix: "৳1200",
      "Amazon Prime": "৳800",
      "Disney+": "Unavailable"
    },
    vpn: "Warp VPN can unlock unavailable streaming services in Bangladesh."
  },
  Other: {
    prices: {
      Netflix: "$13",
      "Amazon Prime": "$7",
      "Disney+": "$6"
    },
    vpn: "NordVPN, Exord VPN, or Warp VPN are great global options."
  }
};

document.getElementById("countrySelect").addEventListener("change", function() {
  const region = this.value;
  const priceData = services[region]?.prices || {};
  const vpnText = services[region]?.vpn || "";
  
  const list = document.getElementById("streamList");
  list.innerHTML = "";
  Object.keys(priceData).forEach(service => {
    const li = document.createElement("li");
    li.textContent = service;
    list.appendChild(li);
  });

  const table = document.getElementById("priceTable");
  table.innerHTML = "<tr><th>Service</th><th>Monthly Price</th></tr>";
  Object.entries(priceData).forEach(([service, price]) => {
    const row = document.createElement("tr");
    row.innerHTML = `<td>${service}</td><td>${price}</td>`;
    table.appendChild(row);
  });

  
  document.getElementById("vpnSuggestion").textContent = vpnText;
});


document.getElementById("countrySelect").dispatchEvent(new Event("change"));
</script>

</body>
</html>
