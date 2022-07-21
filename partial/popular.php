<div class="pb-3">
    <div class="bg-light py-2 px-4 mb-3">
        <h3 class="m-0">Most View </h3>
    </div>
    <?php
    $popular_qry = $mysqli->select(['postId', 'postTitle', 'postImage', 'postCreated_at', 'postCategory', 'catName', 'view'])->from("posts")->join("LEFT JOIN category ON category.catId = posts.postCategory ")->where("posts.postStatus = 1")->order("view")->DESC()->limit(5)->get();
    // $popular_qry = mysqli_query($conn, "SELECT postId,post,postTitle,postImage, postCreated_at, postCategory, catName FROM posts LEFT JOIN category ON category.catId = posts.postCateIMITgory WHERE postStatus = 1 ORDER BY posts.postId DESC Limit 4 ");
    while ($popular = $popular_qry->fetch_assoc()) { ?>
        <div class="d-flex mb-3" id="wrapper">
            <style>
                #wrapper {
                    position: relative;
                    overflow: hidden;
                }

                #wrapper_div {
                    content: "";
                    position: absolute;
                    top: 70%;
                    left: 60%;
                    border-top-right-radius: 103xp;
                    opacity: 1;
                    transform: translate;
                    background-color: rgba(0, 0, 0, .7);
                    color: #fffdfd;
                    padding: 2px;
                    width: 175px;
                    font-weight: 600;
                    font-size: 20px;
                    padding: 2px;
                }
            </style>
            <div class="w-100 d-flex flex-column justify-content-evenly align-items-end bg-light px-3">
                <a class="h6 m-0 test-right" href="posts?post_id=<?php echo $popular["postId"] ?>"><?php echo $popular["postTitle"] ?></a>
                <div class="mb-1" style="font-size: 13px;">
                    <a class='text-primary' href="category.php?category=<?php echo $popular["catName"] ?>"><?php echo $popular["catName"] ?></a>
                    <span class="px-1">/</span>
                    <span><?php echo $popular["postCreated_at"] ?></span>
                </div>
            </div>
            <img src="<?php echo GlobalROOT_PATH ?>/image/<?php echo $popular["postImage"] ?>" style="width: 150px; height: 100px; object-fit:cover;">
            <div id="wrapper_div"><?php echo $popular["view"] . " Views" ?></div>
        </div>

    <?php } ?>
</div>