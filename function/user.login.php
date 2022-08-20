<?php
include "../connection.php";

$email = $_GET['email'] ?? "";
$password = $_GET['password'] ?? "";
$redirectURI = $_GET["uri"] ?? "";

//take user from server by email
$data = "SELECT * FROM users WHERE userEmail='$email'";
$result = mysqli_query($conn, $data);
$count = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

// if user submit empty data
if (!empty($email) && !empty($password)) {

    //if giver email are not valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //if user exist, means row gretter then 0
        if ($count == 1) {

            //get password from database
            $db_password = $row['userPassword'];

            //if password matched
            if (password_verify($password, $row["userPassword"]) || $password == $row["userPassword"]) {
                $_SESSION["user_key"] = $row["userId"];
                // $_SESSION["status"] = "greeting";
                // header("location: $redirectURI");
                echo "success";
            } else {
                //pas not matched
                echo  "password_error";
            }
        } else {
            //if user not exist.
            echo "password_error";
        }
    } else {
        //email not valid
        echo "email_not_valid";
    }
} else {

    //if have any input filed are empty
    echo "empty";
    // $success = array("result" => "success", "uri" => "$redirectURI");
    // print_r($success);
}
