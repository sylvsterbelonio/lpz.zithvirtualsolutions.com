<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class ProfileModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function insertProfile($userID){
        $data = array(
            'userID' => $userID
        );
        $this->db->insert('profile',$data);
    }

    public function insert_family(){

        $relationship = $this->input->post('relationship');

        //TaskID = 9 | Fill up Father's Name
        if($relationship=="Father") {$this->AchievementModel->task_controller(9,'Family Badge');}
        //TaskID = 10 | Fill up Mother's Name
        if($relationship=="Mother") {$this->AchievementModel->task_controller(10,'Family Badge');}        
        //TaskID = 11 | Fill up Grandmother's Name
        if($relationship=="Grandmother") {$this->AchievementModel->task_controller(11,'Family Badge');}   
        //TaskID = 12 | Fill up Grandfather's Name
        if($relationship=="Grandfather") {$this->AchievementModel->task_controller(12,'Family Badge');}  
        //TaskID = 13 | Fill up Fill up Sibling's Name
        if($relationship=="Siblings" || $relationship=="Younger Brother" || $relationship=="Younger Sister" ||
           $relationship=="Older Brother" || $relationship=="Older Sister" || $relationship=="Brother" || $relationship=="Sister" || 
           $relationship=="Step Older Brother" || $relationship=="Step Older Sister" || $relationship=="Step Brother" || $relationship=="Step Sister" ||
           $relationship=="Step Younger Brother" || $relationship=="Step Younger Sister")
           {$this->AchievementModel->task_controller(13,'Family Badge');}

        //TaskID = 14 | If married fill up Spouse Name
        if($this->input->post('civil_status')=="Married" && ($relationship=="Wife" || $relationship=="Husband"))
        {    $this->AchievementModel->task_controller(14,'Family Badge');}


        $data = array(
            'profileID' => $_SESSION['userID'],
            'relationship' => $this->input->post('relationship'),
            'rel_name' => $this->input->post('rel_name'),
            'rel_birthdate' => $this->input->post('rel_birthdate'),
            'rel_age' => $this->input->post('rel_age'),
            'rel_occupation' => $this->input->post('rel_occupation'),
            'rel_contact_no' => $this->input->post('rel_contact_no'),
            'rel_status' => $this->input->post('rel_status')
        );
      return $this->db->insert('profile_family_background',$data);
    }

    public function update_family(){

        $data = array(
            'relationship' => $this->input->post('relationship'),
            'rel_name' => $this->input->post('rel_name'),
            'rel_birthdate' => $this->input->post('rel_birthdate'),
            'rel_age' => $this->input->post('rel_age'),
            'rel_occupation' => $this->input->post('rel_occupation'),
            'rel_contact_no' => $this->input->post('rel_contact_no'),
            'rel_status' => $this->input->post('rel_status'),
            'rel_condition' => $this->input->post('rel_condition')
        );
        $this->db->where('familyBackgroundID',$this->input->post('id'));
        return $this->db->update('profile_family_background',$data);
    }

    public function edit_family_entry($familyID){
        $this->db->select("*");
        $this->db->from("profile_family_background");
        $this->db->where("familyBackgroundID",$familyID);
        $query = $this->db->get();
        if(count($query->result())>0){
            return $query->row();
        }
    }
    public function insert_selected_family($id){

        $relationship = $this->input->post('relationship');

        //TaskID = 9 | Fill up Father's Name
        if($relationship=="Father") {$this->AchievementModel->task_controller(9,'Family Badge');}
        //TaskID = 10 | Fill up Mother's Name
        if($relationship=="Mother") {$this->AchievementModel->task_controller(10,'Family Badge');}        
        //TaskID = 11 | Fill up Grandmother's Name
        if($relationship=="Mother") {$this->AchievementModel->task_controller(11,'Family Badge');}   
        //TaskID = 12 | Fill up Grandfather's Name
        if($relationship=="Mother") {$this->AchievementModel->task_controller(12,'Family Badge');}  
        //TaskID = 13 | Fill up Fill up Sibling's Name
        if($relationship=="Siblings" || $relationship=="Younger Brother" || $relationship=="Younger Sister" ||
           $relationship=="Older Brother" || $relationship=="Older Sister" || $relationship=="Brother" || $relationship=="Sister" || 
           $relationship=="Step Older Brother" || $relationship=="Step Older Sister" || $relationship=="Step Brother" || $relationship=="Step Sister" ||
           $relationship=="Step Younger Brother" || $relationship=="Step Younger Sister")
           {$this->AchievementModel->task_controller(13,'Family Badge');}

        //TaskID = 14 | If married fill up Spouse Name
        if($this->input->post('civil_status')=="Married" && ($relationship=="Wife" || $relationship=="Husband"))
        {    $this->AchievementModel->task_controller(14,'Family Badge');}


        $data = array(
            'profileID' => $id,
            'relationship' => $this->input->post('relationship'),
            'rel_name' => $this->input->post('rel_name'),
            'rel_birthdate' => $this->input->post('rel_birthdate'),
            'rel_contact_no' => $this->input->post('rel_contact_no'),
            'rel_status' => $this->input->post('rel_status')
        );
      return $this->db->insert('profile_family_background',$data);
    }

    public function delete_account_profile($id){
        $this->db->delete('church_members',array('userID'=>$id));
        $this->db->delete('users',array('userID'=>$id));
        $this->db->delete('users_points',array('userID'=>$id));
        $this->db->delete('profile',array('userID'=>$id));
        $this->db->delete('profile_consolidate',array('userID'=>$id));
        $this->db->delete('profile_evangelize',array('userID'=>$id));
        $this->db->delete('profile_family_background',array('profileID'=>$id));
    }

    public function delete_family($id){
        return $this->db->delete('profile_family_background',array('familyBackgroundID'=>$id));     
    }

    public function populate_families(){
        $query = $this->db->query('SELECT * FROM profile_family_background WHERE profileID='.$_SESSION['userID'].' ORDER BY relationship, rel_name');
        //$table = $this->ParameterModel->getRawParameter('table-family');
        return $query->result_array();
    }


    public function get_all_who_invite_list($name){
        $query = $this->db->query("
        
        SELECT `church_members`.userID, `church_members`.memberID, profile_photo_path,  first_name,middle_name,last_name, church_name, networkName

            FROM
            `profile`
            INNER JOIN `church_members`
                ON (
                `profile`.`userID` = `church_members`.`userID`
                )
            LEFT JOIN `church`
                ON (
                `church`.`churchID` = `church_members`.`churchID`
                )
            INNER JOIN `users`
                ON (  `users`.`userID` = `profile`.`userID`  ) LEFT JOIN `church_network`  ON ( `church_network`.`networkID` = `church_members`.`networkID` )
       
        
        
        WHERE  (first_name LIKE '".$name."%' OR middle_name LIKE '".$name."%' OR last_name LIKE '".$name."%') LIMIT 0,10");
        return $query->result();
    }

    public function get_all_network_leaders_list($churchID, $name){
        $query = $this->db->query("
        
        SELECT `church_members`.userID, `church_members`.memberID, profile_photo_path,  first_name,middle_name,last_name, church_name, networkName

            FROM
            `profile`
            INNER JOIN `church_members`
                ON (
                `profile`.`userID` = `church_members`.`userID`
                )
            LEFT JOIN `church`
                ON (
                `church`.`churchID` = `church_members`.`churchID`
                )
            INNER JOIN `users`
                ON (  `users`.`userID` = `profile`.`userID`  ) LEFT JOIN `church_network`  ON ( `church_network`.`networkID` = `church_members`.`networkID` )
       
        
        
        WHERE isAllowedToDisciple=1 AND (first_name LIKE '".$name."%' OR middle_name LIKE '".$name."%' OR last_name LIKE '".$name."%') LIMIT 0,10");
        return $query->result();
    }

    public function fetchSelectedFamilies($id){
    
        $query = $this->db->query('SELECT * FROM profile_family_background WHERE profileID='.$id.' ORDER BY relationship, rel_name');    
           if(count( $query->result() ) > 0){
            return $query->result();
        }

     
    }


    private function task(){
        //TaskID = 1 | Fill up your Full Name
        if($this->input->post('first_name')!="" && $this->input->post('middle_name')!="" && $this->input->post('last_name')!="")
        {$this->AchievementModel->task_controller(1,'Profile Badge');}
        //TaskID = 2 | Fill up your Home Address
        if($this->input->post('loc_country')!="" && $this->input->post('loc_province')!="" && $this->input->post('loc_city')!="" &&
        $this->input->post('loc_barangay')!="" && $this->input->post('loc_address')!="" )
        {$this->AchievementModel->task_controller(2,'Profile Badge');}        
        //TaskID = 3 | FIll up your Nickname
        if($this->input->post('nickname')!="")
        {$this->AchievementModel->task_controller(3,'Profile Badge');}
        //TaskID = 4 | Fill up Civil Status
        if($this->input->post('civil_status')!="")
        {$this->AchievementModel->task_controller(4,'Profile Badge');}  
        //TaskID = 5 | Fill up Gender
        if($this->input->post('sex')=="Male" || $this->input->post('sex')=="Female")
        {$this->AchievementModel->task_controller(5,'Profile Badge');}  
        //TaskID = 6 | Fill up Contact Information
        if($this->input->post('con_mobile_no')!="")
        {$this->AchievementModel->task_controller(6,'Profile Badge');}
        //TaskID = 7 | Fill up Social Information
        if($this->input->post('soc_facebook_url')!="")
        {$this->AchievementModel->task_controller(7,'Profile Badge');}
        //DATE OF BIRTH 
        if($this->input->post('date_of_birth')!="")
        {$this->AchievementModel->task_controller(16,'Profile Badge');}

    }

    public function updateProfile(){

        $this->task();

        $data = array(
            'about' => $this->input->post('about'),
            'nickname' => $this->input->post('nickname'),
            'first_name' => $this->input->post('first_name'),
            'middle_name' => $this->input->post('middle_name'),
            'last_name' => $this->input->post('last_name'),
            'name_ext' => $this->input->post('name_ext'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'place_of_birth' => $this->input->post('place_of_birth'),
            'sex' => $this->input->post('sex'),
            'civil_status' => $this->input->post('civil_status'),
            'height' => $this->input->post('height'),
            'height_metric' => $this->input->post('height_metric'),
            'weight' => $this->input->post('weight'),
            'weight_metric' => $this->input->post('weight_metric'),
            'blood_type' => $this->input->post('blood_type'),
            'loc_country' => $this->input->post('loc_country'),
            'loc_province' => $this->input->post('loc_province'),
            'loc_city' => $this->input->post('loc_city'),
            'loc_barangay' => $this->input->post('loc_barangay'),
            'loc_address' => $this->input->post('loc_address'),
            'loc_zipcode' => $this->input->post('loc_zipcode'),
            'con_mobile_no' => $this->input->post('con_mobile_no'),
            'con_tel_no' => $this->input->post('con_tel_no'),
            'educ_elem' => $this->input->post('educ_elem'),
            'educ_elem_year_graduated' => $this->input->post('educ_elem_year_graduated'),
            'educ_high_school' => $this->input->post('educ_high_school'),
            'educ_high_school_graduated' => $this->input->post('educ_high_school_graduated'),
            'educ_college' => $this->input->post('educ_college'),
            'educ_college_graduate' => $this->input->post('educ_college_graduate'),
            'educ_attainment' => $this->input->post('educ_attainment'),
            'educ_course' => $this->input->post('educ_course'),
            'occ_name_of_employer' => $this->input->post('occ_name_of_employer'),
            'occ_occupation' => $this->input->post('occ_occupation'),
            'occ_address' => $this->input->post('occ_address'),
            'soc_facebook_url' => $this->input->post('soc_facebook_url'),
            'soc_youtube_url' => $this->input->post('soc_youtube_url'),
            'soc_instagram_url' => $this->input->post('soc_instagram_url'),
            'soc_linkin_url' => $this->input->post('soc_linkin_url'),
            'soc_tiktok_url' => $this->input->post('soc_tiktok_url'),
            'soc_twitter_url' => $this->input->post('soc_twitter_url'),
            'updatedBy' => $_SESSION['userID'],
            'dtUpdated' => date('Y-m-d H:i:s')
        );
        $this->db->where('userID',$_SESSION['userID']);
        $this->db->update('profile',$data);
    }
    public function getProfile($username){
        $query = $this->db->query("SELECT * FROM `accessLevel` INNER JOIN `users`  ON (`accessLevel`.`accessLevelID` = `users`.`accessLevelID`) where username='$username'"); 
        return $query->row_array();
    }

    private function set_home_address_combobox($value, $default_value){
        $html="<option value=''>".$default_value."</option>";
        if($value!=""){
            $html.="<option value='".$value."' selected>".$value."</option>";
        }

        if($default_value=="- Select Country -")
        {
            if($value==""){
                $query = $this->db->query("select DISTINCT NAME_0 from spatial_location order by NAME_0");
                foreach($query->result_array() as $row) 
                {
                    $html.="<option value='".$row['NAME_0']."'>".$row['NAME_0']."</option>";
                }
            }
            
        }

       return $html;
    }

    public function getProfileData(){
        $html="";
        $query = $this->db->query("SELECT * FROM `users` AS `users_1` INNER JOIN `profile`   ON (`users_1`.`userID` = `profile`.`userID`) WHERE `users_1`.userID=".$_SESSION['userID']);
        return $query->row_array();
    }

    public function getProfileInformation($userID){

        $churchInformation = $this->ChurchModel->getChurch_from_ProfileInformation($_SESSION['userID']);

        $query = $this->db->query("SELECT * FROM `users` AS `users_1` INNER JOIN `profile`   ON (`users_1`.`userID` = `profile`.`userID`) WHERE `users_1`.userID=".$userID);
        $row = $query->row_array();

        if($row==null){
            $data = [
                'userID' => $userID,
                'about' => ''
            ];
            $this->db->insert('profile',$data);
            $query = $this->db->query("SELECT * FROM `users` AS `users_1` INNER JOIN `profile`   ON (`users_1`.`userID` = `profile`.`userID`) WHERE `users_1`.userID=".$userID);
            $row = $query->row_array();    
        }

        $row['country'] = $row['loc_country'];
        $row['province'] = $row['loc_province'];
        $row['city'] = $row['loc_city'];
        $row['barangay'] = $row['loc_barangay'];
        $row['accessRoleName'] = $this->AuthModel->getSystemRole($row['accessLevelID']);

        $row['overviewtab'] = $this->profile->overviewtab($row,$churchInformation);
        
        return $row;

    }

    public function get_android_profile($userID){
        $query = $this->db->query("SELECT * FROM `profile`  INNER JOIN `users` ON ( `profile`.`userID` = `users`.`userID`  ) where `users`.`userID`=". $userID. "");
        return $query->row_array();
    }

    public function android_change_email($userID, $email){
        $datax = [
            'email' => $email,
        ];
        //$this->db->set($data); 
        return $this->db->update('users',$datax,array('userID'=>$userID));     
    }

    public function android_update_users_profile_photo($file, $userID){

        $file = array(
            'profile_photo_path' => $file
        );

        $this->db->where('userID',$userID);
        $this->db->update('users',$file);
    }

    public function android_update_profile($profile, $userID){
        $this->db->where('userID',$userID);
        $this->db->update('profile',$profile);
    }

    public function android_insert_family($family){
        $this->db->insert('profile_family_background',$family);
    }

    public function android_get_family_list($userID){
        $query = $this->db->query("SELECT * from profile_family_background  where profileID = " . $userID);
        return $query->result();
    }

    public function android_get_family_list_to_delete($userID){
        $query = $this->db->query("SELECT * from profile_family_background  where profileID = " . $userID);
        return $query->result_array();
    }

    public function android_delete_family_list($userID){
        $this->db->query("DELETE from profile_family_background  where profileID = " . $userID);
    }

    public function set_android_setup_mode_update($raw){

        // USERS UPDATE //
        $users = array(
            'userID'=>$raw['userID'],
            'setupMode' => 1,
            'dtUpdated' => date('Y-m-d H:i:s'),
        );
        $this->db->where('userID',$raw['userID']);
        $this->db->update('users',$users);

        // INSERT NEW MEMBERS TO CHURCH //
        $networkID = $this->get_andriod_members_network_by_founders_id($raw['userID_leader']);
        
        $church_members = array(
            'churchID' => $raw['churchID'],
            'userID' => $raw['userID'],
            'user_status' => 'approved',
            'dtJoined' => date('Y-m-d H:i:s'),
            'networkID' => $networkID,
            'churchRoleID' => 12, //disciple
            'uplineID' => $raw['userID_leader'],
            'isAllowedToDisciple' => 1,
            'invitedBy' => $raw['userID_invite'],
            'dtCreated' => date('Y-m-d H:i:s'),
            'updatedBy' => $raw['userID'],
            'dtUpdated' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('church_members',$church_members);

        $profile = array(
            '_networkID' => $networkID,
            '_userID_leader' => $raw['userID_leader'],
            '_churchID' => $raw['churchID'],
            '_userID_invite' =>  $raw['userID_invite'],
            '_isAllowedToNetwork' => 0
        );

        $this->db->where('userID',$raw['userID']);
        $this->db->update('profile',$profile);

        return "";
    }

    private function get_andriod_members_network_by_founders_id($userID_leader){
        $query = $this->db->query("SELECT * FROM church_network where createdBy=".$userID_leader);
        foreach($query->result_array() as $row) 
        {
            return $row['networkID'];
        }
        return 0;
    }

    private function get_andriod_church_members_info($userID){
        $query = $this->db->query("SELECT * FROM church_members where userID=".$userID);
        foreach($query->result_array() as $row) 
        {
            return $row['memberID'];
        }
        return 0;
    }
    
}