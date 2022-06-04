<?php 
include "../connection.php";

$id = $_GET["id"];

//get all caegory by id
$cat = mysqli_query($conn, "DELETE FROM category WHERE catId = '$id'");

//sever delete
$sql = "DELETE FROM category where catId = '$id'";
$result = mysqli_query($conn, $sql);


if ($result ){
    //force delete image from file
    @unlink('../image/category/'.$cat['image']);

    ?>
        <script>
            alert("Successfully Deleted !");
            window.location.href = "category_index.php";
        </script>
    <?php
}else {
    ?>
        <script>
            alert("Not Deleted !");
            window.location.href = "category_index.php"
        </script>
    <?php
}

