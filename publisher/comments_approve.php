<?php 

include "connection.php";
$comment_id = $_GET["comment_id"];

if ( mysqli_query($conn, "UPDATE comments SET commentStatus = 1 WHERE commentId = $comment_id")) {
    ?>
        <script>
            window.location.href = 'comments_manage.php';
        </script>
    <?php
}else {
    header("loaction: comments_manage.php");
}