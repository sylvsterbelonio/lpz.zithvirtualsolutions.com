<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class BookModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }
    
    public function get_list_material_present(){
        $query = $this->db->query("SELECT * FROM material_present order by presentTitle");
            return $query->result_array();           
    }

    public function get_material_present($id){
        $query = $this->db->query("SELECT * FROM material_present where materialPresentID=".$id." order by presentTitle");
        return $query->result_array(); 
    }

    public function get_list_material_book($classification){
        $query = $this->db->query("SELECT * FROM material_book where book_classification='$classification' order by book_name");
            return $query->result_array();           
    }
    
     public function get_material_book($id){
        $query = $this->db->query("SELECT * FROM material_book where bookID=".$id." order by book_name");
        return $query->result_array(); 
    }

     public function get_list_material_book_lessons($bookID){
        $query = $this->db->query("SELECT * FROM material_book_lessons where bookID=".$bookID." order by lessonsID");

         return $query->result_array();           
    }

    public function get_list_disciple_lessons($bookID){
        $query = $this->db->query("SELECT * FROM material_book_discipleship_lessons where bookID=".$bookID." order by lessonID");

         return $query->result_array();           
    }

    public function get_bible_story_book_list($bookID){
        $query = $this->db->query("SELECT * FROM material_book_lessons where bookID=$bookID order by lessonsID");
         return $query->result_array();           
    }

    public function get_bible_story_book_get($lessonID){
        $query = $this->db->query("SELECT * FROM material_book_lessons where lessonsID=$lessonID order by lessonsID");
         return $query->result_array();           
    }

    private function content_wrapper($content){
         $content = str_replace('"',"\"",$content);
        return $content;
    }


}