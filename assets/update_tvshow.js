document.getElementById('update-tvshow-form').addEventListener('submit', function(e) {
  // Example: Confirm before submitting update
  if (!confirm('Are you sure you want to update this TV show?')) {
    e.preventDefault();
  }
});
