<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row align-items-center bg-light px-lg-5">
        <div class="col-12 col-md-8">
            <div class="d-flex justify-content-between">
                <div class="bg-primary text-white text-center py-2" style="width: 100px;">Tranding</div>
                <div class="owl-carousel owl-carousel-1 tranding-carousel position-relative d-inline-flex align-items-center ml-3" style="width: calc(100% - 100px); padding-left: 90px;">

                    <!-- <div class="text-truncate"><a class="text-secondary" href="">Gubergren elitr amet eirmod et lorem diam elitr, ut est erat Gubergren elitr amet eirmod et lorem diam elitr, ut est erat</a></div> -->
                </div>
            </div>
        </div>
        <!-- <div class="col-md-4 text-right d-none d-md-block">
               <?php
                echo date("M/d/Y");
                ?>
            </div> -->
    </div>
    <div class="row align-items-center py-2 px-lg-5">
        <div class="col-lg-4">
            <a href="index.php" class="navbar-brand d-none d-lg-block">
                <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">coder</span>bees</h1>
            </a>
        </div>
        <div class="col-lg-8 text-center text-lg-right">
            <img class="img-fluid" src="img/ads-700x70.jpg" alt="">
        </div>
    </div>
</div>
<!-- Topbar End -->



<!-- nav start -->
<?php
$active = "home";
$title = "Search Reasult ";
include "connection.php";
include "header.php";


//page paginate configuration
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

//get seatch key
$key = $_GET["search"] ?? "";

//limit. how many posts want to shoe page.
$result_per_page = 10;

//offset. from where limit start. by default 0 
$page_first_result = ($page - 1) * $result_per_page;

//define total paginate page by divition total row with page limit.
$total_row = mysqli_num_rows(mysqli_query($conn, "SELECT postId FROM posts WHERE postStatus = 1 AND postTitle LIKE '%$key%' OR post LIKE '%$key%'"));
$total_page = ceil($total_row / $result_per_page);

?>
<!-- nav end -->

<!-- News With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row mb-3">
                    <div class="col-12">
                        <h4 class="fs-6">
                            <?php
                            if ($key != '') { ?>
                                Found <?php echo $total_row ?> Reasult for "<?php echo $_GET["search"] ?? "" ?>"

                            <?php }
                            ?>
                        </h4>


                    </div>

                    <?php
                    if (isset($_GET["search"])) {

                        $search_qry = mysqli_query($conn, "SELECT postId, postTitle, postTag, postCategory, postImage, postCreated_at, catName, catId FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE posts.postStatus = 1 AND posts.postTitle LIKE '%$key%' OR posts.post LIKE '%$key%' ORDER BY posts.postId DESC LIMIT $page_first_result, $result_per_page");
                        if ($_GET["search"] == "") {
                            echo "<strong class='alert alert-warning'>Nothing Else !</strong>";
                        } else {
                            if (($total_result = mysqli_num_rows($search_qry)) > 0) {
                                echo "<p class='text text-secondary font-normal'> $total_result result show this page </p>";
                                while ($search_item = mysqli_fetch_array($search_qry)) { ?>
                                    <div class="col-lg-6">
                                        <div class="d-flex mb-3">
                                            <div style="width:40%; height:100px">

                                                <img src="<?php echo GlobalROOT_PATH ?>/image/<?php echo $search_item["postImage"] ?>" style="width: 100%; height: 100px; object-fit: cover;">
                                            </div>
                                            <div class="w-100 d-flex flex-column justify-content-evenly bg-light px-3" style="height: 100px;">
                                                <a class="h6 m-0 " href="posts.php?post_id=<?php echo $search_item["postId"] ?>"><?php echo $search_item["postTitle"] ?></a>
                                                <div class="mb-1" style="font-size: 13px;">
                                                    <a class="btn btn-primary btn-sm" href="category.php?category=<?php echo $search_item['catName'] ?>"><?php echo $search_item["catName"] ?></a>
                                                    <span class="px-1">/</span>
                                                    <span><?php echo $search_item["postCreated_at"] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    <?php }
                            } else {
                                echo "<strong class='alert alert-warning'>No Data Found Against Your Search ! !</strong>";
                            }
                        }
                    }; ?>

                </div>

                <!-- show pagination page -->
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <?php

                                if ($key != "" && $total_row > $result_per_page) {
                                    for ($i = 1; $i <= $total_page; $i++) { ?>

                                        <form action="search.php" method="get">
                                            <input type="hidden" name="search" value="<?php echo $_GET["search"] ?>">
                                            <button type="submit" name="page" class="btn page-item <?php echo ($i == $page) ? "btn-primary" : "" ?> " value="<?php echo $i ?>"><?php echo $i ?></button>
                                            <!-- <li class="page-item "><a class="page-link  " href="search.php?search?=<?php echo $key ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li> -->

                                        </form>

                                <?php }
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 pt-3 pt-lg-0">
                <!-- Social Follow Start -->
                <!-- <?php include "partial/social_media.php"; ?> -->
                <!-- Social Follow End -->

                <!-- Newsletter Start -->
                <?php include "partial/newsletter.php"; ?>
                <!-- Newsletter End -->

                <!-- category Start -->
                <!-- <?php include "partial/category.php"; ?> -->
                <!-- category End -->

                <!-- Popular News Start -->
                <?php include "partial/popular.php"; ?>
                <!-- Popular News End -->

                <!-- Tags Start -->
                <?php include "partial/tags.php"; ?>
                <!-- Tags End -->
            </div>
        </div>
    </div>
</div>
</div>
<!-- News With Sidebar End -->


<!-- Footer Start -->
<?php include "footer.php" ?>
<!-- Footer End -->