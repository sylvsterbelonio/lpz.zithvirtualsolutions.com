<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SystemAccessController extends CI_Controller {

	public function index()
	{

    }


    public function system_access(){
        
        if(isset($_SESSION['username']) )  {
            $this->NotificationModel->setMenu_Notified("System Access");
            $data['userAccountInfo'] = $this->AuthModel->getLoginInfo($_SESSION['username']);
            $data['populateSideMenu'] = $this->MenuModel->populateSideMenu('System Access');
            if($this->MenuModel->checkMenu_If_Allowed($_SESSION['accessLevelID'],"System Access")){        

                $data['country'] = $this->ChurchModel->populateCountry("");
                $data['province'] = '<option value="" selected>- Select Province -</option> ';
                $data['city'] = '<option value="" selected>- Select Municipality/City -</option> ';
                $data['barangay'] = '<option value="" selected>- Select Barangay -</option> ';;
                $data['notification'] = $this->NotificationModel->getNotification();

                $this->load->view('templates/header');
                $this->load->view('templates/dashboard-toolbar',$data);
                $this->load->view('templates/dashboard-sidebar',$data);
                $this->load->view('pages/admin/systemaccess',$data);
                $this->load->view('templates/footer');

            }else{
                $this->load->view('templates/header');
                $this->load->view('templates/dashboard-toolbar',$data);
                $this->load->view('templates/dashboard-sidebar',$data);
                $this->load->view('errors/restricted');
                $this->load->view('templates/footer');
            }    
            
        }
        else
        {
            redirect('login');
        }
    }

    function getList(){
        if($this->input->is_ajax_request()){
            if($posts = $this->SystemAccessModel->fetch_all()){
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

    function add_access(){
        if($this->input->is_ajax_request()){
            
            $this->form_validation->set_rules('accessLevelName',"Access Level Name",'required|is_unique[accessLevel.accessLevelName]',
            array(
                    'required'      => 'You have not provided %s.',
                    'is_unique'     => 'This %s already exists.'));
            $this->form_validation->set_rules('position', 'Position', 'required');												

            if($this->form_validation->run() == FALSE)
                {
                $data = array('response' => 'error', 
                            'message' => validation_errors(),
                            'accessLevelName' => form_error('accessLevelName'),
                            'position' => form_error('position'));
                echo json_encode($data);  
                }
            else
                {
                if($this->SystemAccessModel->insert_entry()){
                    $this->AuthModel->setTimeLog($_SESSION['userID'],"Successfully created a system access name from the user of ".$_SESSION['username'] );
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

    public function edit_access()
    {
        if($this->input->is_ajax_request())
            {
                
                $edit_id = $this->input->post('edit_id');  
                if($posts = $this->SystemAccessModel->edit_entry($edit_id))
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

    public function update_access(){
        if($this->input->is_ajax_request()){

            $this->form_validation->set_rules('accessLevelName',"Access Level Name",'required');
            $this->form_validation->set_rules('position', 'Position', 'required');		

            if($this->form_validation->run() == FALSE)
                {
                    $data = array('response' => 'error', 
                    'message' => validation_errors(),
                    'accessLevelName' => form_error('accessLevelName'),
                    'position' => form_error('position'));
                }
            else
                {

                if($this->SystemAccessModel->checkIf_AccessName_Existed_for_Update($this->input->post('accessLevelID'),$this->input->post('accessLevelName'))){
                    if($this->SystemAccessModel->update_entry($this->input->post('accessLevelID'))){

                        $this->AuthModel->setTimeLog($_SESSION['userID'],"Successfully updated a system access name from the user of ".$_SESSION['username'] );
                        $data = array('response'=>'success', 'message'=> 'Record updated successfully.');
                    }
                    else{
                        $data = array('response'=>'error', 'message'=> 'Failed to update record.');     
                    }
                }else{
                    if($this->SystemAccessModel->checkIf_AccessName_Existed($this->input->post('accessLevelName'))){
                        $data = array('response' => 'error', 
                        'message' => validation_errors(),
                        'accessLevelName' => 'Access Name is already existed.',
                        'position' => form_error('position'));
                    }else{
                        if($this->SystemAccessModel->update_entry($this->input->post('accessLevelID'))){
                            $this->AuthModel->setTimeLog($_SESSION['userID'],"Successfully updated a system access name from the user of ".$_SESSION['username'] );
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




    public function delete_access(){
        if($this->input->is_ajax_request()){
                $del_id = $this->input->post('del_id');     
                if($this->SystemAccessModel->delete_entry($del_id)){

                    $this->AuthModel->setTimeLog($_SESSION['userID'],"Successfully deleted a system access name from the user of ".$_SESSION['username'] );   
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