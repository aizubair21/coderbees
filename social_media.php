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