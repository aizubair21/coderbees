<?php


include "./connection.php";

if(!isset($_SESSION["admin_key"])){
    header("location: ../index.php");
}

$postid = $_GET["id"];
$delete = "DELETE FROM posts WHERE postId='$postId'";
$result = mysqli_query($conn, $delete);

if ($result ){
    //force delete image file
    $post = mysqli_fetch_assoc(mysqli_query($conn, "SELECT postImage FROM posts WHERE postId = '$postId'"));
    @unlink('../../image/'.$post['postImage']);

    ?>
        <script>
            alert("Successfully Deleted !");
            window.location.href = "post_view.php";
        </script>
    <?php
}else {
    ?>
        <script>
            alert("Not Deleted !");
            window.location.href = "post_view.php"
        </script>
    <?php
}

