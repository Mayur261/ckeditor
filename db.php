<?php
$servers = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servers, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>