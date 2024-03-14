<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersManagementController extends CI_Controller {

	public function index()
	{}

    public function users_management(){
        if(isset($_SESSION['username']) )  {
            $this->NotificationModel->setMenu_Notified("Users Management");
            $data['userAccountInfo'] = $this->AuthModel->getLoginInfo($_SESSION['username']);
            $data['populateSideMenu'] = $this->MenuModel->populateSideMenu('Users Management');
            if($this->MenuModel->checkMenu_If_Allowed($_SESSION['accessLevelID'],"Users Management")){   

                $data['getAccessLevelList'] = $this->AuthModel->getAccessLevel();
                $data['notification'] = $this->NotificationModel->getNotification();
                
                $this->load->view('templates/header');
                $this->load->view('templates/dashboard-toolbar',$data);
                $this->load->view('templates/dashboard-sidebar',$data);
                $this->load->view('pages/admin/users-management',$data);
                $this->load->view('templates/footer');

            }else{
                $this->load->view('templates/header');
                $this->load->view('templates/dashboard-toolbar',$data);
                $this->load->view('templates/dashboard-sidebar',$data);
                $this->load->view('errors/restricted');
                $this->load->view('templates/footer');
            }

        }else{
            redirect('login');
        }
    }

    function getList(){
        if($this->input->is_ajax_request()){
            if($posts = $this->UsersManagementModel->fetch_all()){
                $data = array('response'=>'success', 'posts'=> $posts);
            }else{
                $data = array('response'=>'error', 'message'=> 'failed to fetch data from server.');   
            }
            echo json_encode($data);  
        }else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');
        }
    }

    function add_users(){
        if($this->input->is_ajax_request()){
            

            $this->form_validation->set_rules('username',"username",'required|min_length[5]|max_length[20]|is_unique[users.username]',
            array(
                    'required'      => 'You have not provided %s.',
                    'is_unique'     => 'This %s already exists.'));
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');												
            $this->form_validation->set_rules('password',"password","required");
            $this->form_validation->set_rules('first_name',"First Name","required");
            $this->form_validation->set_rules('last_name',"Last Name","required");


            if($this->form_validation->run() == FALSE)
                {
                $data = array('response' => 'error', 
                            'message' => validation_errors(),
                            'email' => form_error('email'),
                            'username' => form_error('username'),
                            'password' => form_error('password'),
                            'first_name' => form_error('first_name'),
                            'last_name' => form_error('last_name'));
                echo json_encode($data);  
                }
            else
                {
                $ajax_data = $this->input->post();
                if($this->UsersManagementModel->insert_entry()){

                    $this->AuthModel->setTimeLog($_SESSION['userID'],"Successfully created an account from the user of ".$_SESSION['username'] );
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

    public function edit_users()
    {
        if($this->input->is_ajax_request())
            {
                
                $edit_id = $this->input->post('edit_id');  
                if($posts = $this->UsersManagementModel->edit_entry($edit_id))
                    {
                    $data = array('response'=>'success', 'posts'=> $posts);
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

    public function update_users(){
        if($this->input->is_ajax_request()){

            $this->form_validation->set_rules('username',"username",'required|min_length[5]|max_length[20]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');												
            $this->form_validation->set_rules('password',"password","required");
            $this->form_validation->set_rules('first_name',"First Name","required");
            $this->form_validation->set_rules('last_name',"Last Name","required");

            if($this->form_validation->run() == FALSE)
                {
                    $data = array('response' => 'error', 
                    'message' => validation_errors(),
                    'email' => form_error('email'),
                    'username' => form_error('username'),
                    'password' => form_error('password'),
                    'first_name' => form_error('first_name'),
                    'last_name' => form_error('last_name'));
                }
            else
                {

                if($this->AuthModel->checkIfUsernameExisted_for_update($this->input->post('userID'),$this->input->post('username'))){
                    if($this->AuthModel->checkIfEmailExisted_for_update($this->input->post('userID'),$this->input->post('email'))){
                        if($this->UsersManagementModel->update_entry($this->input->post('userID'))){
                            $data = array('response'=>'success', 'message'=> 'Record updated successfully.');
                        }
                        else{
                            $data = array('response'=>'error', 'message'=> 'Failed to update record.');     
                        }
                    }else{
                        if($this->AuthModel->checkIfEmailExisted($this->input->post('email'))){
                            $data = array('response'=>'error', 'message'=> 'Failed to update record.',
                            'username' => '',
                            'email' => 'Email is already existed.',
                            'password' => '',
                            'first_name' => '',
                            'last_name' => '');   
                        }else{
                            if($this->UsersManagementModel->update_entry($this->input->post('userID'))){
                                $data = array('response'=>'success', 'message'=> 'Record updated successfully.');
                            }
                            else{
                                $data = array('response'=>'error', 'message'=> 'Failed to update record.');     
                            }                      
                        }
                    }
                }else{
                    if($this->AuthModel->checkIfUsernameExisted($this->input->post('username'))){
                        $data = array('response'=>'error', 'message'=> 'Failed to update record.',
                                        'username' => 'Username is already existed.',
                                        'email' => '',
                                        'password' => '',
                                        'first_name' => '',
                                        'last_name' => '');   
                    }else{
                        if($this->UsersManagementModel->update_entry($this->input->post('userID'))){
                            $data = array('response'=>'success', 'message'=> 'Record updated successfully.');
                        }
                        else{
                            $data = array('response'=>'error', 'message'=> 'Failed to update record.');     
                        }
                    }
                }    
            }
            //$this->ChurchModel->insertChurch();
            echo json_encode($data);  
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }
    }
    public function delete_users(){
        if($this->input->is_ajax_request()){
                $del_id = $this->input->post('del_id');     
                if($this->UsersManagementModel->delete_entry($del_id)){
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

}    