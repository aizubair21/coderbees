<?php
// include "../connection.php";
$id = $_GET('pId');
function commentCount($pId)
{
    $conn = mysqli_connect('localhost', 'root', '', 'coderbees');

    $comnt = mysqli_query($conn, "SELECT * FROM comments WHERE commentsPostId = '$pId' AND commentStatus = 1");
    echo mysqli_num_rows($comnt);

}
commentCount($id);