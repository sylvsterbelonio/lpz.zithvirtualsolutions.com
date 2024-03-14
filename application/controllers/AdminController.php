<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	public function index()
	{
        if(isset($_SESSION['username']) )  {    

            $this->NotificationModel->setMenu_Notified("Dashboard");

            $this->load->view('templates/header');
            $this->load->view('templates/dashboard-toolbar');
            $this->load->view('templates/dashboard-sidebar',['page'=>'Dashboard']);
            $this->load->view('pages/admin/dashboard');
            $this->load->view('templates/footer');
        }else{
            redirect('login');
        }
	}

}
