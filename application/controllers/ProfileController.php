<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileController extends MY_Controller {

   
	public function index(){
        if(isset($_SESSION['username']) && isset($_SESSION['accessLevelID']) )  
            {
            if($this->MenuModel->checkMenu_If_Allowed($_SESSION['accessLevelID'],_PROFILE))                        
                $this->render(_PROFILE,"pages/admin/profile");
            else
                $this->no_access_page(_PROFILE);
            }
        else           
            redirect(_LOGIN);
    }


    public function android_getProfile($userID){
        $rows = $this->ProfileModel->get_android_profile($userID);
        if($rows==null){
            echo json_encode($data=array(
                'response'=>'error',
                'message'=>'No data found.',
                'data'=>''
                ));
        }else{
         
            $json =  json_encode($data=array(
                'response'=>'success',
                'data'=>array(
                    $rows,
                )
                ));

            $json = str_replace("[","",$json);
            $json = str_replace("]","",$json);
            
            echo $json;

        }
    }

    public function android_search_network_leader(){
        if(isset($_POST['name'])){

            echo json_encode($this->ProfileModel->get_all_network_leaders_list($this->input->post('churchID'),$this->input->post('name')));

        }else{
            echo json_encode($this->ProfileModel->get_all_network_leaders_list(50,""));
        }
    }

    public function android_search_who_invite(){
        if(isset($_POST['name'])){

            echo json_encode($this->ProfileModel->get_all_who_invite_list($this->input->post('name')));

        }else{
            echo json_encode($this->ProfileModel->get_all_who_invite_list(""));
        }
    }


    public function android_get_list_family(){
        if(isset($_POST['userID'])){

         $data = $this->ProfileModel->android_get_family_list($this->input->post('userID'));

         echo json_encode($data);
        
        }else{
         echo "You are not allowed to visit here.";
        }     
    }

    

    public function android_sync_profile(){
        if(isset($_POST['userID'])){
               

            $data = array(
                'userID' => $this->input->post('userID'),
                'about' => $this->input->post('about'),
                'first_name' => $this->input->post('first_name'),
                'middle_name' => $this->input->post('middle_name'),
                'last_name' => $this->input->post('last_name'),
                'name_ext' => $this->input->post('name_ext'),
                'nickname' => $this->input->post('nickname'),
                'date_of_birth' => $this->dateparser->androidDate_to_serverDate($this->input->post('date_of_birth')),
                'place_of_birth' => $this->input->post('place_of_birth'),
                'sex' => $this->input->post('sex'),
                'civil_status' => $this->input->post('civil_status'),
                'occupation' => $this->input->post('occupation'),
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
                'educ_elem_year_graduated' => $this->dateparser->androidDate_to_serverDate($this->input->post('educ_elem_year_graduated')),
                'educ_high_school' => $this->input->post('educ_high_school'),
                'educ_high_school_graduated' => $this->dateparser->androidDate_to_serverDate($this->input->post('educ_high_school_graduated')),
                'educ_college' => $this->input->post('educ_college'),
                'educ_college_graduate' => $this->dateparser->androidDate_to_serverDate($this->input->post('educ_college_graduate')),
                'educ_attainment' => $this->input->post('educ_attainment'),
                'educ_course' => $this->input->post('educ_course'),
                'soc_facebook_url' => $this->input->post('soc_facebook_url'),
                'soc_youtube_url' => $this->input->post('soc_youtube_url'),
                'soc_instagram_url' => $this->input->post('soc_instagram_url'),
                'soc_linkin_url' => $this->input->post('soc_linkin_url'),
                'soc_tiktok_url' => $this->input->post('soc_tiktok_url'),
                'soc_twitter_url' => $this->input->post('soc_twitter_url'),
                'occ_name_of_employer' => $this->input->post('occ_name_of_employer'),
                'occ_occupation' => $this->input->post('occ_occupation'),
                'occ_address' => $this->input->post('occ_address'),
                'privacy_settings' => $this->input->post('privacy_settings'),
                'dtUpdated' => $this->input->post('dtUpdated'),
                'updatedBY' => $this->input->post('updatedBY'),
            );

            $this->ProfileModel->android_update_profile($data,$this->input->post('userID'));


            if($this->input->post('bitmap_photo')!=""){

                    $file="assets/images/default-photo_square.png";

                    $raw = $this->input->post('bitmap_photo');

                    $folderPath =  'assets/upload/profile/';
                    $image_base64 = base64_decode($raw);
                    $file = $folderPath . $this->input->post('cuserID') . '.png';

                    file_put_contents($file, $image_base64);

                    $this->ProfileModel->android_update_users_profile_photo($file,$this->input->post('userID'));

             }


            echo json_encode($data);

        }else{
            echo "You are not allowed to visit here";
        }
    }
    
    public function android_sync_profile_family_delete(){
        if(isset($_POST['userID'])){

            $data = $this->ProfileModel->android_get_family_list_to_delete($this->input->post('userID'));
            foreach($data as $row){
                    if($row['profile_photo_path']!="assets/images/default-photo_square.png"){
                        //unlink($row['profile_photo_path']);
                    }
            }

            $this->ProfileModel->android_delete_family_list($this->input->post('userID'));

        }else{
            echo "You are not allowed to visite here.";
        }
    }

    public function android_sync_profile_family(){
        if(isset($_POST['userID'])){

            $file="assets/images/default-photo_square.png";

            if($this->input->post('raw_photo_bitmap')!=""){
                    $raw = $this->input->post('raw_photo_bitmap');

                    $folderPath =  'assets/upload/profile/family/';
                    $image_base64 = base64_decode($raw);
                    $file = $folderPath . $this->input->post('userID').$this->input->post('familyBackgroundID') . '.png';

                    file_put_contents($file, $image_base64);
             }else if($this->input->post('profile_photo_path')!="assets/images/default-photo_square.png"){
                $file = $this->input->post('profile_photo_path');
                $file = str_replace(base_url(),"",$file);
             }

            $family = array(
                'familyBackgroundID' => $this->input->post('familyBackgroundID'),
                'profileID'=> $this->input->post('userID'),
                'profile_photo_path' => $file,
                'relationship' => $this->input->post('relationship'),
                'rel_name' => $this->input->post('rel_name'),
                'rel_age' => $this->input->post('rel_age'),
                'rel_birthdate' => $this->input->post('rel_birthdate'),
                'rel_occupation' => $this->input->post('rel_occupation'),
                'rel_contact_no' => $this->input->post('rel_contact_no'),
                'rel_condition' => $this->input->post('rel_condition'),
                'relationship' => $this->input->post('relationship'),
                );

                $this->ProfileModel->android_insert_family($family);
                
                echo json_encode($family);
            
            
            
        }else{
            echo "You are not allowed to visit here";
        }
    }


    public function android_update_setup_mode(){

        $raw = array(
            'userID'=>$this->input->post('userID'),
            'churchID'=>$this->input->post('churchID'),
            'userID_leader'=>$this->input->post('userID_leader'),
            'userID_invite'=>$this->input->post('userID_invite'),
        );

        $this->ProfileModel->set_android_setup_mode_update($raw);

        echo json_encode($raw);
    }

    public function android_change_email(){
        if(isset($_POST['action'])){
                
            $this->form_validation->set_rules('email',"email address","required|valid_email|is_unique[users.email]");
    
            if($this->form_validation->run() == FALSE)
                {
                echo 'error-'.validation_errors();
                }
            else
                {
                    $this->ProfileModel->android_change_email($this->input->post('userID'),$this->input->post('email'));
                    echo 'success-You have successfully changed an Email Address.';
                }
            }
        else{
           echo "You are not allowed to visit here.";
        }
        }

    public function ctrl_populate_families(){
        if($this->input->is_ajax_request()){
            if($posts = $this->ProfileModel->populate_families()){
                $data = array(_RESPONSE=>_RESPONSE_SUCCESS, _POST=> $posts);
            }else{
                $data = array(_RESPONSE=>_RESPONSE_ERROR, _MESSAGE=> _FAILED_FETCH);   
            }
            echo json_encode($data);  
        }else{
            $this->no_page_found();
        }
    }

    public function request_delete_account_profile(){
        $this->load->view('templates/header');
        $this->load->view('pages/auth/request-delete-account');
        $this->load->view('templates/full-footer');
    }

    public function delete_account_profile(){

        if(isset($_POST['userID'])){
            $this->AuthModel->setTimeLog($_SESSION['userID'],"Successfully logout an account of ".$_SESSION['username'] );
            $this->session->unset_userdata('userID');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('password');
            $this->session->unset_userdata('photopath');
            $this->session->unset_userdata('accessLevelID');
    
            $this->ProfileModel->delete_account_profile($this->input->post('userID'));

            $data = array('response'=>'success', 'message'=> 'You have successfully deleted an account');   
            echo json_encode($data);  

        }else{
            echo "You are not allowed to enter this site.";
        }
    }

    public function form_delete_account_profile(){
        if(isset($_SESSION['username']) ) {  redirect('dashboard');}
		else
		{

			        //$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback d-block">','</div>');
		$this->form_validation->set_rules('email',"email","required|valid_email");
		$this->form_validation->set_rules('password',"password","required");

			if($this->form_validation->run()==FALSE){
				$this->load->view('templates/header');
				$this->load->view('pages/auth/request-delete-account');
				$this->load->view('templates/full-footer');
				//$data['user'] = $this->AuthModel->getUserLogIn($email,$password);
			}else{

			$response = $this->AuthModel->checkLogIn_Email($this->input->post('email'),$this->input->post('password'));	
			
			if($response['response']=="success")
				{
                    $row = $this->AuthModel->getLoginInfo_Email($this->input->post('email'));
                    $this->ProfileModel->delete_account_profile($row['userID']);
					redirect('login');
				}
			else
			
				{	
						$data = array(
							'login_validate' => '<div class="alert alert-danger">* '.$response['response'].'</div>'
						);

						$this->load->view('templates/header');
						$this->load->view('pages/auth/request-delete-account',$data);
						$this->load->view('templates/full-footer');
				}	

			}


		}	
    }

    public function select_family_list(){
        if($this->input->is_ajax_request()){
            if($posts = $this->ProfileModel->fetchSelectedFamilies($this->input->post('seluserID'))){
                $data = array('response'=>'success', 'posts'=> $posts);
            }else{
                $data = array('response'=>'error', 'posts'=> $posts);   
            }
            echo json_encode($data);  
        }else{
            $this->no_page_found();
        }
    }

    public function family_delete(){
        if($this->input->is_ajax_request()){
            $del_id = $this->input->post('del_id');     
            if($this->ProfileModel->delete_family($del_id)){
                $data = array('response'=>'success', 'message'=> 'Successfully updated.');    
            }else{
                $data = array('response'=>'error', 'message'=> 'Unable to delete record.');   
            }
        echo json_encode($data);  
    }else{
        $this->load->view('templates/header');
        $this->load->view('errors/restricted');
        $this->load->view('templates/footer');
    } 
    }

    public function family_add(){
        if($this->input->is_ajax_request()){
            
            $this->form_validation->set_rules('rel_name',"Name",'required');
            $this->form_validation->set_rules('relationship',"Relationship",'required');

            if($this->form_validation->run() == FALSE)
                {
                $data = array('response' => 'error', 
                            'message' => validation_errors(),
                            'rel_name' => form_error('rel_name'),
                            'relationship' => form_error('relationship'));
                echo json_encode($data);  
                }
            else
                {
                $ajax_data = $this->input->post();
                if($this->ProfileModel->insert_family()){
                    $data = array('response'=>'success', 'message'=> 'Record added successfully.');
                    echo json_encode($data);  
                }
                else{
                    $data = array('response'=>'error', 'message'=> 'Failed to add record.');     
                    echo json_encode($data);  
                }
            }
            
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }

    }

    public function family_edit(){
        if($this->input->is_ajax_request())
        {
            $edit_id = $this->input->post('edit_id');  
            if($posts = $this->ProfileModel->edit_family_entry($edit_id))
                {
                $data = array('response'=>'success', 'post'=> $posts);
                }
            else{
                $data = array('response'=>'error', 'message'=> 'failed to fetch record.');   
                }
            echo json_encode($data);          
        }
    else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');   
        }
    }

    public function family_update(){
        if($this->input->is_ajax_request()){
            
            $this->form_validation->set_rules('rel_name',"Name",'required');
            $this->form_validation->set_rules('relationship',"Relationship",'required');

            if($this->form_validation->run() == FALSE)
                {
                $data = array('response' => 'error', 
                            'message' => validation_errors(),
                            'rel_name' => form_error('rel_name'),
                            'relationship' => form_error('relationship'));
                echo json_encode($data);  
                }
            else
                {
                $ajax_data = $this->input->post();
                if($this->ProfileModel->update_family()){
                    $data = array('response'=>'success', 'message'=> 'Record added successfully.');
                    echo json_encode($data);  
                }
                else{
                    $data = array('response'=>'error', 'message'=> 'Failed to add record.');     
                    echo json_encode($data);  
                }
            }
            
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }
    }

    public function selected_family_add(){
        if($this->input->is_ajax_request()){
            
            $this->form_validation->set_rules('rel_name',"Name",'required');
            $this->form_validation->set_rules('relationship',"Relationship",'required');

            if($this->form_validation->run() == FALSE)
                {
                $data = array('response' => 'error', 
                            'message' => validation_errors(),
                            'rel_name' => form_error('rel_name'),
                            'relationship' => form_error('relationship'));
                echo json_encode($data);  
                }
            else
                {
                $ajax_data = $this->input->post();
                if($this->ProfileModel->insert_selected_family($this->input->post('sel_userID'))){
                    $data = array('response'=>'success', 'message'=> 'Record added successfully.');
                    echo json_encode($data);  
                }
                else{
                    $data = array('response'=>'error', 'message'=> 'Failed to add record.');     
                    echo json_encode($data);  
                }
            }
            
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }

    }

	public function update_profile(){
 
				if($this->input->post('action')!=null) {

				
                    $this->ProfileModel->updateProfile();

                    echo "You have successfully updated your profile.";

				}else{
					$this->load->view('templates/header');
					$this->load->view('errors/restricted');
					$this->load->view('templates/footer');					
				}
	}

    public function upload_profile_photo(){

     if($this->input->post('image')){
        $folderPath =  'assets/upload/profile/';
        $image_parts = explode(";base64,", $this->input->post('image'));
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.png';

        file_put_contents($file, $image_base64);
        
        $response = array(
                        'status' => true,
                        'msg' => 'Image uploaded on server successfully!',
                        'file' => $file
                    );

                    $this->AuthModel->updateProfilePhoto($file);
                        
                    if (file_exists($_SESSION["profilephoto"]))
                        {
                            if($_SESSION["profilephoto"]!="assets/images/default-photo_square.png"){
                            unlink($_SESSION["profilephoto"]);
                            }
                        }
                    

                    $_SESSION["profilephoto"] = $file;
                    echo base_url().$file;


     }else{
        $this->load->view('templates/header');
        $this->load->view('errors/restricted');
        $this->load->view('templates/footer');					
    }   

    
    }
    
	public function remove_profile_photo(){
 
        if($this->input->post('action')!=null) {

            $this->AuthModel->updateProfilePhoto('assets/images/default-photo_square.png');
            if (file_exists($_SESSION["profilephoto"]))
                            {
                                if($_SESSION["profilephoto"]!="assets/images/default-photo_square.png"){
                                    unlink($_SESSION["profilephoto"]);
                                }
                            }
            $_SESSION["profilephoto"] = 'assets/images/default-photo_square.png';       
            
            echo base_url()."assets/images/default-photo_square.png";

        }else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');					
        }
    }

    public function change_email(){
    if($this->input->is_ajax_request()){
            
        $this->form_validation->set_rules('email',"email address","required|valid_email|is_unique[users.email]");

        if($this->form_validation->run() == FALSE)
            {
            $data = array('response' => 'error', 
                        'message' => validation_errors(),
                        'email' => form_error('email'));
            echo json_encode($data);  
            }
        else
            {
                $data = array('response'=>'success', 'message'=> 'Email is valid');
                echo json_encode($data);  
            }
        }
    else{
        $this->load->view('templates/header');
        $this->load->view('errors/restricted');
        $this->load->view('templates/footer');	
    }
    }
    
    public function send_code_email_android(){
            if($this->input->post('action')){
                    
                $codes = substr(str_shuffle("0123456789"), 0, 5);
        
                $configs = array(
                    'useragent' => 'G12 LPZ Admin',
                    'protocol' => 'mail',
                    'mailpath' => '/usr/sbin/sendmail',
                    'smtp_host' => 'localhost',
                    'smtp_user' => 'admin@lpzoutreach.com',
                    'smtp_pass' => 'vln7H2Odstrk',
                    'smtp_port' => 143,
                    'smtp_timeout' => 55,
                    'wordwrap' => TRUE,
                    'wrapchars' => 76,
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'validate' => FALSE,
                    'priority' => 3,
                    'crlf' => "\r\n",
                    'newline' => "\r\n",
                    'bcc_batch_mode' => FALSE,
                    'bcc_batch_size' => 200,
                );
        
                $this->AuthModel->createVerficationCode_Android($this->input->post('userID'),$this->input->post('email'),$codes);
        
                $this->load->library('email',$configs);
                $this->email->from('admin@lpzoutreach.com', 'Verificaion Code');
                $this->email->to($this->input->post('email'));
                $this->email->subject('G12LPZ - Verification Code');
                $this->email->message('This is your verification code: '.$codes.'');
        
                if($this->email->send()){
                    echo 'The code has been sent to your email. Please kindly copy the codes and paste here. This code will automatically expire within 5 minutes.';
                }else{
                    echo 'There is an error with the mail server. Please contact the administrator.';
                }
                              
            }
            else{
                echo "You are restricted to visit this page.";
            }
    
        }

    public function send_code_email(){
    if($this->input->is_ajax_request()){
            
        $codes = substr(str_shuffle("0123456789"), 0, 5);

        $configs = array(
            'useragent' => 'G12 LPZ Admin',
            'protocol' => 'mail',
            'mailpath' => '/usr/sbin/sendmail',
            'smtp_host' => 'localhost',
            'smtp_user' => 'admin@lpzoutreach.com',
            'smtp_pass' => 'vln7H2Odstrk',
            'smtp_port' => 143,
            'smtp_timeout' => 55,
            'wordwrap' => TRUE,
            'wrapchars' => 76,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'validate' => FALSE,
            'priority' => 3,
            'crlf' => "\r\n",
            'newline' => "\r\n",
            'bcc_batch_mode' => FALSE,
            'bcc_batch_size' => 200,
        );

        $this->AuthModel->createVerficationCode($this->input->post('email'),$codes);

        $this->load->library('email',$configs);
        $this->email->from('admin@lpzoutreach.com', 'Verificaion Code');
        $this->email->to($this->input->post('email'));
        $this->email->subject('Activation Code');
        $this->email->message('This is your verification code: '.$codes.'');

        if($this->email->send()){
            $data = array('response'=>'success', 'message'=> 'The code has been sent to your email. Please kindly copy the codes and paste here. This code will automatically expire within 5 minutes.');
        }else{
            $data = array('response'=>'success', 'message'=> 'There is an error with the mail server. Please contact the administrator.');
        }
     
        echo json_encode($data);  

    }
    else{
        $this->load->view('templates/header');
        $this->load->view('errors/restricted');
        $this->load->view('templates/footer');	
    }

    }

    public function send_code_email_none_session_data(){
    if($this->input->is_ajax_request()){


        $this->form_validation->set_rules('email',"email address","required|valid_email");

        if($this->form_validation->run() == FALSE)
            {
            $data = array('response' => 'error', 
                        'message' => validation_errors(),
                        'email' => form_error('email'));
            echo json_encode($data);  
            }
        else{
                   

            if($this->AuthModel->verify_email_exist($this->input->post('email'))){

                $codes = substr(str_shuffle("0123456789"), 0, 5);

                $configs = array(
                    'useragent' => 'G12 Project Admin',
                    'protocol' => 'mail',
                    'mailpath' => '/usr/sbin/sendmail',
                    'smtp_host' => 'localhost',
                    'smtp_user' => 'admin@lpzoutreach.com',
                    'smtp_pass' => 'vln7H2Odstrk',
                    'smtp_port' => 143,
                    'smtp_timeout' => 55,
                    'wordwrap' => TRUE,
                    'wrapchars' => 76,
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'validate' => FALSE,
                    'priority' => 3,
                    'crlf' => "\r\n",
                    'newline' => "\r\n",
                    'bcc_batch_mode' => FALSE,
                    'bcc_batch_size' => 200,
                );

                $this->AuthModel->createVerficationCode_none_session($this->input->post('email'),$codes);

                $this->load->library('email',$configs);
                $this->email->from('admin@lpzoutreach.com', 'Verificaion Code');
                $this->email->to($this->input->post('email'));
                $this->email->subject('Activation Code');
                $this->email->message('This is your verification code: '.$codes.'');

                if($this->email->send()){
                    $data = array('response'=>'success', 'message'=> 'The code has been sent to your email. Please kindly copy the codes and paste here. This code will automatically expire within 5 minutes.');
                }else{
                    $data = array('response'=>'success', 'message'=> 'There is an error with the mail server. Please contact the administrator.');
                }
            
                echo json_encode($data);  

            }else{

                $data = array('response' => 'error', 
                'message' => validation_errors(),
                'email' => 'Your email does not exist from our system.');
                echo json_encode($data);  
            }

            }  

    }
    else{
        $this->load->view('templates/header');
        $this->load->view('errors/restricted');
        $this->load->view('templates/footer');	
    }

    }

    public function verify_code_android(){
        if(isset($_POST['code'])){
                
            $this->form_validation->set_rules('code',"Code","required");
    
            if($this->form_validation->run() == FALSE)
                {
                echo "error-Code is a required field."; 
                }
            else
                {
                    if($this->AuthModel->codeVerify_Android($this->input->post('userID'),$this->input->post('email'),$this->input->post('code')))
                    {
                           $this->AuthModel->codeVerifiedEmailChanged_Android($this->input->post('userID'),$this->input->post('email'),$this->input->post('code'));                            
                           echo 'success-Your Email Address is successfully verified.';   
                    }
                    else
                    {
                       echo 'error-Code does not match, kindly check the exact code.';
                    } 
                }
        }
        else{
          echo  'error-restricted page.';
        
            }
        }
    public function verify_code(){
    if($this->input->is_ajax_request()){
            
        $this->form_validation->set_rules('code',"Code","required");

        if($this->form_validation->run() == FALSE)
            {
            $data = array('response' => 'error', 
                        'message' => validation_errors(),
                        'code' => form_error('code'));
            echo json_encode($data);  
            }
        else
            {

                if($this->AuthModel->codeVerify($this->input->post('email'),$this->input->post('code')))
                {
                       $this->AuthModel->codeVerifiedEmailChanged($this->input->post('email'),$this->input->post('code'));
                       $data = array('response' => 'success', 
                       'message' => 'Code has been verified and your new email has been changed.',
                       'code' => '',
                       'email_status' => 'Verified');            
                }
                else
                {
                    $data = array('response' => 'error', 
                    'message' => validation_errors(),
                    'code' => 'Code does not match, kindly check the exact code.');
                }

                echo json_encode($data);      
            }

    }
    else{
        $this->load->view('templates/header');
        $this->load->view('errors/restricted');
        $this->load->view('templates/footer');	
    }
    }

    public function verify_code_none_session_data(){
    if($this->input->is_ajax_request()){
            
        $this->form_validation->set_rules('code',"Code","required");

        if($this->form_validation->run() == FALSE)
            {
            $data = array('response' => 'error', 
                        'message' => validation_errors(),
                        'code' => form_error('code'));
            echo json_encode($data);  
            }
        else
            {

                if($this->AuthModel->verify_email_exist($this->input->post('email'))){
                    if($this->AuthModel->codeVerify_none_session($this->input->post('email'),$this->input->post('code')))
                    {
                           $this->AuthModel->codeVerifiedEmailChanged_none_session($this->input->post('email'),$this->input->post('code'));
                           $data = array('response' => 'success', 
                           'message' => 'Code has been verified and your new email has been changed.',
                           'code' => '',
                           'email_status' => 'Verified');            
                    }
                    else
                    {
                        $data = array('response' => 'error', 
                        'message' => validation_errors(),
                        'code' => 'Code does not match, kindly check the exact code.');
                    }

                }else{
                    $data = array('response' => 'error', 
                    'message' => validation_errors(),
                    'code' => 'Your email address does not exist from the system.');

                }

                echo json_encode($data);      
            }

    }
    else{
        $this->load->view('templates/header');
        $this->load->view('errors/restricted');
        $this->load->view('templates/footer');	
    }
    }

    public function new_password(){
    if($this->input->is_ajax_request()){
            
        $this->form_validation->set_rules('newpassword',"New Password","required");
        $this->form_validation->set_rules('confirmpassword',"Confirm Password","required");

        if($this->form_validation->run() == FALSE)
            {
            $data = array('response' => 'error', 
                        'message' => validation_errors(),
                        'newpassword' => form_error('newpassword'),
                        'confirmpassword' => form_error('confirmpassword'));
            echo json_encode($data);  
            }
        else
            {

               if($this->input->post('newpassword') == $this->input->post('confirmpassword')){

                $this->AuthModel->changepassword_none_session($this->input->post('newpassword'), $this->input->post('email'));

                $data = array('response' => 'success', 
                'message' => "New Password has been changed",
                'newpassword' => "",
                'confirmpassword' => "");

               }else{
                $data = array('response' => 'error', 
                'message' => validation_errors(),
                'newpassword' => 'Password does not match, please try again.',
                'confirmpassword' => form_error('confirmpassword'));
               }
                
                echo json_encode($data);      
            }

    }
    else{
        $this->load->view('templates/header');
        $this->load->view('errors/restricted');
        $this->load->view('templates/footer');	
    }
    }

    public function sendEmail($data){
    }


//////////////////////////////////////////////////////////////
    public function family_background_form(){
            if($this->input->is_ajax_request()){

                $posts = $this->ProfileFormModel->create_family_background();
                    //$posts = $this->profile->familytab();

                    $data = array('response'=>'success', 
                    'message'=>'You have successfully loaded the data.', 
                    'posts'=> $posts);
                
    
                echo json_encode($data);  
    
            }else{
                $this->load->view('templates/header');
                $this->load->view('errors/restricted');
                $this->load->view('templates/footer');
            }
        
    }

}