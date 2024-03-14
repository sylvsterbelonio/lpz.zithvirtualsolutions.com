<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class UsersManagementModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    
    public function fetch_all(){
        $query = $this->db->query('SELECT * FROM `users` INNER JOIN `profile`    ON (`users`.`userID` = `profile`.`userID`)');
        if(count( $query->result() ) > 0){
            return $query->result();
        }
    }

    public function delete_entry($id){
        $this->db->delete('profile',array('userID'=>$id));   
        return $this->db->delete('users',array('userID'=>$id));   
    }

    public function insert_entry(){
        $options = [
            'cost' => 11
          ];

        $users = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'accessLevelID' => $this->input->post('accessLevelID'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options),
            'profile_photo_path' =>'assets/images/default-photo_square.png',
            'createdBy' => $_SESSION['userID'],
            'dtCreated' => date('Y-m-d H:i:s'),
            'dtUpdated' => date('Y-m-d H:i:s'),
            'updatedBy' => $_SESSION['userID'],
        );
        $this->db->insert('users',$users);
        $query = $this->db->query("SELECT * FROM users where username='".$this->input->post("username")."'");
        $userID=0;
        foreach($query->result_array() as $row) { $userID = $row['userID']; }  

        $profile = array(
            'userID' => $userID,
            'about' => $this->input->post('about'),
            'first_name' => $this->input->post('first_name'),
            'middle_name' => $this->input->post('middle_name'),
            'last_name' => $this->input->post('last_name'),
            'name_ext' => $this->input->post('name_ext'),
            'nickname' => $this->input->post('nickname'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'place_of_birth' => $this->input->post('place_of_birth'),
            'sex' => $this->input->post('sex'),
            'civil_status' => $this->input->post('civil_status'),
            'occupation' => $this->input->post('occupation'),
            'height' => $this->input->post('height'),
            'height_metric' => $this->input->post('height_metric'),
            'weight' => $this->input->post('weight'),
            'weight_metric' => $this->input->post('weight_metric'),
            'blood_type' => $this->input->post('blood_type'),
            'chu_church_name' => $this->input->post('chu_church_name'),
            'chu_cellLeader' => $this->input->post('chu_cellLeader'),
            'loc_country' => $this->input->post('loc_country'),
            'loc_province' => $this->input->post('loc_province'),
            'loc_city' => $this->input->post('loc_city'),
            'loc_barangay' => $this->input->post('loc_barangay'),
            'loc_address' => $this->input->post('loc_address'),
            'loc_zipcode' => $this->input->post('loc_zipcode'),
            'con_mobile_no' => $this->input->post('con_mobile_no'),
            'con_tel_no' => $this->input->post('con_tel_no'),
            'soc_facebook_url' => $this->input->post('soc_facebook_url'),
            'soc_youtube_url' => $this->input->post('soc_youtube_url'),
            'soc_instagram_url' => $this->input->post('soc_instagram_url'),
            'soc_linkin_url' => $this->input->post('soc_linkin_url'),
            'soc_tiktok_url' => $this->input->post('soc_tiktok_url'),
            'soc_twitter_url' => $this->input->post('soc_twitter_url'),
            'privacy_settings' => $this->input->post('privacy_settings'),
            'createdBy' => $_SESSION['userID'],
            'dtCreated' => date('Y-m-d H:i:s'),
            'dtUpdated' => date('Y-m-d H:i:s'),
            'updatedBy' => $_SESSION['userID'],
        );

        return $this->db->insert('profile',$profile);

    }

    public function update_entry($userID){
        $options = [
            'cost' => 11
          ];

        $users = array(
            'userID' => $userID,
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'accessLevelID' => $this->input->post('accessLevelID'),
            'dtUpdated' => date('Y-m-d H:i:s'),
            'updatedBy' => $_SESSION['userID'],
        );

        $this->db->update('users',$users,array('userID'=>$users['userID']));   

        $profile = array(
            'about' => $this->input->post('about'),
            'first_name' => $this->input->post('first_name'),
            'middle_name' => $this->input->post('middle_name'),
            'last_name' => $this->input->post('last_name'),
            'name_ext' => $this->input->post('name_ext'),
            'nickname' => $this->input->post('nickname'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'place_of_birth' => $this->input->post('place_of_birth'),
            'sex' => $this->input->post('sex'),
            'civil_status' => $this->input->post('civil_status'),
            'occupation' => $this->input->post('occupation'),
            'height' => $this->input->post('height'),
            'height_metric' => $this->input->post('height_metric'),
            'weight' => $this->input->post('weight'),
            'weight_metric' => $this->input->post('weight_metric'),
            'blood_type' => $this->input->post('blood_type'),
            'chu_church_name' => $this->input->post('chu_church_name'),
            'chu_cellLeader' => $this->input->post('chu_cellLeader'),
            'loc_country' => $this->input->post('loc_country'),
            'loc_province' => $this->input->post('loc_province'),
            'loc_city' => $this->input->post('loc_city'),
            'loc_barangay' => $this->input->post('loc_barangay'),
            'loc_address' => $this->input->post('loc_address'),
            'loc_zipcode' => $this->input->post('loc_zipcode'),
            'con_mobile_no' => $this->input->post('con_mobile_no'),
            'con_tel_no' => $this->input->post('con_tel_no'),
            'soc_facebook_url' => $this->input->post('soc_facebook_url'),
            'soc_youtube_url' => $this->input->post('soc_youtube_url'),
            'soc_instagram_url' => $this->input->post('soc_instagram_url'),
            'soc_linkin_url' => $this->input->post('soc_linkin_url'),
            'soc_tiktok_url' => $this->input->post('soc_tiktok_url'),
            'soc_twitter_url' => $this->input->post('soc_twitter_url'),
            'privacy_settings' => $this->input->post('privacy_settings'),
            'dtUpdated' => date('Y-m-d H:i:s'),
            'updatedBy' => $_SESSION['userID'],
        );

        return   $this->db->update('profile',$profile,array('userID'=>$userID));   

    }

    public function edit_entry($id){
        $query = $this->db->query("SELECT * FROM `users` INNER JOIN `profile`   ON (`users`.`userID` = `profile`.`userID`) WHERE `users`.`userID` =". $id);
        if(count($query->result())>0){
            return $query->row();
        }
    }



}    