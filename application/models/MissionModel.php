<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class MissionModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function android_delete_all($userID){
        return $this->db->delete('profile_evangelize',array('updatedBy'=>$userID));   
    }

    public function android_consolidate_delete_all($userID){
        return $this->db->delete('profile_consolidate',array('userID'=>$userID));   
    }

    public function android_consolidate_add_row($data){
        $this->db->insert('profile_consolidate',$data);
    }

    public function android_add_row($data){
        $this->db->insert('profile_evangelize',$data);
    }

    public function get_evangelized_datatable_list_key(){
        //first elemement must be unique ID
        //the last key is the action command wether (add,edit,delete,view)
        $data = array();
        $data['sql'] = "tempUserID, first_name, middle_name, last_name, gender,mobileno, email";
        $data['key'] = "tempUserID, first_name, middle_name, last_name, gender,mobileno, email, action(edit-delete)";
        $data['header'] = "First Name, Middle Name, Last Name, Gender, Mobile No, Email Address, Status, Action";
        return $data;
    }

    public function android_get_evangelized_list($userID){
        $query = $this->db->query("SELECT * from profile_evangelize  where userID = " . $userID);
        return $query->result();
    }

    public function android_consolidate_get($userID){
        $query = $this->db->query("SELECT * from profile_consolidate  where userID = " . $userID);
        return $query->result_array();
    }

    public function get_evangelized_list(){

        $data= $this->get_evangelized_datatable_list_key();

        $query = $this->db->query('SELECT '.$data['sql'].' FROM profile__temp WHERE churchID='.$_SESSION['currentChurchID'].' AND networkID='.$_SESSION['currentNetworkID'].' AND createdBy = '.$_SESSION['userID']);
        if(count( $query->result() ) > 0){
            $data['post'] =  $query->result();
        }

        return $data;
    }

    

}