<?php
include "../connection.php";

$postId = $_GET["post_id"];

$like_sql = mysqli_query($conn, "SELECT * FROM follow WHERE postId = $postId");
echo mysqli_num_rows($like_sql);
