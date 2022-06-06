<?php
include "connection.php";

if($_SESSION["publisher_key"]){
    //echo "auth_puiblisher :".$auth_publisher["publisherId"]."<br>";

        $postid = $_REQUEST["id"];
        $delete = "DELETE FROM posts WHERE postId='$postid'";
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
}else{
    header("location: index.php");
}

