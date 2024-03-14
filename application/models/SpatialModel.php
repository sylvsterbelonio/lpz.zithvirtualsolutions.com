<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class SpatialModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    private function replaceWhiteSpace($data){
        return str_replace("%20"," ", $data);
    }
    public function populateSpatial($country,$province, $city,$barangay, $type){
        $sql='';
        $elementKey='';

        $country = $this->replaceWhiteSpace($country);
        $province = $this->replaceWhiteSpace($province);
        $city = $this->replaceWhiteSpace($city);
        $barangay = $this->replaceWhiteSpace($barangay);

        if($type=='country'){
            $sql= "SELECT DISTINCT NAME_0 FROM spatial_location ORDER BY NAME_0";
            $elementKey="NAME_0";
        }
        elseif($type=="province"){
            $elementKey="NAME_1";
            $sql="SELECT DISTINCT $elementKey FROM spatial_location WHERE NAME_0='$country'  ORDER BY $elementKey";
        }elseif($type=="city"){
            $elementKey="NAME_2";
            $sql="SELECT DISTINCT $elementKey FROM spatial_location WHERE NAME_0='$country' AND NAME_1='$province' ORDER BY $elementKey";
        }elseif($type=="barangay"){
            $elementKey="NAME_3";
            $sql="SELECT DISTINCT $elementKey FROM spatial_location WHERE NAME_0='$country' AND NAME_1='$province' AND NAME_2='$city' ORDER BY $elementKey";
        }
            

        $query = $this->db->query($sql);

        $i=0;
        $data=array();
        foreach($query->result_array() as $row)
        {
            $data[$i]=$row[$elementKey];
            $i+=1;
        }    

        return $query->result();

    }
    public function populateCountry($country){
        $html="";
        $query = $this->db->query("SELECT DISTINCT NAME_0 FROM spatial_location ORDER BY NAME_0");

        if($country!=""){
            $html.='<option value="'.$country.'" selected>'.$country.'</option> ';
            $html.='<option value="">- Select Country -</option> ';
        }else{
            $html.='<option value="" selected>- Select Country -</option> ';
        }
        
        foreach($query->result_array() as $row)
            {
                $html.='<option value="'.$row["NAME_0"].'">'.$row["NAME_0"].'</option>';
            }    
        return $html;    
    }

    public function populateProvince($country, $province){
        $html="";
        $query = $this->db->query("SELECT DISTINCT NAME_1 FROM spatial_location WHERE NAME_0='$country' ORDER BY NAME_1");

        if($province!=""){
            $html.='<option value="'.$province.'" selected>'.$province.'</option> ';
            $html.='<option value="">- Select Province -</option> ';
        }else{
            $html.='<option value="" selected>- Select Province -</option> ';
        }

        foreach($query->result_array() as $row)
            {
                $html.='<option value="'.$row["NAME_1"].'">'.$row["NAME_1"].'</option>';
            }    
        return $html;  
    }

    public function populate_autocomplete($mode,$searchValue,$limit){

        $nMode = explode(".",$mode);
        $nMode[0] = trim($nMode[0]);
        $nMode[1] = trim($nMode[1]);

        $filter='';
        if($mode='province') $filter = "NAME_1";
        $query = $this->db->query("SELECT DISTINCT ".$nMode[0]." FROM ".$nMode[1]." WHERE ".$nMode[0]." LIKE '$searchValue%' ORDER BY ".$nMode[0]." LIMIT 0,$limit");

        $value='';

        foreach($query->result_array() as $row)
            {
                $value.=$row[$nMode[0]].',';
            }    
        return $value;  
    }

    public function populateCity($province,$city){
        $html="";
        $query = $this->db->query("SELECT DISTINCT NAME_2 FROM spatial_location WHERE NAME_1='$province' ORDER BY NAME_2");
        if($city!=""){
            $html.='<option value="'.$city.'" selected>'.$city.'</option> ';
            $html.='<option value="">- Select Municipality/City -</option> ';
        }else{
            $html.='<option value="" selected>- Select Municipality/City -</option> ';
        }
        foreach($query->result_array() as $row)
            {
                $html.='<option value="'.$row["NAME_2"].'">'.$row["NAME_2"].'</option>';
            }    
        return $html;  
    }

    public function populateBarangay($city,$barangay){
        $html="";
        $query = $this->db->query("SELECT DISTINCT NAME_3 FROM spatial_location WHERE NAME_2='$city' ORDER BY NAME_3");
        if($barangay!=""){
            $html.='<option value="'.$barangay.'" selected>'.$barangay.'</option> ';
            $html.='<option value="">- Select Barangay -</option> ';
        }else{
            $html.='<option value="" selected>- Select Barangay -</option> ';
        }
        foreach($query->result_array() as $row)
            {
                $html.='<option value="'.$row["NAME_3"].'">'.$row["NAME_3"].'</option>';
            }    
        return $html;  
    }

}