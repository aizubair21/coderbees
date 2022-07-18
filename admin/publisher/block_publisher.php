<?php

include "../connection.php";
include "../../configuration/QueryHandeler.php";
if (!isset($_SESSION['admin_key'])) {
    header("location: index.php");
}

$update = new DBUpdate;

$id = $_REQUEST["id"];

$row = getPublisher($id);
$value = 0;

$sql = $update->on('publisher')->set(["publisherStatus"])->value([$value])->where("publisherId = $id")->go();
if ($sql == "success") {
    header("location: ../publisher.php");
} else {
?>
    <script>
        alert(<?php echo $sql ?>);
    </script>
<?php
} ?>