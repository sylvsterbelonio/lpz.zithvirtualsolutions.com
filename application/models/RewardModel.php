<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class RewardModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function addRewardPoints($points){
        $currentRewardPoints = 0;
        $totalRewardPoints = 0;
        $query = $this->db->query("select * from users_points where userID=". $_SESSION['userID']);
        foreach($query->result_array() as $row) {
            $currentRewardPoints = $row['available_RP'];
            $totalRewardPoints = $row['total_RP_earned'];

            $rewards = array(
                'userID'=>$_SESSION['userID'],
                'available_RP' => $currentRewardPoints + $points,
                'total_RP_earned' => $totalRewardPoints + $points);
    
            $this->db->update('users_points',$rewards,array('userID'=>$_SESSION['userID']));   
        }

       
    }

    public function addRewardPoints_Android($userID, $points){
        $currentRewardPoints = 0;
        $totalRewardPoints = 0;
        $query = $this->db->query("select * from users_points where userID=". $userID);
        foreach($query->result_array() as $row) {
            $currentRewardPoints = $row['available_RP'];
            $totalRewardPoints = $row['total_RP_earned'];

            $rewards = array(
                'userID'=>$userID,
                'available_RP' => $currentRewardPoints + $points,
                'total_RP_earned' => $totalRewardPoints + $points);
    
            $this->db->update('users_points',$rewards,array('userID'=>$userID));   
        }

       
    }


    public function getRewardPoints(){
        $query = $this->db->query("select * from users_points where userID=". $_SESSION['userID']);
        foreach($query->result_array() as $row) {
          return $this->dashboard->rewardpoints($row);
        }
    }


}