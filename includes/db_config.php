<?php
  date_default_timezone_set("Asia/Kolkata");
  require_once 'logger.php';
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

try
{
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
mysqli_query($conn, "SET time_zone = '+05:30'");  //  To set Indian time_zone on live server
// Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
}
catch (Exception $e) 
{
 logError($e->getMessage());
 die("Connection failed: ");
}
?>


