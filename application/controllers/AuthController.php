<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

	public function index()
	{
		$this->load->view('index');
	}

	public function android_login(){

			if(isset($_POST['email'])){

				$response = $this->AuthModel->getCheckUserID_Email($this->input->post('email'));	
			
			if($response>0)
				{
					$row = $this->AuthModel->getLoginInfo_Email($this->input->post('email'));
					$response = $this->AuthModel->checkLogIn_Email($this->input->post('email'),$this->input->post('password'));	
				
					if($response['response']=="success")
					{
						
						$data = array(
							'data' => array(
								'userID' => $row['userID'],
								'username'  => $row['username'],
								'email'     => $row['email'],
								'accessLevelName'=> $row['accessLevelName'],
								'accessLevelID' => $row['accessLevelID'],
								'profilephoto' => base_url($row['profile_photo_path']),
								'logged_in' => TRUE,
								'action' => ''
							)
							);

							//$this->session->set_userdata($data);

						echo "success~You have successfully log in an account.~"
						.$row['email_status']."~" //2
						.$row['setupMode']."~"	  //3	
						.$row['userID']."~"	      //4
						.$row['email']."~"     //5
						.$row['accessLevelName']."~"  		//6
						.$row['accessLevelID']."~"			//7
						.$row['profile_photo_path']."~"	//8
						.$row['username'];

					}
					else{

						$data = array(
						'data' => array('response'=>'error', 
						'message'=>'Email Address and Password does not match, please try again.', 
						'action'=>'all'
						));

						echo "error~Email Address and Password does not match, please try again.";

					}

					echo "error~error";

				}
			else
			
				{
						
					$data = array('data'=>array('response'=>'error', 
                    'message'=>'Email Address does not exist, please try again.', 
                    'action'=> 'email'));

					echo "error~Email Address does not exist, please try again.";

				}	


			}else{

				$data = array('data'=>array('response'=>'error', 
                    'message'=>'You are not allowed to visit here', 
                    ));

				
					//$data =  $this->AuthModel->checkLogIn_Email('sylvster129@gmail.com','123456');

					//echo $data['response'];

			}


			

	}
	
	public function android_create_account(){
		if(isset($_POST['email'])){
			
			$user = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
			);

			$profile = array(
				'first_name' => $this->input->post('first_name'),
				'middle_name' => $this->input->post('middle_name'),
				'last_name' => $this->input->post('last_name'),
			);

			$email =  $this->AuthModel->checkIfEmailExisted($this->input->post('email'));
			if($email)
				{
					echo "error-Email Address is already existed, please try another.";
				}
			else {

				$this->AuthModel->android_create_account();

				echo "success-You have successfully created an account.";	
			}	

			
		}else{
			$data = array(
				'response' => 'error',
				'message' =>'You are restricted to visit here.'
			);
			echo json_encode($data);
		}
	}

	public function android_google_signin(){
	    
	    if(isset($_POST['google_email'])){
	    
			//CHECK IF EMAIL IS EXISTED IN users table//
			$google_id = $this->input->post('google_id');
			$email = $this->input->post('google_email');
			$google_name = $this->input->post('google_name');
			$google_family_name =  $this->input->post('google_family_name');
			$google_given_name = $this->input->post('google_given_name');
		    $google_photo_url = $this->input->post('google_photo_url');
		    
			//$google_id = '';
			//$email = 'sylvster129@gmail.com';
			//$google_name = '';
			//$google_family_name =  'family name';
			//$google_given_name = 'given name';
		    //$google_photo_url = 'photo url';		    

			if($this->AuthModel->checkIfEmailExisted($email))
			    {
			    $data = $this->AuthModel->android_get_user_info_by_email($email);
			    //echo json_encode($data);
			    
			    echo $data['email_status']."~".$data['setupMode']."~".$data['userID']."~".$data['email']."~".$data['accessLevelName']."~".$data['accessLevelID']."~".$data['profile_photo_path'];
			    
		    }else{
		    $google = array(
		        'google_id' => $google_id,
		        'google_name' => $google_name,
		        'google_email' => $email,
		        'google_family_name' => $google_family_name,
		        'google_given_name' => $google_given_name,
		        'google_photo_url' => $google_photo_url
		        );
		    
		    $this->AuthModel->android_google_create_account($google);
		    
		    $data = $this->AuthModel->android_get_user_info_by_email($email);
		    
		    echo $data['email_status']."~".$data['setupMode']."~".$data['userID']."~".$data['email']."~".$data['accessLevelName']."~".$data['accessLevelID']."~".$data['profile_photo_path']."~"."~"."~"."~";
			
			//echo "i am safe";
		    
		}
	    }else{
	        echo "You are not allowed to visit her.";
	    }
	}

	public function android_check_email(){
		if(isset($_POST['email']))
		{
			$email  = $this->AuthModel->checkIfEmailExisted($this->input->post('email'));
			$row = $this->AuthModel->getLoginInfo_Email($this->input->post('email'));
				if($email){
					echo "success~".$row['userID'];
				}else{
					echo "error~Email Address does not exist. Make sure it must be correct and valid.";
				}
		}else{
			echo "not authorize";
		}
	}

	public function android_facebook_signin(){
	
		
		if($this->AuthModel->checkIfEmailExisted('sylvster129')){
		    echo "yes";
		}else{
		    echo "no";
		}
		
		
		
	}

	public function forgot_password(){
		if(isset($_SESSION['username']) ) {  redirect('dashboard');}
		else
		{

		$page = "auth/register";
		if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
			show_404();
		}

		$this->load->view('templates/header');
		$this->load->view('pages/auth/forgot-password');
		$this->load->view('templates/full-footer');

		}
	}

	public function register(){

		if(isset($_SESSION['username']) ) {  redirect('dashboard');}
		else
		{

		$page = "auth/register";
		if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
			show_404();
		}

        //$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback d-block">','</div>');
		$this->form_validation->set_rules('first_name',"first_name","required");
		$this->form_validation->set_rules('middle_name',"middle_name","required");
		$this->form_validation->set_rules('last_name',"last_name","required");
		$this->form_validation->set_rules('email',"email address","required|valid_email");
		$this->form_validation->set_rules('password',"password","required|min_length[6]|max_length[20]");
		$this->form_validation->set_rules('confirmPassword',"confirm password","required|matches[password]");

		if($this->form_validation->run()==FALSE){

			$this->load->view('templates/header');
			$this->load->view('pages/auth/register');
			$this->load->view('templates/full-footer');
		}
		else{
		
		$data=null;

			$email =  $this->AuthModel->checkIfEmailExisted($this->input->post('email'));

			if($email)
				{
				$data = array(
					'email_validate' => '<div class="invalid-feedback d-block">* The email address is already taken. Please try another.</div>'
				);

				$this->load->view('templates/header');
				$this->load->view('pages/auth/register',$data);
				$this->load->view('templates/full-footer');
				}
			else
				{
				$data = array(
					'success' => '<div class="alert alert-success">* You have successfully created an account.</div>'
				);
				$this->AuthModel->createAccount();

				$this->load->view('templates/header');
				$this->load->view('pages/auth/login',$data);
				$this->load->view('templates/full-footer');
				//redirect('login');
			}

		}

		}
	}

	public function login(){

		if(isset($_SESSION['username']) ) {  redirect('dashboard');}
		else
		{

			        //$this->form_validation->set_error_delimiters('<div class="alert alert-danger">','</div>');
		$this->form_validation->set_error_delimiters('<div class="invalid-feedback d-block">','</div>');
		$this->form_validation->set_rules('email',"email","required|valid_email");
		$this->form_validation->set_rules('password',"password","required");

			if($this->form_validation->run()==FALSE){
				$this->load->view('templates/header');
				$this->load->view('pages/auth/login');
				$this->load->view('templates/full-footer');
				//$data['user'] = $this->AuthModel->getUserLogIn($email,$password);
			}else{

			$response = $this->AuthModel->checkLogIn_Email($this->input->post('email'),$this->input->post('password'));	
			
			if($response['response']=="success")
				{
	
					$row = $this->AuthModel->getLoginInfo_Email($this->input->post('email'));
					$newdata = array(
						'userID' => $row['userID'],
						'username'  => $row['email'],
						'email'     => $row['email'],
						'accessLevelName'=> $row['accessLevelName'],
						'accessLevelID' => $row['accessLevelID'],
						'profilephoto' => $row['profile_photo_path'],
						'logged_in' => TRUE
					);

				
					$this->session->set_userdata($newdata);


					$this->AuthModel->setTimeLog($_SESSION['userID'],"Successfully login an account of ".$_SESSION['email'] );
					redirect('dashboard');

				}
			else
			
				{
						
						$data = array(
							'login_validate' => '<div class="alert alert-danger">* '.$response['response'].'</div>'
						);

						$this->load->view('templates/header');
						$this->load->view('pages/auth/login',$data);
						$this->load->view('templates/full-footer');
				}	

			}


		}	

	}

	public function android_privacy_settings(){
		if(isset($_POST['privacy'])){
				$this->AuthModel->android_change_privacy($this->input->post('userID'),$this->input->post('privacy'));
				echo "success~You have successfully changed your privacy settings.";
		}
		else{
			echo "You are not allowed to visit here.";
		}
	}
	
	public function android_changePassword(){
		if(isset($_POST['password'])){
            

				if($this->AuthModel->android_checkPassword($this->input->post('email'),$this->input->post('password'))){

					if($this->input->post('newpassword') == $this->input->post('password')){

						echo "error~Current password and new password must not be the same.";

					}
					else if($this->input->post('newpassword') == $this->input->post('confirmpassword')){
						
						if($this->AuthModel->android_changePassword($this->input->post('userID'),$this->input->post('newpassword'))){
							echo "success~Password changed successfully!";
						}else{

							echo "error~Cannot change password.";
						}
						
					}
				}
				else{
					echo "error~Current password does not match. Please try again.";
				}
			
			
		}
		else{
			echo "You are not allowed to visit here.";
		}
	}

	public function android_changePassword_direct(){
		if(isset($_POST['newpassword'])){
					if($this->input->post('newpassword') == $this->input->post('password')){
						echo "error~Current password and new password must not be the same.";
					}
					else if($this->input->post('newpassword') == $this->input->post('confirmpassword')){
						if($this->AuthModel->android_changePassword($this->input->post('userID'),$this->input->post('newpassword'))){
							echo "success~Password changed successfully!";
						}else{

							echo "error~Cannot change password.";
						}						
					}		
		}
		else{
			echo "You are not allowed to visit here.";
		}
	}

	public function changePassword(){
		if($this->input->is_ajax_request()){
            
			$this->form_validation->set_rules('password',"Current Password","required");
			$this->form_validation->set_rules('newpassword',"New Password","required");
			$this->form_validation->set_rules('confirmpassword',"Confirm Password","required");
	
			if($this->form_validation->run() == FALSE)
				{
				$data = array('response' => 'error', 
							'message' => validation_errors(),
							'password' => form_error('password'),
							'newpassword' => form_error('newpassword'),
							'confirmpassword' => form_error('confirmpassword'));
				echo json_encode($data);  
				}
			else
				{
				$ajax_data = $this->input->post();
				if($this->AuthModel->checkPassword($this->input->post('password'))){

					if($this->input->post('newpassword') == $this->input->post('password')){
						$data = array('response' => 'error', 
						'message' => validation_errors(),
						'password' => form_error('newpassword'),
						'newpassword' => 'Current password and new password must not be the same.',
						'confirmpassword' => form_error('confirmpassword'));
						echo json_encode($data);  
					}
					else if($this->input->post('newpassword') == $this->input->post('confirmpassword')){
						
						if($this->AuthModel->changePassword($this->input->post('newpassword'))){
							$data = array('response'=>'success', 'message'=> 'Password changed successfully!');
						}else{
							$data = array('response' => 'error', 
							'message' => 'Cannot change password.');
						}
						
						echo json_encode($data);  
					}else{
						$data = array('response' => 'error', 
						'message' => validation_errors(),
						'password' => form_error('newpassword'),
						'newpassword' => 'New password and confirm password does not match.',
						'confirmpassword' => form_error('confirmpassword'));
						echo json_encode($data);  
					}


				}
				else{
					$data = array('response' => 'error', 
					'message' => validation_errors(),
					'password' => 'Current password does not match. Please try again.',
					'newpassword' => form_error('newpassword'),
					'confirmpassword' => form_error('confirmpassword'));
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

	public function getAccessLevelList(){
		
	}
}
