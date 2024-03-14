<?php

require '../data-config.php';
require '../data-variable.php';

$user_level = "Member";
$username = null;
$email_address= null;
$password = null;
$fname= null;
$lname= null;
$confirm_password= null;

if ($_SERVER['REQUEST_METHOD'] === 'GET') 
    {
        if(isset($_GET['username'])) $username = $_GET['username'];
        if(isset($_GET['email_address'])) $email_address = $_GET['email_address'];
        if(isset($_GET['first_name'])) $fname = $_GET['first_name'];
        if(isset($_GET['last_name'])) $lname = $_GET['last_name'];
        if(isset($_GET['password'])) $password = $_GET['password'];
        if(isset($_GET['confirm_password'])) $confirm_password = $_GET['confirm_password'];
    }
if(isset($username) && isset($email_address) && isset($password) && isset($fname) && isset($lname) && isset($confirm_password))
    {
        if(empty($username))
        {
            $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_USERNAME_REQUIRED, $RESPONSE_ACTION =>$RESPONSE_USERNAME_REQUIRED));
            echo json_encode($arr); 
        }
        else if(empty($fname))
        {
            $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_FIRST_NAME_REQUIRED, $RESPONSE_ACTION =>$RESPONSE_FIRST_NAME_REQUIRED));
            echo json_encode($arr); 
        }    
        else if(empty($lname))
        {
            $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_LAST_NAME_REQUIRED, $RESPONSE_ACTION =>$RESPONSE_LAST_NAME_REQUIRED));
            echo json_encode($arr); 
        }        
        else if(empty($email_address))
        {
            $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_EMAIL_ADDRESS_REQUIRED, $RESPONSE_ACTION =>$RESPONSE_EMAIL_ADDRESS_REQUIRED));
            echo json_encode($arr); 
        }    
        else if(empty($password))
        {
            $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_PASSWORD_REQUIRED, $RESPONSE_ACTION =>$RESPONSE_PASSWORD_REQUIRED));
            echo json_encode($arr); 
        }  
        else if(empty($confirm_password))
        {
            $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_CONFIRM_PASSWORD_REQUIRED, $RESPONSE_ACTION =>$RESPONSE_CONFIRM_PASSWORD_REQUIRED));
            echo json_encode($arr); 
        }  
         else if(!filter_var($email_address, FILTER_VALIDATE_EMAIL))
        {
             $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_EMAIL_ADDRESS_INVALID, $RESPONSE_ACTION =>$RESPONSE_EMAIL_ADDRESS_INVALID));
            echo json_encode($arr); 
        }   
        else if(password_length($password,8))
        {
            $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_PASSWORD_LENGTH, $RESPONSE_ACTION =>$RESPONSE_PASSWORD_LENGTH));
            echo json_encode($arr); 
        }
        else if(text__spec_char_and_num_only($password))
        {
            $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_PASSWORD_SECURE, $RESPONSE_ACTION =>$RESPONSE_PASSWORD_SECURE));
            echo json_encode($arr); 
        }
        else if(password_match($password,$confirm_password ))
        {
            $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_PASSWORD_MATCH, $RESPONSE_ACTION =>$RESPONSE_PASSWORD_MATCH));
            echo json_encode($arr);  
        }
        else if(username_check($conn,$username))
        {
            $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>"$ERROR_USERNAME_EXISTED", $RESPONSE_ACTION =>$RESPONSE_USERNAME_EXISTED));
            echo json_encode($arr); 
        }      
        else if(email_check($conn,$email_address))
        {
            $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_EMAIL_ADDRESS_EXISTED, $RESPONSE_ACTION =>$RESPONSE_EMAIL_ADDRESS_EXISTED));
            echo json_encode($arr); 
        }        
        else
        {
        $user_code = create_random_code();
        
        $query = "INSERT INTO g12_users (user_level, user_code, username, password, email_address)
        VALUES ('$user_level', '$user_code', '$username', md5('$password'),'$email_address');";
        $result = $conn->query($query);
        
        $user_ID = get_userID($conn, $username);
        $sql = "INSERT INTO g12_profile_information (user_ID, first_name, last_name, created_by, updated_by) VALUES ($user_ID, '$fname', '$lname', $user_ID, $user_ID);";
        $result = $conn->query($sql);
            
        $arr = array($RESPONSE_DATA => array($RESPONSE_RESPONSE => $NOFITY_SUCCESS_CREATE_ACCOUNT, $RESPONSE_ACTION =>$RESPONSE_RESPONSE_SUCCESS));
        echo json_encode($arr);
        }
    }
    else
    {
         $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE => $ERROR_REQUIRED_ALL_FIELDS));
         echo json_encode($arr);
    }
    
function get_userID($conn, $username)
    {
        $query =  "select user_ID from g12_users where username = '" . $username . "'";
        $result = $conn->query($query);        
        if($result->num_rows >0) 
            {
            $userID=null;
            while($row = $result->fetch_assoc()) 
                {
                    return $row['user_ID'];
                }
            }
        return 0; 
    }    
    
function username_check($conn, $username)
    {
        $query =  "select username from g12_users where username = '" . $username . "'";
        $result = $conn->query($query);        
        if($result->num_rows >0) return true;                                             
        else return false;              
    }    
function email_check($conn,$email_address)
    {
        $query =  "select email_address from g12_users where email_address = '" . $email_address . "'";
        $result = $conn->query($query);
        if($result->num_rows >0) return true;                                             
        else return false; 
    }    
function text__spec_char_and_num_only($string)
    {
        if (preg_match('/[A-Za-z]/', $string) && preg_match('/[0-9]/', $string)) return false;          
        else return true;    
    }  
function password_length($string, $length)
    {
        if(strlen($string)>=$length) return false;
        else return true;
    }      
function password_match($password,$confirm_password)
    {
        if($password != $confirm_password) return true;
        return false;
    }    
    
function create_random_code($length = 50, $in_params = [])
{
    $in_params['upper_case']        = isset($in_params['upper_case']) ? $in_params['upper_case'] : true;
    $in_params['lower_case']        = isset($in_params['lower_case']) ? $in_params['lower_case'] : true;
    $in_params['number']            = isset($in_params['number']) ? $in_params['number'] : true;
    $in_params['special_character'] = isset($in_params['special_character']) ? $in_params['special_character'] : false;

    $chars = '';
    if ($in_params['lower_case']) {
        $chars .= "abcdefghijklmnopqrstuvwxyz";
    }

    if ($in_params['upper_case']) {
        $chars .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    }

    if ($in_params['number']) {
        $chars .= "0123456789";
    }

    if ($in_params['special_character']) {
        $chars .= "!@#$%^&*()_-=+;:,.";
    }

    return substr(str_shuffle($chars), 0, $length);
}
        
?>