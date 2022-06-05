<?php 
include "../connection.php";

if(!isset($_SESSION["admin_key"])){
    header("location: ../index.php");
}

$id = $_GET["id"];

//get all caegory by id
$cat = getCategory($id);

//sever delete
$sql = "DELETE FROM category where catid = '$id'";
$result = mysqli_query($conn, $sql);

//force delete image from file
@unlink('../image/category/'.$cat['image']);

if ($result ){
    ?>
        <script>
            alert("Successfully Deleted !");
            window.location.href = "index.php";
        </script>
    <?php
}else {
    ?>
        <script>
            alert("Not Deleted !");
            window.location.href = "index.php"
        </script>
    <?php
}

