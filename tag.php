<?php
$active = "category";
$title = "Tag - coderbees";

include "connection.php";
include "header.php";

$tags = trim($_GET["tags"] ?? "all_tag");
// $tag_qry = mysqli_query($conn, "SELECT * FROM post WHERE postTag=$tags ORDER BY postId DESC ");
?>


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="container">
        <nav class="breadcurmbs">
            <a class="breadcrumbs-item" href="index.php"> <i class="fas fa-home"></i> Home</a>
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

                <!-- adds start -->
                <!-- <div class="mb-3">
                    <a href=""><img class="img-fluid w-100" src="img/ads-700x70.jpg" alt=""></a>
                </div> -->
                <!-- adds end -->
                <br>
                <div class="row">

                    <?php

                    //page paginate configuration
                    if (isset($_GET["page"])) {
                        $page = $_GET["page"];
                    } else {
                        $page = 1;
                    }
                    // echo $page;

                    //pagnation limit
                    // how many data you want to display per page
                    $result_per_page = 2;

                    //pagination offset
                    //from where start showing item every page. 
                    $page_first_result = ($page - 1) * $result_per_page;

                    $tag_qry = $mysqli->select([])->from("posts")->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("posts.postTag LIKE '%$tags%' AND posts.postStatus = 1")->limit($page_first_result, $result_per_page)->get();

                    //total page into paginate.
                    //total paginate item to show. 
                    $total_page = ceil($tag_qry->num_rows / $result_per_page);
                    echo $total_page;


                    if ($tag_qry->num_rows > 0) {
                        while ($posts = $tag_qry->fetch_assoc()) { ?>

                            <div class="col-lg-6">
                                <div class="d-flex mb-3">
                                    <div style="width:40%; height:100px">
                                        <img src="image/<?php echo $posts["postImage"] ?>" style="width: 100%; height:100px; object-fit: cover;">
                                    </div>
                                    <div class="w-100 d-flex flex-column justify-content-evenly bg-light px-3" style="height:auto">
                                        <a class="h5 m-0" href="posts.php?post_id=<?php echo $posts["postId"] ?>"><?php echo $posts["postTitle"] ?></a>
                                        <div class="mb-1" style="font-size: 13px;">
                                            <a href="category.php?category=<?php echo $posts["catName"] ?>"><?php echo $posts["catName"] ?></a>
                                            <span class="px-1">/</span>
                                            <span><?php echo $posts["postCreated_at"]; ?></span>
                                            <?php
                                            make_tag_for_posts($posts["postTag"]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php }
                    } elseif (isset($_GET["show"])) {

                        $tag_qry = $mysqli->select([])->from("posts")->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("posts.postTag = '$tags' AND posts.postStatus = 1")->get();

                        if ($tag_qry->num_rows > 0) {
                            while ($posts = $tag_qry->fetch_assoc()) { ?>

                                <div class="col-lg-6">
                                    <div class="d-flex mb-3">
                                        <div style="width:40%; height:100px;">
                                            <img src="image/<?php echo $posts["postImage"] ?>" style="width:100%; height:100px; object-fit: cover;">
                                        </div>
                                        <div class="w-100 d-flex flex-column justify-content-evenly bg-light px-3" style="height: auto;">
                                            <a class="h5 m-0" href="single_post.php?post_id=<?php echo $posts["postId"] ?>"><?php echo $posts["postTitle"] ?></a>
                                            <div class="mb-1" style="font-size: 13px;">
                                                <a href="category.php?category=<?php echo $posts["catName"] ?>"><?php echo $posts["catName"] ?></a>
                                                <span class="px-1">/</span>
                                                <span><?php echo $posts["postCreated_at"] ?></span>
                                                <?php
                                                make_tag_for_posts($posts["postTag"]);
                                                ?>
                                            </div>
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

                <!-- paginaiton paginate -->


                <?php
                if ($total_page > 1) :
                ?>
                    <div class="row">
                        <div class="col-12">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item <?php if ($page < 2) {
                                                                echo "d-none";
                                                            } ?>">
                                        <form action="tag.php" method="get">
                                            <input type="hidden" name="tags" value="<?php echo $tags ?>">
                                            <button class="page-link" href="tag.php?page=1" aria-label="Previous">
                                                <span class="fa fa-angle-double-left" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </button>
                                        </form>
                                    </li>
                                    <?php
                                    for ($i = 1; $i <= $total_page; $i++) {
                                    ?>

                                        <li class="page-item d-flex  <?php echo ($i == $page) ? "active" : "" ?>">
                                            <form action="tag.php" method="get">
                                                <input type="hidden" name="tags" value="<?php echo $tags ?>">
                                                <button class="page-link" name="page" value="<?php echo $i ?>">
                                                    <?php echo $i ?>
                                                </button>
                                            </form>
                                        </li>
                                        <!-- <li class="page-item active"><a class="page-link" href="search.php?page=<?php echo $i ?>"><?php echo $i ?></a></li> -->

                                    <?php
                                    }
                                    ?>
                                    <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                                    <li class="page-item <?php
                                                            echo ($page == $total_page && $total_page < 2) ? "d-none " : "";
                                                            ?>">
                                        <form action="tag.php" method="get">
                                            <input type="hidden" name="tags" value="<?php echo $tags ?>">
                                            <button class="page-link" aria-label="Next" name="page" value="<?php echo $total_page ?>">
                                                <span class="fa fa-angle-double-right" aria-hidden="true"></span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                <?php
                endif;
                ?>


                <!-- read more -->


            </div>

            <div class="col-lg-4 pt-3 pt-lg-0">
                <!-- Social Follow Start -->
                <?php include "partial/social_media.php" ?>
                <!-- Social Follow End -->

                <!-- Newsletter Start -->
                <?php include "partial/newsletter.php"; ?>
                <!-- Newsletter End -->

                <!-- Ads Start -->
                <!-- <div class="mb-3 pb-3">
                    <a href=""><img class="img-fluid" src="img/news-500x280-4.jpg" alt=""></a>
                </div> -->
                <!-- Ads End -->

                <!-- Popular News Start -->

                <!-- Popular News End -->

                <!-- Tags Start -->

                <!-- Tags End -->
            </div>
        </div>
    </div>
</div>
</div>
<!-- News With Sidebar End -->

<?php include "footer.php" ?>