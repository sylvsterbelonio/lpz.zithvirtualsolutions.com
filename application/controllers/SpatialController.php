<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SpatialController extends CI_Controller {

	public function index()
	{}

    public function android_get_spatial_list($country,$province,$city,$barangay){

        if($country=="country" && $province=="province" && $city=="city" && $barangay=="barangay"){
            $value = $this->SpatialModel->populateSpatial($country,$province,$city,$barangay,"country");
            echo json_encode($value); 
        }else if($province=="province" && $city=="city" && $barangay=="barangay"){
            $value = $this->SpatialModel->populateSpatial($country,$province,$city,$barangay,"province");
            echo json_encode($value);
        }else if($city=="city"){
            $value = $this->SpatialModel->populateSpatial($country,$province,$city,$barangay,"city");
            echo json_encode($value);
        }else {
            $value = $this->SpatialModel->populateSpatial($country,$province,$city,$barangay,"barangay");
            echo json_encode($value);
        }

    }
    public function get_autocomplete(){
        if($this->input->is_ajax_request()){
            $value = $this->SpatialModel->populate_autocomplete($this->input->post('mode'),$this->input->post('search'),$this->input->post('limit'));	
            $data = array('response'=>'success', 'html'=> $value);  	 
            echo json_encode($data); 
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }
    }
    public function search_spatial(){
        if($this->input->is_ajax_request()){
            if($this->input->post('type')=="fetch-country"){
                $value = $this->SpatialModel->populateCountry('');
                $data = array('response'=>'success', 'html'=> $value);  	 
                echo json_encode($data); 
            }
            else if($this->input->post('type')=="fetch-province"){
                $value = $this->SpatialModel->populateProvince($this->input->post('search_value'),'');
                $data = array('response'=>'success', 'html'=> $value);  	 
                echo json_encode($data); 
            }
            else if($this->input->post('type')=="fetch-city"){
                $value = $this->SpatialModel->populateCity($this->input->post('search_value'),'');
                $data = array('response'=>'success', 'html'=> $value);  	
                echo json_encode($data); 
            }
            else if($this->input->post('type')=="fetch-barangay"){
                $value = $this->SpatialModel->populateBarangay($this->input->post('search_value'),'');
                $data = array('response'=>'success', 'html'=> $value);  	
                echo json_encode($data); 
            }
            else{
                $value = $this->SpatialModel->populate_autocomplete($this->input->post('mode'),$this->input->post('search'),$this->input->post('limit'));	
                $data = array('response'=>'success', 'html'=> $value);  	 
                echo json_encode($data); 
            }
        }else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');					
        }
    }


}