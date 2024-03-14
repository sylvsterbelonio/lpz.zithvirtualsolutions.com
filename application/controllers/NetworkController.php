<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NetworkController extends CI_Controller {

	public function index(){
        if($this->input->is_ajax_request()){

            if($posts = $this->NetworkModel->my_disciples()){
                $data = array('response'=>'success', 'message'=>'You have successfully loaded the data.', 'post'=> $posts);
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

    public function create(){
        if($this->input->is_ajax_request()){

            $this->form_validation->set_rules('networkName',"Network Name",'required');
            $this->form_validation->set_rules('networkPrivacy',"Network Privacy",'required');
            $this->form_validation->set_rules('networkMode',"Mode of Invitation",'required');

            if($this->form_validation->run() == FALSE)
                {
                $data = array('response' => 'error', 
                            'message' => validation_errors(),
                            'networkName' => form_error('networkName'),
                            'networkMode' => form_error('networkMode'),
                            'networkPrivacy' => form_error('networkPrivacy'));
                echo json_encode($data);  
                }
            else
                {
                    $data = array(
                        'networkName' => $this->input->post('networkName'),
                        'networkAbout' => $this->input->post('networkAbout'),
                        'networkDescription' => $this->input->post('networkDescription'),
                        'networkMode' => $this->input->post('networkMode'),
                        'networkPrivacy' => $this->input->post('networkPrivacy')
                    );

                    //CHECK IF ZERO - MEANS CREATE NEW RECORD//
                    if($_SESSION['currentNetworkID']==0)
                        {
                            //CHECK IF NETWORK NAME IS ALREADY EXISTED
                            if($this->NetworkModel->check_if_other_network_name_exist($this->input->post('networkName')))
                            {
                                $data = array('response' => 'error', 
                                'message' => '',
                                'networkName' => 'Network Name is already existed, please try another.',
                                'networkMode' => '',
                                'networkPrivacy' => '');
                            }
                            else
                            {
                                if($this->NetworkModel->_network($data)){
                                    $post = $this->NetworkModel->my_disciples();
                                    $data = array('response'=>'success', 'message'=>'You have successfully created a record.', 'post'=> $post);
                                }else{
                                    $data = array('response'=>'error', 'message'=> 'failed to fetch data from server.');   
                                }
                            }    
                        }
                    else    
                    //MEANS IF NON ZERO - UPDATE RECORD
                        {
                            if($this->NetworkModel->check_network_exist($this->input->post('networkName')))
                                {
                                    if($this->NetworkModel->_network($data)){
                                        $post = $this->NetworkModel->my_disciples();
                                        $data = array('response'=>'success', 'message'=>'You have successfully updated a record.', 'post'=> $post);
                                    }else{
                                        $data = array('response'=>'error', 'message'=> 'failed to fetch data from server.');   
                                    }
                                }
                            else
                                {
                                        //CHECK IF NETWORK NAME IS ALREADY EXISTED
                                        if($this->NetworkModel->check_if_other_network_name_exist($this->input->post('networkName')))
                                        {
                                            $data = array('response' => 'error', 
                                            'message' => '',
                                            'networkName' => 'Network Name is already existed, please try another.',
                                            'networkMode' => '',
                                            'networkPrivacy' => '');
                                        }
                                        else
                                        {
                                            if($this->NetworkModel->_network($data)){
                                                $post = $this->NetworkModel->my_disciples();
                                                $data = array('response'=>'success', 'message'=>'You have successfully updated a record.', 'post'=> $post);
                                            }else{
                                                $data = array('response'=>'error', 'message'=> 'failed to fetch data from server.');   
                                            }
                                        }    
                                }
                        }    
                echo json_encode($data);  
                } 
        }else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');
        }
    }

    public function delete(){
        if($this->input->is_ajax_request())
            {   
                if($this->NetworkModel->delete_network()){
 
                    $post = $this->NetworkModel->my_disciples();
                    $data = array('response'=>'success', 'message'=>'You have successfully deleted a record.', 'post'=> $post);

                }else{
                    $data = array('response'=>'error', 'message'=> 'Unable to delete record.');   
                }
            echo json_encode($data);  
            }
            else
                {
                    $this->load->view('templates/header');
                    $this->load->view('errors/restricted');
                    $this->load->view('templates/footer');
                } 
    }

    public function search(){
        if($this->input->is_ajax_request()){

            if($posts = $this->NetworkModel->search_members($this->input->post('name'))){
                $data = array('response'=>'success', 
                'message'=>'You have successfully loaded the data.', 
                'count' => $posts['count'],
                'post'=> $posts['posts']);
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

    public function add_new_member(){
        if($this->input->is_ajax_request()){

            if($this->input->post('action')=="add"){
                if($this->NetworkModel->check_member_maximum_capacity(12)){
                    if($posts = $this->NetworkModel->add_new_member($this->input->post('id'))){
                        $data = array('response'=>'success', 
                        'message'=>'You have successfully loaded the data.', 
                        'post'=> $posts);
                    }else{
                        $data = array('response'=>'error', 'message'=> 'failed to fetch data from server.');   
                    }
                }else{
                    $data = array('response'=>'error', 
                    'message'=>'You have exceeded the 12 capacity limit of your disciples.', 
                    );
                }
            }else{
                if($posts = $this->NetworkModel->remove_member($this->input->post('id'))){
                    $data = array('response'=>'success', 
                    'message'=>'You have successfully loaded the data.', 
                    'post'=> $posts);
                }else{
                    $data = array('response'=>'error', 'message'=> 'failed to fetch data from server.');   
                }
            }

           


            echo json_encode($data);  
        }else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');
        }
    }

    public function get_members(){
        if($this->input->is_ajax_request()){

            if($posts = $this->NetworkModel->get_members()){
                $data = array('response'=>'success', 
                'message'=>'You have successfully loaded the data.', 
                'post'=> $posts);
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

}