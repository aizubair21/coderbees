<div class="pb-3">
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
</div>