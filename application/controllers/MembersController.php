<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MembersController extends CI_Controller {

	public function index()
	{}

    
    public function android_get_person_info_from_id(){
        if(isset($_POST['userID'])){
        
            echo json_encode($this->MembersModel->android_get_person_info_from_id($_POST['userID']));
        }else{
            echo json_encode($this->MembersModel->android_get_person_info_from_id(41));
        }
    }

    public function android_search_members(){
        if(isset($_POST['action'])){
        $data = $this->MembersModel->search_members($this->input->post('searchValue'));
        echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }
    }

    public function android_add_network_leader(){
        if(isset($_POST['userID'])){
        $this->MembersModel->android_network_leader_add($this->input->post('userID'),$this->input->post('person_userID'));
        echo "Success";
        }else{
            $this->load->view('errors/restricted');
        }    
    }

    public function android_remove_network_leader(){
        if(isset($_POST['userID'])){
        $this->MembersModel->android_network_leader_remove($this->input->post('userID'));
        echo "Success";
        }else{
            $this->load->view('errors/restricted');
        }
    }

    public function android_get_member(){
        if(isset($_POST['userID'])){
        
            echo json_encode($this->MembersModel->android_get_network_members_list($_POST['userID']));
        }else{
            echo json_encode($this->MembersModel->android_get_network_members_list(41));
        }
        
    }

    public function android_get_network_leader(){
        if(isset($_POST['userID'])){
            echo json_encode($this->MembersModel->android_get_network_leader_info($_POST['userID']));

        }else{
            echo json_encode($this->MembersModel->android_get_network_leader_info(136));
        }
    }

    public function get_quick_add_members_form(){
        if($this->input->is_ajax_request()){
            if(isset($_SESSION['currentChurchID'])){
                $data = array(
                    'response' => 'success',
                    'post' => $this->member->quick_add_form($_SESSION['currentChurchID'])
                );
                echo json_encode($data);
            }else{
                $this->load->view('templates/header');
                $this->load->view('errors/restricted');
                $this->load->view('templates/footer');	
            }
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }
    }



}