<?php 
include "connection.php";

if($_SESSION["admin_key"]){
    $post = $_REQUEST["post"];
    $approve_qry = "DELETE FROM posts WHERE postId = '$post'";
    if (mysqli_query($conn, $approve_qry)) {
        header("location: controls.php");
    }

}else{
    header("location: login.php");
}