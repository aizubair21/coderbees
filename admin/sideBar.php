<style>
    td{
        text-align: center;
        font-size: 15px;
        color:black;
    }
</style>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    
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
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-users"></i>
        <span>Publisher</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class=" text-white collapse-inner rounded">
            <a class="collapse-item" href="publisher.php">Publisher Controls</a>
            <a class="collapse-item" href="publisher_insert.php">Publisher Add</a>
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
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
    aria-expanded="true" aria-controls="collapseUtilities2">
    <i class="fas fa-caret-square-o-left"></i>
    <span>Posts</span>
</a>
<div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
data-parent="#accordionSidebar">
<div class=" text-white collapse-inner rounded">
        <a class="collapse-item" href="posts/post_view.php">Posts Controls</a>
        <a class="collapse-item" href="posts/post_add.php">Post Add</a>
    </div>
</div>
</li>
<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
    aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-caret-square-o-left"></i>
    <span>Category</span>
</a>
<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
    data-parent="#accordionSidebar">
    <div class=" text-white collapse-inner rounded">
        <a class="collapse-item" href="category/index.php">Category Controls</a>
        <a class="collapse-item" href="category/insert.php">Category Add</a>
    </div>
</div>
</li>
<li class="nav-item">
    <a class="nav-link" href="show_subscribe.php">Subscriber</a>
    <a class="nav-link" href="social_media_control.php">Social Media Control</a>
</li>

</ul>