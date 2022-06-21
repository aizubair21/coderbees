<?php

include "connection.php";
$comment_id = $_GET["delete_id"];

if (mysqli_query($conn, "DELETE FROM comments WHERE commentId = '$comment_id'")) {
    $_SESSION['status'] = 'comment_deleted';
?>
    <script>
        window.location.href = 'comments_manage.php';
    </script>
<?php
} else {
    header("loaction: comments_manage.php");
}
