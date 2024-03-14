<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class SystemAccessModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function checkIf_AccessName_Existed_for_Update($id, $name){
        $this->db->where('accessLevelID', $id);
        $this->db->where('accessLevelName', $name);
        $result = $this->db->get('accessLevel');
        return $result->num_rows();
    }

    public function checkIf_AccessName_Existed($name){
        $this->db->where('accessLevelName', $name);
        $result = $this->db->get('accessLevel');
        return $result->num_rows();
    }

    public function fetch_all(){
        $query = $this->db->query('SELECT * FROM accessLevel order by position');
        if(count( $query->result() ) > 0){
            return $query->result();
        }
    }

    public function insert_entry(){
        $access = array(
            'accessLevelName' => $this->input->post('accessLevelName'),
            'position' => $this->input->post('position'),
            'createdBy' => $_SESSION['userID'],
            'dtCreated' => date('Y-m-d H:i:s'),
            'dtUpdated' => date('Y-m-d H:i:s'),
            'updatedBy' => $_SESSION['userID']
        );
        return $this->db->insert('accessLevel',$access);
    }

    public function update_entry($id){
        $access = array(
            'accessLevelID' => $id,
            'accessLevelName' => $this->input->post('accessLevelName'),
            'position' => $this->input->post('position'),
            'dtUpdated' => date('Y-m-d H:i:s'),
            'updatedBy' => $_SESSION['userID']
        );
        return   $this->db->update('accessLevel',$access,array('accessLevelID'=>$id)); 
    }

    
    public function edit_entry($id){
        $query = $this->db->query("SELECT * FROM accessLevel WHERE accessLevelID =". $id);
        if(count($query->result())>0){
            return $query->row();
        }
    }

    public function delete_entry($id){
        $this->db->delete('accessLevel',array('accessLevelID'=>$id));   
        return $this->db->delete('system_access',array('accessLevelID'=>$id));   
    }

}