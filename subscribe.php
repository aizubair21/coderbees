<?php
include "connection.php";



if (isset($_GET["subscribe"])) {
    $uri = ($_SERVER['HTTP_REFERER']) ?? 'index.php';

    $subscriber_email =  $_GET["email"];
    $subscribeOn = date("M/d/y");

    $get_subscribe_qry = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM subscriber WHERE subscriberEmail = '$subscriber_email'"));
    if ($get_subscribe_qry > 0) {
        $_SESSION['status'] = 'subscribe_error';
        header("location: $uri");
    } else {
        $subscribe_qry = mysqli_query($conn, "INSERT INTO subscriber (subscriberEmail, subscribeOn) VALUES ('$subscriber_email','$subscribeOn')");
        if ($subscribe_qry) {
            $_SESSION['status'] = 'subscrived';
            header("location: $uri");
        } else {
            header("location: $uri");
        }
    }
}
