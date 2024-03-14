<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class ChurchModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function fetch_all(){
        $query = $this->db->get('church');
        if(count( $query->result() ) > 0){
            return $query->result();
        }
    }

    public function android_join_church($userID, $churchID){
        $profile = array(
            '_churchID' => $churchID,
            '_church_position' => "Member",
        );
        $this->db->where('userID',$userID);
        $this->db->update('profile',$profile);

        $query = $this->db->query("SELECT *,(SELECT church_name FROM church b WHERE b.churchID=a.church_parent) AS 'churchParent' FROM church a where a.churchID=".$churchID);
        return $query->result_array();
            
    }
    public function android_leave_church($userID){
        $profile = array(
            '_churchID' => 0,
            '_church_position' => "Member",
        );
        $this->db->where('userID',$userID);
        $this->db->update('profile',$profile);
    }

    public function getChurchInfo($id){
        $query = $this->db->query("SELECT * FROM church where churchID=".$id);
        if(count($query->result())>0){
            foreach($query->result_array() as $row)
            {
               return $row;
            }    
        }
    }

    public function getChurchInfo_Android($name){
        $query = $this->db->query("SELECT * FROM church where church_name='".$name."'");
        if(count($query->result())>0){
            foreach($query->result_array() as $row)
            {
               return $row;
            }    
        }else{
            return "";
        }
    }

    public function getChurchInfo_by_ID_Android($id){
        $query = $this->db->query("SELECT *,(SELECT church_name FROM church b WHERE b.churchID=a.church_parent) AS 'churchParent' FROM church a where a.churchID=$id");
        $data = array();
        if(count($query->result())>0){
            foreach($query->result_array() as $row)
            {
               $data[0] = $row;
            }    
        }
        return $data;
    }

    public function get_church_members_android($id){
        $query = $this->db->query("SELECT churchID,  church_name, `profile`.`userID`, first_name, middle_name, last_name, profile_photo_path,loc_address, loc_barangay, loc_city, loc_province, _church_position 
        FROM`church` INNER JOIN `profile` ON (`church`.`churchID` = `profile`.`_churchID` ) INNER JOIN `users` ON ( `users`.`userID` = `profile`.`userID` )
        WHERE churchID=$id ORDER BY last_name, middle_name, first_name");
        return $query->result_array(); 
    }

    public function get_church_members_count_android($id){
        $query = $this->db->query("SELECT churchID,  church_name, `profile`.`userID`, first_name, middle_name, last_name, profile_photo_path, loc_address, loc_barangay, loc_city, loc_province 
        FROM`church` INNER JOIN `profile` ON (`church`.`churchID` = `profile`.`_churchID` ) INNER JOIN `users` ON ( `users`.`userID` = `profile`.`userID` )
        WHERE churchID=$id");
        return count($query->result()); 
    }

    public function get_all_Church_Android(){
        $query = $this->db->query("SELECT church_name FROM church");
        
        return $query->result();

    }

    public function search_church($searchValue,$churchID){
        $query = $this->db->query("
        SELECT churchID, url_photo, church_name, address, barangay, city, province, zipcode, country, (SELECT COUNT(*) FROM `profile` WHERE _churchID=churchID) AS 'total_members'
        FROM church
        WHERE church_name LIKE '%$searchValue%' AND churchID != $churchID
        ORDER BY church_name
        LIMIT 0, 25
        ");
        return $query->result();
    }

    public function getChurch_from_ProfileInformation($id){
    $query = $this->db->query("SELECT * FROM `church`  INNER JOIN `church_members`   ON (`church`.`churchID` = `church_members`.`churchID`)   WHERE church_members.`userID`=$id");
    if(count($query->result())>0){
        foreach($query->result_array() as $row)
        {
           $data = $row;
           $data['complete_address'] = $row['address'].', '. $row['barangay']. ', '.$row['city'].', '.$row['province'].', '.$row['zipcode'].', '.$row['country'];
           $data['pastor_leader'] = "On Maintenance"; 
           return $data;
        }    
    }

    $row = array(
        'church_name' => 'N/A',
        'complete_address' => "N/A",
        'pastor_leader' => 'N/A',
        'accessRole' => 'N/A');
    return $row;
    }

    public function getCurrent_Church_Joined(){
        $profile_info = $this->ProfileModel->getProfileData();
        $query = $this->db->query("SELECT * FROM church WHERE churchID=".$profile_info['chu_churchID']);
        //CHECKING IF THE PROFILE TABLE HAS SET CHU_CHURCHID//
        if(count($query->result())>0){
            $query = $this->db->query("SELECT * FROM `church` INNER JOIN `church_members`  ON (`church`.`churchID` = `church_members`.`churchID`) WHERE church_members.userID=".$_SESSION['userID']);
            if(count($query->result())>0){
                foreach($query->result_array() as $row)
                {
                   return $row;
                }    
            }
        }
        return null;
    }

    public function getChurchInfo_by_Name($church){
        $query = $this->db->query("SELECT * FROM church where church_name='".$church."'");
        if(count($query->result())>0){
            foreach($query->result_array() as $row)
            {
               return $row;
            }    
        }
    }

    public function checkChurchName_if_Existed($churchName){
        $query = $this->db->query("SELECT * FROM church where church_name='".$churchName."'");
        if(count($query->result())>0){
            return true;
        }
        return false;
    }

    public function getProfilePhoto($id){
        $query = $this->db->query("SELECT * FROM church where churchID=".$id);

        foreach($query->result_array() as $row)
        {
                return $row['url_photo'];
        }
    }

    public function getCoverPhoto($id){
        $query = $this->db->query("SELECT * FROM church where churchID=".$id);

        foreach($query->result_array() as $row)
        {
                return $row['url_cover_photo'];
        }
    }

    public function searchChurchUrl($url){
        $query = $this->db->query("SELECT * FROM church where url='". $url ."'");
        if(count( $query->result() ) > 0){
            foreach($query->result_array() as $row)
            {
                    return $row;
            }
        }
        else{
            return null;
        }
    }

    private function getList_CreatedChurch_Not_Included_from_Search(){
        $condition="";
        $query = $this->db->query("SELECT * from church where userID=".$_SESSION['userID']);
        foreach($query->result_array() as $row)
            {
                $condition = " AND userID !=" . $_SESSION['userID'];     
            }
        return $condition;
    }

    public function searchChurchName($key){
        $condition = $this->getList_CreatedChurch_Not_Included_from_Search();

        $query = $this->db->query("SELECT churchID, url_photo, church_name, (SELECT COUNT(*) FROM church_members  WHERE church_members.churchID = church.churchID) AS 'total_members', invitationMode, url FROM church WHERE church_name  LIKE '%".$key."%' AND privacy_settings='Public' ".$condition." ORDER BY church_name LIMIT 0,10");

        if(count( $query->result() ) > 0){
            $html ='<div class="list-group mt-3">';

            foreach($query->result_array() as $row)
            {

                    if($row['invitationMode']=='Anyone'){
                        $html.='
                        <button type="button" onclick="selectChurch(\''.$row['url'].'\')" class="list-group-item list-group-item-action">
                        <img src="'. base_url() .$row['url_photo'].'" height=32 height=32>
                        <span style="text-overflow: ellipsis;overflow: hidden;">'.$row['church_name'].'</span> 
                        <span class=" float-end"><small>'.$row['total_members'].'</small><i class="bi bi-person-fill ms-2" style="color:#0d6efd"></i><i class="bi bi-globe ms-2" style="color:#adb5bd"></i><span></button>
                        ';
                    }
                    else if($row['invitationMode']=='Invite Only'){
                        $html.='
                        <button onclick="selectChurch(\''.$row['url'].'\')" type="button" class="list-group-item list-group-item-action">
                        <img src="'. base_url() .$row['url_photo'].'" height=32 height=32>
                        '.$row['church_name'].' 
                        <span class=" float-end"><small>'.$row['total_members'].'</small><i class="bi bi-person-fill ms-2" style="color:#0d6efd"></i><i class="bi bi-envelope ms-2" style="color:#ffc107"></i><span></button>
                        ';
                    }else{
                        $html.='
                        <button onclick="selectChurch(\''.$row['url'].'\')" type="button" class="list-group-item list-group-item-action">
                        <img src="'. base_url() .$row['url_photo'].'" height=32 height=32>
                        '.$row['church_name'].' 
                        <span class=" float-end"><small>'.$row['total_members'].'</small><i class="bi bi-person-fill ms-2" style="color:#0d6efd"></i><i class="ri-lock-2-line ms-2" style="color:#dc3545"></i><span></button>
                        ';
                    }
                   

            }

            $html.='</div>';

        }else{

            $html ='
            <div class="mb-4 mt-4 pb-4 d-ne" style="height:250px">
                <p align=center style="ms auto fluid">No Data Found.</p>
            </div>
            ';
        }

        return $html;
    }

    public function updatePhoto($id,$path,$action){

        if($action=="profile-photo"){
            $data = array('url_photo'=>$path);
        }else{
            $data = array('url_cover_photo'=>$path);
        }
  
        $gallery = array(
            'churchID' => $id,
            'userID' => $_SESSION['userID'],
            'type' => 'church profile photo',
            'filePath' => $path
        );
        $this->db->insert('image_gallery',$gallery);   


        $this->db->where('churchID',$id);
        return $this->db->update('church',$data);
    }

    public function check_ChurchID_ChurchName_Existed($id, $churchName){
        $query = $this->db->query("SELECT * FROM church where churchID = $id and church_name='$churchName'");
        if(count($query->result())>0){
            return true;
        }
        return false;
    }

    public function join_church($id){

        $row = $this->getChurchInfo($id);

        if($this->input->post('action')=="join")
            {
                ///////IF THE INVITATION IS ANYONE////////////////
                if($row['invitationMode']=="Anyone")
                    {
                        $member = array(
                            'churchID' => $row['churchID'],
                            'userID' => $_SESSION['userID'],
                            'dtJoined' => date('Y-m-d H:i:s'),
                            'user_status' => 'approved',
                            'accessRole' => 'Member'
                        );
                        $this->db->insert('church_members',$member);
        
                        //UPDATE CURRENT CHURCH IN THE PROFILE//
                        $profile = array(
                            'userID' => $_SESSION['userID'],
                            'chu_churchID' => $row['churchID']);
                        $this->db->update('profile',$profile,array('userID'=>$_SESSION['userID']));   

                        //TaskID = 17 | When Join in the church
                        $this->AchievementModel->task_controller(17,'Church Badge');
        
                    return "You have successfully joined in the church.";

                }
                else if($row['invitationMode']=="Invite Only")
                    {
        
                        $member = array(
                            'churchID' => $row['churchID'],
                            'userID' => $_SESSION['userID'],
                            'user_status' => 'pending',
                            'accessRole' => 'Member'
                        );
                        $this->db->insert('church_members',$member);   

                        
                        
                        return "You have successfully ask to join in the church. Please wait for an approval by the Admin";
                    
                }


            }
        else if($this->input->post('action')=="remove")
            {
            $row = $this->getChurchInfo($id);
            $this->db->query("DELETE FROM `church_members` WHERE userId=".$_SESSION['userID']." AND churchID=" . $row['churchID']);   
            //UPDATE CURRENT CHURCH IN THE PROFILE//
            $profile = array(
                    'userID' => $_SESSION['userID'],
                    'chu_churchID' => 0);
            $this->db->update('profile',$profile,array('userID'=>$_SESSION['userID']));  
            return "You have successfuly remove this church";

            }    





    }

    public function insert_entry($data){

        $data['createdBy'] = $_SESSION['userID'];
        $data['updatedBy'] = $_SESSION['userID'];
        $data['userID'] = $_SESSION['userID'];
        $data['url'] = uniqid();
        $this->db->insert('church',$data);   

        $row = $this->getChurchInfo_by_Name($this->input->post('church_name'));
        $member = array(
            'churchID' => $row['churchID'],
            'userID' => $_SESSION['userID'],
            'dtJoined' => date('Y-m-d H:i:s'),
            'user_status' => 'approved',
            'churchRoleID' => 1
        );

        return $this->db->insert('church_members',$member);
    }

    public function delete_entry($id){
        return $this->db->delete('church',array('churchID'=>$id));   
    }

    public function update_entry($data){
        return $this->db->update('church',$data,array('churchID'=>$data['churchID']));   
    }

    public function edit_entry($id){
        $this->db->select("*");
        $this->db->from("church");
        $this->db->where("churchID",$id);
        $query = $this->db->get();
        if(count($query->result())>0){
            return $query->row();
        }
    }

    public function get_simple_list_churches(){
        $html="";
        $query = $this->db->query("SELECT * FROM church WHERE userID=".$_SESSION['userID']." ORDER BY church_name");

        if(count( $query->result() ) > 0){
            foreach($query->result_array() as $row)
            {
                $html.='
                <a id="selEdit" href="#" value="'.$row['churchID'].'" onclick="browseCreatedChurch(this)" class="list-group-item list-group-item-action">
                <img class="border border-light border-2 rounded-circle" src="'. base_url() . $row['url_photo'].'" style="height:50px;width:50px">  
                '.$row['church_name'].'
                </a>';
            }  
        }else{
            $html.=' <p align=center class="mt-4 mb-4">No Data Found.</p>';
        }
        return $html;
    }

//////////////////////////////////////////////////////////////////FORM ONLY///////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


  

}