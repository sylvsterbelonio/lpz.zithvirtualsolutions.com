<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function render($section,$route){

        $this->NotificationModel->setMenu_Notified($section);
        
        $data['page'] = $this->ParameterModel->getGroupParameter($section);

        $this->load->view('templates/header',$data);
        $this->load->view('templates/dashboard-toolbar');
        $this->load->view('templates/dashboard-sidebar',['page'=>$section]);
        $this->load->view($route);
        $this->load->view('templates/footer');
    }

    function no_page_found(){

        $data['app'] = $this->ParameterModel->getGroupParameter('app');
        $data['page'] = $this->ParameterModel->getGroupParameter('error-page');

        $this->load->view('templates/header',$data);
        $this->load->view('errors/restricted');
        $this->load->view('templates/full-footer');
    }

    function no_access_page($section){

        $data['page'] = $this->ParameterModel->getGroupParameter('no-access-page');

        $this->load->view('templates/header');
        $this->load->view('templates/dashboard-toolbar');
        $this->load->view('templates/dashboard-sidebar',['page'=>$section]);
        $this->load->view('errors/restricted',$data);
        $this->load->view('templates/footer');
    }

}