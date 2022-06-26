<?php
session_start();
include "connection.php";
$postId = $_POST["postId"];
$publisherId = $_POST["publisherId"];
$userName = $auth_user["userName"];
$userEmail = $auth_user["userEmail"];
$comment = $_POST["comment"];


if (isset($_POST["leave_comment"]) && !empty($comment)) {

    $qry = "INSERT INTO comments (comment, commentsPostId, postPublisherId, commentEmail, commentUser) VALUES ('$comment', '$postId', '$publisherId', '$userEmail',' $userName')";
    $comment_qry = mysqli_query($conn, $qry);
    if ($comment_qry) {
        $_SESSION['status'] = 'comment_success';
        header("location: posts.php?post_id=$postId");
    } else {
        $_SESSION['status'] = 'comment_reject';
    }
} else {
    $_SESSION['status'] = 'comment_reject';
    header("location: posts.php?post_id=$postId");
}
