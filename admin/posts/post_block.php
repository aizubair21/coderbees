<?php
include "../connection.php";

//include QueryHander classes
include "../../configuration/QueryHandeler.php";
$mysql = new DBUpdate;

if (!$_SESSION["admin_key"]) {
    header("location: ../index.php");
} else {

    $postId = $_GET["post"];
    $block = '0';

    $block_qry = $mysql->on('posts')->set(['postStatus'])->value([$block])->where("postStatus = $postId");
    if ($block_qry->go() == "success") {
        $_SESSION['status'] = 'block';
    }
    header("location: post_view.php");
}
