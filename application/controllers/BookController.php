<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookController extends CI_Controller {

    public function index()
	{}

    public function android_material_present_get_list(){
        $data = $this->BookModel->get_list_material_present();
            echo json_encode($data);   
    }

    public function android_material_present_get(){
        if(isset($_POST['materialPresentID'])){
            $data = $this->BookModel->get_material_present($this->input->post('materialPresentID'));
            echo json_encode($data);  
        }else{
            $this->load->view('errors/restricted');
        }
    }

  public function android_material_book_get_list(){
    if(isset($_POST['book_classification'])){
        $data = $this->BookModel->get_list_material_book($this->input->post('book_classification'));
            echo json_encode($data);   
        }else{
            //$this->load->view('errors/restricted');
             $data = $this->BookModel->get_list_material_book('tools-2');
            echo json_encode($data);
        }      
    }
    
    public function android_material_book_get(){
        if(isset($_POST['bookID'])){
        $data = $this->BookModel->get_material_book($this->input->post('bookID'));
        echo json_encode($data);  
        }else{
            $this->load->view('errors/restricted');
        }
}

    public function android_material_book_lessons_get_list(){
        if(isset($_POST['bookID'])){
            $data = $this->BookModel->get_list_material_book_lessons($this->input->post('bookID'));
            echo json_encode($data);
           }else{
            echo "You are not allowed to visit here.";
           }
    }

    public function android_disciple_lessons_get_list(){
        if(isset($_POST['bookID'])){
            $data = $this->BookModel->get_list_disciple_lessons($this->input->post('bookID'));
            echo json_encode($data);
           }else{
            //echo "You are not allowed to visit here.";
            $data = $this->BookModel->get_list_disciple_lessons(5);
            echo json_encode($data);
           }
    }

    public function android_bible_story_book_get_list(){
        if(isset($_POST['bookID'])){
        $data = $this->BookModel->get_bible_story_book_list($this->input->post('bookID'));
        echo json_encode($data);
    }else{
        $this->load->view('errors/restricted');
    }
    }

    public function android_bible_story_book_get(){
        if(isset($_POST['lessonID'])){
            $data = $this->BookModel->get_bible_story_book_get($this->input->post('lessonID'));
            echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }   
    }

}