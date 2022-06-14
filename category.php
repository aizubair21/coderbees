<?php
    $active = "category";
    $title = "Categories - coderbees";
    include "header.php";
    include "connection.php";


    $category = $_GET["category"] ?? "";
    $all_category = $_GET["show"] ?? "";

   

?>


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="container">
            <nav class="breadcrumb bg-transparent m-0 p-0">
                <a class="breadcrumb-item" href="index.php">Home</a>
                <a class="breadcrumb-item" href="category.php?show=all_category">Category</a>
                <span class="breadcrumb-item active"><?php echo ($category ?? "All Blogs") ?></span>
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
                            <div class="d-flex align-items-center justify-content-between bg-light py-2  mb-3">
                                <h3 class="m-0">Show blogs for category "<?php echo  $category ?? "" ?>"</h3>
                            </div>
                        </div>   
                    </div>


                    <div class="row">


                        <?php
                            if (isset($category)) {

                                $get_cat_id = mysqli_query($conn, "SELECT catId FROM category WHERE catName = '$category'");
                                if (mysqli_num_rows($get_cat_id) > 0 ) {
                                    $cat_id = mysqli_fetch_array ($get_cat_id);
                                    $catId = $cat_id["catId"];
                                
                                

                                if (isset($catId)) {
                                    
                                    $get_cat_wise_post = mysqli_query($conn, "SELECT * FROM posts Where postCategory = '$catId' AND postStatus = 1");
                                       if(mysqli_num_rows($get_cat_wise_post) < 1) {
                                            echo "<strong class='alert alert-warning'>No Result Found !</strong>";
                                        }   
                                    while ($posts = mysqli_fetch_assoc($get_cat_wise_post)) { ?>
                                        <div class="col-lg-6">
                                            <div class="d-flex mb-3">
                                                <img src="image/<?php echo $posts["postImage"] ?>" style="width: 100px; height: 100px; object-fit: cover;">
                                                <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                                    <div class="mb-1" style="font-size: 13px;">
                                                        <a href="category.php?category=<?php echo $category ?>"> <?php echo $category ?> </a>
                                                        <span class="px-1">/</span>
                                                        <span> <?php echo $posts['postCreated_at'] ?> </span>
                                                    </div>
                                                    <a class="h6 m-0" href="single_post.php?post_id=<?php echo $posts["postId"] ?>"><?php echo $posts["postTitle"] ?></a>

                                                    <a class='text text-secondary width-10 py-2' href="tag.php?tags=<?php echo $posts["postTag"] ?>"><span><?php echo $posts["postTag"] ?></span></a>
                                                </div>
                                            </div>
                                        </div>

                                <?php } }
                               
                               

                            }elseif ($all_category == "all_category") {
                                $post = mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE posts.postStatus = 1 ");
                                while ($posts = mysqli_fetch_assoc($post)) { ?>
                                    <div class="col-lg-6">
                                        <div class="d-flex mb-3">
                                            <img src="image/<?php echo $posts["postImage"] ?>" style="width: 100px; height: 100px; object-fit: cover;">
                                            <div class="w-100 d-flex flex-column justify-content-center bg-light px-3" style="height: 100px;">
                                                <div class="mb-1" style="font-size: 13px;">
                                                    <a href="category.php?category=<?php echo $posts["catName"] ?>"> <?php echo $posts["catName"] ?> </a>
                                                    <span class="px-1">/</span>
                                                    <span> <?php echo $posts['postCreated_at'] ?> </span>
                                                </div>
                                                <a class="h6 m-0" href="single_post.php?post_id=<?php echo $posts['postId'] ?>"><?php echo $posts["postTitle"] ?></a>

                                                <a class='text text-secondary width-10 py-2' href="tag.php?tags=<?php echo $posts["postTag"] ?>"><span><?php echo $posts["postTag"] ?></span></a>
                                            </div>
                                        </div>
                                    </div>
                               <?php }
                            } }
                        ?>
                        
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
                                <input type="email" class="form-control form-control-lg" placeholder="Your Email" name="email" required>
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

<?php include "footer.php" ?>