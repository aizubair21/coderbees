<div class="pb-3">
    <div class="border-bottom border-primary mb-3">
        <h3 class="m-0 py-1 px-4 text-light bg-primary d-inline-flex">Most View </h3>
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
                    left: 74%;
                    border-top-right-radius: 103xp;
                    opacity: 1;
                    transform: translate;
                    background-color: rgba(0, 0, 0, .7);
                    color: #fffdfd;
                    padding: 2px;
                    width: 175px;
                    font-weight: 600;
                    font-size: 16px;
                    padding: 2px;
                }
            </style>
            <div class="w-100 d-flex flex-column justify-content-evenly align-items-end bg-light px-3">
                <a class="h6 m-0 text-left" href="<?php url_for('posts/' . $popular["postId"] .'/'. str_replace(" ", "-", $popular["postTitle"])) ?>"><?php echo $popular["postTitle"] ?></a>
                <div class="mb-1 text-left w-100" style="font-size: 13px;">
                    <a class='text-primary' href="<?php url_for('category/' . $popular["catName"]) ?>"><?php echo $popular["catName"] ?></a>
                    <span class="px-1">/</span>
                    <span><?php echo $popular["postCreated_at"] ?></span>
                </div>
            </div>
            <div style="width:40%; height:100px">
                <img src="<?php echo GlobalROOT_PATH ?>/image/<?php echo $popular["postImage"] ?>" style="width: 100%; height: 100px; object-fit:cover;">
            </div>
            <div id="wrapper_div"><?php echo $popular["view"] . " Views" ?></div>
        </div>

    <?php } ?>
</div>