<?php
require 'connect.php';

$sql = "SELECT name, user, description, date FROM events ORDER BY id";


$sth = mysqli_query($conn, $sql);
$rows = array();
while($r = mysqli_fetch_assoc($sth)) {
    $rows[] = $r;
}
print json_encode($rows);

$conn->close();
http_response_code(201);
exit;
