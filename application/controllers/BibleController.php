<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BibleController extends CI_Controller {

	public function index()
	{
		$this->load->view('index');
	}

    public function android_get_mnemonic_verse(){
        if(isset($_POST['searchValue'])){
        $data = $this->BibleModel->get_all_mnemonic_verse($this->input->post('searchValue'),$this->input->post('version'),$this->input->post('language'));
        echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }
    }

    public function android_get_distinct_column(){
        if(isset($_POST['columnName'])){
        $data = $this->BibleModel->get_all_distinct_column($this->input->post('columnName'),$this->input->post('table'));
        echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }
    }

    public function bible_get_list(){
        if(isset($_POST['action'])){
            $searchValue = $this->input->post('searchValue');
            $language = $this->input->post('language');
            $limit = $this->input->post('limit');
            $data = $this->BibleModel->bible_get_all_list($searchValue,$language,$limit);
            echo json_encode($data);
            }else{
                $this->load->view('errors/restricted');
            }
    }
    public function bible_get_all_language(){
        if(isset($_POST['action'])){
            $data = $this->BibleModel->bible_get_all_language();
            echo json_encode($data);
            }else{
                $this->load->view('errors/restricted');
            }
    }

    public function bible_get(){
        if(isset($_POST['holyBibleID'])){
            $data = $this->BibleModel->bible_get($this->input->post('holyBibleID'));
            echo json_encode($data);
            }else{
                //$data = $this->BibleModel->bible_get(1);
                //echo json_encode($data);
                $this->load->view('errors/restricted');
            }
    }

}