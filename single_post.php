<?php

    $active = "single_post";
    $title = "Single Post - coderbees ";
    include "header.php";
    include "connection.php";
    $single_post_id = $_GET["post_id"] ?? "";
    $single_post = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory LEFT JOIN publisher ON publisher.publisherId = posts.postPublisher WHERE posts.postId = $single_post_id AND posts.postStatus = 1"));

?>


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="container">
            <nav class="breadcrumb bg-transparent m-0 p-0">
                <a class="breadcrumb-item" href="index.php">Home</a>
                <a class="breadcrumb-item" href="category.php?show_category=all_category">Category</a>
                <a class="breadcrumb-item" href="category.php?category=<?php echo $single_post["catName"] ?>"><?php echo $single_post["catName"] ?></a>
                <span class="breadcrumb-item active"><?php echo $single_post["postTitle"] ?></span>
            </nav>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- News With Sidebar Start -->
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- News Detail Start -->
                    <div class="position-relative mb-3">
                        <img class="img-fluid w-100 h-sm-100" style="height:100%" src="image/<?php echo $single_post["postImage"] ?>" style="object-fit: cover;">
                        <div class="overlay position-relative bg-light">
                            <div class="mb-3">
                                <a href="category.php?category=<?php echo $single_post["catName"] ?>"><?php echo $single_post["catName"] ?></a>
                                <span class="px-1">/</span>
                                <span><?php echo $single_post["postCreated_at"] ?></span>
                            </div>
                            <div>
                            <?php echo $single_post["post"] ?>
                            </div>
                        </div>
                    </div>
                    <!-- News Detail End -->

                    <!-- Comment List Start -->
                    <div class="bg-light mb-3" style="padding: 30px;">
                        <?php 
                            $get_comment_qry = mysqli_query($conn, "SELECT comment, commentUser, commentOn, commentsPostId, commentStatus FROM comments WHERE commentsPostId = $single_post_id AND commentStatus = 1");
                            if ($count = mysqli_num_rows($get_comment_qry) > 0 ) { ?>

                                <h3 class="mb-4"><?php echo mysqli_num_rows($get_comment_qry) ?> Comments</h3>
                                <?php
                                    while ($comments = mysqli_fetch_assoc($get_comment_qry)) { ?>
                                        
                                        <div class="media mb-4">
                                            <i class="fas fa-user-circle" style="font-size:30px; padding:2px;"></i>
                                            <div class="media-body px-3">
                                                <h6><a href=""><?php  echo $comments["commentUser"] ?> </a> <small><i><?php echo $comments["commentOn"] ?></i></small></h6>
                                                <p><?php echo $comments["comment"] ?></p>
                                                <button class="btn btn-sm btn-outline-secondary">Reply</button>
                                                <!-- <div class="media mt-4">
                                                    <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1"
                                                        style="width: 45px;">
                                                    <div class="media-body">
                                                        <h6><a href="">John Doe</a> <small><i>01 Jan 2045 at 12:00pm</i></small></h6>
                                                        <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor
                                                            labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed
                                                            eirmod ipsum. Gubergren clita aliquyam consetetur sadipscing, at tempor amet
                                                            ipsum diam tempor consetetur at sit.</p>
                                                        <button class="btn btn-sm btn-outline-secondary">Reply</button>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                   <?php } }else {
                                 echo "<strong class='alert alert-warning w-100'>NO Comment</strong>";
                             }
                        ?>

                    </div>
                    <!-- Comment List End -->

                    <!-- Comment Form Start -->
                    <?php 
                        if ($_SESSION['user_key'] ?? "") { ?>
                           
                        <div class="bg-light mb-3" style="padding: 30px">
                            <h3 class="mb-4 text-primary">Leave a comment</h3>
                            <form action="comment.php" method="POST" class="">
                                <input type="hidden" name="postId" value="<?php echo $single_post_id ?>">
                                <input type="hidden" name="publisherId" value="<?php echo $single_post["postPublisher"] ?>">
                                <div class="form-group d-flex justify-content-between align-items-center">
                                    <input type="text" id="message" name="comment" class="form-control">
                                    <input type="submit" name="leave_comment" value=" comment" class="btn btn-success font-weight-semi-bold py-2 px-3">
                                </div>
                            </form>
                        </div>

                       <?php } else {
                           echo "<strong class='alert alert-warning'> Please login to make a comment ! </strong>";
                       }
                    ?>
                    <!-- Comment Form End -->
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
                    <div class="mb-3 pb-3">
                        <a href=""><img class="img-fluid" src="img/news-500x280-4.jpg" alt=""></a>
                    </div>
                    <!-- Ads End -->

                    <!-- Popular News Start -->
                    <div class="pb-3">
                        <div class="bg-light py-2 px-4 mb-3">
                            <h3 class="m-0">Tranding</h3>
                        </div>
                        <?php 
                            $tranding_category = $single_post["postCategory"];
                            $tranding_qry = mysqli_query($conn, "SELECT posts.postTitle, posts.postCreated_at, posts.postCategory, posts.postImage, category.catName FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE posts.postCategory = $tranding_category ORDER BY posts.postId LIMIT 5");
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

<?php 
    include "footer.php";
?>