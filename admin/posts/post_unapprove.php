<?php
include "../connection.php";
include "../../configuration/QueryHandeler.php";

$mysqli = new DBUpdate;

if (!isset($_SESSION["admin_key"])) {
    header("location: ../index.php");
}



$post = $_GET["post"];
$status = NULL;
$approve_qry = $mysqli->on("posts")->set(["postStatus"])->value(["NULL"])->where("postId = $postId")->go();
$_SESSION['status'] = 'post_unapproved';
header("location: post_view.php");
