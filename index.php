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



// $data = [
//     'id' => 3,
//     'name' => 'zubair3',
// ];
// $json = json_decode(file_get_contents('auth.json'));
// $json [] = $data;

// //file_put_contents('auth.json', json_encode($json));

// foreach ($json as $item) {
//     if ($item->id == 2) {
//         echo $item->name;
//     }
// }


?>
<!-- nav end -->







<style>
    h3 {
        font-family: "oswald";
    }

    .h4 {
        line-height: 20px;
    }
</style>

<!-- Main News Slider Start -->
<div class="container-fluid py-3">
    <style>

    </style>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative mb-3 mb-lg-0">

                    <?php
                    $post_status = 1;
                    $limit = '5';
                    $post_restlt = $mysqli->select([])->from('posts')->join("LEFT JOIN category ON category.catId = posts.postId")->where("postStatus = $post_status")->limit(5)->get();
                    while ($posts = $post_restlt->fetch_assoc()) { ?>

                        <div class="position-relative overflow-hidden" style="height: 435px;">
                            <img class="img-fluid h-100" src="<?php echo GlobalROOT_PATH ?>/image/<?php echo $posts["postImage"] ?>" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-1">
                                    <a class="btn btn-primary btn-sm" href="category/<?php echo $posts["catSlug"] ?>"> <i class="px-1 fas fa-dot-circle"></i> <?php echo $posts["catName"] ?></a>
                                    <span class="px-2 text-white">/</span>
                                    <a class="text-white" href=""> <i class="px-1 fas fa-clock"></i> <?php echo $posts["postCreated_at"] ?></a>
                                    <?php
                                    $tag = '';
                                    $tag = explode(",", $posts['postTag']);
                                    foreach ($tag as $tags) :
                                    ?>
                                        <a class="btn btn-outline-secondary btn-sm" href="tag.php?tags=<?php echo $tags ?>"> <i class="px-1 fas fa-caret-right"></i> <?php echo $tags ?> </a>
                                    <?php
                                    endforeach;
                                    ?>

                                </div>
                                <a class="h2 m-0 text-white font-weight-bold" href="posts?post_id=<?php echo $posts['postId'] ?>"><?php echo $posts["postTitle"] ?></a>
                            </div>
                        </div>

                    <?php }
                    ?>

                </div>
            </div>
            <div class="col-lg-4 overflow-hidden">
                <div class="row">
                    <div class="col-12">
                        <?php
                        $popular_qry = $mysqli->select(['postId', 'post', 'postTitle', 'postImage', 'postCreated_at', 'postCategory', 'catName'])->from('posts')->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("posts.postStatus = 1")->order("posts.view")->DESC()->limit("4")->get();
                        while ($popular = $popular_qry->fetch_assoc()) { ?>
                            <div class="d-flex mb-3">
                                <img src="<?php echo GlobalROOT_PATH ?>/image/<?php echo $popular["postImage"] ?>" style="width: 150px; height: 100px; object-fit: cover">
                                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                    <div class="mb-1" style="font-size: 13px;">
                                        <a class="text-primary" href="category.php?category=<?php echo $popular["catName"] ?>"><?php echo $popular["catName"] ?></a>
                                        <span class="px-1">/</span>
                                        <span><?php echo $popular["postCreated_at"] ?></span>
                                    </div>
                                    <a class="h6 m-0" href="posts.php?post_id=<?php echo $popular["postId"] ?>"><?php echo $popular["postTitle"] ?></a>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Main News Slider End -->

<!-- Category News Slider Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 py-3">
                <div class="bg-light py-2 px-4 mb-3">
                    <h3 class="m-0">Business</h3>
                </div>
                <style>
                    .owl-nav {
                        position: absolute;
                    }
                </style>
                <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                    <?php
                    // $business_cat = $mysqli->select([])->from("posts")->join("OIN category ON category.catId = posts.postCategory")->where("posts.postStatus = 1 AND posts.postCategory = ($mysqli->select(['catId'])->where('catName' = 'business')->get())")->order("posts.postId")->DESC()->limit("5")->get();
                    $business_cat = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = (SELECT catId FROM category WHERE catName='business') ORDER BY posts.postId DESC LIMIT 5 ");
                    while ($business = $business_cat->fetch_assoc()) { ?>

                        <div class="position-relative">
                            <img class="img-fluid w-100 " src="/coderbees/image/<?php echo $business["postImage"] ?>" style="object-fit: cover;height:150px;">
                            <div class="p-2 position-relative bg-light">
                                <div class="mb-2" style="font-size: 13px;">
                                    <a class="text-primary" href="category.php?category=<?php echo $business["catName"] ?>"><?php echo $business["catName"] ?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo $business["postCreated_at"] ?></span>
                                </div>
                                <a class="h6 m-0" href="posts.php?post_id=<?php echo $business["postId"] ?>"><?php echo $business["postTitle"] ?></a>
                            </div>
                        </div>


                    <?php }
                    ?>

                </div>
            </div>
            <div class="col-lg-6 py-3">
                <div class="bg-light py-2 px-4 mb-3">
                    <h3 class="m-0">Technology</h3>
                </div>
                <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                    <?php
                    $technology_cat = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = (SELECT catId FROM category WHERE catName='technology') ORDER BY posts.postId DESC LIMIT 5 ");
                    while ($business = mysqli_fetch_assoc($technology_cat)) { ?>

                        <div class="position-relative">
                            <img class="img-fluid w-100" style="height:150px" src="/coderbees/image/<?php echo $business["postImage"] ?>" style="object-fit: cover;">
                            <div class="p-2 position-relative bg-light">
                                <div class="mb-2" style="font-size: 13px;">
                                    <a class="text-primary" href="category.php?category=<?php echo $business["catName"] ?>"><?php echo $business["catName"] ?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo $business["postCreated_at"] ?></span>
                                </div>
                                <a class="h6 m-0" href="posts.php?post_id=<?php echo $business["postId"] ?>"><?php echo $business["postTitle"] ?></a>
                            </div>
                        </div>

                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Category News Slider End


    < Category News Slider Start -->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 py-3">
                <div class="bg-light py-2 px-4 mb-3">
                    <h3 class="m-0">Intertainment</h3>
                </div>
                <style>
                    .owl-nav {
                        position: absolute;
                    }
                </style>
                <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                    <?php
                    $intertainment_cat = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = (SELECT catId FROM category WHERE catName='intertainment') ORDER BY posts.postId DESC LIMIT 5 ");
                    while ($intertainment = mysqli_fetch_assoc($intertainment_cat)) { ?>

                        <div class="d-flex mb-3">
                            <img src="/coderbees/image/<?php echo $intertainment["postImage"] ?>" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <a class="h6 m-0" href="posts.php?post_id=<?php echo $intertainment["postId"] ?>"><?php echo $intertainment["postTitle"] ?></a>
                                <div class="mt-1" style="font-size: 13px;">
                                    <a class="text-primary" href="category.php?category=<?php echo $intertainment["catName"] ?>"><?php echo $intertainment["catName"] ?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo $intertainment["postCreated_at"] ?></span>
                                </div>
                            </div>
                        </div>


                    <?php }
                    ?>

                </div>
            </div>
            <div class="col-lg-6 py-3">
                <div class="bg-light py-2 px-4 mb-3">
                    <h3 class="m-0">Sports</h3>
                </div>

                <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                    <?php
                    // $sportc_cat_qry = $mysqli->select(['postId', 'postImage', 'postCategory', 'postTag', 'postTitle', 'postCreated_at', 'catName', 'postStatus', 'catId'])->from('posts')->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("posts.postStatus = 1 AND posts.postCategory = ($mysqli-select['catId'])->from('category')->where('catName = 'sports')->get()")->order("posts.postId")->DESC()->limit(8)->get();
                    $sportc_cat = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = (SELECT catId FROM category WHERE catName='sports') ORDER BY posts.postId DESC LIMIT 5 ");
                    while ($sports = mysqli_fetch_assoc($sportc_cat)) { ?>

                        <div class="d-flex mb-3">
                            <img src="/coderbees/image/<?php echo $sports["postImage"] ?>" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <a class="h6 m-0" href="posts.php?post_id=<?php echo $sports["postId"] ?>"><?php echo $sports["postTitle"] ?></a>
                                <div class="mt-1" style="font-size: 13px;">
                                    <a class="text-primary" href="category.php?category=<?php echo $sports["catName"] ?>"><?php echo $sports["catName"] ?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo $sports["postCreated_at"] ?></span>
                                </div>
                            </div>
                        </div>

                    <?php }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- News With Sidebar Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- show all category -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Your favourite in here</h3>
                            <a class="text-secondary font-weight-medium text-decoration-none" href="#">All Categories</a>
                        </div>
                    </div>

                    <div class="col-12 my-3 px-2 d-flex">
                        <?php
                        $categories_qry = mysqli_query($conn, "SELECT * FROM category limit 15");
                        // echo $categories_qry;
                        while ($categories = mysqli_fetch_assoc($categories_qry)) {

                        ?>
                            <a href="category.php?category=<?php echo $categories['catName'] ?>" class="btn btn-outline-primary btn-sm mx-2 my-1 shadow rounded"> <?php echo $categories['catName'] ?> </a>
                        <?php
                        }
                        ?>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Latest</h3>
                            <a class="text-secondary font-weight-medium text-decoration-none" href="#">View All</a>
                        </div>
                    </div>

                    <?php
                    $latest_qry = $mysqli->select(['postId', 'postImage', 'postCategory', 'postTag', 'postTitle', 'postCreated_at', 'catName', 'postStatus', 'catId'])->from('posts')->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("posts.postStatus = 1")->order("posts.postId")->DESC()->limit(8)->get();
                    // $latest_qry = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 ORDER BY posts.postId DESC LIMIT 8 ");
                    // echo $latest_qry;
                    while ($latest = $latest_qry->fetch_assoc()) { ?>

                        <div class="col-lg-6 mb-2">
                            <style>
                                .wrapper {
                                    background-color: rgba(255, 255, 255, .7);
                                }

                                .wrapper {
                                    position: absolute;
                                    bottom: 0;
                                    left: 0;
                                    width: 100%;
                                    text-align: left;
                                    transition: all linear 0.3s;
                                }

                                .wrapper_div:hover~.wrapper {
                                    left: 0;
                                    transition: all linear .3s;
                                    overflow: hidden;
                                }
                            </style>
                            <div class="position-relative wrapper-div bg-light">
                                <img class="image-wrapper image-fluid w-100" style="height: 240px;" src="<?php echo GlobalROOT_PATH ?>/image/<?php echo $latest['postImage'] ?>" alt="Not Found !">
                                <div class="wrapper p-2">
                                    <div class="mb-1 fs-6 bg-secondary-50">
                                        <a class='text-primary' style='font-size:small' href="category.php?category=<?php echo $latest['catName'] ?>"> <i class="px-2 fas fa-arrow-circle-right"></i> <?php echo $latest['catName'] ?></a>
                                        <span class="px-1">/</span>
                                        <span style='font-size:small'> <i class=" px-1 fas fa-clock"></i> <?php echo $latest['postCreated_at'] ?>
                                        </span>
                                        <a class="text-secondary" style='font-size:small' href="tag.php?tags=<?php echo $latest['postTag'] ?>"> <i class="px-1 fas fa-caret-right"></i> <?php echo $latest['postTag'] ?> </a>
                                    </div>
                                    <a class="h6 p-2" href="posts.php?post_id=<?php echo $latest['postId'] ?>"><?php echo $latest['postTitle'] ?></a>
                                </div>
                            </div>
                        </div>

                    <?php }
                    ?>
                </div>
                <style>
                    .owl-nav {
                        position: absolute;
                        display: block;
                    }

                    .owl-carousel .owl-dots.disabled,
                    .owl-carousel .owl-nav.disabled {
                        display: flex;
                    }

                    .owl-dots {
                        display: block;
                        ;
                    }
                </style>
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
                            <form action="subscribe.php" method="GET">
                                <input type="email" class="form-control form-control-lg" placeholder="Your Email" name="email">
                                <small>Subscribe can get all emaail by his provided email.</small>
                                <div class="input-group-append py-3">
                                    <button type="submit" name="subscribe" class="btn btn-primary">Subscribe</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- Newsletter End -->

                <!-- Ads Start -->
                <!-- <div class="pb-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Categories</h3>
                    </div>
                    <div class="bg-light py-2 text-left mb-4">
                        <style>
                            a {
                                text-decoration: none;
                                color: black;
                                ;
                            }

                            li:hover .fas {
                                color: #DC472E;
                                margin-left: 17px;
                                transition: all linear .3s;
                            }

                            li:hover a {
                                color: #DC472E;
                                text-decoration: none;
                            }

                            li .fas {
                                transition: all linear .3s;
                            }
                        </style>
                        <ul style="list-style-type:none;">
                            <?php
                            $cat_qry = mysqli_query($conn, "SELECT catId, catName FROM category LIMIT 7");

                            while ($category = mysqli_fetch_assoc($cat_qry)) {
                                echo '<li class=" m-2"><a  href="category.php?category=' . $category["catName"] . '"style="font-size:18px;"> <i class="fas fa-caret-right px-2 ;" ></i>' . $category["catName"] . '</a></li>';
                            }

                            ?>

                        </ul>
                    </div>
                </div> -->
                <!-- Ads End -->

                <!-- Popular News Start -->
                <!-- <div class="pb-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Most View </h3>
                    </div>
                    <?php
                    $popular_qry = $mysqli->select(['postId', 'postTitle', 'postImage', 'postCreated_at', 'postCategory', 'catName', 'view'])->from("posts")->join("LEFT JOIN category ON category.catId = posts.postCategory ")->where("posts.postStatus = 1")->order("view")->DESC()->limit(5)->get();
                    // $popular_qry = mysqli_query($conn, "SELECT postId,post,postTitle,postImage, postCreated_at, postCategory, catName FROM posts LEFT JOIN category ON category.catId = posts.postCateIMITgory WHERE postStatus = 1 ORDER BY posts.postId DESC Limit 4 ");
                    while ($popular = $popular_qry->fetch_assoc()) { ?>
                        <div class="d-flex mb-3">
                            <div class="w-100 d-flex flex-column justify-content-center align-items-end bg-light px-3">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a class='text-primary' href="category.php?category=<?php echo $popular["catName"] ?>"><?php echo $popular["catName"] ?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo $popular["postCreated_at"] ?></span>
                                </div>
                                <a class="h6 m-0" href="posts?post_id=<?php echo $popular["postId"] ?>"><?php echo $popular["postTitle"] ?></a>
                            </div>
                            <img src="<?php echo GlobalROOT_PATH ?>/image/<?php echo $popular["postImage"] ?>" style="width: 100px; height: 100px; object-fit:cover;">
                        </div>

                    <?php } ?>
                </div> -->
                <!-- Popular News End -->

                <!-- Tags Start -->
                <div class="pb-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Tags</h3>
                    </div>
                    <div class="d-flex flex-wrap m-n1">
                        <?php
                        // $mysqli = new DBSelect;
                        $tag_sql = $mysqli->select(["postTag"])->from("posts")->limit(10)->get();
                        if ($tag_sql->num_rows > 0) {

                            while ($result = $tag_sql->fetch_assoc()) {
                                if (str_word_count($result['postTag']) > 1) {
                                    $tag = '';
                                    $tag = explode(",", $result['postTag']);
                                    foreach ($tag as $tags) {
                                        echo "<a href='#' class='btn btn-outline-secondary btn-sm m-1'>{$tags}</a>";
                                    }
                                } else {

                                    echo "<a class='btn btn-outline-secondary btn-sm m-1'>{$result['postTag']}</a>";
                                }
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


<!-- Footer Start -->
<?php

include "footer.php";
// require_once 'greeting.php';
?>
<!-- Footer End -->

<!-- post view count -->