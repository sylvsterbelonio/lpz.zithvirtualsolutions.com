<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class SlidesModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function get_group_slide_list(){
        $query = $this->db->query("SELECT * FROM power_point_slide ORDER BY ppt_name");
        return $query->result_array();
    }
    public function get_slide_list($id){
        $query = $this->db->query("SELECT * FROM power_point_slide_lessons WHERE pptID=$id ORDER BY ppt_lesson_no");
        return $query->result_array();
    }

}