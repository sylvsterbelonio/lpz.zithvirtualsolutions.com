<?php

require '../../data-config.php';
require '../../data-variable.php';

$action_mode=null;
$user_id=null;
$first_name = '';
$middle_name = '';
$last_name = '';
$name_ext = '';
$date_of_birth = '';
$place_of_birth = '';
$sex = '';
$civil_status = '';
$height = 0;
$height_metric = '';
$weight = 0;
$weight_metric = '';
$blood_type = '';

$updated_by = null;
$dt_updated = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET') 
    {
        if(isset($_GET['action_mode'])) $action_mode = $_GET['action_mode'];
        if(isset($_GET['user_id'])) $user_id = $_GET['user_id'];
        if(isset($_GET['first_name'])) $first_name = $_GET['first_name'];
        if(isset($_GET['middle_name'])) $middle_name = $_GET['middle_name'];
        if(isset($_GET['last_name'])) $last_name = $_GET['last_name'];
        if(isset($_GET['name_ext'])) $name_ext = $_GET['name_ext'];
        if(isset($_GET['date_of_birth'])) $date_of_birth = $_GET['date_of_birth'];
        if(isset($_GET['place_of_birth'])) $place_of_birth = $_GET['place_of_birth'];
        if(isset($_GET['sex'])) $sex = $_GET['sex'];
        if(isset($_GET['civil_status'])) $civil_status = $_GET['civil_status'];
        if(isset($_GET['height'])) $height = $_GET['height'];
        if(isset($_GET['height_metric'])) $height_metric = $_GET['height_metric'];
        if(isset($_GET['weight'])) $weight = $_GET['weight'];
        if(isset($_GET['weight_metric'])) $weight_metric = $_GET['weight_metric'];
        if(isset($_GET['blood_type'])) $blood_type = $_GET['blood_type'];        
    }
    

if(isset($action_mode))
    {
        if($action_mode == "update")
            {
                 if(isset($user_id) && !empty($user_id))
                    {
                                       
                     $sql = "
                     UPDATE g12_profile_information
                        SET 
                          first_name = '$first_name',
                          middle_name = '$middle_name',
                          last_name = '$last_name',
                          name_ext = '$name_ext',
                          date_of_birth = '$date_of_birth',
                          place_of_birth = '$place_of_birth',
                          sex = '$sex',
                          civil_status = '$civil_status',
                          height = $height,
                          height_metric = '$height_metric',
                          weight = $weight,
                          weight_metric = '$weight_metric',
                          blood_type = '$blood_type',
                          updated_by = $user_id,
                          dt_updated = '". date("Y-m-d H:i:s")  . "'
                        WHERE user_ID = $user_id";
                        
                      $result = $conn->query($sql);  
                                                                                  
                      $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$NOTIFY_UPDATE, $RESPONSE_ACTION => $RESPONSE_RESPONSE_SUCCESS));
                      echo json_encode($arr); 
                                                                                  
                    }
                 else
                    {
                        $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_NO_USER_ID, $RESPONSE_ACTION => $RESPONSE_NO_USER_ID));
                        echo json_encode($arr);                   
                    }   
            
            }
        else if($action_mode == "get")
            {
                if(isset($user_id) && !empty($user_id))
                    {
                    
                        $query =  "select * from g12_profile_information where user_ID = " . $user_id . "";
                        $result = $conn->query($query);
                        
                         if($result->num_rows >0)
                            { 
                            
                                $userID=null;
                                while($row = $result->fetch_assoc()) 
                                    {
                                    $userID = $row['user_ID'];
                                    $first_name = $row['first_name'];
                                    $middle_name = $row['middle_name'];
                                    $last_name = $row['last_name'];
                                    $name_ext = $row['name_ext'];
                                    $date_of_birth = $row['date_of_birth'];
                                    $place_of_birth = $row['place_of_birth'];
                                    $sex = $row["sex"];
                                    $civil_status = $row["civil_status"];
                                    $height = $row['height'];
                                    $height_metric = $row['height_metric'];
                                    $weight = $row['weight'];
                                    $weight_metric = $row['weight_metric'];
                                    $blood_type = $row['blood_type'];
                                    }
                                
                            $arr = array($RESPONSE_DATA =>array(
                                        $RESPONSE_RESPONSE =>"Success", 
                                        "user_ID" => $user_id,
                                        "first_name" => $first_name,
                                        "middle_name" => $middle_name,
                                        "last_name" => $last_name,
                                        "name_ext" => $name_ext,
                                        "date_of_birth" => $date_of_birth,
                                        "place_of_birth" => $place_of_birth,
                                        "sex" => $sex,
                                        "civil_status" => $civil_status,
                                        'height' => $height,
                                        'height_metric' => $height_metric,
                                        'weight' => $weight,
                                        'weight_metric' => $weight_metric, 
                                        'blood_type' => $blood_type,
                                        $RESPONSE_ACTION => "success"
                                        ));
                            echo json_encode($arr);   
                            
                            }
                         else
                            {
                            $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_NO_DATA_FOUND, $RESPONSE_ACTION => $RESPONSE_NO_DATA_FOUND));
                            echo json_encode($arr);                           
                            }   
                        
                    }
                else
                    {
                    $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_NO_USER_ID, $RESPONSE_ACTION => $RESPONSE_NO_USER_ID));
                    echo json_encode($arr);
                    }    
           
            }
        else
            {
                $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_NO_TRANSACTION_SELECTED, $RESPONSE_ACTION => $RESPONSE_NO_TRANSACTION_SELECTED));
                echo json_encode($arr);
            }
    }
else
    {
    $arr = array($RESPONSE_DATA =>array($RESPONSE_RESPONSE =>$ERROR_TYPE_OF_TRANSACTION, $RESPONSE_ACTION => $RESPONSE_TYPE_OF_TRANSACTION));
    echo json_encode($arr);
    }        

?>