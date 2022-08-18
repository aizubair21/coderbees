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
            console.log(error);
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
                toastr.success("Liked counted.");
            }

        })
        .catch(function (error) {
            console.log(error);
        });
}


// method for user login
function userLogin(email, password, uri) {
    axios.post("/coderbees/function/user.login.php?email=" + email + "&password=" + password + "&uri=" + uri)
        .then(function (response) {

            console.log(response.data);

            // if user not logged in on system
            if (response.data == "success") {
                toastr.success("successfully login");
                window.location.href = '/coderbees/index.php';

            };
            if (response.data == "password_error") {
                toastr.warning("Email or password are invalid !");
            };
            if (response.data == "empty") {
                toastr.warning("Please, Fillid up all the fields !");
            }

        })
        .catch(function (error) {
            // console.log(error);
            toastr.alert(error);
        });
}