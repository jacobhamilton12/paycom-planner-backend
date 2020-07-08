<?php
require 'connect.php';


if(isset($_SESSION['userId']) && isset($_SESSION['userEmail'])){
    session_unset();
}

http_response_code(201);
mysqli_close($conn);