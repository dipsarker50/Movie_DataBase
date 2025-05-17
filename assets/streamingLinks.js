const streamList = document.getElementById("streamList");
const regionAlert = document.getElementById("regionAlert");
const vpnSuggestion = document.getElementById("vpnSuggestion");
const countrySelect = document.getElementById("countrySelect");

const streamingAvailability = {
  US: ["Netflix", "Amazon Prime", "Disney+"],
  UK: ["Netflix", "Amazon Prime"],
  IN: ["Netflix", "Disney+"],
  Other: []
};

countrySelect.addEventListener("change", updateStreamingInfo);

function updateStreamingInfo() {
  const country = countrySelect.value;
  const services = streamingAvailability[country];
  
  streamList.innerHTML = "";
  if (services.length === 0) {
    regionAlert.textContent = "This movie is not available in your region.";
    vpnSuggestion.textContent = "Use a VPN to switch to a supported region like US or UK.";
  } else {
    regionAlert.textContent = "";
    vpnSuggestion.textContent = "";
    services.forEach(service => {
      const li = document.createElement("li");
      li.textContent = service;
      streamList.appendChild(li);
    });
  }
}


updateStreamingInfo();
