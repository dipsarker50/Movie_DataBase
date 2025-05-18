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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
        .stars span {
            font-size: 25px;
            cursor: pointer;
            color: #ccc;
        }
        .stars span.selected {
            color: gold;
        }
        textarea {
            width: 100%;
            height: 80px;
            margin-top: 10px;
            padding: 10px;
            resize: none;
        }
        button {
            margin-top: 10px;
            padding: 8px 16px;
            background: #ff9900;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        .review {
            background: #fafafa;
            margin-top: 20px;
            padding: 10px;
            border-radius: 8px;
        }
        .review button {
            background: none;
            color: blue;
            border: none;
            cursor: pointer;
            margin-right: 10px;
        }
        .reply {
            margin-top: 10px;
            margin-left: 20px;
            padding-left: 10px;
            border-left: 2px solid #eee;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Write a Review</h2>
    <div class="stars" id="starRating">
        <span data-value="1">&#9733;</span>
        <span data-value="2">&#9733;</span>
        <span data-value="3">&#9733;</span>
        <span data-value="4">&#9733;</span>
        <span data-value="5">&#9733;</span>
    </div>
    <textarea id="reviewText" placeholder="Your review..."></textarea><br>
    <button onclick="submitReview()">Submit Review</button>

    <h2 style="margin-top:40px;">User Reviews</h2>
    <div id="reviewsSection"></div>
</div>

<script>
    var selectedRating = 0;

    // Handle star click
    var stars = document.querySelectorAll('#starRating span');
    for (var i = 0; i < stars.length; i++) {
        stars[i].addEventListener('click', function() {
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
        submitBtn.onclick = function() {
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
</script>

</body>
</html>
