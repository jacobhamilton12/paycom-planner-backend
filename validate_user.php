<?php
require 'connect.php';
$postdata = file_get_contents("php://input");


if(isset($postdata) && !empty($postdata)){
    $request = json_decode($postdata);
    $email = $request->email;
    $password = $request->password;
    $filter = "/^[a-zA-Z0-9._@]+$/";
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo ("Email is invalid");
        exit();
    }
    if(!preg_match($filter, $password)){
        echo ("Password is invalid");
        exit();
    }

    $sql = "SELECT `email` FROM `users` WHERE `email`=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $num_rows = mysqli_stmt_num_rows($stmt);
    if($num_rows === 0){
        echo ("failed");
        exit();
    };

    $sql = "SELECT * FROM `users` WHERE `email` = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    if(password_verify($password, $row['password'])){
        echo "success";
        $_SESSION['userId'] = $row['id'];
        $_SESSION['userEmail'] = $row['email'];
    }else{
        echo "failed";
    }

    http_response_code(201);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

exit;