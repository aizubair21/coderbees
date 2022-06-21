<?php 
include "../connection.php";
if(!isset($_SESSION["admin_key"])){
    header("location: ../index.php");
}

    $post = $_GET["post"];
    $approve_qry = "DELETE FROM posts WHERE postId = '$post'";
    if (mysqli_query($conn, $approve_qry)) {
        $_SESSION['status'] = 'rejected';
        header("location: post_view.php");
    }