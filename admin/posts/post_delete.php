<?php


include "../connection.php";

if (isset($_REQUEST['post_delete'])) {
    
    $postid = $_GET["id"];
    $delete = "DELETE FROM posts WHERE postId=$postId";
    $result = mysqli_query($conn, $delete);

    if ($result ){
        //force delete image file
        $post = mysqli_fetch_assoc(mysqli_query($conn, "SELECT postImage FROM posts WHERE postId = '$postId'"));
        @unlink('../../image/'.$post['postImage']);
        $_SESSION['status'] = 'post_deleted';
        header('location : post_view.php');
        
    }else {
        
        $_SESSION['status'] = 'post_deleted_err';
        header('location: post_view.php');
    }
    
    
}else {
    $_SESSION['status'] = 'post_deleted_err';
    header('location: post_view.php');
}