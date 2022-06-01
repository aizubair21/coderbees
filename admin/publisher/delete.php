<?php 
include "../connection.php";

$id = $_GET["id"];

$sql = "DELETE FROM publisher where id = '$id'";
$result = mysqli_query($conn, $sql);
if ($result ){
    header("location: ../publisher.php");
}

