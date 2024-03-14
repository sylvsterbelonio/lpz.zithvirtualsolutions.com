<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SlidesController extends CI_Controller {

	public function index(){
    }

    public function get_group_slide_list(){
        if(isset($_POST['action'])){
            $data = $this->SlidesModel->get_group_slide_list();
            echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }
    }

    public function get_slide_list(){
        if(isset($_POST['pptID'])){
            $data = $this->SlidesModel->get_slide_list($this->input->post('pptID'));
            echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }
    }

}