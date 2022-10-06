<?php
include "../connection.php";
$id = $_GET['post'] ?? "";

if ($user = $_SESSION['user_key']) {
    $postId = $id;
    $userId = $user;
    $category = 'user';

    //check if already like
    $stmt = mysqli_query($conn, "SELECT userId FROM follow WHERE postId = '$postId'");
    $is_like = mysqli_fetch_assoc($stmt);
    if (!$is_like) {
        $sql = mysqli_query($conn, "DELETE FROM follow WHERE postId = $postId AND userId = $userId");
        if ($sql) {
            // $_SESSION['status'] = 'unlike';
            // header("location: /coderbees/posts.php?post_id=$postId");

            echo "success";
        }
    } else {
        // $_SESSION['status'] = 'not_liked_yet';
        // header("location: /coderbees/posts.php?post_id=$postId");

        echo "not_liked_yet";
    }
} else {
    // $_SESSION['status'] = 'like_login_error';
    // header("location: /coderbees/posts.php?post_id=$id");

    echo "login_error";
}
