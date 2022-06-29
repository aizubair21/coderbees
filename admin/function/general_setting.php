<?php

include "../connection.php";
if (isset($_POST['site_setting'])) {
    print_r($_POST);

    $title = $_POST['title'];
    $description = $_POST['description'];
    $keyword = $_POST['keyword'];
    $about = $_POST['about'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];


    //if data inserted, update or insert

    $is_setting_set = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM site_setting "));

    if ($is_setting_set) {
        $stmt = "UPDATE `site_setting` SET `title`='$title',`description`='$description',`keyword`='$keyword',`about`='$about',`address`='$address',`phone`='$phone',`email`='$email' WHERE 1";
    } else {
        $stmt = "INSERT INTO site_setting (title,description,keyword,about,address,phone,email) VALUES('$title', '$description','$keyword','$about','$address','$phone','$email')";
    }

    if (mysqli_query($conn, $stmt)) {
        echo "Data inserted";
    } else {
        echo mysqli_error($conn);
    }
    header("location: ../settings/site_setting.php");
}
