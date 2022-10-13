<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'coderbees');

$key = $_SESSION["publisher_key"] ?? '';

if ($key) {
    $GLOBALS['auth_publisher'] = getAuthPublisher($key);
}

//include "../function.php";


define('ROOT_PATH', dirname(__DIR__) . '/');
define('ADMIN_PATH', ROOT_PATH . "admin/");
define('PUBLISHER_PATH', ROOT_PATH . "publisher/");
define('CATEGORY_PATH', ROOT_PATH . "category/");
// echo PUBLISHER_PATH;

function url_for($script_url)
{
    //add the loading '/' if not present.
    if ($script_url[0] != '/') {
        $script_url = '/' . $script_url;
    }

    echo "/coderbees/" . $script_url;
}

//echo $auth_user["user_name"];

function getSingleData($table, $key)
{
    $conn = mysqli_connect('localhost', 'root', '', 'coderbees');

    if ($table == "publisher") {
        $data1 = "SELECT * FROM publisher WHERE publisherId='$key'";
        $result1 = mysqli_query($conn, $data1);
        if (mysqli_num_rows($result1) > 0) {
            return  mysqli_fetch_assoc($result1);
        } else {
            return "Not found !";
        }
    } elseif ($table == "posts") {
        $data2 = "SELECT * FROM posts WHERE postId='$key'";
        $result2 = mysqli_query($conn, $data2);
        if (mysqli_num_rows($result2) > 0) {
            return mysqli_fetch_assoc($result2);
        } else {
            return "Not found !";
        }
    } elseif ($table == "category") {
        $data3 = "SELECT * FROM category WHERE catId='$key'";
        $result3 = mysqli_query($conn, $data3);
        if (mysqli_num_rows($result3) > 0) {
            return mysqli_fetch_assoc($result3);
        } else {
            return "Not found !";
        }
    }
}

//get all publisehr
function getPublisher()
{
    $conn = mysqli_connect('localhost', 'root', '', 'coderbees');
    $data = "SELECT * FROM publisher";

    return mysqli_query($conn, $data);
}

//get current login publisher
function getAuthPublisher($publisherId)
{
    $conn = mysqli_connect('localhost', 'root', '', 'coderbees');
    $data = "SELECT * FROM publisher WHERE publisherId = '$publisherId'";
    $count = mysqli_num_rows($result = mysqli_query($conn, $data));

    if ($count == 1) {

        return mysqli_fetch_assoc($result);
    }
}

//get all posts
function getPosts()
{
    $conn = mysqli_connect('localhost', 'root', '', 'coderbees');
    $data = "SELECT * FROM posts";
    return mysqli_query($conn, $data);
}

//get all cateory
function getCategories()
{
    $conn = mysqli_connect('localhost', 'root', '', 'coderbees');
    $data = "SELECT * FROM category";
    return mysqli_query($conn, $data);
}

//get admin




function isInAdminDatabase($user_name)
{

    $conn = mysqli_connect('localhost', 'root', '', 'coderbees');
    $data = "SELECT * FROM admin WHERE adminUser_name='$user_name'";
    $result = mysqli_query($conn, $data);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
}
