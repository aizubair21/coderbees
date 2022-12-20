<?php
session_start();

// include "/config.php";

//make root relative path;
define('A_ROOT_PATH', dirname(__DIR__) . '/');
define('l_ADMIN_PATH', A_ROOT_PATH . "admin/");
// define('PUBLISHER_PATH', ROOT_PATH."publisher/");
// define('CATEGORY_PATH', ROOT_PATH."category/");
// echo "admin root path : " . A_RO_PATH;
include A_ROOT_PATH . "function.php";
// define('conn', $conn);

//include config.php
include A_ROOT_PATH.'/config.php';

// $conn = mysqli_connect($host, $user, $password, $db, $port);

$key = $_SESSION["admin_key"] ?? "";

if ($key) {
    $GLOBALS['auth_admin'] = getData($key, $conn);
}
//echo $auth_admin["adminUser_name"];

function getData($key, $conn)
{
    // $conn = mysqli_connect($host, $user, $password, $db, $port);
    $data = "SELECT adminId, adminUser_name, adminEmail, adminImage FROM admin WHERE adminId=$key";
    $result = mysqli_query($conn, $data);
    if (mysqli_num_rows($result) > 0) {
        return $row = mysqli_fetch_assoc($result);
    } else {
        return "Not found !";
    }
}
function getCategory($key, $conn)
{
    // $conn = mysqli_connect($host, $user, $password, $db, $port);
    $data = "SELECT * FROM category WHERE catId='$key'";
    $result = mysqli_query($conn, $data);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return "Not found !";
    }
}

function getPublisher($key, $conn)
{
    // $conn = mysqli_connect($host, $user, $password, $db, $port);
    $data = "SELECT * FROM publisher WHERE publisherId='$key'";
    $result = mysqli_query($conn, $data);
    if (mysqli_num_rows($result) > 0) {
        return  mysqli_fetch_assoc($result);
    } else {
        return "Not found !";
    }
}


function getAllPublisher($conn)
{
    // $conn = mysqli_connect($host, $user, $password, $db, $port);
    $data = "SELECT * FROM publisher";
    return mysqli_query($conn, $data);
}

function getCurd($key, $conn)
{
    // $conn = mysqli_connect($host, $user, $password, $db, $port);
    $data = "SELECT * FROM crud WHERE id='$key'";
    $result = mysqli_query($conn, $data);
    if (mysqli_num_rows($result) > 0) {
        return $row = mysqli_fetch_assoc($result);
    } else {
        return "Not found !";
    }
}




function isInAdminDatabase($user_name, $conn)
{
    // $conn = mysqli_connect($host, $user, $password, $db, $port);
    $data = "SELECT * FROM admin WHERE adminUser_name='$user_name'";
    $result = mysqli_query($conn, $data);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
}
