<?php
header('Access-Control-Allow-Origin: *');
session_start();
$servername = "localhost";
$username = "root";
$password = "Phoenix";
$dbname = "paycom_event_planner";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

