<?php
include "../connection.php";
$id = $_GET['post'] ?? "";

if ($user = isset($_SESSION['user_key'])) {
    $postId = $id;
    $userId = $user;
    $category = 'user';

    //check if already like
    $stmt = mysqli_query($conn, "SELECT userId FROM follow WHERE postId = $postId");
    $is_like = mysqli_fetch_assoc($stmt);

    //if already liked a user
    if ($is_like) {
        // $_SESSION['status'] = 'already_liked';
        echo "already_liked";
        // header("location: /coderbees/posts.php?post_id=$postId");
    } else {
        $sql = mysqli_query($conn, "INSERT INTO follow (postId, userId, category) VALUES('$postId','$userId','$category')");
        // $_SESSION['status'] = 'like';
        echo "success";
        // header("location: /coderbees/posts.php?post_id=$postId");
    }
} else {
    //if user not log in yet


    // $_SESSION['status'] = 'like_login_error';
    echo "login_error";
    // header("location: /coderbees/posts.php?post_id=$id");
}
