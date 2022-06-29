<?php
include "../connection.php";
if (!isset($_SESSION["admin_key"])) {
    header("location: ../index.php");
}

$post = $_GET["post"];
$status = NULL;
$approve_qry = "UPDATE posts SET postStatus = NULL WHERE postId = '$post'";
if (mysqli_query($conn, $approve_qry)) {
    $_SESSION['status'] = 'post_unapproved';
    header("location: post_view.php");
}
