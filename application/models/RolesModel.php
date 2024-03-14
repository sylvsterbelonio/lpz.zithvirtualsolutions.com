<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class RolesModel extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function get_list_of_churches_selection(){

        $profileInformation = $this->ProfileModel->getProfileData();

        $html=' <button id="btnChurchSelector" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Select Church
      </button>
      <ul class="dropdown-menu dropdown-menu-light">
        <li><a class="dropdown-item" href="#" onclick="select_church(\'Action\')">Action</a></li>
        
        <li><a class="dropdown-item" href="#" onclick="select_church(\'Another Action\')">Another action</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#" onclick="select_church(\'Something Else\')">Something else here</a></li>
      </ul>';

        $query = $this->db->query("SELECT * FROM `church` WHERE churchID=".$profileInformation['chu_churchID']);
        if(count( $query->result() ) > 0)
            {
            foreach($query->result_array() as $row) {
             $html.='<li><a class="dropdown-item" href="#" onclick="select_church(\''.$row['churchID'].'\')">Action</a></li>';
            }
            $html.='<li><hr class="dropdown-divider"></li>';
            }
            $query = $this->db->query("SELECT * FROM `church` WHERE churchID=".$profileInformation['chu_churchID']);    

}

}