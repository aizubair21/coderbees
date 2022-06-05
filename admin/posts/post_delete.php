<?php


include "./connection.php";
if(!$_SESSION["admin_key"]){
    //
}


$postid = $_GET["id"];
$delete = "DELETE FROM posts WHERE postId='$postId'";
$result = mysqli_query($conn, $delete);

if ($result ){
    //force delete image file
    $post = mysqli_fetch_assoc(getPosts());
    @unlink('/coderbees/image/'.$post['image']);

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

