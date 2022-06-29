<?php
$active = "home";
$title = "Home ";
include "connection.php";
include "header.php";

?>
<style>
    body {
        background-color: white;
        box-shadow: 0px 0px 5px gray;
    }
</style>

<div class="container-fluid d-flex justify-content-center align-items-center text-center my-3">
    <div class="">
        <div class="fs-2 text-danger fw-bolder">
            OPPS ! Page Not Found.
        </div>
        <div>
            <img style="width:500px; height:300px;" src="/coderbees/img/404-not-found.jpg" alt="">
        </div>
        <div class="py-1 text-danger fw-bolder fs-2">
            We can't find the page you are looking for.
        </div>
        <a href="<?php echo GlobalROOT_PATH ?>/index.php" class="btn btn-success btn-sm"> Visit Homepage </a>
    </div>
</div>



<?php

include "footer.php";

?>

<!-- Footer End -->