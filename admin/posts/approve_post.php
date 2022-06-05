<?php 
include "../connection.php";

if(!$_SESSION["admin_key"]){
    $post = $_REQUEST["post"];
    $status = '1';
    $approve_qry = "UPDATE posts SET postStatus = '$status' WHERE postId = '$post'";
    if (mysqli_query($conn, $approve_qry)) {
        header("location: ../controls.php");
    }

}else{
    header("location: ../login.php");
}