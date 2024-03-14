<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class NetworkModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function my_disciples(){
        $query = $this->db->query("SELECT * FROM church_network where createdBy=".$_SESSION['userID']."");
        return $this->network->getDisciples(count($query->result()) ,$query->result_array());
    }

    public function check_if_other_network_name_exist($networkName){
        $query = $this->db->query("SELECT * FROM church_network where networkName='".$networkName."'");
        return count($query->result());
    }
    public function check_network_exist($networkName){
        $query = $this->db->query("SELECT * FROM church_network where networkID=".$_SESSION['currentNetworkID']." and networkName='".$networkName."'");
        return count($query->result());
    }

    private function getID_by_Network_Name($name){
        $query = $this->db->query("SELECT * FROM church_network where networkName='".$name."'");
        foreach($query->result_array() as $row)
            {
                return $row['networkID'];
            }
            return 0;
    }

    public function _network($data){

        $data['networkUrl'] = uniqid();
        $data['createdBy'] = $_SESSION['userID'];       
        
        if($_SESSION['currentNetworkID']>0){
            $this->db->where('networkID',$_SESSION['currentNetworkID']);
            return $this->db->update('church_network',$data);
        }else{

            $this->db->insert('church_network',$data);
            $networkID = $this->getID_by_Network_Name($this->input->post('networkName'));
            return  $this->db->query("UPDATE church_members SET networkID=$networkID  WHERE churchID=".$_SESSION['currentChurchID']." AND userID =".$_SESSION['userID']);

        }
    }

    public function add_new_member($id){
        //default value churchRoleID = 12 - Automatically play the role of Disciple
       return $this->db->query("UPDATE church_members SET networkID=".$_SESSION['currentNetworkID'].", churchRoleID=12 WHERE churchID=".$_SESSION['currentChurchID']." AND userID =".$id);
    }

    public function remove_member($id){
       return $this->db->query("UPDATE church_members SET networkID=0, churchRoleID=2 WHERE churchID=".$_SESSION['currentChurchID']." AND userID =".$id);
    }

    public function check_member_maximum_capacity($max){
        $query = $this->db->query($this->query_network_members());  
        if(count($query->result())>$max){
            return false;
        }
        else {
            return true;
        }
    }

    public function get_members(){

        $query = $this->db->query($this->query_network_members());  
        $rows = $this->network->get_network_members($query);

        return $rows;    
    }

    public function delete_network(){
        if($_SESSION['currentNetworkID']>0){
            
            $query = $this->db->query($this->query_network_members());  

            if(isset($query)){
                foreach($query->result_array() as $row)
                {
                    if($_SESSION['userID']!=$row['userID']){
                        $this->remove_member($row['userID']);
                    }
                }
            }

            return $this->db->delete('church_network',array('networkID'=>$_SESSION['currentNetworkID']));   
        }
        return 0;
    }
    
    private function query_network_members(){
        $sql='
        SELECT users.`profile_photo_path`,  profile.`first_name`,profile.`middle_name`,profile.`last_name`, church.`church_name`,church_roles.`roleName`, church_members.`userID`
        FROM
            `profile`
            INNER JOIN `church_members` 
                ON (`profile`.`userID` = `church_members`.`userID`)
            INNER JOIN `users` 
                ON (`users`.`userID` = `profile`.`userID`)
            INNER JOIN `church` 
                ON (`church`.`churchID` = `church_members`.`churchID`)
            INNER JOIN `church_roles` 
                ON (`church_roles`.`churchRoleID` = `church_members`.`churchRoleID`)
                
            WHERE church_members.`churchID`='.$_SESSION['currentChurchID'].' AND church_members.`networkID`>0 AND church_members.`networkID` = '.$_SESSION['currentNetworkID'].'
            ORDER BY last_name,middle_name,first_name
        ';
        return $sql;
    }

    public function search_members($name){
        $sql="
                SELECT church_members.userID, users.`profile_photo_path`,  profile.`first_name`,profile.`middle_name`,profile.`last_name`, church.`church_name`
                FROM
                    `profile`
                    INNER JOIN `church_members` 
                        ON (`profile`.`userID` = `church_members`.`userID`)
                    INNER JOIN `users` 
                        ON (`users`.`userID` = `profile`.`userID`)
                    INNER JOIN `church` 
                        ON (`church`.`churchID` = `church_members`.`churchID`) 
                        WHERE church_members.`churchID`=" . $_SESSION['currentChurchID'] . " AND church_members.`networkID`=0
                    AND (first_name LIKE '".$name."%' OR middle_name LIKE '".$name."%' OR last_name LIKE '".$name."%') LIMIT 0, 20";
          
          $query = $this->db->query($sql);
          $count = count($query->result());

          $html['posts']='<div class="list-group mt-4">';
          $html['count']=$count;

          foreach($query->result_array() as $row)
            {
                $html['posts'].='
                
                <button type="button" class="list-group-item list-group-item-action" onclick="selectMember('.$row['userID'].')">
                
                <div class="d-flex flex-row">
                            <div class=""><img src="'.base_url($row['profile_photo_path']).'" style="max-width:50px"></div>
                            <div class="pt-3 ps-2">' . $row['first_name'] . ' ' . $row['middle_name'] .' '.$row['last_name'].'</div>
                </div>              
            
                </button>';
            }    

            $html['posts'].="</div>";

          return $html;

    }

}