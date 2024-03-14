<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppController extends CI_Controller {

	public function index()
	{
    }

    public function android_app_assets_get_list(){
            $data = $this->AppModel->get_list_app_assets();
                echo json_encode($data);   
    }

    public function copyright(){
		$this->load->view('templates/header');
		$this->load->view('templates/copyright');
		$this->load->view('templates/full-footer');
    }

    public function data_privacy(){
      $this->load->view('templates/header');
      $this->load->view('templates/data_privacy');
      $this->load->view('templates/full-footer');
      }
      public function privacy_policy(){
        //$this->load->view('templates/header');
        $this->load->view('templates/privacy_policy');
        //$this->load->view('templates/full-footer');
        }  

    public function terms_and_conditions(){
      $this->load->view('templates/header');
      $this->load->view('templates/terms_and_conditions');
      $this->load->view('templates/full-footer');
      }
      
      
    public function simbanay_privacy_policy(){
    $this->load->view('templates/simbanay_privacy_policy');
    }  
    public function simbanay_terms_and_conditions(){
    $this->load->view('templates/simbanay_terms_conditions');
    }
    public function suynl_privacy_policy(){
    $this->load->view('templates/suynl_privacy_policy');
    }  
    public function suynl_terms_and_conditions(){
    $this->load->view('templates/suynl_terms_conditions');
    }  
    public function cell_explosion_privacy_policy(){
    $this->load->view('templates/cell_explosion_privacy_policy');
    }  
    public function cell_explosion_terms_and_conditions(){
    $this->load->view('templates/cell_explosion_terms_conditions');
    }

    public function download(){

      $data['list_app_updates'] = $this->AppModel->get_update_info_by_html();

      $this->load->view('templates/header');
      $this->load->view('pages/download',$data);
      $this->load->view('templates/full-footer');
    }

    public function android_get_app_assets(){
      if(isset($_POST['assetType'])){
        $data = $this->AppModel->get_app_assets($this->input->post('assetType'));
        echo json_encode($data);
      }else{
        $this->load->view('errors/restricted');
      }
    }

    public function android_update_checker(){
      echo $this->AppModel->get_latest_update();
    }

    public function android_get_update(){
      $data = $this->AppModel->get_update_info();
      echo json_encode($data);
    }

}