<?php


$conn = mysqli_connect('localhost','root','','coderbees');

$key = $_SESSION["publisher_key"] ?? '';

if ($key) {
    $GLOBALS['auth_publisher'] = GetPublisher($key);
}


define('ROOT_PATH', dirname(__DIR__) . '/');
define('ADMIN_PATH', ROOT_PATH."admin/");
define('PUBLISHER_PATH', ROOT_PATH."publisher/");
define('CATEGORY_PATH', ROOT_PATH."category/");


//echo $auth_user["user_name"];

function getData($key){
    $conn = mysqli_connect('localhost','root','','users');
    $data = "SELECT * FROM publisher WHERE id='$key'";
    $result = mysqli_query($conn, $data);
    if(mysqli_num_rows($result) > 0) {
        return $row = mysqli_fetch_assoc($result);
       
    }else {
        return "Not found !";
    }
}

function getPublisher($key){
    $conn = mysqli_connect('localhost','root','','users');
    $data = "SELECT * FROM publisher WHERE id='$key'";
    $result = mysqli_query($conn, $data);
    if(mysqli_num_rows($result) > 0) {
        return $row = mysqli_fetch_assoc($result);
       
    }else {
        return "Not found !";
    }
}


function getAllPublisher(){
    $conn = mysqli_connect('localhost','root','','coderbees');
    $data = "SELECT * FROM publisher";

    return mysqli_query($conn, $data);
     
}

function getPosts(){
    $conn = mysqli_connect('localhost','root','','coderbees');
    $data = "SELECT * FROM posts";
    $result = mysqli_query($conn, $data);
    if(mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }else {
        return "Not found !";
    }
}




function isInAdminDatabase ($user_name) {
    $conn = mysqli_connect('localhost','root','','coderbees');
    $data = "SELECT * FROM admin WHERE user_name='$user_name'";
    $result = mysqli_query($conn, $data);
    if(mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
       
    }
}

