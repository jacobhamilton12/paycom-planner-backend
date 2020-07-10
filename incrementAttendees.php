<?php
require 'connect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata) && isset($_SESSION['userId']) && isset($_SESSION['userEmail'])){
    $uemail = $_SESSION['userEmail'];
    $request = json_decode($postdata);
    $name = $request->name;
    $date = $request->date;
    $attendees = $request->attendees;
    $listAttendees = json_decode($attendees);
    $id = $date . $name;

    $sql = "SELECT attendees FROM events WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    if (in_array($_SESSION['userEmail'], json_decode($row['attendees']))){
        echo "exists";
        exit();
    }
}else{
    echo "Not logged in";
    exit();
}

$sql = "UPDATE events SET attendees=? WHERE id=?";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "ss", $attendees, $id);
mysqli_stmt_execute($stmt);

http_response_code(201);
echo "success";
mysqli_close($conn);
exit;
