//maethod for like post
function makeLike(id) {
    axios.post("function/like_post.php?post=" + id)
        .then(function (response) {


            // if user not logged in on system
            if (response.data == "login_error") {
                toastr.warning("Please login to react.");

            };
            if (response.data == "already_liked") {
                toastr.info("No need to react. You already react this post once!");
            };
            if (response.data == "success") {
                toastr.success("Liked counted.");
                showPostReaction();
            }

        })
        .catch(function (error) {
            toastr.warning(error);
        });
}



// method for unlike post
function makeUnLike(id) {
    // alert("unlike trigrared !");
    axios.post("function/unlike_post.php?post=" + id)
        .then(function (response) {

            // console.log(response.data);
            // if user not logged in on system
            if (response.data == "login_error") {
                toastr.warning("Please login to react.");

            };
            if (response.data == "not_liked_yet") {
                toastr.info("No need to react. You already react this post once!");
            };

            if (response.data == "success") {
                toastr.success("Unliked .");
                showPostReaction();

            }

        })
        .catch(function (error) {
            toastr.warning(error);
        });
}


// method for user login
function userLogin(e, email, password, uri) {

    let loginButton = document.getElementById('userLoginButton');
    let spinner = '<span style="font-size:14px; opacity:.5;" class="d-flex justify-content-between align-items-center"> verifying..</span ';
    loginButton.innerHTML = spinner;

    console.log(loginButton);
    axios.post("/coderbees/function/user.login.php?email=" + email + "&password=" + password + "&uri=" + uri)
        .then(function (response) {

            loginButton.innerHTML = "Login";

            //user logged in on system
            if (response.data == "success") {
                toastr.success("successfully login");
                window.location.href = '/coderbees/index.php';

            };

            //password not matched
            if (response.data == "password_error") {
                toastr.warning("Email or password are invalid !");
            };

            //if input are empty
            if (response.data == "empty") {
                toastr.warning("Please, Fillid up all the fields !");
                // console.log(e.target);
            }
            // console.log(response.data);

            //email not valid
            if (response.data == "email_not_valid") {
                toastr.info("Please, Give a valid email address !");
            };

            document.getElementById("floatingInput").value = ""
            document.getElementById("floatingPassword").value = ""
        })
        .catch(function (error) {
            // console.log(error);
            toastr.warning(error);
        });
}


//method for count post reaction
function showPostReaction() {
    let postId = document.getElementById('post_id').value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('post_react_show').innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "/coderbees/function/post_react.count.php?post_id=" + postId);
    xmlhttp.send();
}


//method for newsletter
function getNewsletter(clientEmail) {
    // alert(clientEmail);
    let clientEmailField = document.getElementById("newsletterEmailField");
    if (clientEmail == "") {
        $('.newdletterEmailField').focus();
        toastr.info("please, Give a valid email address !");
    } else {
        axios.post("/coderbees/function/subscribe.php?email=" + clientEmail)
            .then((res) => {

                console.log(res.data);
                if (res.data == "error") {
                    toastr.alert("Something Wrong !");
                }
                if (res.data == "success") {
                    toastr.success("We mailed you if anything new in here. Be with us.");
                }
                if (res.data == 'subscribed') {
                    toastr.info("No need ! You already get our newsletter.");
                }
            })
            .catch((error) => {
                toastr.warning(error);
            })
    }
}
// document.getElementById('newsletterButton').addEventListener('click', getNewsletter());


//method for post comment 
function makeComment(postId, publisherId, comment) {
    console.log(postId + "," + publisherId + "," + comment);
    if (comment == "") {
        toastr.info("Leave a comment first !");
        $("#postCommentField").focus();

    } else {
        axios.post("/coderbees/function/comment.php?pId=" + postId + "&pbId=" + publisherId + "&cmt=" + comment + "&leave_comment")
            .then((res) => {

                console.log(res.data);
                if (res.data == "error") {
                    toastr.info("Something Wrong !");
                }
                if (res.data == "success") {
                    toastr.success("Your comment successfully published.");
                }
                if (res.data == 'reject') {
                    toastr.info("You can't comment right now");
                }
            })
            .catch((error) => {
                toastr.warning(error);
            })
    }
}

$(".slick_slide").slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
});

$("#owl-carousel-1").owlCarousel({
    center:true,
    autoplay: true,
    smartSpeed: 1500,
    items: 2,
    dots: false,
    loop: true,
    nav: true,
    navText: [
        '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        '<i class="fa fa-angle-right" aria-hidden="true"></i>'
    ]
});