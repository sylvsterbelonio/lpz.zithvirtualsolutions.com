<?php

require '../../data-config.php';

$email_address=null;

if ($_SERVER['REQUEST_METHOD'] === 'GET') 
    {
        if(isset($_GET['email_address'])) $email_address = $_GET['email_address'];
    }

if(isset($email_address))
    {
        $query =  "select email_address from g12_users where email_address = '" . $email_address . "'";
        $result = $conn->query($query);
        
        if($result->num_rows >0)
            {        
                $arr = array($data =>array($response =>"Email address is already existed"));
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