<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class AuthModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function getAllUsers(){
        //THIS IS HOW TO CALL THE PRIVATE FUNCTION INSIDE THE CLASS
        //$this->yourNameFunction();
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function getUserDetails(){
        $query = $this->db->query('SELECT * FROM users WHERE userID='.$_SESSION['userID']);
        foreach($query->result_array() as $row)
        {
           return $row;
        }   
    }

    public function getHomeDashboardMenu(){
    

        $data = '<nav class="header-nav ms-auto mt-0 mb-0 pt-0 pb-0"">';

        if(isset($_SESSION['username']) )  

            {

                $row = $this->getUserDetails();

            $data.='
            <!-- Profile Dropdown Items -->
            <ul class="d-flex align-items-center" style="list-style-type: none">
                <li class="nav-item dropdown">
                
                    <a class="nav-link nav-profile d-flex align-items-center pe-0 mt-3" href="#" data-bs-toggle="dropdown">
                        <img style="height:25px;height:25px" src="'. base_url() . $row['profile_photo_path'] . '" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block text-light dropdown-toggle ps-2">'.  $_SESSION['username'] . '</span>
                    </a>
                    <!-- End Profile Iamge Icon -->
                
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="'. base_url('dashboard').'">
                            <i class="bi bi-grid  me-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="'. base_url('profile').'">
                            <i class="bi bi-person me-3"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="'. base_url('logout') .'">
                            <i class="bi bi-box-arrow-right me-3"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>
            </ul>
            <!-- End Profile Dropdown Items -->
            ';
            }
        else
            {

                $data.='
                <!-- Profile Dropdown Items -->
                <ul class="d-flex align-items-center mt-3" style="list-style-type: none">
                    <li><a href="/login" ><span id="linkLogIn" class="btn btn-outline-light me-1"><span class="bi bi-key me-2"></span>Log In</a></li>
                    <li><a href="/register" ><span id="linkRegister" class="btn btn-success me-1"><span class="bi bi-person-plus me-2"></span>Register</a></li>
                </ul>
                <!-- End Profile Dropdown Items -->';

            }

        $data.='</nav><!-- End Icons Navigation -->';    

        return $data;

    }

    public function getIconDashboardMenu(){
  

        $data = '<nav id="nav-dashboard" class="header-nav ms-auto">';

        if(isset($_SESSION['username']) )  
            {

                $row = $this->getUserDetails();
                
            $data.='
            <!-- Profile Dropdown Items -->
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3" style="list-style-type: none">
                
                    <a class="nav-link nav-profile d-flex align-items-center pe-0 mt-3" href="#" data-bs-toggle="dropdown">
                        <img style="height:32px;height:32px" src="'. base_url(). $row['profile_photo_path'] . '" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block text-light dropdown-toggle ps-2">'.  $_SESSION['username'] . '</span>
                    </a>
                    <!-- End Profile Iamge Icon -->
                
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>'. $_SESSION['username'] . '</h6>
                        <span>'. $_SESSION['accessLevelName'] . '</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="'. base_url('dashboard').'">
                            <i class="bi bi-grid  me-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="'. base_url('profile').'">
                            <i class="bi bi-person me-3"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="'. base_url('logout') .'">
                            <i class="bi bi-box-arrow-right me-3"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>
            </ul>
            <!-- End Profile Dropdown Items -->
            ';
            }
        else
            {

                $data.='
                <!-- Profile Dropdown Items -->
                <ul class="d-flex align-items-center mt-3" style="list-style-type: none">
                    <li><a href="/login" ><span id="linkLogIn" class="btn btn-outline-light me-2"><span class="bi bi-key "></span></a></li>
               </ul>
                <!-- End Profile Dropdown Items -->';

            }

        $data.='</nav><!-- End Icons Navigation -->';    

        return $data;

    }

    public function checkIfEmailExisted_for_update($userid, $email){
        $this->db->where('email', $email);
        $this->db->where('userID', $userid);
        $result = $this->db->get('users');
        return $result->num_rows();
    }

    public function checkIfUsernameExisted_for_update($userid, $username){
        $this->db->where('username', $username);
        $this->db->where('userID', $userid);
        $result = $this->db->get('users');
        return $result->num_rows();
    }

    public function checkIfEmailExisted($email){
        $this->db->where('email', $email);
        $result = $this->db->get('users');
        return $result->num_rows();
    }

    public function check_if_google_id_and_email_existed($email,$cuserID){
        $this->db->where('email', $email);
        $query = $this->db->query("SELECT * FROM users where email='$email' AND cuserID='$cuserID'"); 
        if($query->num_rows())
        return true;
        else
        return false;
    }

    public function android_update_cuserID($email,$cuserID){
        $data = array('cuserID'=>$cuserID);
        $this->db->where('email',$email);
        $this->db->update('users',$data);
    }

    public function checkIfUsernameExisted($username){
        $this->db->where('username', $username);
        $result = $this->db->get('users');
        return $result->num_rows();
    }

    public function getEmailAddress($userID){
          //$result = $this->db->get_where('users',array('userID' => $userID));
         //$result = $this->db->query('your query here');
        $this->db->where('userID',$userID);
        $result = $this->db->get('users');
      
        return $result->row_array();
    }

    public function getAccessLevel(){
        $html="";
        $query = $this->db->query("SELECT * FROM accessLevel ORDER BY accessLevelName");
        $html.='<option value="0">- Select Access Level - </option>';
        foreach($query->result_array() as $row){
            $html.='<option value="'.$row["accessLevelID"].'">'.$row["accessLevelName"].'</option>';
        }
        return $html;
    }

    public function setTimeLog($userID,$action){
        $usersAgent="";
        $currentLocation="";

        if ($this->agent->is_browser()){
             $usersAgent = $this->agent->browser().' '.$this->agent->version();
             $data = [
                'userID' => $userID,
                'action' => $action,
                'ipaddress' => $this->input->ip_address(),
                'browser' => $this->agent->browser().' '.$this->agent->version(),
                'isRobot' => "No",
                'isMobile' => "No",
                'osVersion' => $this->agent->platform()
            ];
            } elseif ($this->agent->is_robot()){        
                $data = [
                    'userID' => $userID,
                    'action' => $action,
                    'ipaddress' => $this->input->ip_address(),
                    'browser' => $this->agent->browser().' '.$this->agent->version(),
                    'isRobot' => $this->agent->robot(),
                    'isMobile' => "No",
                    'isUnknown' => "No",
                    'osVersion' => $this->agent->platform()
                ];
            } elseif ($this->agent->is_mobile()){      
                $data = [
                    'userID' => $userID,
                    'action' => $action,
                    'ipaddress' => $this->input->ip_address(),
                    'browser' =>  $this->agent->browser().' '.$this->agent->version(),
                    'isRobot' => "No",
                    'isMobile' => $this->agent->mobile(),
                    'isUnknown' => "No",
                    'osVersion' => $this->agent->platform()
                ];  
                $usersAgent = $this->agent->mobile();
            } else{
                $data = [
                    'userID' => $userID,
                    'action' => $action,
                    'ipaddress' => $this->input->ip_address(),
                    'browser' =>  $this->agent->browser().' '.$this->agent->version(),
                    'isRobot' => "No",
                    'isMobile' => $this->agent->mobile(),
                    'isUnknown' => "Unidentified User Agent",
                    'osVersion' => $this->agent->platform()
                ];                 
            }
     
            $query = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
            $currentLocation = $this->config->site_url().$this->uri->uri_string(). $query;     

            $this->db->set($data);
            $this->db->insert('users_timelog',$data);    

    }

    public function getLoginInfo($username){
        $query = $this->db->query("SELECT * FROM `accessLevel` INNER JOIN `users`  ON (`accessLevel`.`accessLevelID` = `users`.`accessLevelID`) where username='$username'"); 
        return $query->row_array();
        }
    
        public function getLoginInfo_Email($email){
            $query = $this->db->query("SELECT * FROM `accessLevel` INNER JOIN `users`  ON (`accessLevel`.`accessLevelID` = `users`.`accessLevelID`) where email='$email'"); 
            return $query->row_array();
            }    
    public function android_get_user_info_by_email($email){
        $query = $this->db->query("SELECT * FROM `accessLevel` INNER JOIN `users`  ON (`accessLevel`.`accessLevelID` = `users`.`accessLevelID`) where email='$email'"); 

        foreach($query->result_array() as $row)
            {
                $data=array(
                    'userID' => $row['userID'],
                    'email_status' => $row['email_status'],
                    'setupMode' => $row['setupMode'],
                    'email' => $row['email'],
                    'accessLevelName' => $row['accessLevelName'],
                    'accessLevelID' => $row['accessLevelID'],
                    'profile_photo_path' => $row['profile_photo_path'],
                    'username' => $row['username']
                );   
            }

        return $data;

        } 


    public function getUserID($username){
        $query = $this->db->query("SELECT userID from users where username='$username'");
        $row = $query->row_array();
        return $row['userID'];
    }
    public function getUserID_Android($email){
        $query = $this->db->query("SELECT userID from users where email='$email'");
        $row = $query->row_array();
        return $row['userID'];
    }

    public function getCheckUserID($username){
        $query = $this->db->query("SELECT userID from users where username='$username'");
        return count( $query->result());
    }

    public function getCheckUserID_Email($email){
        $query = $this->db->query("SELECT userID from users where email='$email'");
        return count( $query->result());
    }

    private function getUserID_from_email($email){
        $query = $this->db->query("SELECT userID from users where email='$email'");
        $row = $query->row_array();
        return $row['userID'];
    }


    public function updateProfilePhoto($path){

        //TaskID = 8 | Upload Profile Photo
        if($path!=""){$this->AchievementModel->task_controller(8,'Profile Badge');}

        $data = array('profile_photo_path'=>$path);
        $this->db->where('userID',$_SESSION['userID']);
        $this->db->update('users',$data);
    }

    public function android_checkPassword($email, $password){
        $options = ['cost' => 11];
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);
        $query = $this->db->query("SELECT * FROM users where email='".$email."'");
        if($query->num_rows())
        {
            $row = $query->row_array();           
            $hash_password = $row['password'];

            if(password_verify($password, $hash_password)) 
            {
                return true;
            }
            else{
                return false;
            }
        }
    }

    public function checkPassword($password){
        $options = ['cost' => 11];
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);
        $query = $this->db->query("SELECT * FROM users where username='".$_SESSION['username']."'");
        if($query->num_rows())
        {
            $row = $query->row_array();           
            $hash_password = $row['password'];

            if(password_verify($password, $hash_password)) 
            {
                return true;
            }
            else{
                return false;
            }
        }
    }

    public function android_change_privacy($userID, $privacy){
        $data = [
            'privacy_settings' => $privacy,
        ];
       return $this->db->update('profile',$data,array('userID'=>$userID));   
    }

    public function android_changePassword($userID, $password){
        $options = [
            'cost' => 11
          ];
        $data = [
            'password' => password_hash($password, PASSWORD_BCRYPT, $options),
        ];

       return $this->db->update('users',$data,array('userID'=>$userID));   
    }

    public function changePassword($password){
        $options = [
            'cost' => 11
          ];
        $data = [
            'password' => password_hash($password, PASSWORD_BCRYPT, $options),
        ];

       return $this->db->update('users',$data,array('userID'=>$_SESSION['userID']));   
    }

    public function checkLogIn($username,$password){
        //$query = $this->db->get('tablename');
        //foreach($query->result() as $row)
            //{
            //    echo $row->title;
            //}
       // return $query->result();     
      
      $options = ['cost' => 11];
      $hash = password_hash($password, PASSWORD_BCRYPT, $options);
      $query = $this->db->query("SELECT * FROM users where username='$username'");

      $returnValue=null;

      if($query->num_rows())
        {

            $row = $query->row_array();                 
            $hash_password = $row['password'];

            if(password_verify($password, $hash_password)) 
                {
                    
                    $returnValue['userID']=$row['userID'];
                    $returnValue['email']=$row['email'];
                    $returnValue['username']=$row['username'];  
                    $returnValue['accessLevelID']=$row['accessLevelID'];  
                    $returnValue['profile_photo_path']=$row['profile_photo_path'];
                    $returnValue['response']="success";
                    $_SESSION['currentChurchID']=0;
                } 
            else 
                {$returnValue['response']= "Username and password does not match. Please try again.";;}
        }
      else
        {$returnValue['response'] = "Username does not exist. Please try again.";}      

        return $returnValue;    
    }

    public function checkLogIn_Email($email,$password){
        //$query = $this->db->get('tablename');
        //foreach($query->result() as $row)
            //{
            //    echo $row->title;
            //}
       // return $query->result();     
      
      $options = ['cost' => 11];
      $hash = password_hash($password, PASSWORD_BCRYPT, $options);
      $query = $this->db->query("SELECT * FROM users where email='$email'");

      $returnValue=null;

      if($query->num_rows())
        {

            $row = $query->row_array();                 
            $hash_password = $row['password'];

            if(password_verify($password, $hash_password)) 
                {
                    
                    $returnValue['userID']=$row['userID'];
                    $returnValue['email']=$row['email'];
                    $returnValue['username']=$row['username'];  
                    $returnValue['accessLevelID']=$row['accessLevelID'];  
                    $returnValue['profile_photo_path']=$row['profile_photo_path'];
                    $returnValue['response']="success";
                    $_SESSION['currentChurchID']=0;
                } 
            else 
                {$returnValue['response']= "Email Address and Password does not match. Please try again.";;}
        }
      else
        {$returnValue['response'] = "Email Address does not exist. Please try again.";}      

        return $returnValue;    
    }

    public function android_create_account(){
        $options = [
            'cost' => 11
          ];

        $cuserID = uniqid();
        $data = [
            'cuserID' => uniqid(),
            'username' => '',
            'email' => $this->input->post("email"),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options),
            'profile_photo_path' =>'assets/images/default-photo_square.png',
            'url_address' => uniqid(),
            'createdBy' => 0,
            'dtCreated' => date('Y-m-d H:i:s'),
            'dtUpdated' => date('Y-m-d H:i:s'),
            'updatedBy' => 0
        ];
        //$this->db->set($data); 
        $this->db->insert('users',$data);

        $query = $this->db->query("SELECT * FROM users where email='".$this->input->post("email")."'");
        $userID=0;
        foreach($query->result_array() as $row)
        {
            $userID = $row['userID'];
        }    

        $user = array(
            'userID'=>$userID, 
            'cuserID'=>$cuserID,
			'first_name' => $this->input->post('first_name'),
				'middle_name' => $this->input->post('middle_name'),
				'last_name' => $this->input->post('last_name'),
            );
        
        $this->db->insert('profile',$user);

        $points = array(
            'userID'=>$userID,
            'cuserID'=>$cuserID,
        );

        $this->db->insert('users_points',$points);

        $this->setTimeLog($this->getUserID_Android($this->input->post("email")),"Successfully created an account of ". $this->input->post("email"));
    
    }


    public function android_google_create_account($google){
        $options = [
            'cost' => 11
          ];

        $cuserID = uniqid();
        $data = [
            'cuserID' => uniqid(),
            'username' => '',
            'email' => $google['google_email'],
            'password' => password_hash('123456', PASSWORD_BCRYPT, $options),
            'profile_photo_path' =>$google['google_photo_url'],
            'url_address' => uniqid(),
            'email_status' => 'Verified',
            'gmail_token_id' => $google['google_id'],
            'setupMode' => 0,
            'createdBy' => 0,
            'dtCreated' => date('Y-m-d H:i:s'),
            'dtUpdated' => date('Y-m-d H:i:s'),
            'updatedBy' => 0
        ];
        //$this->db->set($data); 
        $this->db->insert('users',$data);


        $query = $this->db->query("SELECT * FROM users where email='".$google['google_email']."'");
        $userID=0;
        foreach($query->result_array() as $row)
        {
            $userID = $row['userID'];
        }    

        $user = array(
            'userID'=>$userID, 
            'cuserID'=>$cuserID,
            'first_name' => $google['google_given_name'],
            'last_name' => $google['google_family_name']
            );

        $points = array(
            'userID'=>$userID, 
            'cuserID'=>$cuserID,
        );    
        
        $this->db->insert('profile',$user);
        $this->db->insert('users_points',$points);

        //$this->setTimeLog($this->getUserID_Android($google['google_email']),"Successfully created an account of ". $google['google_email']);

    
    }

    public function createAccount(){
        $options = [
            'cost' => 11
          ];

        $cuserID = uniqid();
        $data = [
            'cuserID' => uniqid(),
            'username' => '',
            'email' => $this->input->post("email"),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options),
            'profile_photo_path' =>'assets/images/default-photo_square.png',
            'url_address' => uniqid(),
            'createdBy' => 0,
            'dtCreated' => date('Y-m-d H:i:s'),
            'dtUpdated' => date('Y-m-d H:i:s'),
            'updatedBy' => 0
        ];
        //$this->db->set($data); 
        $this->db->insert('users',$data);


        $query = $this->db->query("SELECT * FROM users where email='".$this->input->post("email")."'");
        $userID=0;
        foreach($query->result_array() as $row)
        {
            $userID = $row['userID'];
        }    

        $user = array(  'userID' => $userID, 
                        'cuserID' => $cuserID,
                        'first_name' => $this->input->post('first_name'),
                        'middle_name' => $this->input->post('middle_name'),
                        'last_name' => $this->input->post('last_name'),
                        );
        $points = array('userID' => $userID, 
        'cuserID' => $cuserID);                
        
        $this->db->insert('profile',$user);
        $this->db->insert('users_points',$points);

        $this->setTimeLog($this->getUserID_from_email($this->input->post("email")),"Successfully created an account of ". $this->input->post("email"));
    
    
    }
    private function yourNameFunction(){
            echo "this is private class";
    }

    public function getSystemRole($accessLevelID){
        $query = $this->db->query("SELECT accessLevelName from accessLevel where accessLevelID=".$accessLevelID);
        $row = $query->row_array();
        return $row['accessLevelName'];
    }

	public function createVerficationCode($Toemail,$code){	
        $data = [
			'userID' => $_SESSION['userID'],
            'email' => $Toemail,
            'code' => $code,
            'status' => 'pending'
        ];
        //$this->db->set($data); 
      return  $this->db->insert('users_email_verifier',$data);     
    
	}

    public function createVerficationCode_Android($useriD,$Toemail,$code){	
        $data = [
			'userID' => $useriD,
            'email' => $Toemail,
            'code' => $code,
            'status' => 'pending'
        ];
        //$this->db->set($data); 
      return  $this->db->insert('users_email_verifier',$data);     
    
	}

    public function createVerficationCode_none_session($Toemail,$code){	
        $userID = $this->getUserID_from_email($Toemail);
        $data = [
			'userID' => $userID,
            'email' => $Toemail,
            'code' => $code,
            'status' => 'pending'
        ];
        //$this->db->set($data); 
      return  $this->db->insert('users_email_verifier',$data);     
    
	}

    public function codeVerify_Android($userid,$email,$code){
        $query = $this->db->query("SELECT * FROM users_email_verifier where  email='".$email."' and code=".$code." and  userID='".$userid."'");
        if($query->num_rows())
        {
           return true;
        }
        else
        {
           return false;
        }
    }
    public function codeVerify($email,$code){
        $query = $this->db->query("SELECT * FROM users_email_verifier where  email='".$email."' and code=".$code." and  userID='".$_SESSION['userID']."'");
        if($query->num_rows())
        {
           return true;
        }
        else
        {
           return false;
        }
    }

    public function codeVerify_none_session($email,$code){
        $userID = $this->getUserID_from_email($email);

        $query = $this->db->query("SELECT * FROM users_email_verifier where  email='".$email."' and code=".$code." and  userID=".$userID."");
        if($query->num_rows())
        {
           return true;
        }
        else
        {
           return false;
        }
    }

    public function codeVerifiedEmailChanged_Android($userid,$email,$code){

        //TaskID = 15 | Validate your Email Address
        $this->AchievementModel->task_controller_Android($userid,15,'Email Badge');

        $datax = [
			'userID' => $userid,
            'email' => $email,
            'code' => $code,
            'status' => 'verified'
        ];
        //$this->db->set($data); 
        $this->db->update('users_email_verifier',$datax,array('userID'=>$userid,'email' => $email, 'code' => $code));     

        $data = [
            'userID'=>$userid,
            'email' => $email,
            'email_status' => 'Verified'
        ];

       return $this->db->update('users',$data,array('userID'=>$userid));   
    }

    public function codeVerifiedEmailChanged($email,$code){

        //TaskID = 15 | Validate your Email Address
        $this->AchievementModel->task_controller(15,'Email Badge');

        $datax = [
			'userID' => $_SESSION['userID'],
            'email' => $email,
            'code' => $code,
            'status' => 'verified'
        ];
        //$this->db->set($data); 
        $this->db->update('users_email_verifier',$datax,array('userID'=>$_SESSION['userID'],'email' => $email, 'code' => $code));     

        $data = [
            'userID'=>$_SESSION['userID'],
            'email' => $email,
            'email_status' => 'Verified'
        ];

       return $this->db->update('users',$data,array('userID'=>$_SESSION['userID']));   
    }

    public function codeVerifiedEmailChanged_none_session($email,$code){

        $userID = $this->getUserID_from_email($email);

        $datax = [
			'userID' => $userID ,
            'email' => $email,
            'code' => $code,
            'status' => 'verified'
        ];
        //$this->db->set($data); 
        return $this->db->update('users_email_verifier',$datax,array('userID'=>$userID ,'email' => $email, 'code' => $code));     
       
    }

    public function changepassword_none_session($password,$email){
        $userID = $this->getUserID_from_email($email);
        $options = [
            'cost' => 11
          ];
        $data = [
            'password' => password_hash($password, PASSWORD_BCRYPT, $options),
        ];
       return $this->db->update('users',$data,array('userID'=>$userID));   
    }

    public function verify_email_exist($email){
        $query = $this->db->query("SELECT * FROM users where  email='".$email."'");
        if($query->num_rows())
        {
           return true;
        }
        else
        {
           return false;
        }
    }

}