

    <div class="container-fluid bg-light pt-5 px-sm-3 px-md-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="index.php" class="navbar-brand">
                    <h1 class="mb-2 mt-n2 display-5 text-uppercase"><span class="text-primary">Coder</span>bees</h1>
                </a>
                <p>Volup amet magna clita tempor. Tempor sea eos vero ipsum. Lorem lorem sit sed elitr sed kasd et</p>
                <div class="d-flex justify-content-start align-items-center mt-4">
                    <a class="btn btn-outline-primary text-center mr-2 px-0" style="width: 38px; height: 38px; " href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-primary text-center mr-2 px-0" style="width: 38px; height: 38px; " href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary text-center mr-2 px-0" style="width: 38px; height: 38px; " href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-primary text-center mr-2 px-0" style="width: 38px; height: 38px; " href="#"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-outline-primary text-center mr-2 px-0" style="width: 38px; height: 38px; " href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-bold mb-4">Categories</h4>
                <div class="d-flex flex-wrap m-n1">
                    <?php 
                        
                        $cat_qry = mysqli_query($conn, "SELECT catId, catName FROM category ORDER BY catId DESC LIMIT 10");
                        if (mysqli_num_rows($cat_qry) > 0) {
                            while($cat = mysqli_fetch_assoc($cat_qry)){
                                echo '<a href="category.php?category='.$cat["catName"].'" class="btn btn-sm btn-outline-secondary m-1">'. $cat["catName"]. '</a>';
                            }
                        }
                    ?>
                    
                   
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-bold mb-4">Tags</h4>
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
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-bold mb-4">Quick Links</h4>
                <div class="d-flex flex-column justify-content-star">
                    <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>About</a>
                    <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Advertise</a>
                    <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Privacy & policy</a>
                    <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Terms & conditions</a>
                    <a class="text-secondary" href="#"><i class="fa fa-angle-right text-dark mr-2"></i>Contact</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4 px-sm-3 px-md-5">
        <p class="m-0 text-center">
            &copy; <a class="font-weight-bold" href="#">Your Site Name</a>. All Rights Reserved. 
			
			<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
			Designed by <a class="font-weight-bold" href="https://htmlcodex.com">HTML Codex</a>
        </p>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-dark back-to-top"><i class="fa fa-angle-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="bootstrap-5.1.0-dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>