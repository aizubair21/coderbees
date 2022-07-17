<?php


include "../connection.php";

//include QueryHandler classes
include "../../configuration/QueryHandeler.php";
$mysql_select = new DBSelect;
$mysql_delete = new DBDelete;

if (isset($_POST['post_delete'])) {

    $postId = $_POST["delete_id"];
    $delete = $mysql_delete->from("posts")->where("postId = $postId");
    $result = $delete->go();
    echo $result;
    die();

    if ($result == "success") {
        //force delete image file
        $posts = $mysql_select->select(['postImage', 'postStatus', 'postId'])->from("posts")->where("postId = $postId")->get();
        $post = $posts->fetch_assoc();
        @unlink('../../image/' . $post['postImage']);
        $_SESSION['status'] = 'post_deleted';
        header('location : post_view.php');
    } else {

        $_SESSION['status'] = 'post_deleted_err';
        header('location: post_view.php');
    }
} else {
    $_SESSION['status'] = 'post_deleted_err';
    header('location: post_view.php');
}
