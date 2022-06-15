<?php 
include "../connection.php";
if (!isset($_SESSION['admin_key'])) {
    header("location: index.php");
}

$id = $_GET["id"];

$sql = "DELETE FROM publisher where publisherId = '$id'";
$result = mysqli_query($conn, $sql);
if ($result ){
    header("location: ../publisher.php");
}

