var reportTitle = "";
var reportType = "";
var reportDescription = "";
var reportStatus = "None";
var points = 0;

function showSection(sectionId) {
  var sections = document.getElementsByClassName('section');
  for (var i = 0; i < sections.length; i++) {
    if (sections[i].id === sectionId) {
      sections[i].classList.add('active');
    } else {
      sections[i].classList.remove('active');
    }
  }
  if (sectionId === 'log') {
    showReport();
  }
  if (sectionId === 'moderator') {
    showModerator();
  }
}

function submitReport() {
  var t = document.getElementById('title').value;
  var ty = document.getElementById('type').value;
  var d = document.getElementById('description').value;

  if (t === "" || d === "") {
    alert("Please fill in all fields.");
  } else {
    reportTitle = t;
    reportType = ty;
    reportDescription = d;
    reportStatus = "Pending";
    alert("Report submitted!");
    document.getElementById('title').value = "";
    document.getElementById('type').value = "Cast";
    document.getElementById('description').value = "";
  }
}

function showReport() {
  var display = document.getElementById('reportDisplay');
  if (reportStatus === "None") {
    display.innerHTML = "No reports submitted.";
  } else {
    display.innerHTML = "<div class='report'><b>" + reportTitle + "</b> (" + reportType + ")<br>" +
                        reportDescription + "<br>Status: " + reportStatus + "<br>Points: " + points + "</div>";
  }
}

function showModerator() {
  var mod = document.getElementById('moderatorDisplay');
  if (reportStatus === "Pending") {
    mod.innerHTML = "<div class='report'><b>" + reportTitle + "</b> (" + reportType + ")<br>" +
                    reportDescription + "<br>" +
                    "<button onclick='approveReport()'>Approve</button> " +
                    "<button onclick='rejectReport()'>Reject</button></div>";
  } else {
    mod.innerHTML = "No pending reports.";
  }
}

function approveReport() {
  if (reportStatus === "Pending") {
    reportStatus = "Approved";
    points = points + 10;
    alert("Report approved! +10 points.");
    showModerator();
    showReport();
  }
}

function rejectReport() {
  if (reportStatus === "Pending") {
    reportStatus = "Rejected";
    alert("Report rejected.");
    showModerator();
    showReport();
  }
}
