<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EbookController extends CI_Controller {

    public function index(){}

    public function get_ebook_list(){

        if(isset($_POST['bookName'])){

        $filter = array(
            'bookName' => $this->input->post('bookName'),
            'orderType' => $this->input->post('orderType'),
            'limit' => $this->input->post('limit'),
        );

        $data = $this->EbookModel->get_list_ebook($filter);
        echo json_encode($data);

    }else{
        $this->load->view('errors/restricted');
    }

    }

    public function get_similar_ebook_list(){

        if(isset($_POST['ebookID'])){

        $filter = array(
            'ebookID' => $this->input->post('ebookID'),
            'bookTag' => $this->input->post('bookTag'),
            'limit' => $this->input->post('limit'),
        );

        $data = $this->EbookModel->get_similar_list_ebook($filter);
        echo json_encode($data);

    }else{
        
        $filter = array(
            'ebookID' => 1,
            'bookTag' => 'Cell Group Ministry, Church, Growth',
            'limit' => $this->input->post('limit'),
        );
        
        $data = $this->EbookModel->get_similar_list_ebook($filter);
        echo json_encode($data);
        
        $this->load->view('errors/restricted');
    }

    }


    public function get_ebook(){
        if(isset($_POST['ebookID'])){
            $data = $this->EbookModel->get_ebook($this->input->post('ebookID'));
            echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }
    }

    public function get_top_10_ebook(){
        if(isset($_POST['type'])){
            $data = $this->EbookModel->get_top_10_ebook($this->input->post('type'));
            echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }
    }

    public function get_count_all_ebook_list(){
        if(isset($_POST['bookName'])){
            $data = $this->EbookModel->get_count_ebook();
            echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }
    }

    public function add_history_analytics(){
     if(isset($_POST['ebookID'])){

        $action = array(
            'ebookID' => $this->input->post('ebookID'),
            'userID' => $this->input->post('userID'),
            'type' => $this->input->post('type'),
            'action' => $this->input->post('action')
        );

        $data = $this->EbookModel->android_add_history_analytics($action);
        echo json_encode($data);

    }else{
        $this->load->view('errors/restricted');
    }

    }

    public function get_list_books_by_author(){
        if(isset($_POST['bookAuthor'])){
            $data = $this->EbookModel->get_list_books_by_author($this->input->post('bookAuthor'));
            echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }
    }

}