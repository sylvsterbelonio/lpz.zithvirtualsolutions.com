<?php
$servername = "163.44.242.14";
$username = "tgscwozb_admin";
$password = "vln7H2Odstrk";
$database = "tgscwozb_lpz";

$where="";


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
$where = $_GET['query_data'];
}



// Create connection
$conn = mysqli_connect($servername, $username, $password,$database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$sql_where="";
if($where!=""){
$conditions = explode("-", $where);
for ($x = 0; $x < count($conditions); $x++) {
  
  if($x==0) { $sql_where = " WHERE abbreviation != '" . $conditions[$x] . "' ";}
  else { $sql_where.=" AND abbreviation !='" . $conditions[$x] . "' ";   }
  
}
}



$query =  "select * from tbl_bible " . $sql_where;
$result = $conn->query($query);

$rows = array();
   while($row = $result->fetch_assoc()) {
    $rows[] = $row;
  }
  
echo json_encode($rows);











?>