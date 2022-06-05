<?php 
include "../connection.php";

    $post = $_GET["post"];
    $status = '0';
    $approve_qry = "UPDATE posts SET postStatus = '$status' WHERE postId = '$post'";
    if (mysqli_query($conn, $approve_qry)) {
        header("location: ../controls.php");
    }
