<style>
    td {
        text-align: center;
        font-size: 15px;
        color: black;
    }

    .nav-link {
        cursor: pointer;
    }
</style>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo ADMIN_PATH ?>index.php">

        <div class="sidebar-brand-text mx-3">CB Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Admin Control
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <div class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-users"></i>
            <span>Publisher</span>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class=" text-white collapse-inner rounded">
                <a class="collapse-item" href="<?php echo ADMIN_PATH ?>publisher.php">Publisher Controls</a>
                <a class="collapse-item" href="<?php echo ADMIN_PATH ?>publisher/publisher_insert.php">Publisher Add</a>
            </div>
        </div>
    </li>




    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Site Control
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <div class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities2">
            <i class="fas fa-caret-square-o-left"></i>
            <span>Posts</span>
        </div>
        <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class=" text-white collapse-inner rounded">
                <a class="collapse-item" href="<?php echo ADMIN_PATH ?>posts/post_view.php">Posts Controls</a>
                <a class="collapse-item" href="<?php echo ADMIN_PATH ?>posts/post_add.php">Post Add</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <div class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-caret-square-o-left"></i>
            <span>Category</span>
        </div>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class=" text-white collapse-inner rounded">
                <a class="collapse-item" href="<?php echo ADMIN_PATH ?>category/index_category.php">Category Controls</a>
                <a class="collapse-item" href="<?php echo ADMIN_PATH ?>category/insert_category.php">Category Add</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <div class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#siteUtilities" aria-expanded="true" aria-controls="siteUtilities">
            <i class="fas fa-caret-square-o-left"></i>
            <span>Site Setting</span>
        </div>
        <div id="siteUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class=" text-white collapse-inner rounded">
                <a class="collapse-item" href="show_subscribe.php">Subscriber</a>
                <a class="collapse-item" href="social_media_control.php">Social Media Control</a>
                <a class="collapse-item" href="<?php echo ADMIN_PATH ?>settings/site_setting.php">General Site Setting</a>
                <a class="collapse-item" href="<?php echo ADMIN_PATH ?>settings/home_page_setting.php">Homepage Setting</a>
            </div>
        </div>
    </li>

</ul>