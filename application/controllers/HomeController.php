<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	public function view($param = null)
	{

		//YOU CAN MANUALLY LOAD MODEL
		//$this->load->model('MODELNAME');
		//$this->MODELNAME->function();

		//$student = new YOURMODELNAME;
		//@student = $student->student_data();

		//$this->load->model('YOURMODELNAME','new variable name')
		//$this->new variable name->function();


        if($param==null){
            $page = "home";
            if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
                show_404();
            }

			$data['App'] = $this->AppModel->getAPPInfo();
            $data['dashboard'] = $this->AuthModel->getHomeDashboardMenu();
			$data['dashboardIcon'] = $this->AuthModel->getIconDashboardMenu();
			$data['mainFeatures'] = $this->HomeModel->getMainFeatures();

            $this->load->view('templates/header-home');
            $this->load->view('pages/home-home',$data);
            $this->load->view('templates/footer-home');
        }else{

            echo "no page";

        }
        
	}



	public function addUser(){

	}

	public function logout(){
		$this->AuthModel->setTimeLog($_SESSION['userID'],"Successfully logout an account of ".$_SESSION['username'] );
		$this->session->unset_userdata('userID');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('photopath');
		$this->session->unset_userdata('accessLevelID');
		redirect('login');
	}

	
}
