<?php
// session_start();
include "../connection.php";


$postId = $_GET["pId"];
$publisherId = $_GET["pbId"];
$userName = $auth_user["userName"];
$userEmail = $auth_user["userEmail"];
$comment = $_GET["cmt"];


if (isset($_GET["leave_comment"])) {

    $qry = "INSERT INTO comments (comment, commentsPostId, postPublisherId, commentEmail, commentUser) VALUES ('$comment', '$postId', '$publisherId', '$userEmail',' $userName')";
    $comment_qry = mysqli_query($conn, $qry);
    if ($comment_qry) {
        // $_SESSION['status'] = 'comment_success';
        // header("location: posts.php?post_id=$postId");
        echo "success";

    } else {
        // $_SESSION['status'] = 'comment_reject';
        echo "reject";
    }

} else {
    // $_SESSION['status'] = 'comment_reject';
    // header("location: posts.php?post_id=$postId");
    echo "error";
}
