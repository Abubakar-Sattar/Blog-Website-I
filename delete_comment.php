<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "db_connection.php";

    $index = mysqli_real_escape_string($conn, $_POST["index"]);

    // Assuming your comments are stored in an array in PHP, you can delete a comment by index
    // Example: unset($comments[$index]);
    // Then, update your database accordingly using SQL DELETE statement

    echo "Comment deleted successfully";

    mysqli_close($conn);
}
?>
