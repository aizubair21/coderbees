function makeLike(id) {
    axios.post("/coderbees/function/like_post.php?post=" + id)
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
            }

        })
        .catch(function (error) {
            toastr.warning(error);
        });
}



// method for unlike post
function makeUnLike(id) {
    axios.post("/coderbees/function/like_post.php?post=" + id)
        .then(function (response) {

            // if user not logged in on system
            if (response.data == "login_error") {
                toastr.warning("Please login to react.");

            };
            if (response.data == "not_liked_yet") {
                toastr.info("No need to react. You already react this post once!");
            };

            if (response.data == "success") {
                toastr.success("Unliked .");
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


//post react cou