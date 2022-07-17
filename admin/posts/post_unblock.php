<?php
include "../connection.php";
include "../../configuration/QueryHandeler.php";

$mysqli = new DBUpdate;

if (!isset($_SESSION["admin_key"])) {
    header("location: ../index.php");
}


$post = $_GET["post"];
$status = '1';
$mysqli->on("posts")->set(["postStatus"])->value(["$status"])->where("postId = $post")->go();
header("location: post_view.php");
