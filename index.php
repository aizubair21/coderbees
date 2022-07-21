<!-- Topbar Start -->
<!-- <div class="container-fluid">
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
</div> -->

<!-- Topbar End -->
<!-- nav start -->
<?php
$active = "home";
$title = "Home ";
include "connection.php";
include "header.php";

//get all info from home_page setting tagle
$set = $mysqli->select([])->from('home_page')->get();
$setting = $set->fetch_assoc();




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
    h3,
    h2 {
        font-family: "oswald";
    }

    .h4 {
        line-height: 20px;
    }
</style>

<!-- Main News Slider Start -->
<div class="container-fluid py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="owl-carousel owl-carousel-2 carousel-item-1 position-relative mb-3 mb-lg-0">

                    <?php
                    $post_status = 1;
                    $slider_order = $setting['main_slider_order'];
                    $slider_item = $setting["main_slider_item"];

                    $post_restlt = $mysqli->select([])->from('posts')->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("postStatus = $post_status")->order("posts.postId")->DESC()->limit($slider_item)->get();
                    while ($posts = $post_restlt->fetch_assoc()) { ?>

                        <div class="position-relative overflow-hidden" style="height: 435px;">
                            <img class="img-fluid h-100" src="<?php echo GlobalROOT_PATH ?>/image/<?php echo $posts["postImage"] ?>" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-1">
                                    <a class="btn btn-primary btn-sm" href="category/<?php echo $posts["catSlug"] ?>"> <i class="px-1 fas fa-dot-circle"></i> <?php echo $posts["catName"] ?></a>
                                    <span class="px-2 text-white">/</span>
                                    <a class="text-white" href=""> <i class="px-1 fas fa-clock"></i> <?php echo $posts["postCreated_at"] ?></a>
                                    <?php
                                    if ($setting["show_post_tag"]) :;
                                        make_tag_for_posts($posts["postTag"]);
                                    endif;
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
                    <h3 class="m-0">
                        <?php
                        $cat_1 = $setting["cat_1"];
                        ?>
                    </h3>
                </div>
                <style>
                    .owl-nav {
                        position: absolute;
                    }
                </style>
                <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                    <?php

                    //first category[plr]

                    $first_cat = $mysqli->select([])->from("posts")->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("posts.postStatus = 1 AND posts.postCategory = $cat_1")->order("posts.postId")->DESC()->limit(4)->get();
                    // $business_cat = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = (SELECT catId FROM category WHERE catName='business') ORDER BY posts.postId DESC LIMIT 5 ");



                    while ($first_category = $first_cat->fetch_assoc()) : ?>


                        <div class="position-relative">
                            <img class="img-fluid w-100 " src="/coderbees/image/<?php echo $first_category["postImage"] ?>" style="object-fit: cover;height:150px;">
                            <div class="p-2 position-relative bg-light">
                                <div class="mb-2" style="font-size: 13px;">
                                    <a class="text-primary" href="category.php?category=<?php echo $first_category["catName"] ?>"><?php echo $first_category["catName"] ?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo $first_category["postCreated_at"] ?></span>
                                </div>
                                <a class="h6 m-0" href="posts.php?post_id=<?php echo $first_category["postId"] ?>"><?php echo $first_category["postTitle"] ?></a>
                            </div>
                        </div>


                    <?php endwhile;
                    ?>

                </div>
            </div>
            <div class="col-lg-6 py-3">
                <div class="bg-light py-2 px-4 mb-3">
                    <h3 class="m-0"></h3>
                </div>
                <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                    <?php


                    //second category
                    $cat_2 = $setting["cat_2"];
                    $secound_cat = $mysqli->select([])->from("posts")->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("posts.postStatus = 1 AND posts.postCategory = $cat_2")->DESC()->limit(5)->get();


                    // $technology_cat = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = (SELECT catId FROM category WHERE catName='technology') ORDER BY posts.postId DESC LIMIT 5 ");
                    while ($secound_category = $secound_cat->fetch_assoc()) { ?>

                        <div class="position-relative">
                            <img class="img-fluid w-100" style="height:150px" src="/coderbees/image/<?php echo $secound_category["postImage"] ?>" style="object-fit: cover;">
                            <div class="p-2 position-relative bg-light">
                                <div class="mb-2" style="font-size: 13px;">
                                    <a class="text-primary" href="category.php?category=<?php echo $secound_category["catName"] ?>"><?php echo $secound_category["catName"] ?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo $secound_category["postCreated_at"] ?></span>
                                </div>
                                <a class="h6 m-0" href="posts.php?post_id=<?php echo $secound_category["postId"] ?>"><?php echo $secound_category["postTitle"] ?></a>
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
                    <h3 class="m-0"></h3>
                </div>
                <style>
                    .owl-nav {
                        position: absolute;
                    }
                </style>
                <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                    <?php
                    //third category
                    $cat_3 = $setting["cat_3"];
                    $third_cat = $mysqli->select([])->from("posts")->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("posts.postStatus = 1 AND posts.postCategory = $cat_3")->DESC()->limit(5)->get();


                    while ($third_category = $third_cat->fetch_assoc()) { ?>

                        <div class="d-flex mb-3">
                            <img src="/coderbees/image/<?php echo $third_category["postImage"] ?>" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <a class="h6 m-0" href="posts.php?post_id=<?php echo $third_category["postId"] ?>"><?php echo $third_category["postTitle"] ?></a>
                                <div class="mt-1" style="font-size: 13px;">
                                    <a class="text-primary" href="category.php?category=<?php echo $third_category["catName"] ?>"><?php echo $third_category["catName"] ?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo $third_category["postCreated_at"] ?></span>
                                </div>
                            </div>
                        </div>


                    <?php }
                    ?>

                </div>
            </div>
            <div class="col-lg-6 py-3">
                <div class="bg-light py-2 px-4 mb-3">
                    <h3 class="m-0"></h3>
                </div>

                <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                    <?php

                    //forth category
                    $cat_4 = $setting["cat_4"];
                    $forth_cat = $mysqli->select([])->from("posts")->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("posts.postStatus = 1 AND posts.postCategory = $cat_4")->DESC()->limit(5)->get();
                    while ($forth_category = $forth_cat->fetch_assoc()) { ?>

                        <div class="d-flex mb-3">
                            <img src="/coderbees/image/<?php echo $forth_category["postImage"] ?>" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <a class="h6 m-0" href="posts.php?post_id=<?php echo $forth_category["postId"] ?>"><?php echo $forth_category["postTitle"] ?></a>
                                <div class="mt-1" style="font-size: 13px;">
                                    <a class="text-primary" href="category.php?category=<?php echo $forth_category["catName"] ?>"><?php echo $forth_category["catName"] ?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo $forth_category["postCreated_at"] ?></span>
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
                <?php if ($setting["cat_show_in"] == "main") : ?>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0">Your favourite are here</h3>
                                <a class="text-secondary font-weight-medium text-decoration-none" href="#">All Categories</a>
                            </div>
                        </div>

                        <?php
                        $categories_qry = mysqli_query($conn, "SELECT * FROM category limit 15");
                        // echo $categories_qry;
                        while ($categories = mysqli_fetch_assoc($categories_qry)) {

                        ?>
                            <div class="col-md-2 my-1 px-2 d-flex">
                                <a href="category.php?category=<?php echo $categories['catName'] ?>" class="w-100 btn btn-outline-primary mx-2 my-1 shadow rounded"> <?php echo $categories['catName'] ?> </a>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Latest</h3>
                            <a class="text-secondary font-weight-medium text-decoration-none" href="#">View All</a>
                        </div>
                    </div>

                    <?php
                    $latest_item = $setting["latest"];
                    $latest_qry = $mysqli->select(['postId', 'postImage', 'postCategory', 'postTag', 'postTitle', 'postCreated_at', 'catName', 'postStatus', 'catId'])->from('posts')->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("posts.postStatus = 1")->order("posts.postId")->DESC()->limit($latest_item)->get();
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

                                        <?php
                                        if (str_word_count($latest['postTag']) > 1) {
                                            $s_tag = '';
                                            $s_tag = explode(",", $latest['postTag']);
                                            foreach ($s_tag as $s_tags) {
                                        ?>
                                                <a class="text text-secondary" style='font-size:small' href="tag.php?tags=<?php echo $s_tags ?>"> <i class="px-1 fas fa-caret-right"></i> <?php echo $s_tags ?> </a>
                                            <?php
                                                // echo "<a href='#' class='btn btn-outline-secondary btn-sm m-1'>{$tags}</a>";
                                            }
                                        } else {
                                            ?>
                                            <a class="text text-secondary" style='font-size:small' href="tag.php?tags=<?php echo $latest['postTag'] ?>"> <i class="px-1 fas fa-caret-right"></i> <?php echo $latest["postTag"] ?> </a>
                                        <?php
                                            // echo "<a class='btn btn-outline-secondary btn-sm m-1'>{$latest['postTag']}</a>";
                                        }
                                        ?>
                                    </div>
                                    <a class="h6 p-2" href="posts.php?post_id=<?php echo $latest['postId'] ?>"><?php echo $latest['postTitle'] ?></a>
                                </div>
                            </div>
                        </div>

                    <?php }
                    ?>
                </div>
                <!-- <style>
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
                </style> -->
            </div>

            <div class="col-lg-4 pt-3 pt-lg-0">
                <!-- Social Follow Start -->
                <?php
                if ($setting['follow_us']) :
                    include "social_media.php";
                endif;
                ?>
                <!-- Social Follow End -->

                <!-- Newsletter Start -->
                <!-- if admin stop it, or not -->
                <?php if ($setting['newsletter']) :
                    include "partial/newsletter.php";
                endif; ?>
                <!-- Newsletter End -->


                <!-- category start -->

                <!-- where admin shown it -->
                <?php if ($setting['cat_show_in'] == "sideBar") :
                    include "partial/category.php";
                endif; ?>
                <!-- category end -->

                <!-- Popular News Start -->
                <?php
                if ($setting["most_visited"]) {
                    include "partial/popular.php";
                }
                ?>
                <!-- Popular News End -->

                <!-- Tags Start -->
                <?php if ($setting['tags_in_main']) :
                    include "partial/tags.php";
                endif; ?>
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