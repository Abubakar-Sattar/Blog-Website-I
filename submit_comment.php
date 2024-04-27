<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Include database connection file
include_once "db_connection.php";

// Check request method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if data is received
    if(isset($_POST['name']) && isset($_POST['profile_url']) && isset($_POST['comment'])){
        // Escape user inputs for security
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $profileUrl = mysqli_real_escape_string($conn, $_POST['profile_url']);
        $commentText = mysqli_real_escape_string($conn, $_POST['comment']);

        // Attempt to insert comment into database
        $sql = "INSERT INTO comments (name, profile_url, comment_text) VALUES ('$name', '$profileUrl', '$commentText')";
        if(mysqli_query($conn, $sql)){
            echo "Comment posted successfully";
        } else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: Data not received";
    }
} else {
    echo "Error: Invalid request method";
}

// Close database connection
mysqli_close($conn);
?>
