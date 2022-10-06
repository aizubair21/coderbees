<?php
include "../connection.php";

$subscriber_email =  $_GET["email"];
$subscribeOn = date("M/d/y");
// echo $subscriber_email;

if (!filter_var($subscriber_email, FILTER_VALIDATE_EMAIL)) {
    echo "error";
} else {


    $get_subscribe_qry = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM subscriber WHERE subscriberEmail = '$subscriber_email'"));
    if ($get_subscribe_qry > 0) {
        // $_SESSION['status'] = 'subscribe_error';
        // header("location: $uri");
        echo "subscribed";
    } else {
        $subscribe_qry = mysqli_query($conn, "INSERT INTO subscriber (subscriberEmail, subscribeOn) VALUES ('$subscriber_email','$subscribeOn')");
        if ($subscribe_qry) {
            // $_SESSION['status'] = 'subscrived';
            // header("location: $uri");
            echo "success";
        } else {
            // header("location: $uri");
            echo 'error';
        }
    }
}
