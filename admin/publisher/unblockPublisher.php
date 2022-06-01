<?php
session_start();
include "../connection.php";

$id = $_REQUEST["id"];
$row = getPublisher($id);
$value = 1;

    $sql = "UPDATE publisher SET status='$value' where id ='$id'";
    if (mysqli_query($conn, $sql)){
        header("location: ../publisher.php");
    }else {
        ?>
            <script>
                alert(<?php echo mysqli_error($conn) ?>);
            </script>
        <?php
    } ?>





