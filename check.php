<?php

$server = mysqli_connect("localhost","root","");
$create_db = "CREATE DATABASE code";
mysqli_query($server,$create_db;

$conn = mysqli_connect("localhost","root","","code");
if($server) {
        $create_table = "CREATE TABLE publisher (
            id int AUTO_INCREMENT PRIMARY,
            name varchar(50) NOT NULL,
            user_name varchar(50),
            email varchar(255) UNIQUE,
            phone int(15),
            password varchar(100),
            created_at DATETIME(6),
            varify_at int(10) NOT NULL,
            status int(1) NOT NULL,
            PRIMARY KEY (id)
        )";

        if (mysqli_query($conn, $create_db)) {
            echo "DB created ";
        }
}else {
    echo "Not connect ";
}