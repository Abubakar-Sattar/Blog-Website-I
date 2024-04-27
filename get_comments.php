<?php
include_once "db_connection.php";

$sql = "SELECT * FROM comments ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
$comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo json_encode($comments);

mysqli_close($conn);
?>
