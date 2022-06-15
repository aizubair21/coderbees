
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
    
    
    
    <!-- nav start -->
    <?php
        $active = "home";
        $title ="Search Reasult ";
        include "connection.php";
        include "header.php";


            
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        }else{
            $page = 1;
        }
        $key = $_GET["search"] ?? "";
        $result_per_page = 6;
        $page_first_result = ($page -1) * $result_per_page;
        $total_row = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM posts WHERE postStatus = 1 AND posts.postTitle LIKE '%$key%' OR posts.post LIKE '%$key%'"));
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
                                        Fount <?php echo $total_row ?> Reasult for "<?php echo $_GET["search"] ?? "" ?>"
                                        
                                   <?php }
                                ?>
                            </h4>

                           
                        </div>

                        <?php
                        if (isset($_GET["search"])) {
                           
                            $popular_qry = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE posts.postStatus = 1 AND posts.postTitle LIKE '%$key%' OR posts.post LIKE '%$key%' ORDER BY posts.postId DESC LIMIT $page_first_result, $result_per_page");
                            if ($_GET["search"] == "") {
                                echo "<strong class='alert alert-warning'>Nothing Else !</strong>";
                            }else {
                                if (($total_result = mysqli_num_rows($popular_qry)) > 0) {
                                    echo "<p class='text text-secondary font-normal'> $total_result result show this page </p>";
                                    while ($search_item = mysqli_fetch_array($popular_qry))
                                    { ?>
                                        <div class="col-lg-6">
                                        <div class="d-flex mb-3">
                                                <img src="image/<?php echo $search_item["postImage"] ?>" style="width: 50%; height: 100px; object-fit: cover;">
                                                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                                    <div class="mb-1" style="font-size: 13px;">
                                                        <a href="category.php?category=<?php echo $search_item['catName'] ?>"><?php echo $search_item["catName"] ?></a>
                                                        <span class="px-1">/</span>
                                                        <span><?php echo $search_item["postCreated_at"] ?></span>
                                                    </div>
                                                    <a class="h6 m-0" href="single_post.php?post_id=<?php echo $search_item["postId"] ?>"><?php echo $search_item["postTitle"] ?></a>

                                                    <a class='text text-secondary py-2' href="tag.php?tags=<?php echo $search_item["postTag"] ?>"><?php echo $search_item["postTag"] ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                }else{
                                    echo "<strong class='alert alert-warning'>No Data Found Against Your Search ! !</strong>";
                                }
                        }}; ?>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <nav aria-label="Page navigation">
                              <ul class="pagination justify-content-center">
                                <?php
                                    
                                    if ($key != "" && $total_row > $result_per_page) {
                                        for ($i=1; $i <= $total_page; $i++) { ?>
                                        
                                            <form action="search.php" method="get">
                                                <input type="hidden" name="search" value="<?php echo $_GET["search"] ?>">
                                                <button type="submit" name="page" class="btn page-item <?php echo ($i == $page) ? "btn-primary" : "" ?> " value="<?php echo $i ?>"><?php echo $i ?></button>
                                                <!-- <li class="page-item "><a class="page-link  " href="search.php?search?=<?php echo $key ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li> -->

                                            </form>

                                   <?php } }
                                ?>
                              </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 pt-3 pt-lg-0">
                    <!-- Social Follow Start -->
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Follow Us</h3>
                        </div>
                        <?php 

                                $follow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM social_media_link"))

                        ?>
                        <div class="d-flex mb-3">
                            <a href="<?php echo $follow["facebook"] ?>" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #39569E;">
                                <small class="fab fa-facebook-f mr-2"></small><small>12,345 Fans</small>
                            </a>
                            <a href="<?php echo $follow["twitter"] ?>" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #52AAF4;">
                                <small class="fab fa-twitter mr-2"></small><small>12,345 Followers</small>
                            </a>
                        </div>
                        <div class="d-flex mb-3">
                            <a href="<?php echo $follow["linkedin"] ?>" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #0185AE;">
                                <small class="fab fa-linkedin-in mr-2"></small><small>12,345 Connects</small>
                            </a>
                            <a href="" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #C8359D;">
                                <small class="fab fa-instagram mr-2"></small><small>12,345 Followers</small>
                            </a>
                        </div>
                        <div class="d-flex mb-3">
                            <a href="<?php echo $follow["youtube"] ?>" class="d-block w-50 py-2 px-3 text-white text-decoration-none mr-2" style="background: #DC472E;">
                                <small class="fab fa-youtube mr-2"></small><small>12,345 Subscribers</small>
                            </a>
                            <a href="<?php echo $follow["vimo"] ?>" class="d-block w-50 py-2 px-3 text-white text-decoration-none ml-2" style="background: #1AB7EA;">
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
                        <div class="bg-light text-justify p-4 mb-3">
                            <p>Wanna subscribe your newslatter. Everytime you get an email, if there anything chagnge of updated or added.<br>If you do please subscribe !</p>
                            <div class="input-group" style="width: 100%;">
                            <form action="subscribe.php" method="get">
                                <input type="email" class="form-control form-control-lg" placeholder="Your Email" name="email">
                                <small>Subscribe can get all email by his provided email.</small>
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
                                        echo '<li class="text-dark m-2"><a href="category.php?category='. $category["catName"] .'"style="color:black; font-size:18px;"> <i class="fas fa-caret-right px-2 ;" ></i>'. $category["catName"] .'</a></li>';
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
                                        <a href="category.php?category=<?php echo $popular['catName'] ?>"><?php echo $popular["catName"] ?></a>
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