<?php

$title = "Contactus";
$active = "contact";
include "connection.php";
include "header.php";




?>


<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="container">
        <style>
            .breadcrumbs-item {
                padding: 2px 10px;
                margin: 0px 3px;
                position: relative;
                text-align: center;
                color: white;
                z-index: 1;
            }

            .breadcrumbs-item:hover {
                color: white;
            }

            .breadcrumbs-item::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: #6c757d;
                z-index: -1;
                transform: skewX(-25deg);
            }

            .breadcrumbs-item::before {
                content: '';
                position: absolute;
                top: 0;
                right: 0;
                width: 10%;
                height: 130%;
                background-color: #6c757d;
                transform: skewx(-25deg);
                z-index: -1;
            }
        </style>
        <nav class="breadcrumb">
            <a class="breadcrumbs-item" href="index.php">Home</a>
            <a class="breadcrumbs-item">Contact Us</a>
        </nav>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Contact Start -->
<div class=" container-fluid py-3">
    <div class="container">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Contact Us For Any Queries</h3>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="bg-light mb-3" style="padding: 30px;">
                    <h6 class="font-weight-bold">Get in touch</h6>
                    <p>Labore ipsum ipsum rebum erat amet nonumy, nonumy erat justo sit dolor ipsum sed, kasd lorem sit et duo dolore justo lorem stet labore, diam dolor et diam dolor eos magna, at vero lorem elitr</p>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-2x fa-map-marker-alt text-primary mr-3"></i>
                        <div class="d-flex flex-column">
                            <h6 class="font-weight-bold">Our Office</h6>
                            <p class="m-0">123 Street, New York, USA</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-2x fa-envelope-open text-primary mr-3"></i>
                        <div class="d-flex flex-column">
                            <h6 class="font-weight-bold">Email Us</h6>
                            <p class="m-0">info@example.com</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-2x fa-phone-alt text-primary mr-3"></i>
                        <div class="d-flex flex-column">
                            <h6 class="font-weight-bold">Call Us</h6>
                            <p class="m-0">+012 345 6789</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="contact-form bg-light mb-3" style="padding: 30px;">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <input type="text" class="form-control p-4" id="name" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="control-group">
                                    <input type="email" class="form-control p-4" id="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control p-4" id="subject" placeholder="Subject" required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="4" id="message" placeholder="Message" required="required" data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary font-weight-semi-bold px-4" style="height: 50px;" type="submit" id="sendMessageButton">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<?php
include "footer.php";

?>