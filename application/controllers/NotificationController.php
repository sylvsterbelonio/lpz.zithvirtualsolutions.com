<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotificationController extends CI_Controller {

	public function index()
	{
    }

	public function welcome_close(){
        if($this->input->is_ajax_request()){    
            if($this->NotificationModel->welcome_close()){
                $data = array('response'=>'success', 'message'=> 'Successfully close.');    
            }else{
                $data = array('response'=>'error', 'message'=> 'Unable to close welcome message.');   
            }
        echo json_encode($data);  
    }else{
        $this->load->view('templates/header');
        $this->load->view('errors/restricted');
        $this->load->view('templates/footer');
    } 

    }

    public function read_notification(){
        if($this->input->is_ajax_request()){    
            if($post = $this->NotificationModel->readNotificationMessage()){
                $data = array('response'=>'success', 'message'=> 'Successfully close.', 'posts' => $post);    
            }else{
                $data = array('response'=>'error', 'message'=> 'Unable to close welcome message.');   
            }
        echo json_encode($data);  
    }else{
        $this->load->view('templates/header');
        $this->load->view('errors/restricted');
        $this->load->view('templates/footer');
    } 
    }

}