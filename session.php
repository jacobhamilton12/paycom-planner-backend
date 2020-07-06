<?php
require 'connect.php';


if(isset($_SESSION['userId']) && isset($_SESSION['userEmail'])){
    echo $_SESSION['userEmail'];
}else{
    echo "Not logged in";
}

http_response_code(201);
mysqli_close($conn);