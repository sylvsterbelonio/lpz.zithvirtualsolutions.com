<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class AppModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function getAPPInfo(){
        $query = $this->db->query("SELECT * FROM system_app where appID=1");
            return $query->row_array();           
    }

    public function get_list_app_assets(){
        $query = $this->db->query("SELECT * FROM app_assets");
            return $query->result_array();           
    }

    public function get_app_assets($assetType){
        $query = $this->db->query("SELECT * FROM app_assets where assetType='$assetType'");
            return $query->result_array();           
    }

    public function get_latest_update(){
        $query = $this->db->query("SELECT MAX(appUpdateID) as 'max_id' FROM app_system_update");
        foreach($query->result_array() as $row) {
                return $row['max_id'];
        }
    }

    public function get_update_info(){
        $maxID = $this->get_latest_update();
        $query = $this->db->query("SELECT * FROM app_system_update ORDER BY appUpdateID DESC");
        return $query->result_array();     
    }

    public function get_update_info_by_html(){
        $maxID = $this->get_latest_update();
        $query = $this->db->query("SELECT * FROM app_system_update ORDER BY appUpdateID DESC");

        $html="";
        foreach($query->result_array() as $row)
        {
                
            if($html=="")
                {
                    $html = "
                    <div class='col-lg-12' style='background-color:#EDEDED;border-top-left-radius:10px;border-top-right-radius:10px'>  
                            ".$row['appDescription']."
                    </div>   
                    <div class='col-lg-12' style='background-color:#EDEDED;border-bottom-left-radius:10px;border-bottom-right-radius:10px'>  
                            <p style='text-align:right;width:100%'><a href=".base_url().$row['appPath']."> Download (".$row['appVersion'].")</a></p>
                   </div>
                    ";
                }
            else {
                $html .= "
                <div class='col-lg-12' style='background-color:#EDEDED;border-top-left-radius:10px;border-top-right-radius:10px;margin-top:10px'>  
                        ".$row['appDescription']."
                </div>   
                <div class='col-lg-12' style='background-color:#EDEDED;border-bottom-left-radius:10px;border-bottom-right-radius:10px'>  
                            <p style='text-align:right;width:100%'><a href=".base_url().$row['appPath']."> Download (".$row['appVersion'].")</a></p>
               </div>
                ";
            }    
            
        }

        return $html;     
    }

}