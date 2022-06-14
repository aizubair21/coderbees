
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
            <div class="col-md-4 text-right d-none d-md-block">
               <?php
                    echo date("M/d/Y");
               ?>
            </div>
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
    

    <style>
        h3 {
            font-family: "oswald";
        }
    </style>
    
    
    <!-- nav start -->
        <?php
            $active = "home";
            $title ="Home ";
            include "connection.php";
            include "header.php";
            
        ?>
    <!-- nav end -->

   


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
                            $limit = '5' ;
                            $post_restlt = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId=posts.postCategory WHERE postStatus='$post_status' LIMIT 5 ");
                            while ($posts = mysqli_fetch_assoc($post_restlt)) { ?>

                                <div class="position-relative overflow-hidden" style="height: 435px;">
                                    <img class="img-fluid h-100" src="image/<?php echo $posts["postImage"] ?>" style="object-fit: cover;">
                                    <div class="overlay">
                                        <div class="mb-1">
                                            <a class="text-white" href="category.php?category=<?php echo $posts["catName"] ?>"><?php echo $posts["catName"] ?></a>
                                            <span class="px-2 text-white">/</span>
                                            <a class="text-white" href=""><?php echo $posts["postCreated_at"] ?></a>
                                        </div>
                                        <a class="h2 m-0 text-white font-weight-bold" href="single_post.php?post_id=<?php echo $posts['postId'] ?>"><?php echo $posts["postTitle"] ?></a>
                                    </div>
                                </div>
                        
                            <?php }
                        ?>
                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Site Quick View</h3>
                    </div>
                   
                    
                    <div class="d-flex justify-content-between align-items-center">

                        <div class="col-lg-6 btn btn-outline-info  py-4 mb-2" style="text-align:center;font-weight:800">
                            <strong style="text-transform: uppercase; font-family:'oswald';">Posts</strong>
                            <div>
                            <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE postStatus = 1")) ?>
                            </div>
                        </div>
                        <div class="col-lg-6 btn btn-outline-info  py-4 mb-2" style="text-align:center;font-weight:800">
                            <strong style="text-transform: uppercase; font-family:'oswald';">Users</strong>
                            <div><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE userStatus = 1")) ?></div>
                        </div>
                       
                        
                    </div>
                    <div class="d-flex justify-content-between align-items-center">

                        <div class="col-lg-6 btn btn-outline-info  py-4 mb-2" style="text-align:center;font-weight:800">
                            <strong style="text-transform: uppercase; font-family:'oswald';">Category</strong>
                            <div>
                            <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT catId FROM category")) ?>
                            </div>
                        </div>
                        <div class="col-lg-6 btn btn-outline-info  py-4 mb-2" style="text-align:center;font-weight:800">
                            <strong style="text-transform: uppercase; font-family:'oswald';">Publisher</strong>
                            <div><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT publisherId FROM publisher WHERE publisherStatus = 1")) ?></div>
                        </div>
                       
                        
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Main News Slider End -->


    <!-- Featured News Slider Start -->
    <div class="container-fluid py-3">

        <div class="container">
            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                <h3 class="m-0">Featured</h3>
                <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
            </div>

            <div class="row">
                <?php
                    $featured_qry = (mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = 2 ORDER BY posts.postId DESC LIMIT 2 "));
                    while ($featured = mysqli_fetch_array($featured_qry)) {?>
                  
                        <div class=" col-lg-6 col-md-6 bg-light d-flex align-items-center mb-2">
                            <img class="" style="height:100px; width:100px" src="/coderbees/image/<?php echo $featured["postImage"] ?>" >
                            <div class="p-3">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a class="" href="category.php?category=<?php echo $featured["catName"] ?>"><?php echo $featured["catName"] ?></a>
                                    <span class="px-1 ">/</span>
                                    <a class="" href=""><?php echo $featured["postCreated_at"] ?></a>
                                </div>
                                <a class="h4 m-0 " href="single_post.php?post_id=<?php echo $featured["postId"] ?>"><?php echo $featured["postTitle"] ?></a>
                            </div>
                        </div>  
                
                    <?php }
                ?>
                <?php
                    $featured_qry = (mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = 4 ORDER BY posts.postId DESC LIMIT 2 "));
                    while ($featured = mysqli_fetch_array($featured_qry)) {?>
                  
                        <div class=" col-lg-6 col-md-6 bg-light d-flex align-items-center mb-2">
                            <img class="" style="width:180px" src="/coderbees/image/<?php echo $featured["postImage"] ?>" >
                            <div class="p-3">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="category.php?category=<?php echo $featured["catName"] ?>"><?php echo $featured["catName"] ?></a>
                                    <span class="px-1 ">/</span>
                                    <a class="" href=""><?php echo $featured["postCreated_at"] ?></a>
                                </div>
                                <a class="h4 m-0 " href="single_post.php?post_id=<?php echo $featured["postId"] ?>"><?php echo $featured["postTitle"] ?></a>
                            </div>
                        </div>  
                
                    <?php }
                ?>
                

            </div>
        </div>
    </div>
    <!-- Featured News Slider End -->


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
                            $business_cat = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = 4 ORDER BY posts.postId DESC LIMIT 5 ") ;
                            while ($business = mysqli_fetch_assoc($business_cat)) { ?>

                                <div class="position-relative">
                                    <img class="img-fluid w-100" src="image/<?php echo $business["postImage"] ?>" style="object-fit: cover;">
                                    <div class="p-2 position-relative bg-light">
                                        <div class="mb-2" style="font-size: 13px;">
                                            <a href="category.php?category=<?php echo $business["catName"] ?>"><?php echo $business["catName"] ?></a>
                                            <span class="px-1">/</span>
                                            <span><?php echo $business["postCreated_at"] ?></span>
                                        </div>
                                        <a class="h4 m-0" href="single_post.php?post_id=<?php echo $business["postId"] ?>"><?php echo $business["postTitle"] ?></a>
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
                            $business_cat = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = 3 ORDER BY posts.postId DESC LIMIT 5 ") ;
                            while ($business = mysqli_fetch_assoc($business_cat)) { ?>

                                <div class="position-relative">
                                    <img class="img-fluid w-100" style="height:150px" src="image/<?php echo $business["postImage"] ?>" style="object-fit: cover;">
                                    <div class="p-2 position-relative bg-light">
                                        <div class="mb-2" style="font-size: 13px;">
                                            <a href="category.php?category=<?php echo $business["catName"] ?>"><?php echo $business["catName"] ?></a>
                                            <span class="px-1">/</span>
                                            <span><?php echo $business["postCreated_at"] ?></span>
                                        </div>
                                        <a class="h4 m-0" href="single_post.php?post_id=<?php echo $business["postId"] ?>"><?php echo $business["postTitle"] ?></a>
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
                            $business_cat = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = 2 ORDER BY posts.postId DESC LIMIT 5 ") ;
                            while ($business = mysqli_fetch_assoc($business_cat)) { ?>

                                <div class="position-relative">
                                    <div style="height:150px; ">
                                        <img class="img-fluid w-100 h-100" style="image-resolution:inherit;" src="image/<?php echo $business["postImage"] ?>" style="object-fit: cover;">
                                        
                                    </div>
                                        
                                    <div class="p-2 position-relative bg-light">
                                        <div class="mb-2" style="font-size: 13px;">
                                            <a href="category.php?category=<?php echo $business["catName"] ?>"><?php echo $business["catName"] ?></a>
                                            <span class="px-1">/</span>
                                            <span><?php echo $business["postCreated_at"] ?></span>
                                        </div>
                                        <a class="h5 m-0" href="single_post.php?post_id=<?php echo $business["postId"] ?>"><?php echo $business["postTitle"] ?></a>
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
                            $business_cat = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = 47 ORDER BY posts.postId DESC LIMIT 5 ") ;
                            while ($business = mysqli_fetch_assoc($business_cat)) { ?>

                                <div class="position-relative">
                                    <img class="img-fluid w-100" style="height:150px" src="image/<?php echo $business["postImage"] ?>" style="object-fit: cover;">
                                    <div class="overlay position-relative bg-light">
                                        <div class="mb-2" style="font-size: 13px;">
                                            <a href="category.php?category=<?php echo $business["catName"] ?>"><?php echo $business["catName"] ?></a>
                                            <span class="px-1">/</span>
                                            <span><?php echo $business["postCreated_at"] ?></span>
                                        </div>
                                        <a class="h4 m-0" href="single_post.php?post_id=<?php echo $business["postId"] ?>"><?php echo $business["postTitle"] ?></a>
                                    </div>
                                </div>
  
                            <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 py-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Entertainment</h3>
                    </div>
                    <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                        <div class="position-relative">
                            <img class="img-fluid w-100" src="img/news-500x280-6.jpg" style="object-fit: cover;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 13px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>January 01, 2045</span>
                                </div>
                                <a class="h4 m-0" href="">Sanctus amet sed ipsum lorem</a>
                            </div>
                        </div>
                        <div class="position-relative">
                            <img class="img-fluid w-100" src="img/news-500x280-5.jpg" style="object-fit: cover;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 13px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>January 01, 2045</span>
                                </div>
                                <a class="h4 m-0" href="">Sanctus amet sed ipsum lorem</a>
                            </div>
                        </div>
                        <div class="position-relative">
                            <img class="img-fluid w-100" src="img/news-500x280-4.jpg" style="object-fit: cover;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 13px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>January 01, 2045</span>
                                </div>
                                <a class="h4 m-0" href="">Sanctus amet sed ipsum lorem</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 py-3">
                    <div class="bg-light py-2 px-4 mb-3">
                        <h3 class="m-0">Sports</h3>
                    </div>
                    <div class="owl-carousel owl-carousel-3 carousel-item-2 position-relative">
                        <div class="position-relative">
                            <img class="img-fluid w-100" src="img/news-500x280-3.jpg" style="object-fit: cover;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 13px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>January 01, 2045</span>
                                </div>
                                <a class="h4 m-0" href="">Sanctus amet sed ipsum lorem</a>
                            </div>
                        </div>
                        <div class="position-relative">
                            <img class="img-fluid w-100" src="img/news-500x280-2.jpg" style="object-fit: cover;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 13px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>January 01, 2045</span>
                                </div>
                                <a class="h4 m-0" href="">Sanctus amet sed ipsum lorem</a>
                            </div>
                        </div>
                        <div class="position-relative">
                            <img class="img-fluid w-100" src="img/news-500x280-1.jpg" style="object-fit: cover;">
                            <div class="overlay position-relative bg-light">
                                <div class="mb-2" style="font-size: 13px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>January 01, 2045</span>
                                </div>
                                <a class="h4 m-0" href="">Sanctus amet sed ipsum lorem</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div> -->
    <!-- Category News Slider End -->


    <!-- News With Sidebar Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0">Latest</h3>
                                <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                            </div>
                        </div>

                        <?php 

                            $latest_qry = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 ORDER BY posts.postId DESC LIMIT 8 ");
                            while ($latest= mysqli_fetch_assoc($latest_qry) ) { ?>

                                <div class="col-lg-6" >
                                    <div class="position-relative mb-3">
                                        <img class="img-fluid w-100" style="height:200px" src="image/<?php echo $latest["postImage"] ?>" style="object-fit: cover;">
                                        <div class=" position-relative bg-light p-2">
                                            <div class="mb-2" style="font-size: 14px;">
                                                <a href="category.php?category=<?php echo $latest["catName"] ?>"><?php echo $latest["catName"] ?></a>
                                                <span class="px-1">/</span>
                                                <span><?php echo $latest["postCreated_at"] ?></span>
                                            </div>
                                            <a class="h4" href="single_post.php?post_id=<?php echo $latest["postId"] ?>"><?php echo $latest["postTitle"] ?></a>
                                            <p style="font-family: serif ;" class="m-0"><?php echo substr_replace($latest["post"], "..",150) ?></p>
                                        </div>
                                    </div>
                                
                                </div>

                             <?php }
                        ?>
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
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Categories</h3>
                        </div>
                        <div class="bg-light py-2 text-left mb-4">
                            <style>
                                a {
                                    text-decoration: none;
                                    ;
                                }
                                li:hover .fas {
                                    color:#DC472E;
                                    margin-left: 17px;
                                    transition: all linear .3s;
                                }
                                li .fas {
                                    transition: all linear .3s;
                                }
                                
                            </style>
                            <ul style="list-style-type:none;">
                                <?php 
                                    $cat_qry = mysqli_query($conn, "SELECT catId, catName FROM category LIMIT 7");

                                    while ($category = mysqli_fetch_assoc($cat_qry)) {
                                        echo '<li class="text-dark m-2"><a href="category.php?cat_id='. $category["catId"] .'"style="color:black; font-size:18px;"> <i class="fas fa-caret-right px-2 ;" ></i>'. $category["catName"] .'</a></li>';
                                    }

                                ?>
                                
                            </ul>
                        </div>
                    </div>
                    <!-- Ads End -->

                    <!-- Popular News Start -->
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Most View </h3>
                        </div>
                        <?php
                        $popular_qry = mysqli_query($conn, "SELECT postId,post,postTitle,postImage, postCreated_at, postCategory, catName FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 ORDER BY posts.postId DESC LIMIT 4 ");
                        while ($popular = mysqli_fetch_assoc($popular_qry)){ ?>
                            <div class="d-flex mb-3">
                                <img src="image/<?php echo $popular["postImage"] ?>" style="width: 50%; height: 100px; object-fit: cover;">
                                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                    <div class="mb-1" style="font-size: 13px;">
                                        <a href="category.php?category=<?php echo $popular["catName"] ?>"><?php echo $popular["catName"] ?></a>
                                        <span class="px-1">/</span>
                                        <span><?php echo $popular["postCreated_at"] ?></span>
                                    </div>
                                    <a class="h6 m-0" href="single_post.php?post_id=<?php echo $popular["postId"] ?>"><?php echo $popular["postTitle"] ?></a>
                                </div>
                            </div>

                        <?php } ?>
                        <!-- <div class="d-flex mb-3">
                            <img src="img/news-100x100-2.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>January 01, 2045</span>
                                </div>
                                <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <img src="img/news-100x100-3.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>January 01, 2045</span>
                                </div>
                                <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <img src="img/news-100x100-4.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>January 01, 2045</span>
                                </div>
                                <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <img src="img/news-100x100-5.jpg" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a href="">Technology</a>
                                    <span class="px-1">/</span>
                                    <span>January 01, 2045</span>
                                </div>
                                <a class="h6 m-0" href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                            </div>
                        </div> -->
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
                                if(mysqli_num_rows($tag_qry) > 0) {
                                    while ($tag = mysqli_fetch_assoc($tag_qry)) {
                                        echo ' <a href="tag.php?tags='. $tag["postTag"] .'" class="btn btn-sm btn-outline-secondary m-1">'. $tag["postTag"] .'</a>';
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
        <?php include "footer.php"?>
    <!-- Footer End -->