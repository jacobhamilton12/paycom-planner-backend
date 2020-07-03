<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'Phoenix');
define('DB_NAME', 'paycom_event_planner');

function connect(){
    $connect = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );

    if(mysqli_connect_errno($connect)){
        die("FAILED TO CONNECT: " . mysqli_connect_error());
    }

    mysqli_set_charset($connect, "utf8");

    return $connect;
}
$con = connect();