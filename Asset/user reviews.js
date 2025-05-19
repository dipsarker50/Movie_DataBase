var selectedRating = 0;

var stars = document.querySelectorAll('#starRating span');
for (var i = 0; i < stars.length; i++) {
    stars[i].addEventListener('click', function () {
        selectedRating = this.getAttribute('data-value');
        updateStars();
    });
}

function updateStars() {
    var allStars = document.querySelectorAll('#starRating span');
    for (var i = 0; i < allStars.length; i++) {
        if (allStars[i].getAttribute('data-value') <= selectedRating) {
            allStars[i].classList.add('selected');
        } else {
            allStars[i].classList.remove('selected');
        }
    }
}

function submitReview() {
    var text = document.getElementById('reviewText').value.trim();
    if (selectedRating == 0) {
        alert('Please select a star rating.');
    } else if (text.length == 0) {
        alert('Please write a review.');
    } else {
        var reviews = document.getElementById('reviewsSection');
        var reviewDiv = document.createElement('div');
        reviewDiv.className = 'review';
        reviewDiv.innerHTML =
            '<div>' + '★'.repeat(selectedRating) + '</div>' +
            '<p>' + text + '</p>' +
            '<button onclick="replyToReview(this)">Reply</button>' +
            '<button onclick="reportReview()">Report</button>';
        reviews.appendChild(reviewDiv);
        document.getElementById('reviewText').value = '';
        selectedRating = 0;
        updateStars();
    }
}

function replyToReview(button) {
    var parent = button.parentElement;
    var replyBox = document.createElement('textarea');
    replyBox.placeholder = "Write a reply...";
    var submitBtn = document.createElement('button');
    submitBtn.innerText = "Submit Reply";
    submitBtn.onclick = function () {
        if (replyBox.value.trim().length > 0) {
            var replyDiv = document.createElement('div');
            replyDiv.className = 'reply';
            replyDiv.innerText = replyBox.value.trim();
            parent.appendChild(replyDiv);
            replyBox.remove();
            submitBtn.remove();
        } else {
            alert('Please write something in your reply.');
        }
    }
    parent.appendChild(replyBox);
    parent.appendChild(submitBtn);
}

function reportReview() {
    alert('This review has been reported.');
}
