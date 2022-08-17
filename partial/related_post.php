<?php

function category_related_post($category, $conn)
{
    $tranding_qry = mysqli_query($conn, "SELECT posts.postTitle, posts.postCreated_at, posts.postCategory, posts.postImage, category.catName FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE posts.postCategory = $category ORDER BY posts.postId LIMIT 5");
    while ($tranding = mysqli_fetch_assoc($tranding_qry)) { ?>

        <div class="d-flex mb-3">
            <div style="width: 40%;">
                <img src="/coderbees/image/<?php echo $tranding["postImage"] ?>" style="width: 100%; height: 100px; object-fit: cover;">
            </div>
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
}


function tag_related_post($tags, $conn)
{
    $tranding_qry = mysqli_query($conn, "SELECT posts.postTitle, posts.postCreated_at, posts.postCategory, posts.postImage, category.catName FROM posts LEFT JOIN category ON category.catId = posts.postCategory WHERE posts.postTags = $tags ORDER BY posts.postId LIMIT 5");
    while ($tranding = mysqli_fetch_assoc($tranding_qry)) { ?>

        <div class="d-flex mb-3">
            <div style="width: 40%">
                <img src="/coderbees/image/<?php echo $tranding["postImage"] ?>" style="width: 100%; height: 100px; object-fit: cover;">
            </div>
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
}
?>