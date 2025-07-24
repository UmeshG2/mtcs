<?php

// ---- Live  ---- 
/*
$servername = "localhost";  //localhost:3306
$username = "umesh";
$password = "April@2025";
$database = "mtcs";
*/

//  ---- Dev ----
$servername = "localhost";  //localhost:3306
$username = "root";
$password = "Umesh@80";
$database = "mtcs";


// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>


