<?php

include "../connection.php";
$id = $_REQUEST["id"];

$row = getPublisher($id);
$value = 0;

$sql = "UPDATE publisher SET publisherStatus='$val' where publisherId ='$id'";
if (mysqli_query($conn, $sql)){
    header("location: ../publisher.php");
}else {
    ?>
        <script>
            alert(<?php echo mysqli_error($conn) ?>);
        </script>
    <?php
} ?>

