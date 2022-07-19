<?php
$active = "category";
$title = "Tag - coderbees";
include "connection.php";
include "header.php";

$tags = $_GET["tags"] ?? "";
$tag_qry = mysqli_query($conn, "SELECT * FROM post WHERE postTag=$tags ORDER BY postId DESC ");
?>


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="container">
        <nav class=" ">
            <a class="breadcrumbs" href="index.php"> <i class="fas fa-home"></i> Home</a>
            <a class="breadcrumbs-item" href="tag.php?show=all_tag">Tags</a>
            <span class="breadcrumbs-item-active"><?php echo $tags ?></span>
        </nav>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- News With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                            <h3 class="m-0"> <?php echo "show blogs for tag " . $tags ?></h3>
                            <!-- <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a> -->
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <a href=""><img class="img-fluid w-100" src="img/ads-700x70.jpg" alt=""></a>
                </div>
                <br>
                <div class="row">

                    <?php

                    $tag_qry = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE posts.postTag = '$tags' AND posts.postStatus = 1");
                    if (mysqli_num_rows($tag_qry) > 0) {
                        while ($posts = mysqli_fetch_assoc($tag_qry)) { ?>

                            <div class="col-lg-6">
                                <div class="d-flex mb-3">
                                    <img src="image/<?php echo $posts["postImage"] ?>" style="width: 100px; height: 100px; object-fit: cover;">
                                    <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                        <div class="mb-1" style="font-size: 13px;">
                                            <a href="category.php?category=<?php echo $posts["catName"] ?>"><?php echo $posts["catName"] ?></a>
                                            <span class="px-1">/</span>
                                            <span><?php echo $posts["postCreated_at"] ?></span>
                                        </div>
                                        <a class="h6 m-0" href="posts.php?post_id=<?php echo $posts["postId"] ?>"><?php echo $posts["postTitle"] ?></a>
                                    </div>
                                </div>
                            </div>

                            <?php }
                    } elseif (isset($_GET["show"])) {

                        $tag_qry = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE posts.postStatus = 1");
                        if (mysqli_num_rows($tag_qry) > 0) {
                            while ($posts = mysqli_fetch_assoc($tag_qry)) { ?>

                                <div class="col-lg-6">
                                    <div class="d-flex mb-3">
                                        <img src="image/<?php echo $posts["postImage"] ?>" style="width: 100px; height: 100px; object-fit: cover;">
                                        <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                            <div class="mb-1" style="font-size: 13px;">
                                                <a href="category.php?category=<?php echo $posts["catName"] ?>"><?php echo $posts["catName"] ?></a>
                                                <span class="px-1">/</span>
                                                <span><?php echo $posts["postCreated_at"] ?></span>
                                            </div>
                                            <a class="h6 m-0" href="single_post.php?post_id=<?php echo $posts["postId"] ?>"><?php echo $posts["postTitle"] ?></a>
                                        </div>
                                    </div>
                                </div>
                    <?php }
                        }
                    } else {
                        //if not found in database
                        echo "<strong class='alert alert-waring'> Not Found ! </strong>";
                    } ?>


                </div>
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span class="fa fa-angle-double-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span class="fa fa-angle-double-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 pt-3 pt-lg-0">
                <!-- Social Follow Start -->
                <?php include "social_media.php" ?>
                <!-- Social Follow End -->

                <!-- Newsletter Start -->
                <div class="pb-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Newsletter</h3>
                    </div>
                    <div class="bg-light text-justify p-4 mb-3">
                        <p>Wanna subscribe your newslatter. Everytime you get an email, if there anything chagnge of updated or added.<br>If you do please subscribe !</p>
                        <div class="input-group" style="width: 100%;">
                            <form action="subscribe.php" method="get">
                                <input type="email" class="form-control form-control-lg" placeholder="Your Email" name="email">
                                <small>Subscribe can get all emaail by his provided email.</small>
                                <div class="input-group-append py-3">
                                    <button name="subscribe" class="btn btn-primary">Subscribe</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- Newsletter End -->

                <!-- Ads Start -->
                <div class="mb-3 pb-3">
                    <a href=""><img class="img-fluid" src="img/news-500x280-4.jpg" alt=""></a>
                </div>
                <!-- Ads End -->

                <!-- Popular News Start -->
                <div class="pb-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Latest</h3>
                    </div>
                    <?php
                    $tranding_qry = mysqli_query($conn, "SELECT posts.postTitle, posts.postCreated_at, posts.postCategory, posts.postImage, category.catName FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE posts.postStatus = 1 ORDER BY posts.postId DESC LIMIT 4");
                    while ($tranding = mysqli_fetch_assoc($tranding_qry)) { ?>

                        <div class="d-flex mb-3">
                            <img src="image/<?php echo $tranding["postImage"] ?>" style="width: 50%; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="category.php?category=<?php echo $tranding['catName'] ?>"> <?php echo $tranding["catName"] ?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo $tranding["postCreated_at"] ?></span>
                                </div>
                                <a class="h6 m-0" href=""><?php echo $tranding["postTitle"] ?></a>
                            </div>
                        </div>
                    <?php }
                    ?>

                </div>
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