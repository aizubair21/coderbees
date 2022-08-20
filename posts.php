<?php
include "connection.php";

$single_post_id = $_GET["post_id"] ?? "";
if (isset($_GET["post_id"])) {

    //get the post which url was clicked
    // $single_post = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM posts LEFT JOIN category ON category.catId = posts.postCategory LEFT JOIN publisher ON publisher.publisherId = posts.postPublisher WHERE posts.postId = $single_post_id AND posts.postStatus = 1"));


    $single_post_query = $mysqli->select([])->from('posts')->join("LEFT JOIN category ON category.catId = posts.postCategory LEFT JOIN publisher ON publisher.publisherId = posts.postPublisher")->where("posts.postId = $single_post_id AND posts.postStatus = 1")->get();
    // echo "<pre>";
    // print_r($single_post_query);

    // echo "</pre>";
    $single_post = $single_post_query->fetch_assoc();

    //if post not found. 
    if ($single_post) {
        //echo "ok";
        //incress value of view
        $id = $single_post['postId'];
        $view = ($single_post['view'] < 1) ? 1 : $single_post['view'] + 1;
        $view = mysqli_query($conn, "UPDATE posts SET view = $view WHERE postId = $id");
    } else {
        $redirectURI = $_SERVER['HTTP_REFERER'];
        header("location: home.php");
    }
} else {
    header("location: $redirectURI");
}

//for which item will be active in navigation item.
$active = "posts";

//for page title 
$title =  $single_post['postTitle'];
include "header.php";

// print_r(

//     $_SERVER['HTTP_REFERER']
// );


?>


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="container">
        <nav class="breadcrumbs">
            <a class="breadcrumbs-item" href="index.php"> <i class="fas fa-home"></i> home</a>
            <a class="breadcrumbs-item" href="blog.php"> Post</a>
            <span class="breadcrumbs-item-active "><?php echo $single_post["postTitle"] ?? "" ?></span>
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
                <div class="position-relative mb-3 bg-light">
                    <div class="d-block position-relative">
                        <div>
                            <img class=" w-100" src="/coderbees/image/<?php echo $single_post["postImage"] ?>" style="object-fit: cover;">
                        </div>
                        <div class="mb-3 p-2 text-left">
                            <div class='h3'>
                                <?php
                                echo $single_post['postTitle'];
                                echo '<br>';
                                ?>
                                <br>

                            </div>
                            <div class="fs-6 m-0 p-0">
                                <?php
                                echo "Publisher :  <a href='#' > {$single_post['publisherUser_name']} </a>";

                                ?>
                            </div>
                            <div class='fs-6 d-flex align-items-center'>
                                <a href="category.php?category=<?php echo $single_post["catName"] ?>" class='btn btn-outline-primary btn-sm'> <i class="fas fa-arrow-circle-right"></i> <?php echo $single_post["catName"] ?></a>
                                <span class="px-1">/</span>
                                <span> <i class="fas fa-clock"></i> <?php echo $single_post["postCreated_at"] ?></span>
                            </div>
                        </div>

                    </div>

                    <div class="overlay position-relative bg-light">
                        <div>
                            <?php echo $single_post["post"] ?>
                        </div>
                        <div>
                            <hr class="bg-primary">
                            <p>Give Your Openions </p>
                            <div class="d-flex align-items-center justify-content-start text-center">

                                <div class="d-flex align-items-center">

                                    <!-- for like -->
                                    <form action="" method="get" name="like_form">
                                        <input type="hidden" name="post_id" id="post_id" value="<?php echo $single_post['postId'] ?>">
                                        <button title="like" type="button" class="btn btn-outline-secondary btn-sm" onclick="makeLike(like_form.post_id.value)"> <i class="fas fa-caret-up"></i> </button>
                                    </form>
                                    <!-- <a href=" <?php echo GlobalROOT_PATH ?>/function/like_post.php?post=<?php echo $single_post['postId'] ?>" type="button" name="like" title="Like" class="btn btn-outline-secondary btn-sm"> <i class="fas fa-caret-up"></i> </a> -->

                                    <!-- show reaction -->
                                    <div class="text-secondary px-2 " id="post_react_show">
                                        <script>
                                            function showPostReaction() {
                                                let postId = document.getElementById('post_id').value;
                                                var xmlhttp = new XMLHttpRequest();
                                                xmlhttp.onreadystatechange = function() {
                                                    if (this.readyState == 4 && this.status == 200) {
                                                        document.getElementById('post_react_show').innerHTML = this.responseText;
                                                    }
                                                };
                                                xmlhttp.open("GET", "/coderbees/function/post_react.count.php?post_id=" + postId);
                                                xmlhttp.send();
                                            }

                                            showPostReaction();
                                        </script>

                                    </div>

                                    <!-- for unlike  -->
                                    <form action="" method="get" name="unlike_form">
                                        <input type="hidden" name="post_id" value="<?php echo $single_post['postId'] ?>">
                                        <button title="Unlike" type="button" class="btn btn-outline-secondary btn-sm" onclick="makeUnLike(Unlike_form.post_id.value)"> <i class="fas fa-caret-down"></i> </button>
                                    </form>
                                    <!-- <a href="<?php echo GlobalROOT_PATH ?>/function/unlike_post.php?post=<?php echo $single_post['postId'] ?>" title="Dislike" name="unlike" class="btn btn-outline-secondary btn-sm"> <i class="fas fa-caret-down"></i> </a> -->
                                </div>

                                <!-- button for showing comments modals -->
                                <button type="button" class="mx-2 px-2 btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#commentsModal"> <i class="fas fa-comment pe-2"></i>
                                    <?php
                                    $comnt = mysqli_query($conn, "SELECT * FROM comments WHERE commentsPostId = $single_post_id AND commentStatus = 1");
                                    echo mysqli_num_rows($comnt);
                                    ?>
                                </button>

                                <!-- show how many time watch this post -->
                                <button type="button" class="px-2 btn btn-outline-secondary btn-sm"> <i class="fas fa-eye pe-2"></i> <?php echo $single_post['view'] ?> </button>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- News Detail End -->



                <!-- Comment Form Start -->
                <?php
                if ($_SESSION['user_key'] ?? "") { ?>

                    <div class="bg-light mb-3" style="padding: 30px">
                        <h3 class="mb-4 text-primary">Leave a comment</h3>
                        <form action="<?php echo GlobalROOT_PATH ?>/function/comment.php" method="POST" class="">
                            <input type="hidden" name="postId" value="<?php echo $single_post_id ?>">
                            <input type="hidden" name="publisherId" value="<?php echo $single_post["postPublisher"] ?>">
                            <div class="form-group d-flex justify-content-between align-items-center">
                                <input type="text" id="message" name="comment" class="form-control">
                                <input type="submit" name="leave_comment" id="get_comment" value="  comment" class="btn btn-success font-weight-semi-bold py-2 px-3">
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
                <?php include "partial/social_media.php" ?>
                <!-- Social Follow End -->

                <!-- Newsletter Start -->
                <?php
                include "partial/newsletter.php";
                ?>
                <!-- Newsletter End -->

                <!-- Ads Start -->
                <!-- <div class="mb-3 pb-3">
                    <a href=""><img class="img-fluid" src="img/news-500x280-4.jpg" alt=""></a>
                </div> -->
                <!-- Ads End -->

                <!-- Popular News Start -->
                <div class="pb-3">
                    <div class="border-bottom border-primary mb-3">
                        <h4 class="m-0 py-2 px-4 text-light bg-primary d-inline-flex">Realted Post</h4>
                    </div>
                    <?php

                    //category_related_post() method/function are defined at coderbees/partial/related_post.php file
                    category_related_post($single_post['postCategory'], $conn);
                    ?>

                </div>
                <!-- Popular News End -->

                <!-- Tags Start -->
                <!-- <div class="pb-3">
                    <div class="border-bottom border-primary mb-3">
                        <h4 class="m-0 text-light bg-primary d-inline-flex py-2 px-4">Tags</h3>
                    </div>
                    <div class="d-flex flex-wrap m-n1">
                        <?php
                        // $mysqli = new DBSelect;

                        //current category
                        $cat = $single_post['postCategory'];

                        ?>
                    </div>
                </div> -->
                <!-- Tags End -->
            </div>
        </div>
    </div>
</div>

</div>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary">
    Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div>

                    <h5 class="modal-title" id="exampleModalLabel"> Post's Comment </h5>
                    <a href="/coderbees/posts.php?post_id=<?php echo trim($single_post["postId"]) ?>">
                        <h6 class="text-primary"><?php echo $single_post['postTitle'] ?></h6>

                    </a>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow-Y: scroll ;">
                <!-- Comment List Start -->
                <div class="bg-light mb-1 fs-6" style="padding: 30px;">
                    <?php
                    $get_comment_qry = mysqli_query($conn, "SELECT comment, commentUser, commentOn, commentsPostId, commentStatus FROM comments WHERE commentsPostId = $single_post_id AND commentStatus = 1");
                    if ($count = mysqli_num_rows($get_comment_qry) > 0) { ?>

                        <h5 class="mb-2"><?php echo mysqli_num_rows($get_comment_qry) ?> Comments</h5>
                        <?php
                        while ($comments = mysqli_fetch_assoc($get_comment_qry)) { ?>

                            <div class="media mb-4" style="font-size: 12px;">
                                <i class="fas fa-user-circle" style="font-size:30px; padding:2px;"></i>
                                <div class="media-body px-3">
                                    <h6><a href=""><?php echo $comments["commentUser"] ?> </a> <small><i><?php echo $comments["commentOn"] ?></i></small></h6>
                                    <p><?php echo $comments["comment"] ?></p>
                                    <button class="btn btn-sm btn-outline-secondary">Reply</button>
                                    <div class="media mt-4">
                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6><a href="">John Doe</a> <small><i>01 Jan 2045 at 12:00pm</i></small></h6>
                                            <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor
                                                labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed
                                                eirmod ipsum. Gubergren clita aliquyam consetetur sadipscing, at tempor amet
                                                ipsum diam tempor consetetur at sit.</p>
                                            <button class="btn btn-sm btn-outline-secondary">Reply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } else {
                        echo "<strong class='alert alert-warning w-100'>NO Comment</strong>";
                    }
                    ?>

                </div>
                <!-- Comment List End -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- News With Sidebar End -->

<?php

include "footer.php";


?>