<?php
$active = "category";
$title = "Categories - coderbees";
include "connection.php";
include "header.php";

//pagination
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
//pagination lmit
$result_per_page = 6;
//pagination offset
$page_first_result = ($page - 1) * $result_per_page;

//how many pagination display.
$total_row = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE postStatus = 1 "));
$total_page = ceil($total_row / $result_per_page);
?>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="container">

        <nav class="breadcrumbs">
            <a class="breadcrumbs-item" href="index.php">Home</a>
            <a class="breadcrumbs-item-active" href="blog.php">All Blog</a>
        </nav>
    </div>
</div>

<!-- News With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">

                <div class="row">


                    <?php

                    $get_cat_wise_post = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory Where postStatus = 1 LIMIT $page_first_result, $result_per_page");
                    if (mysqli_num_rows($get_cat_wise_post) < 1) {
                        echo "<strong class='alert alert-warning'>No Result Found !</strong>";
                    }

                    while ($posts = mysqli_fetch_assoc($get_cat_wise_post)) { ?>
                        <div class="col-lg-6">
                            <div class="d-flex mb-3">
                                <img src="image/<?php echo $posts["postImage"] ?>" style="width: 100px; height: 100px; object-fit: cover;">
                                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                    <div class="mb-1" style="font-size: 13px;">
                                        <a href="category.php?category=<?php echo $posts["catName"] ?>"> <?php echo $posts["catName"] ?> </a>
                                        <span class="px-1">/</span>
                                        <span> <?php echo $posts['postCreated_at'] ?> </span>
                                    </div>
                                    <a class="h6 m-0" href="posts.php?post_id=<?php echo $posts["postId"] ?>"><?php echo $posts["postTitle"] ?></a>

                                    <a class='text text-secondary width-10 py-2' href="tag.php?tags=<?php echo $posts["postTag"] ?>"><span><?php echo $posts["postTag"] ?></span></a>
                                </div>
                            </div>
                        </div>

                    <?php  } ?>

                </div>


                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <?php
                                if ($key != "" && $total_row > $result_per_page) {
                                    for ($i = 1; $i <= $total_page; $i++) { ?>

                                        <form action="blog.php" method="get">
                                            <li class="bg-light">
                                                <button type="submit" name="page" class="btn  <?php echo ($i == $page) ? "btn-primary " : "" ?> " value="<?php echo $i ?>"><?php echo $i ?></button>
                                            </li>


                                        </form>

                                <?php }
                                }
                                ?>
                                <!-- <li class="page-item disabled">
                                  <a class="page-link" href="#" aria-label="Previous">
                                    <span class="fa fa-angle-double-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                </li>
                                
                                <li class="page-item"><a class="page-link " href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                  <a class="page-link" href="#" aria-label="Next">
                                    <span class="fa fa-angle-double-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                </li> -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 pt-3 pt-lg-0">
                <!-- Social Follow Start -->
                <?php include "partial/social_media.php" ?>
                <!-- Social Follow End -->

                <!-- Newsletter Start -->
                <?php include "partial/newsletter.php" ?>
                <!-- Newsletter End -->

                <!-- Ads Start -->

                <!-- Ads End -->

                <!-- Popular News Start -->
                <!-- <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Tranding</h3>
                        </div>
                        <div class="d-flex mb-3">
                            <img src="img/news-100x100-1.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>January 01, 2045</span>
                                </div>
                                <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                            </div>
                        </div>
                    </div> -->
                <!-- Popular News End -->

                <!-- Tags Start -->
                <div class="pb-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Tags</h3>
                    </div>
                    <div class="d-flex flex-wrap m-n1">
                        <?php
                        $tag_qry = mysqli_query($conn, "SELECT postTag FROM posts ORDER BY postId DESC LIMIT 10");
                        if (mysqli_num_rows($tag_qry) > 0) {
                            while ($tag = mysqli_fetch_assoc($tag_qry)) {
                                echo ' <a href="tag.php?tags=' . $tag["postTag"] . '" class="btn btn-sm btn-outline-secondary m-1">' . $tag["postTag"] . '</a>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <!-- Tags End -->
            </div>
        </div>
    </div>
</div>
</div>
<!-- News With Sidebar End -->

<?php include "footer.php" ?>