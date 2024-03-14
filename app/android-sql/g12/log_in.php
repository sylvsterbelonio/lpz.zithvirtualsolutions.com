<?php

require '../data-config.php';
require '../data-variable.php';

$username=null;
$password=null;

//THIS IS TO INITIALIZE FIRST THE PARAMETERS//
if ($_SERVER['REQUEST_METHOD'] === 'GET') 
    {
        if(isset($_GET['username'])) $username = $_GET['username'];
        if(isset($_GET['password'])) $password = $_GET['password'];
    }

//VALIDATE ALL FIELDS//
if(isset($username) && isset($password))
    {
    if(empty($username))
        {
            $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_USERNAME_REQUIRED, $RESPONSE_ACTION =>$RESPONSE_USERNAME_REQUIRED));
            echo json_encode($arr); 
        }
    else if(empty($password))
        {
            $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_PASSWORD_REQUIRED, $RESPONSE_ACTION => $RESPONSE_PASSWORD_REQUIRED));
            echo json_encode($arr);
        }    
    else
        {
    
            $query =  "select * from g12_users where username = '" . $username . "'";
            $result = $conn->query($query);
            
            if($result->num_rows >0)
                {            
                    $query =  "select * from g12_users where username = '" . $username . "' AND password = md5('".$password."')";
                    $result = $conn->query($query);
            
                     if($result->num_rows >0)
                            {        
                            
                            $userID=null;
                            while($row = $result->fetch_assoc()) {
                              $userID = $row['user_ID'];
                            }
                            
                            
                            $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$NOTIFY_SUCCESS, $RESPONSE_ACTION => $RESPONSE_RESPONSE_SUCCESS, "user_ID" => $userID));
                            echo json_encode($arr);                      
                            }                 
                    else
                            {
                            $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_USERNAME_PASSWORD_UNMATCH, $RESPONSE_ACTION => $RESPONSE_USERNAME_PASSWORD_UNMATCH));
                            echo json_encode($arr);
                            }       
                }
            else
                {            
                    $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_USERNAME_UNEXISTED, $RESPONSE_ACTION =>$RESPONSE_USERNAME_UNEXISTED));
                    echo json_encode($arr);        
                }
        }
    }
else
    {
     $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE => $ERROR_REQUIRED_ALL_FIELDS));
     echo json_encode($arr);
    }

$conn->close();

?>