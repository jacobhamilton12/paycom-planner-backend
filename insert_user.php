<?php
require 'connect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);

    print_r($request);
    $email = $request->email;
    $password = $request->password;

    $sql = "INSERT INTO `users`(
        `email`,
        `password`
    ) VALUES
     ('{$email}',
      '{$password}')
      ";

    if(mysqli_query($con,$sql)){
        http_response_code(201);
    }
    else{
        http_response_code(422);
    }
}
