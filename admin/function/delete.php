<?php

require "connection.php";
$did = $_REQUEST["id"];

session_start();


echo "POST <br>";
print_r($_POST);
echo "POST <br>";
print_r($_REQUEST);


if($_SESSION["key"] && $_REQUEST["id"]) {

    $row = getCurd($did);

    @unlink('image/'.$row['image']);
    
    $table = "DELETE FROM crud WHERE id = '$did'";
    if(mysqli_query($conn,$table)) {
     
        $_SESSION['status'] = "Successfully Deleted";
        header("location: dashboard.php");
    }

}else {
    $_SESSION['error'] = "Something wrong !";
    header("location: dashboard.php");
}