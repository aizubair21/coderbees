<?php
include "../connection.php";
include "../../configuration/QueryHandeler.php";

$mysql = new DBDelete;
$mysql_select = new DBSelect;
if (!isset($_SESSION["admin_key"])) {
    header("location: ../index.php");
}

$id = $_GET["id"];

//get all caegory by id
$qry = $mysql_select->select(['catId', 'catImage'])->from("category")->where("catId = $id")->get();
$cat = $qry->fetch_assoc();

//sever delete
$sql = $mysql->from("category")->where("catId = $id");
$result = $sql->go();
echo $result;
die();
//force delete image from file
@unlink('../../image/category/' . $cat['catImage']);

if ($result  == 'success') {
    $_SESSION['status'] = 'category_deleted';
    header('location: index_category.php');
} else {
    $_SESSION['status'] = 'category_delete_error';
    header("location: index_category.php");
}
