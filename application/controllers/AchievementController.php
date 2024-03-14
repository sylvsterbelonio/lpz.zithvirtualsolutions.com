<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AchievementController extends CI_Controller {

	public function index()
	{
        if(isset($_SESSION['username']) )  {

            $this->NotificationModel->setMenu_Notified("Achievements");

            if($this->MenuModel->checkMenu_If_Allowed($_SESSION['accessLevelID'],"Achievements")){   
                $this->load->view('templates/header');
                $this->load->view('templates/dashboard-toolbar');
                $this->load->view('templates/dashboard-sidebar',['page'=>'Achievements']);
                $this->load->view('pages/admin/achievements');
                $this->load->view('templates/footer');

            }else{
                $this->load->view('templates/header');
                $this->load->view('templates/dashboard-toolbar');
                $this->load->view('templates/dashboard-sidebar',['page'=>'Achievements']);
                $this->load->view('errors/restricted');
                $this->load->view('templates/footer');
            }

        }else{
            redirect('login');
        }
    }

    public function claim_now(){
        if($this->input->is_ajax_request()){
            if($posts = $this->AchievementModel->claim($this->input->post('sel_id'))){
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

}