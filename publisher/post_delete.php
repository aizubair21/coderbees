<?php


include "connection.php";
if(!$_SESSION["publisher_key"]){
    //
}


$postid = $_GET["id"];
$delete = "DELETE FROM posts WHERE postId='$postId'";
$result = mysqli_query($conn, $delete);

if ($result ){
    //force delete image file
    $post = mysqli_fetch_assoc(getPosts());
    @unlink('../image/'.$post['image']);

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

