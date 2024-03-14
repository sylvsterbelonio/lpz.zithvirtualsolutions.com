<?php
$global_servername = "163.44.242.14";
$global_username = "tgscwozb_admin";
$global_password = "vln7H2Odstrk";
$global_database = "tgscwozb_lpz";

// Create connection
$conn = mysqli_connect($global_servername, $global_username, $global_password, $global_database);
// Check connection
if ($conn->connect_error)  die("Connection failed: " . mysqli_connect_error());


?>