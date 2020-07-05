<?php
require 'connect.php';
$postdata = file_get_contents("php://input");


if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
    $email = $request->email;
    $password = $request->password;

    $sql = "SELECT * FROM `users` WHERE `email` = '{$email}' and `password` = '{$password}'";

    $result = mysqli_query($conn,$sql);
    $matchFound = mysqli_num_rows($result) > 0 ? 'success' : 'failed';
    echo $matchFound;

    http_response_code(201);
}

exit;