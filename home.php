<?php  ?>
<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row align-items-center bg-light px-lg-5">
        <div class="col-12 col-md-8">
            <div class="d-flex justify-content-between">
                <div class="bg-primary text-white text-center py-2" style="width: 100px;">Tranding</div>
                <div class="owl-carousel owl-carousel-1 tranding-carousel position-relative d-inline-flex align-items-center ml-3" style="width: calc(100% - 100px); padding-left: 90px;">

                    <div class="text-truncate"><a class="text-secondary" href="">Gubergren elitr amet eirmod et lorem diam elitr, ut est erat Gubergren elitr amet eirmod et lorem diam elitr, ut est erat</a></div>

                </div>
            </div>
        </div>
    </div>
    <div class="row align-items-center py-2 px-lg-5">
        <div class="col-lg-4">
            <a href="index.php" class="navbar-brand d-none d-lg-block">
                <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">coder</span>bees</h1>
            </a>
        </div>
        <div class="col-lg-8 text-center text-lg-right">
            <img class="img-fluid" src="/coderbees/img/ads-700x70.jpg" alt="">
        </div>
    </div>
</div>

<!-- Topbar End -->



<!-- nav start -->
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