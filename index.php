
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
            <div class="col-md-4 text-right d-none d-md-block">
                Monday, January 01, 2045
            </div>
        </div>
        <div class="row align-items-center py-2 px-lg-5">
            <div class="col-lg-4">
                <a href="" class="navbar-brand d-none d-lg-block">
                    <h1 class="m-0 display-5 text-uppercase"><span class="text-primary">News</span>Room</h1>
                </a>
            </div>
            <div class="col-lg-8 text-center text-lg-right">
                <img class="img-fluid" src="img/ads-700x70.jpg" alt="">
            </div>
        </div>
    </div> -->
    <!-- Topbar End -->
    
    
    
    <!-- nav start -->
        <?php
            $active = "home";
            $title ="Home ";
            include "header.php";
            include "connection.php";
            
        ?>
    <!-- nav end -->

   


    <!-- Main News Slider Start -->
    <div class="container-fluid py-3">
        <style>
            h3{
                color:#DC472E;
            }
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
                                            <a class="text-white" href=""><?php echo $posts["catName"] ?></a>
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
                        <h3 class="m-0">Categories</h3>
                        <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                    </div>
                    <style>
                        .home_li:hover .fas{
                            color:#DC472E;
                        }
                        .home_li:hover .home_a {
                            margin-left:15px;
                            transition: all linear .3s;
                        }
                    </style>
                    <ul class="bg-light py-5">
                    <?php 
                        $cat_result = mysqli_query($conn, "SELECT * FROM category ORDER BY catId DESC LIMIT 8");
                        while($category = mysqli_fetch_assoc($cat_result)){?>

                            <li class=" home_li list-style-none py-1" style="list-style-type: none;">
                                <a href="" class=" home_a h5 text-dark text-decoration-none" style="font-family:'Times New Roman', Times, serif; text-transform:capitalize; transition: all linear .1s">
                                    
                                    <i class="fas fa-arrow-circle-right"></i>
                                    <?php echo $category["catName"] ?>
                                </a>
                            </li>

                     <?php };
                    ?>
                    </ul>
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
                    $featured_qry = (mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = 1 ORDER BY posts.postId DESC LIMIT 2 "));
                    while ($featured = mysqli_fetch_array($featured_qry)) {?>
                  
                        <div class=" col-lg-6 col-md-6 bg-light d-flex align-items-center mb-2">
                            <img class="" style="width:180px" src="/coderbees/image/<?php echo $featured["postImage"] ?>" >
                            <div class="p-3">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a class="" href=""><?php echo $featured["catName"] ?></a>
                                    <span class="px-1 ">/</span>
                                    <a class="" href=""><?php echo $featured["postCreated_at"] ?></a>
                                </div>
                                <a class="h4 m-0 " href="single_post.php?post_id=<?php echo $featured["postId"] ?>"><?php echo $featured["postTitle"] ?></a>
                            </div>
                        </div>  
                
                    <?php }
                ?>
                <?php
                    $featured_qry = (mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = 41 ORDER BY posts.postId DESC LIMIT 2 "));
                    while ($featured = mysqli_fetch_array($featured_qry)) {?>
                  
                        <div class=" col-lg-6 col-md-6 bg-light d-flex align-items-center mb-2">
                            <img class="" style="width:180px" src="/coderbees/image/<?php echo $featured["postImage"] ?>" >
                            <div class="p-3">
                                <div class="mb-1" style="font-size: 13px;">
                                    <a class="" href=""><?php echo $featured["catName"] ?></a>
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
                            $business_cat = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = 41 ORDER BY posts.postId DESC LIMIT 5 ") ;
                            while ($business = mysqli_fetch_assoc($business_cat)) { ?>

                                <div class="position-relative">
                                    <img class="img-fluid w-100" src="image/<?php echo $business["postImage"] ?>" style="object-fit: cover;">
                                    <div class="overlay position-relative bg-light">
                                        <div class="mb-2" style="font-size: 13px;">
                                            <a href=""><?php echo $business["catName"] ?></a>
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
                            $business_cat = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = 1 ORDER BY posts.postId DESC LIMIT 5 ") ;
                            while ($business = mysqli_fetch_assoc($business_cat)) { ?>

                                <div class="position-relative">
                                    <img class="img-fluid w-100" style="height:150px" src="image/<?php echo $business["postImage"] ?>" style="object-fit: cover;">
                                    <div class="overlay position-relative bg-light">
                                        <div class="mb-2" style="font-size: 13px;">
                                            <a href=""><?php echo $business["catName"] ?></a>
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
                            $business_cat = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = 46 ORDER BY posts.postId DESC LIMIT 5 ") ;
                            while ($business = mysqli_fetch_assoc($business_cat)) { ?>

                                <div class="position-relative">
                                    <div style="height:150px; ">
                                        <img class="img-fluid w-100 h-100" style="image-resolution:inherit;" src="image/<?php echo $business["postImage"] ?>" style="object-fit: cover;">
                                        
                                    </div>
                                        
                                    <div class="overlay position-relative bg-light">
                                        <div class="mb-2" style="font-size: 13px;">
                                            <a href=""><?php echo $business["catName"] ?></a>
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
                                            <a href=""><?php echo $business["catName"] ?></a>
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
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0">Popular</h3>
                                <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                            </div>
                        </div>

                        <?php
                            $popular_qry = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 AND postCategory = 1 ORDER BY posts.postId DESC LIMIT 2 ");
                            while ($popular = mysqli_fetch_assoc($popular_qry)){ ?>
                            

                                <div class="col-lg-6">
                                    <div class="position-relative mb-3">
                                        <img class="img-fluid w-100" src="img/news-500x280-2.jpg" style="object-fit: cover;">
                                        <div class="overlay position-relative bg-light">
                                            <div class="mb-2" style="font-size: 14px;">
                                                <a href=""><?php echo $popular["catName"] ?></a>
                                                <span class="px-1">/</span>
                                                <span><?php echo $popular["postCreated_at"] ?></span>
                                            </div>
                                            <a class="h4" href="single_post.php?post_id=<?php echo $popular["postId"] ?>"><?php echo $popular["postTitle"] ?></a>
                                            <p class="m-0"><?php echo substr_replace($popular["post"],'...',100) ?></p>
                                        </div>
                                    </div>
                            <?php };
                        ?>
                    
                        <!-- <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="img/news-500x280-3.jpg" style="object-fit: cover;">
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 14px;">
                                        <a href="">Technology</a>
                                        <span class="px-1">/</span>
                                        <span>January 01, 2045</span>
                                    </div>
                                    <a class="h4" href="">Est stet amet ipsum stet clita rebum duo</a>
                                    <p class="m-0">Rebum dolore duo et vero ipsum clita, est ea sed duo diam ipsum, clita at justo, lorem amet vero eos sed sit...</p>
                                </div>
                            </div>
                           
                           
                        </div> -->


                    </div>
                    
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between bg-light py-2 px-4 mb-3">
                                <h3 class="m-0">Latest</h3>
                                <a class="text-secondary font-weight-medium text-decoration-none" href="">View All</a>
                            </div>
                        </div>

                        <?php 

                            $latest_qry = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE postStatus = 1 ORDER BY posts.postId DESC LIMIT 4 ");
                            while ($latest= mysqli_fetch_assoc($latest_qry) ) { ?>

                                <div class="col-lg-6">
                                    <div class="position-relative mb-3">
                                        <img class="img-fluid w-100" style="height:250px" src="image/<?php echo $latest["postImage"] ?>" style="object-fit: cover;">
                                        <div class="overlay position-relative bg-light">
                                            <div class="mb-2" style="font-size: 14px;">
                                                <a href=""><?php echo $latest["catName"] ?></a>
                                                <span class="px-1">/</span>
                                                <span><?php echo $latest["postCreated_at"] ?></span>
                                            </div>
                                            <a class="h4" href="single_post.php?post_id=<?php echo $latest["postId"] ?>"><?php echo $latest["postTitle"] ?></a>
                                            <p style="font-family: serif ;" class="m-0"><?php echo htmlspecialchars(substr_replace($latest["post"], "..",150)) ?></p>
                                        </div>
                                    </div>
                                
                                </div>

                             <?php }
                        ?>


                        <!-- <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="img/news-500x280-5.jpg" style="object-fit: cover;">
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 14px;">
                                        <a href="">Technology</a>
                                        <span class="px-1">/</span>
                                        <span>January 01, 2045</span>
                                    </div>
                                    <a class="h4" href="">Est stet amet ipsum stet clita rebum duo</a>
                                    <p class="m-0">Rebum dolore duo et vero ipsum clita, est ea sed duo diam ipsum, clita at justo, lorem amet vero eos sed sit...</p>
                                </div>
                            </div>
                           
                        </div>

                         <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="img/news-500x280-5.jpg" style="object-fit: cover;">
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 14px;">
                                        <a href="">Technology</a>
                                        <span class="px-1">/</span>
                                        <span>January 01, 2045</span>
                                    </div>
                                    <a class="h4" href="">Est stet amet ipsum stet clita rebum duo</a>
                                    <p class="m-0">Rebum dolore duo et vero ipsum clita, est ea sed duo diam ipsum, clita at justo, lorem amet vero eos sed sit...</p>
                                </div>
                            </div>
                           
                        </div>

                         <div class="col-lg-6">
                            <div class="position-relative mb-3">
                                <img class="img-fluid w-100" src="img/news-500x280-5.jpg" style="object-fit: cover;">
                                <div class="overlay position-relative bg-light">
                                    <div class="mb-2" style="font-size: 14px;">
                                        <a href="">Technology</a>
                                        <span class="px-1">/</span>
                                        <span>January 01, 2045</span>
                                    </div>
                                    <a class="h4" href="">Est stet amet ipsum stet clita rebum duo</a>
                                    <p class="m-0">Rebum dolore duo et vero ipsum clita, est ea sed duo diam ipsum, clita at justo, lorem amet vero eos sed sit...</p>
                                </div>
                            </div>
                           
                        </div> -->
                       
                    </div>
                </div>
                
                <div class="col-lg-4 pt-3 pt-lg-0">
                    <!-- Social Follow Start -->
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Follow Us</h3>
                        </div>
                        <div class="d-flex mb-3">
                            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #39569E;">
                                <small class="fab fa-facebook-f mr-2"></small><small>12,345 Fans</small>
                            </a>
                            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #52AAF4;">
                                <small class="fab fa-twitter mr-2"></small><small>12,345 Followers</small>
                            </a>
                        </div>
                        <div class="d-flex mb-3">
                            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #0185AE;">
                                <small class="fab fa-linkedin-in mr-2"></small><small>12,345 Connects</small>
                            </a>
                            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #C8359D;">
                                <small class="fab fa-instagram mr-2"></small><small>12,345 Followers</small>
                            </a>
                        </div>
                        <div class="d-flex mb-3">
                            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #DC472E;">
                                <small class="fab fa-youtube mr-2"></small><small>12,345 Subscribers</small>
                            </a>
                            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #1AB7EA;">
                                <small class="fab fa-vimeo-v mr-2"></small><small>12,345 Followers</small>
                            </a>
                        </div>
                    </div>
                    <!-- Social Follow End -->

                    <!-- Newsletter Start -->
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Newsletter</h3>
                        </div>
                        <div class="bg-light text-center p-4 mb-3">
                            <p>Aliqu justo et labore at eirmod justo sea erat diam dolor diam vero kasd</p>
                            <div class="input-group" style="width: 100%;">
                                <input type="text" class="form-control form-control-lg" placeholder="Your Email">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                            <small>Sit eirmod nonumy kasd eirmod</small>
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
                        <div class="d-flex mb-3">
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
                        </div>
                    </div>
                    <!-- Popular News End -->

                    <!-- Tags Start -->
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Tags</h3>
                        </div>
                        <div class="d-flex flex-wrap m-n1">
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Politics</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Business</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Corporate</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Sports</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Health</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Education</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Science</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Technology</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Foods</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Entertainment</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Travel</a>
                            <a href="" class="btn btn-sm btn-outline-secondary m-1">Lifestyle</a>
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