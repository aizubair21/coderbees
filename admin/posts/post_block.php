<?php
include "../connection.php";

if (!$_SESSION["admin_key"]) {
    header("location: ../index.php");
}else{

    $postId = $_GET["post"];
    $block = '0';
    $block_qry = mysqli_query($conn, "UPDATE posts SET postStatus = '$block' WHERE postid = '$postId'");
    if ($block_qry) {
        $_SESSION['status'] = 'block';
        header("location: post_view.php");
    }
}