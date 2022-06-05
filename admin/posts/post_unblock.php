<?php 
include "../connection.php";

if(!$_SESSION["admin_key"]){
    $post = $_GET["post"];
    $status = '1';
    $aeeeeeeeeeeeeeeeeeeeeee`pprove_qry = "UPDATE 'posts' SET 'postStatus'='$status' WHERE 'postId'='$post'";
    if (mysqli_query($conn, $approve_qry)) {
        header("location: ../post_view.php");
    }

}else{
    header("location: ../login.php");
}