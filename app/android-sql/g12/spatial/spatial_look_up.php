<?php

require '../../data-config.php';

$name_0=null;
$name_1=null;
$name_2=null;
$name_3=null;

//THIS IS TO INITIALIZE FIRST THE PARAMETERS//
if ($_SERVER['REQUEST_METHOD'] === 'GET') 
    {
        if(isset($_GET['name_0'])) $name_0 = $_GET['name_0'];
        if(isset($_GET['name_1'])) $name_1 = $_GET['name_1'];
        if(isset($_GET['name_2'])) $name_2 = $_GET['name_2'];
        if(isset($_GET['name_3'])) $name_3 = $_GET['name_3'];
    }
    
if(!empty($name_0) && !empty($name_1) && !empty($name_2))
    {
        $query =  "SELECT DISTINCT NAME_3 as 'name' FROM `g12_spatial` WHERE NAME_0='$name_0' AND NAME_1='$name_1' AND NAME_2='$name_2'";
        $result = $conn->query($query);
        if($result->num_rows >0)
            {
                $rows = array();
                while($row = $result->fetch_assoc()) 
                    {
                              $rows[] = $row;
                    }
                echo json_encode($rows);
            }
    } 
else if(!empty($name_0) && !empty($name_1))
    {
        $query =  "SELECT DISTINCT NAME_2 as 'name' FROM `g12_spatial` WHERE NAME_0='$name_0' AND NAME_1='$name_1'";
        $result = $conn->query($query);
        if($result->num_rows >0)
            {
                $rows = array();
                while($row = $result->fetch_assoc()) 
                    {
                              $rows[] = $row;
                    }
                echo json_encode($rows);
            }
    }        
else if(!empty($name_0))
    {
        $query =  "SELECT DISTINCT NAME_1 as 'name' FROM `g12_spatial` WHERE NAME_0='$name_0'";
        $result = $conn->query($query);
        if($result->num_rows >0)
            {
                $rows = array();
                while($row = $result->fetch_assoc()) 
                    {
                              $rows[] = $row;
                    }
                echo json_encode($rows);
            }
    }
else
    {
        $query =  "SELECT DISTINCT NAME_0 as 'name' FROM `g12_spatial`";
        $result = $conn->query($query);
        if($result->num_rows >0)
            {
                $rows = array();
                while($row = $result->fetch_assoc()) 
                    {
                              $rows[] = $row;
                    }
                echo json_encode($rows);
            }    
    }    
?>