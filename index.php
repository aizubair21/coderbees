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
// echo "Valu pacche an ekhane. onoo vabe try korte hobe...";

$mysql_setting = new DBSelect;
$set = $mysql_setting->select([])->from('home_page')->get();
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

    /* owl-carousel  */
    .owl-item {
        opacity: .4;
    }

    .center {
        opacity: 1;
        transition: all linear .3s;
    }

    .owl-stage {
        perspective: 1000px;
    }

    .owl-item:not(.center) {
        transition: transform 0.8s;
        transform-style: preserve-3d;
        /* transform: rotateY(45deg); */
    }
</style>

<!-- Main News Slider Start -->
<div class="container-fluid py-3">
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-carousel mb-3 mb-lg-0" id="owl-carousel-1">

                    <?php
                    $post_status = 1;
                    $slider_order = $setting['main_slider_order'];
                    $slider_item = $setting["main_slider_item"];

                    $post_restlt = $mysqli->select([])->from('posts')->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("postStatus = $post_status")->order("posts.postId")->DESC()->limit($slider_item)->get();
                    while ($posts = $post_restlt->fetch_assoc()) { ?>

                        <div class="position-relative overflow-hidden slick_slider" style="height: 435px; margin:5px;">

                            <img class="img-fluid h-100" src="<?php echo GlobalROOT_PATH ?>/image/<?php echo $posts["postImage"] ?>" style="object-fit: cover;">
                            <div class="overlay">
                                <div class="mb-1">
                                    <a class="btn btn-primary btn-sm" href="<?php url_for('category/' . $posts["catSlug"]) ?>"> <i class="px-1 fas fa-dot-circle"></i> <?php echo $posts["catName"] ?></a>
                                    <span class="px-2 text-white">/</span>
                                    <a class="text-white" href=""> <i class="px-1 fas fa-clock"></i> <?php echo $posts["postCreated_at"] ?></a>
                                    <?php
                                    if ($setting["show_post_tag"]) :;
                                        make_tag_for_posts($posts["postTag"]);
                                    endif;
                                    ?>

                                </div>
                                <a class="h2 m-0 text-white font-weight-bold" href="<?php url_for('posts/' . $posts['postId'] . '/' . $posts['postTitle']) ?>"><?php echo $posts["postTitle"] ?></a>
                            </div>
                        </div>

                    <?php }
                    ?>

                </div>
            </div>
            <div class="row" style="margin-top: 25px;">
                <?php
                $popular_qry = $mysqli->select(['postId', 'post', 'postTitle', 'postImage', 'postCreated_at', 'postCategory', 'catName'])->from('posts')->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("posts.postStatus = 1")->order("posts.view")->DESC()->limit("12")->get();
                while ($popular = $popular_qry->fetch_assoc()) { ?>
                    <div class="col-md-3">
                        <div class="d-flex mb-3">
                            <div style="width:40%">
                                <img src="<?php echo GlobalROOT_PATH ?>/image/<?php echo $popular["postImage"] ?>" style="width: 100%; height: 100px">
                            </div>
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px; width:70%">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a class="text-primary" href="<?php url_for('category/'.$popular["catName"]) ?>"><?php echo $popular["catName"] ?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo $popular["postCreated_at"] ?></span>
                                </div>
                                <a class="h6 m-0" href="<?php url_for('posts/' .  $popular['postId'] . "/" . str_replace(" ", "-", $popular["postTitle"])) ?>"><?php echo $popular["postTitle"] ?></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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
                <div class="mb-3 border-bottom border-primary">
                    <h3 class="m-0 py-1 px-4 bg-primary d-inline-flex text-light">
                        <?php
                        $cat_1 = $setting["cat_1"];
                        echo getCategoryName($cat_1);
                        ?>
                    </h3>
                </div>
                <style>
                    .owl-nav {
                        position: absolute;
                    }
                </style>
                <!-- <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative"> -->
                <?php

                //first category[plr]

                $cat_1 = $setting["cat_1"];
                $first_cat = $mysql->select([])->from("posts")->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("posts.postStatus = 1 AND posts.postCategory = '$cat_1'")->order("posts.postId")->DESC()->limit(4)->get();
                // $business_cat = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = (SELECT catId FROM category WHERE catName='business') ORDER BY posts.postId DESC LIMIT 5 ");

                // print_r($first_cat);


                while ($first_category = $first_cat->fetch_assoc()) : ?>

                    <div class="col-lg-12 mb-2">

                        <div class="d-flex mb-3">
                            <div style="width: 30%;">
                                <img src="<?php echo GlobalROOT_PATH ?>/image/<?php echo $first_category["postImage"] ?>" style="width: 100%; height: 100px">
                            </div>
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px; width:70%">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a class="text-primary" href="<?php url_for('category/' . $first_category["catName"]) ?>"><?php echo $first_category["catName"] ?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo $first_category["postCreated_at"] ?></span>
                                </div>
                                <a class="h5 m-0" href="<?php url_for('posts/' . $first_category["postId"] .'/'. str_replace(" ", "-", $first_category["postTitle"])) ?>"><?php echo $first_category["postTitle"] ?></a>
                            </div>
                        </div>
                    </div>


                <?php endwhile;
                ?>

                <!-- </div> -->
            </div>
            <div class="col-lg-6 py-3">
                <div class=" mb-3 border-bottom border-primary">
                    <h3 class="m-0 d-inline-flex py-1 px-4 bg-primary text-light">
                        <?php
                        $cat_2 = $setting["cat_2"];
                        echo getCategoryName($cat_2);
                        ?>
                    </h3>
                </div>
                <!-- <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative"> -->
                <?php


                //second category
                $secound_cat = $mysql->select([])->from("posts")->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("posts.postStatus = 1 AND posts.postCategory = '$cat_2'")->DESC()->limit(5)->get();


                // $technology_cat = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = (SELECT catId FROM category WHERE catName='technology') ORDER BY posts.postId DESC LIMIT 5 ");
                while ($secound_category = $secound_cat->fetch_assoc()) { ?>

                    <div class="position-relative col-12 mb-2">
                        <div class="d-flex mb-3">
                            <div style="width:30%;">
                                <img src="<?php echo GlobalROOT_PATH ?>/image/<?php echo $secound_category["postImage"] ?>" style="width: 100%; height: 100px">
                            </div>
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px; width:70%">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a class="text-primary" href="<?php url_for('category/' . $secound_category["catName"]) ?>"><?php echo $secound_category["catName"] ?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo $secound_category["postCreated_at"] ?></span>
                                </div>
                                <a class="h5 m-0" href="<?php url_for('posts/' . $secound_category["postId"] .'/'. str_replace(" ", "-", $secound_category["postTitle"]))?>"><?php echo $secound_category['postTitle'] ?></a>
                            </div>
                        </div>
                    </div>

                <?php }
                ?>
                <!-- </div> -->
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
                <div class="border-bottom border-primary mb-3">
                    <h3 class="m-0 py-1 px-4 d-inline-flex text-light bg-primary">
                        <?php
                        $cat_3 = $setting["cat_3"];
                        echo getCategoryName($cat_3);
                        ?>
                    </h3>
                </div>
                <style>
                    .owl-nav {
                        position: absolute;
                    }
                </style>
                <!-- <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative"> -->
                <?php
                //third category
                $third_cat = $mysql->select([])->from("posts")->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("posts.postStatus = 1 AND posts.postCategory = '$cat_3'")->DESC()->limit(5)->get();


                while ($third_category = $third_cat->fetch_assoc()) { ?>

                    <div class="col-12 mb-2">

                        <div class="d-flex align-items-start mb-3">
                            <div style="width:30%">
                                <img src="/coderbees/image/<?php echo $third_category["postImage"] ?>" style="width: 100%; height: 100px; object-fit: cover;">
                            </div>
                            <div class="w-100 d-flex flex-column justify-content-evenly align-items-start bg-light px-3" style="height: 100px;">
                                <a class="h5 m-0" href="<?php url_for('posts/' . $third_category["postId"] .'/'. str_replace(" ", "-", $third_category["postTitle"])) ?>"><?php echo $third_category["postTitle"] ?></a>
                                <div class="mt-1" style="font-size: 13px;">
                                    <a class="text-primary" href="<?php url_for('category/' . $third_category["catName"]) ?>"><?php echo $third_category["catName"] ?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo $third_category["postCreated_at"] ?></span>
                                </div>
                            </div>
                        </div>

                    </div>

                <?php }
                ?>

                <!-- </div> -->
            </div>
            <div class="col-lg-6 py-3">
                <div class="mb-3 border-bottom border-primary">
                    <h3 class="m-0 py-1 px-4 bg-primary d-inline-flex text-light">
                        <?php
                        $cat_4 = $setting["cat_4"];
                        echo getCategoryName($cat_4);
                        ?>
                    </h3>
                </div>

                <!-- owl carousel -->
                <!-- <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative"> -->
                <?php

                //forth category
                $forth_cat = $mysql->select([])->from("posts")->join("LEFT JOIN category ON category.catId = posts.postCategory")->where("posts.postStatus = 1 AND posts.postCategory = '$cat_4'")->DESC()->limit(5)->get();
                while ($forth_category = $forth_cat->fetch_assoc()) { ?>
                    <div class="col-12 mb-2">

                        <div class="d-flex mb-3">
                            <div style="width:30%">
                                <img src="/coderbees/image/<?php echo $forth_category["postImage"] ?>" style="width: 100%; height: 100px; object-fit: cover;">
                            </div>
                            <div class="w-100 d-flex flex-column justify-content-evenly bg-light px-3" style="height: 100px;">
                                <a class="h5 m-0" href="<?php url_for('posts/' . $forth_category["postId"] .'/'. str_replace(" ", "-", $forth_category["postTitle"])) ?>"><?php echo $forth_category["postTitle"] ?></a>
                                <div class="mt-1" style="font-size: 13px;">
                                    <a class="text-primary" href="<?php url_for('category/' . $forth_category["catName"]) ?>"><?php echo $forth_category["catName"] ?></a>
                                    <span class="px-1">/</span>
                                    <span><?php echo $forth_category["postCreated_at"] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php }
                ?>
                <!-- </div> -->

            </div>
        </div>
    </div>
</div>


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
                                <a href="<?php url_for('category/' . $categories["catName"]) ?>" class="w-100 btn btn-outline-primary mx-2 my-1 shadow rounded"> <?php echo $categories['catName'] ?> </a>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between border-bottom border-primary mb-3">
                            <h3 class="m-0 py-1 px-4 d-inline-flex bg-primary text-light">Latest</h3>
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
                                        <a class='text-primary' style='font-size:small' href="<?php url_for('category/' . $latest["catName"]) ?>"> <i class="px-2 fas fa-arrow-circle-right"></i> <?php echo $latest['catName'] ?></a>
                                        <span class="px-1">/</span>
                                        <span style='font-size:small'> <i class=" px-1 fas fa-clock"></i> <?php echo $latest['postCreated_at'] ?>
                                        </span>

                                        <?php
                                        //make_tag_for_posts($latest["postTag"]);

                                        ?>
                                    </div>
                                    <a class="h6 p-2" href="<?php url_for('posts/' . $latest["postId"] .'/'. str_replace(" ", "-", $latest["postTitle"])) ?>"><?php echo $latest['postTitle'] ?></a>
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



            <!-- right side bar -->

            <div class="col-lg-4 pt-3 pt-lg-0">
                <!-- Social Follow Start -->
                <?php
                if ($setting['follow_us']) :
                    include "partial/social_media.php";
                endif;
                ?>
                <!-- Social Follow End -->

                <!-- Newsletter Start -->
                <!-- if admin stop it, or not -->
                <?php

                if ($setting['newsletter']) :
                    include "partial/newsletter.php";
                endif;
                ?>
                <!-- Newsletter End -->


                <!-- category start -->

                <!-- where admin shown it -->
                <?php
                if ($setting['cat_show_in'] == "sideBar") :
                    include "partial/category.php";
                endif;
                ?>
                <!-- category end -->

                <!-- Popular News Start -->
                <?php
                if ($setting["most_visited"]) {
                    include "partial/popular.php";
                }
                ?>
                <!-- Popular News End -->

                <!-- Tags Start -->
                <!-- if admin set "show" in  home page setting. Tag section show, else hide -->
                <?php
                if ($setting['tags_in_main']) :
                    include "partial/tags.php";
                endif;
                ?>
                <!-- Tags End -->
            </div>
        </div>
    </div>
</div>
</div>
<!-- News With Sidebar End -->


<!-- Footer Start -->
<?php
//include footer
include "footer.php";
// require_once 'greeting.php';
?>
<!-- Footer End -->

<!-- post view count -->