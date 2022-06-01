<?php
print_r($_REQUEST);
require "connection.php";

if ($_REQUEST["id"] ) {
    
    $id = $_REQUEST["id"];
    $vefiry_at =  date("d-m-Y");
    $update = "UPDATE user SET verify_at = '$vefiry_at' WHERE id = '$id'";
    if (mysqli_query($conn, $update)) {
        header("location: welcome.php");
    }else{
        header("location: welcome.php");
    }

}else{
    header("location: welcome.php");
}