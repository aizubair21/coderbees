<?php
include "../connection.php";

if (!$_SESSION["admin_key"]) {
    //header("location: post_view.php");
}else{

    $postId = $_GET["post"];
    $block = '0';
    $block_qry = mysqli_query($conn, "UPDATE posts SET postStatus = '$block' WHERE postid = '$postId'");
    if ($block_qry) {
        header("location: post_view.php");
    }
}