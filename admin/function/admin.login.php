<?php

session_start();
$email = $_GET['email'] ?? "";

include "../../configuration/QueryHandeler.php";

if (!empty($email) && !empty($password)) {
    $db = new DBSelect;
    $result = $db->select(['adminEmail', 'adminPassword', 'adminId'])->from('admin')->where("adminEmail = '$email'")->get();
    $count = $result->num_rows;
    $row = $result->fetch_assoc();
    echo "Admin password : " . $row["adminPassword"];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if ($count > 0) {

            $db_password = $row['adminPassword'];
            if (password_verify($password, $db_password)) {
                $_SESSION["admin_key"] = $row["adminId"];
                echo 'success';
            } else {
                echo "Password not matched !";
            }
        } else {
            echo  "Email not register yet. <a class='text text-info' href='register.php'> register now</a>";
        }
    } else {
        echo "Please, Give a valid email address";
    }
} else {
    echo "Please, Fill all the required field";
}
