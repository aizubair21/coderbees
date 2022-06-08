<?php 

    include "connection.php";

    if (isset($_POST["leave_comment"])) {
        print_r($_POST);
        $postId = $_POST["postId"];
        $publisherId = $_POST["publisherId"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $comment = $_POST["comment"];

        $qry = "INSERT INTO comment (comment, commentsPostId, postPublisherId, commentEmail, commentUser) VALUES ('$comment', '$postId', '$publisherId', '$email',' $name')";
        $comment_qry = mysqli_query($conn, $qry);
        if ($comment_qry) {
            header("location: single_post.php?post_id='$postId'");
        } else {
            echo mysqli_connect_error($conn);
        }
        
    }


?>