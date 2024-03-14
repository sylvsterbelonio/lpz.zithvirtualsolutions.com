<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class TaskModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }


    public function check_completed_task($id){
        $query = $this->db->query("select * from users_task_points_completion where userID=". $_SESSION['userID'].' and taskID='.$id);
        if(count($query->result())>0){
            return 1;
        }
        return 0;
    }

    public function check_completed_task_Android($userID, $id){
        $query = $this->db->query("select * from users_task_points_completion where userID=". $userID.' and taskID='.$id);
        if(count($query->result())>0){
            return 1;
        }
        return 0;
    }

    public function get_task_data($id){
        $query = $this->db->query("select * from task where taskID=".$id);
        foreach($query->result_array() as $row) 
        {
            $data['rewardPoints'] = $row['rewardPoints'];
            $data['taskPoints'] = $row['taskPoints'];
            return $data;
        }
    }


    private function getNextLevel($level){
        $this->NotificationModel->notify_levelup($level);
        $query = $this->db->query("select * from ref_level where level=". $level);
        foreach($query->result_array() as $row) {
            return $row['next_level'];
        }
        
    }

    private function getNextLevel_Android($userID, $level){
        $this->NotificationModel->notify_levelup_Android($userID,$level);
        $query = $this->db->query("select * from ref_level where level=". $level);
        foreach($query->result_array() as $row) {
            return $row['next_level'];
        }
        
    }

    private function getAcessName($accessLevelID){
        $query = $this->db->query("select * from accessLevel where accesslevelID=". $accessLevelID);
        foreach($query->result_array() as $row) {
            return $row['accessLevelName'];
        }
    }

    private function unlockSystemAccess($level){
        //BECOME - trusted user
        if($level==5){
            $OldAccessName = $this->getAcessName(5);
            $NewAccessName = $this->getAcessName(6);
            $task = array(
                'userID'=>$_SESSION['userID'],
                'accessLevelID' => 6,
            );
            $_SESSION['accessLevelID']=6;
            $this->db->update('users',$task,array('userID'=>$_SESSION['userID']));  
            
            $this->NotificationModel->notify_accessLevelUpgrade($OldAccessName,$NewAccessName,"Church Ministry");
        }
    }

    private function unlockSystemAccess_Android($userID, $level){
        //BECOME - trusted user
        if($level==5){
            $OldAccessName = $this->getAcessName(5);
            $NewAccessName = $this->getAcessName(6);
            $task = array(
                'userID'=>$userID,
                'accessLevelID' => 6,
            );
            $_SESSION['accessLevelID']=6;
            $this->db->update('users',$task,array('userID'=>$userID));  
            
            $this->NotificationModel->notify_accessLevelUpgrade_Android($OldAccessName,$NewAccessName,"Church Ministry");
        }
    }

    public function addTaskPoints_Android($userID, $points){
        $query = $this->db->query("select * from users_points where userID=". $userID);
        foreach($query->result_array() as $row) {
            
            $currentLevel = $row['currentLevel'];
            $currentTP = $row['currentTP'];
            $totalTPEarned = $row['totalTPEarned'];
            $nextLevel = $row['nextLevel'];


            $totalCurrentTP = $currentTP + $points;
            $totalTPEarned = $row['totalTPEarned'] + $points;


            if($totalCurrentTP>=$nextLevel)
                {
                do
                    {
                        $totalCurrentTP-=$nextLevel;
                        $currentLevel+=1;
                        //UNLOCK SYSTEM ACCESS FEATURES//
                        $this->unlockSystemAccess_Android($userID, $currentLevel);
                        $nextLevel = $this->getNextLevel_Android($userID, $currentLevel);
                    }
                while($totalCurrentTP>=$nextLevel);
                }

            $task = array(
                'userID'=>$userID,
                'currentLevel' => $currentLevel,
                'currentTP' => $totalCurrentTP,
                'totalTPEarned' => $totalTPEarned,
                'nextLevel' => $nextLevel
            );
    
            $this->db->update('users_points',$task,array('userID'=>$userID));   
        }
    }

    public function add_users_completion($id){
        //ADD TO TASK COMPLETION LOGS//
        $completion = array(
            'userID' => $_SESSION['userID'],
            'taskID' => $id,
            'dtCreated' => date('Y-m-d H:i:s')
        );
        $this->db->insert('users_task_points_completion',$completion);
    }

    public function add_users_completion_Android($userID,$id){
        //ADD TO TASK COMPLETION LOGS//
        $completion = array(
            'userID' => $userID,
            'taskID' => $id,
            'dtCreated' => date('Y-m-d H:i:s')
        );
        $this->db->insert('users_task_points_completion',$completion);
    }

    private function get_completed_task(){
        $condition="";
        $inc=0;
        $query = $this->db->query("select * from users_task_points_completion where userID=". $_SESSION['userID']);
        foreach($query->result_array() as $row) 
            {
             if($inc==0){
                $condition .= " where taskID != ". $row['taskID']; 
             }else{
                $condition .= " AND taskID != ". $row['taskID'];
             }   
             $inc+=1;
            }  
        return $condition;    
    }

    public function get_Task_List(){
        $query = $this->db->query("SELECT * from task ". $this->get_completed_task() . " order by `order` LIMIT 0,5");
        return $this->dashboard->tasklist($query);
    }

    public function getCurrentLevel(){
        $query = $this->db->query("select * from users_points where userID=". $_SESSION['userID']);
        foreach($query->result_array() as $row) 
            { 
                return $this->dashboard->taskpoints($row); 
            }
        return "";
    }


}