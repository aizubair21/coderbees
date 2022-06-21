<?php
include "connection.php";

if ($_SESSION["publisher_key"]) {
    //echo "auth_puiblisher :".$auth_publisher["publisherId"]."<br>";
    if (isset($_REQUEST['post_delete'])) {
        # code...
        $postid = $_REQUEST["id"];
        $delete = "DELETE FROM posts WHERE postId='$postid'";
        $result = mysqli_query($conn, $delete);

        if ($result) {
            //force delete image file
            $post = mysqli_fetch_assoc(getPosts());
            @unlink('../image/' . $post['image']);
            $_SESSION['status'] = 'post_deleted';
            header('location: post_view.php');
        } else {
            $_SESSION['status'] = 'post_deleted_error';
            header('location: post_view.php');
        }
    } else {
        header("location: index.php");
    }
} else {
    header("location: index.php");
}
