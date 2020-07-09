<?php
require 'connect.php';

$postdata = file_get_contents("php://input");
$uemail = "";

if(isset($postdata) && !empty($postdata) && isset($_SESSION['userId']) && isset($_SESSION['userEmail'])){
    $uemail = $_SESSION['userEmail'];
    $request = json_decode($postdata);
    $name = $request->name;
    $description = $request->description;
    $date = $request->date;
    $id = $date . $name;
    echo "success";
}else{
    echo "Not logged in";
    exit();
}

$sql = "INSERT INTO `events` (`id`,`name`, `user`, `description`, `date`) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "sssss", $id, $name, $uemail, $description, $date);
mysqli_stmt_execute($stmt);

http_response_code(201);

mysqli_close($conn);
exit;
