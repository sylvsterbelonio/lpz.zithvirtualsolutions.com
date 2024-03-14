<?php

require '../data-config.php';

$username="";

if ($_SERVER['REQUEST_METHOD'] === 'GET') 
    {
        if(isset($_GET['username'])) $username = $_GET['username'];
    }

if(isset($email_address))
    {    
        $query =  "select username from g12_users where username = '" . $username . "'";
        $result = $conn->query($query);
        
        if($result->num_rows >0)
            {        
                $arr = array($data =>array($response =>"Username is already existed"));
                echo json_encode($arr);                      
            }                 
        else
            {
                $arr = array($data =>array($response =>"No Data"));
                echo json_encode($arr);
            }    
    }
else
    {
     $arr = array($data =>array($response => $requireAll));
     echo json_encode($arr);
    }
     
$conn->close();

?>