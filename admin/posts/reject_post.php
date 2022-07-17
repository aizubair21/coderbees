<?php
include "../connection.php";

include "../../configuration/QueryHandeler.php";

$mysql = new DBDelete;
if (!isset($_SESSION["admin_key"])) {
    header("location: ../index.php");
}

$post = $_GET["post"];
$approve_qry = $mysql->from("posts")->where("postId = $post")->go();
if ($approve_qry == "success") {
    $_SESSION['status'] = 'rejected';
    header("location: post_view.php");
}
