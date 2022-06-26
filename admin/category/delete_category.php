<?php 
include "../connection.php";

if(!isset($_SESSION["admin_key"])){
    header("location: ../index.php");
}

$id = $_GET["id"];

//get all caegory by id
$cat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT catImage FROM category WHERE catId = '$id'"));

//sever delete
$sql = "DELETE FROM category where catid = '$id'";
$result = mysqli_query($conn, $sql);

//force delete image from file
@unlink('../../image/category/'.$cat['catImage']);

if ($result ){
    $_SESSION['status'] = 'category_deleted';
    header('location: index_category.php');
}else {
    $_SESSION['status'] = 'category_delete_error';
   header("location: index_category.php");
}

