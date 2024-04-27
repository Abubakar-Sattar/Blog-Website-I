<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance Blog</title>
    <!-- Add CSS link here -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.html"><img src="Logo/Logo Files/For Web/png/Color logo - no background.png" alt="" id="logo"></a>
    <header>
        <h1>Welcome to Shield Guardian Insurance</h1>
    </header>

    <div class="sidebar">
        <h2>Categories</h2>
        <ul>
            <li><a href="index.html">Home Insurance</a></li>
            <li><a href="index.html">Auto Insurance</a></li>
            <li><a href="index.html">Health Insurance</a></li>
            <li><a href="index.html">Life Insurance</a></li>
            <li><a href="index.html">Business Insurance</a></li>
            <li><a href="index.html">Travel Insurance</a></li>
            <li><a href="index.html">Pet Insurance</a></li>
            <li><a href="index.html">Disability Insurance</a></li>
            <li><a href="index.html">Liability Insurance</a></li>
            <!-- Add more categories as needed -->
        </ul>
    </div>

    <!-- Blog Post -->
    <section>
        <h2>Understanding the Importance of Insurance: Safeguarding Your Future</h2>
        <img src="Images/img-main.jpg" alt="" height="400px" width="900px">
        <p><!-- Your blog post content here --></p>
    </section>

    <form id="commentForm" action="submit_comment.php" method="post">
        <h2 id="comment-title">Comments</h2>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="profile_url">Profile URL:</label>
        <input type="url" id="profile_url" name="profile_url"><br>
        <label for="comment">Comment:</label><br>
        <textarea id="comment" name="comment" rows="4" required></textarea><br>
        <input type="submit" value="Submit">
    </form>
    
    <div id="commentsContainer"></div>

    <footer>
        <p>&copy; 2024 PettallInfo. All rights reserved.</p>
    </footer>
    
    <script>
        // Define your secret key
        var secretKey = "5599"; // Update this with your secret key
        
        // Retrieve comments from the server using AJAX request
        function fetchComments() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_comments.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var comments = JSON.parse(xhr.responseText);
                        displayComments(comments);
                    } else {
                        console.error("Failed to fetch comments: " + xhr.status);
                    }
                }
            };
            xhr.send();
        }
        
        // Call fetchComments when the page loads to initially display comments
        window.onload = function() {
            fetchComments();
        };
        
        // Function to display comments
        function displayComments(comments) {
            var commentContainer = document.getElementById("commentsContainer");
            commentContainer.innerHTML = ""; // Clear existing comments
            
            comments.forEach(function(comment, index) {
                var formattedComment = "<div class='comment'>" +
                                    "<div class='comment-header'><strong><a href='" + comment.profileUrl + "'>" + comment.name + "</a></strong>" +
                                    "<button class='delete-btn' data-index='" + index + "'>Delete</button></div>" + // Add delete button
                                    "<div class='comment-body'>" + comment.comment_text + "</div>" + // Modify comment_text to match your database column name
                                    "</div>";
                
                var commentElement = document.createElement("div");
                commentElement.innerHTML = formattedComment;
                commentContainer.appendChild(commentElement);
            });
            
            // Attach event listener to delete buttons
            var deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Prompt user for secret key
                    var userInput = prompt("Enter the secret key:");
                    if (userInput === secretKey) {
                        var index = this.getAttribute('data-index');
                        deleteComment(index);
                    } else {
                        alert("Incorrect secret key. Only the commenter or an authorized user can delete this comment.");
                    }
                });
            });
        }
        
        // Function to delete a comment
        function deleteComment(index) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_comment.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        fetchComments(); // Refresh comments after successful deletion
                    } else {
                        console.error("Failed to delete comment: " + xhr.status);
                    }
                }
            };
            xhr.send("index=" + index);
        }
        </script>
</body>
</html>
