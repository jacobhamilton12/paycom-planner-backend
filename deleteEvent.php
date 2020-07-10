<?php
require 'connect.php';
$postdata = file_get_contents("php://input");

$sql = "DELETE FROM `events` WHERE `events`.`id` = ?";

if(isset($postdata) && !empty($postdata) && isset($_SESSION['userId']) && isset($_SESSION['userEmail'])){
    $request = json_decode($postdata);
    if($request->user === $_SESSION['userEmail']){
        $id = $request->date . $request->name;
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        http_response_code(201);
    }else{
        echo "failed";
    }
    
}else{
    echo "failed";
}


$conn->close();

exit;
