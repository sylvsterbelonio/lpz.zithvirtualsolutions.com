<?php
 if (!defined('BASEPATH')) exit('No direct script access allowed');

class MembersModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function android_get_network_leader_info($userID){
        $query = $this->db->query("SELECT * FROM profile WHERE userID=$userID");
        $leaderID=0;
        foreach($query->result_array() as $row) {
            $leaderID = $row['_userID_leader'];
        }

        $query = $this->db->query("SELECT profile.userID,profile_photo_path, first_name, middle_name, last_name, networkName, networkLogo FROM `users` INNER JOIN `profile`  ON ( `users`.`userID` = `profile`.`userID` ) LEFT JOIN `church_network` ON ( `church_network`.`createdBy` = `users`.`userID`  ) WHERE profile.userID = $leaderID");

        $data = array();
        $count = 0;

        foreach($query->result_array() as $row) {
            $data[$count] = array(
            'userID'=>$row['userID'],
            'profile_photo_path' => $row['profile_photo_path'],
            'first_name' => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'last_name' => $row['last_name'],
            'networkName' => $row['networkName'],
            'networkLogo' => $row['networkLogo'],
            'totalMembers' => $this->get_count_number_members_list($userID),
            'Total144Members' => $this->get_144_count_number_members_list($userID),
            'Total1789Members' => $this->get_1789_count_number_members_list($userID),
            );
            $count+=1;
        }

        if($count==0){
            $data[$count] = array('userID'=>'',
            'profile_photo_path' => '',
            'first_name' => '',
            'middle_name' => '',
            'last_name' => '',
            'networkName' => '',
            'networkLogo' => '',
            'totalMembers' => $this->get_count_number_members_list($userID),
            'Total144Members' => $this->get_144_count_number_members_list($userID),
            'Total1789Members' => $this->get_1789_count_number_members_list($row['userID']),
            );
        }
   
        return $data;
   
    }


    public function android_get_network_members_list($userID){
        $query = $this->db->query("SELECT profile.userID, profile_photo_path, first_name, middle_name, last_name, networkName FROM `church_network` RIGHT JOIN `profile` ON (`church_network`.`createdBy` = `profile`.`_networkID` ) INNER JOIN `users` ON ( `users`.`userID` = `profile`.`userID` ) where profile._userID_leader=$userID");
        $data = array();
        $count=0;
        foreach($query->result_array() as $row) {
            $data[$count] = array(
                'userID' => $row['userID'],
                'profile_photo_path' => $row['profile_photo_path'],
                'first_name' => $row['first_name'],
                'middle_name' => $row['middle_name'],
                'last_name' => $row['last_name'],
                'networkName' => $row['networkName'],
                'totalPLMembers' => $this->get_count_number_members_list($row['userID']),
                'Total144Members' => $this->get_144_count_number_members_list($row['userID']),
                'Total1789Members' => $this->get_1789_count_number_members_list($row['userID']),
            );

            $count+=1;
        }
        return $data;
    }

    public function get_count_number_members_list($userID){
        $query = $this->db->query("SELECT profile.userID, profile_photo_path, first_name, middle_name, last_name, networkName FROM `church_network` RIGHT JOIN `profile` ON (`church_network`.`createdBy` = `profile`.`_networkID` ) INNER JOIN `users` ON ( `users`.`userID` = `profile`.`userID` ) where profile._userID_leader=$userID");
        return $query->num_rows();
    }

    public function get_144_count_number_members_list($userID){
        $count=0;
        
        $query = $this->db->query("SELECT profile.userID FROM `church_network` RIGHT JOIN `profile` ON (`church_network`.`createdBy` = `profile`.`_networkID` ) INNER JOIN `users` ON ( `users`.`userID` = `profile`.`userID` ) where profile._userID_leader=$userID");
        foreach($query->result_array() as $row) {
             $count+= $this->get_count_number_members_list($row['userID']);
        }

        return $count;
    }


    public function get_1789_count_number_members_list($userID){
        $count=0;
        $level=1;
      
        $query = $this->db->query("SELECT profile.userID FROM  `profile` where profile._userID_leader=$userID");
        foreach($query->result_array() as $row) {
            $count = $this->get_level_2_members_list($row['userID'],0);
        }

        return $count;

    }

    public function get_level_2_members_list($userID,$count){
        $query = $this->db->query("SELECT profile.userID FROM  `profile` where profile._userID_leader=$userID");
        foreach($query->result_array() as $row) {
            $count = $this->get_level_3_members_list($row['userID'],$count);
        }
        return $count;
    }

    public function get_level_3_members_list($userID,$count){
        $query = $this->db->query("SELECT profile.userID  FROM  `profile` where profile._userID_leader=$userID");
        foreach($query->result_array() as $row) {
                $count = $this->get_count_members_inifite($row['userID'],$count);
        }
        return $count;
    }

    public function get_count_members_inifite($userID, $count){
        $query = $this->db->query("SELECT profile.userID  FROM  `profile` where profile._userID_leader=$userID");
        if($query->num_rows()){
            foreach($query->result_array() as $row) {
              $count = $this->get_count_members_inifite($row['userID'],$count);
            }
        }else{
            $count+=1;
        }
        return $count;
    }

    public function search_members($searchValue){
        $query = $this->db->query(
           "
           SELECT `users`.userID, email, profile_photo_path, first_name, middle_name, last_name, _userID_leader, privacy_settings, (SELECT church_name FROM church WHERE church.churchID = _churchID) AS 'ChurchName'
            FROM
            `users`
            INNER JOIN `profile`
                ON (
                `users`.`userID` = `profile`.`userID`
                )
                
                WHERE _userID_leader = 0 AND privacy_settings = 'Public' AND (email LIKE '$searchValue%' OR first_name LIKE '$searchValue%' OR middle_name LIKE '$searchValue%' OR last_name LIKE '$searchValue%')        
                ORDER BY last_name, first_name, middle_name, email LIMIT 0,15    
                "
        );
        return $query->result_array();
    }

    public function android_get_person_info_from_id($userID){
        $query = $this->db->query("SELECT _networkID, _userID_leader, _churchID, _userID_invite  FROM  `profile` where userID=$userID");
        $data = array();
        foreach($query->result_array() as $row) {
            $networkDetails = $this->get_network_details_info($row['_networkID']);
            $leaderDetails = $this->get_profile_details_info($row['_userID_leader']);
            $churchDetails = $this->get_church_info($row['_churchID']);
            $inviteDetails = $this->get_profile_details_info($row['_userID_invite']);

            $data[0] = array(
                'networkLogo'=> $networkDetails['networkLogo'],
                'networkName' => $networkDetails['networkName'],
                'leader_photo' => $leaderDetails['leader_photo'],
                'leader_name' => $leaderDetails['leader_name'],
                'church_photo' => $churchDetails['church_photo'],
                'church_name' => $churchDetails['church_name'],
                'church_address' => $churchDetails['church_address'],
                'invite_logo' => $inviteDetails['leader_photo'],
                'invite_name' => $inviteDetails['leader_name']
            );
        }

        return $data;

    }

    public function android_network_leader_add($userID,$person_userID){

        $query = $this->db->query("SELECT *  FROM  `profile` where userID=$userID");
        
        $_networkID = 0;

        foreach($query->result_array() as $row) {
            $_networkID = $row['_networkID'];
        }
        

        $profile = array(
            '_networkID' => $_networkID,
            '_userID_leader' => $userID,
        );

        $this->db->where('userID',$person_userID);
        $this->db->update('profile',$profile);
    }

    public function android_network_leader_remove($id){
        $profile = array(
            '_networkID' => 0,
            '_userID_leader' => 0,
        );
        $this->db->where('userID',$id);
        $this->db->update('profile',$profile);
    }

    private function get_network_details_info($id){
        $query = $this->db->query("SELECT *  FROM church_network where networkID=$id");
        $data = array('networkLogo'=>base_url() . "assets/images/network_logo.png",'networkName'=>'');
        foreach($query->result_array() as $row) {
            $data = array('networkLogo' => base_url() . $row['networkLogo'], 'networkName' => $row['networkName']);
        }
        return $data;
    }

    private function get_profile_details_info($id){
        $query = $this->db->query("SELECT profile_photo_path, first_name, middle_name, last_name  FROM  `users` INNER JOIN `profile` ON ( `users`.`userID` = `profile`.`userID`  )  where `profile`.`userID`=$id");
        $data = array('leader_photo'=>base_url(). "assets/images/default-photo_square.png",'leader_name'=>'');
        foreach($query->result_array() as $row) {

            $info = explode("/",$row['profile_photo_path']);
            $url="";
            if($info[0]=="assets"){
                    $url = base_url() . $row['profile_photo_path'];
            }else{
                $url = $row['profile_photo_path'];
            }

            $data = array('leader_photo'=>$url, 'leader_name' => $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']);
        }
        return $data;
    }

    private function get_church_info($id){
        $query = $this->db->query("SELECT *  FROM church where churchID=$id");
        $data = array('church_photo'=>base_url(). "assets/images/default_church_square.png",'church_name'=>'','church_address'=>'');
        foreach($query->result_array() as $row) {
            $address = $row['barangay'] . ', ' . $row['city'] . ", " . $row['province'];
            $data = array(
            'church_photo'=> base_url() . $row['url_photo'], 
            'church_name'=>$row['church_name'],
            'church_address' => $address );
        }

        return $data;

    }
  


    public function getChurchRoles(){
        $query = $this->db->query("SELECT * FROM church_members where userID=".$_SESSION['userID']." AND churchID=".$_SESSION['currentChurchID']);
        foreach($query->result_array() as $row) {
             return $row['churchRoleID'];
            }    
        return 0;    
    }

    public function getMembers($roleName,$searchName){
        $churchID = $_SESSION['currentChurchID'];
        $query = $this->db->query("
        SELECT church.`church_name`,  users.`url_address`, users.`profile_photo_path`, profile.`first_name`, profile.`middle_name`, profile.`last_name`, church_roles.`roleName`
        FROM
            `profile`
            INNER JOIN `church_members` 
                ON (`profile`.`userID` = `church_members`.`userID`)
            INNER JOIN `church` 
                ON (`church`.`churchID` = `church_members`.`churchID`)
            INNER JOIN `church_roles` 
                ON (`church_roles`.`churchRoleID` = `church_members`.`churchRoleID`)
            INNER JOIN `users` 
                ON (`users`.`userID` = `profile`.`userID`) 
                
        WHERE  church_members.churchID=$churchID AND roleName LIKE '%$roleName%' AND (first_name LIKE '$searchName%' OR middle_name LIKE '$searchName%' OR last_name LIKE '$searchName%')
        LIMIT 0,25
        ");
   
        return $query->result_array();

    }

    public function createProfile($profile, $account, $member, $family){

        $options = [
            'cost' => 11
          ];

        $data = [
            'username' => $account["username"],
            'email' => $account["email"],
            'password' => password_hash($account['password'], PASSWORD_BCRYPT, $options),
            'profile_photo_path' =>'assets/images/default-photo_square.png',
            'url_address' => uniqid(),
            'accessLevelID' => 6,
            'createdBy' => $_SESSION['userID'],
            'dtCreated' => date('Y-m-d H:i:s'),
            'dtUpdated' => date('Y-m-d H:i:s'),
            'updatedBy' => $_SESSION['userID']
        ];
        //$this->db->set($data); 
        $this->db->insert('users',$data);

        // INSERT PROFILE TABLE//
        $query = $this->db->query("SELECT * FROM users where username='".$this->input->post("username")."'");
        $userID=0;
        foreach($query->result_array() as $row) { $userID = $row['userID']; }    

        $user = ['userID'=>$userID];
        $profile['userID'] = $userID;
        $profile['about'] = "";
        $profile['createdBy'] = $_SESSION['userID'];
        $profile['updatedBy'] = $_SESSION['userID'];

        $this->db->insert('profile',$profile);
        $this->db->insert('users_points',$user);

        $member['churchID'] = $_SESSION['currentChurchID'];
        $member['userID']   = $userID;
        $member['user_status']   = 'approved';
        $member['dtJoined'] = date('Y-m-d H:i:s');
        $member['createdBy'] = $_SESSION['userID'];
        $member['updatedBy'] = $_SESSION['userID'];
        $this->db->insert('church_members',$member);

        //INSERT FAMILY//
   
            $array_family = explode("♮",$family['family']);
                if($array_family[0]!=""){
                    for($i=0; $i< count($array_family); $i++)
                        {
                        $col = explode("␦",$array_family[$i]);
                        $family_row = array(
                            'profileID' => $userID,
                            'rel_name' => $col[0],
                            'rel_birthdate' => $col[1],
                            'rel_age' => $col[2],
                            'rel_occupation' => $col[3],
                            'rel_condition' => $col[4],
                            'relationship' => $col[5],
                            'rel_contact_no' => $col[6]
                        );
                        $this->db->insert('profile_family_background',$family_row);
                        }
                    }    
            //END OF INSERT FAMILY//
        
       

        $this->AuthModel->setTimeLog($this->AuthModel->getUserID($this->input->post("username")),"Successfully created an account of ". $this->input->post("username"));
    
        
    }
       
        



}
