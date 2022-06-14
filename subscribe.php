<?php
include "connection.php";


if(isset($_GET["subscribe"])) {
    $subscriber_email =  $_GET["email"];
    $subscribeOn = date("M/d/y");

    $get_subscribe_qry = mysqli_num_rows (mysqli_query($conn, "SELECT * FROM subscriber WHERE subscriberEmail = '$subscriber_email'"));
    if ($get_subscribe_qry > 0) {
        ?>

            <script>
                alert("Not need subscribe. You are already subsscribe once.");
                window.location.href = 'index.php';
            </script>

        <?php
    }else{
        $subscribe_qry = mysqli_query($conn, "INSERT INTO subscriber (subscriberEmail, subscribeOn) VALUES ('$subscriber_email','$subscribeOn')");
        if ($subscribe_qry) {
            ?>

                <script>
                    alert("Thanks for your subscription. W'll send you an email wen we change something into our sitie.");
                    window.location.href = 'index.php';
                </script>

            <?php
        }else {
            header("location: index.php");
        }
    }
}

