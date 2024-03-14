<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class ParameterModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    private function getCurrentLanguage(){
        if(isset($_SESSION['language'])){
            return $_SESSION['language'];
        }
        return "English";
    }

    public function getChurchRoleParameterList($defaultValue){
        $query = $this->db->query("SELECT churchRoleID , roleName FROM church_roles where roleName != 'Administrator' order by roleName");
        if($defaultValue!="")
            $html="<option value=''>- Select Church Role -</option>";
        else 
            $html="<option value='' selected>- Select Church Role -</option>";   
        foreach($query->result_array() as $row) 
        { 
            if($defaultValue==$row['roleName'])
                $html.="<option value='".$row['churchRoleID']."' selected>".$row['roleName']."</option>";
            else
                $html.="<option value='".$row['churchRoleID']."'>".$row['roleName']."</option>";
        }
        return $html;  
    }

    public function getDefaultParameterList($group, $defaultValue){
        $query = $this->db->query("SELECT default_name FROM ref_parameter where group_name='".$group."' order by default_name");
        if($defaultValue!="")
            $html="<option value=''>- Select $group -</option>";
        else 
            $html="<option value='' selected>- Select $group -</option>";   
        foreach($query->result_array() as $row) 
        { 
            if($defaultValue==$row['default_name'])
                $html.="<option value='".$row['default_name']."' selected>".$row['default_name']."</option>";
            else
                $html.="<option value='".$row['default_name']."'>".$row['default_name']."</option>";
        }
        return $html;  
    }


    public function getRawParameter($class){
        $query = $this->db->query("SELECT * FROM ref_parameter where class_name='".$class."'");
        return $query->result_array();
    }

    public function getDefaultParameter($group){
        $query = $this->db->query("SELECT default_name FROM ref_parameter where group_name='".$group."' order by default_name");
        foreach($query->result_array() as $row) 
        { 
            return preg_replace("/[\r\n]*/","",$row['default_name']);
        }
    }

    public function getGroupParameter($class){
        $parameter=array();
        $query = $this->db->query("SELECT * FROM ref_parameter where class_name='$class' order by default_name");
        foreach($query->result_array() as $row) 
        { 
            $parameter[$row['group_name']] = preg_replace("/[\r\n]*/","",$row['pre_name'] . $row['default_name']) ;
            $parameter['key-'.$row['group_name']] = $row['group_name'];
            $parameter['type-'.$row['group_name']] = $row['type'];
            $parameter['mode-'.$row['group_name']] = $row['mode'];

            //This is for datatable only//
            $parameter['dtableFilter-'.$row['group_name']] = $row['dtableFilter'];
            $parameter['dtableFilterType-'.$row['group_name']] = $row['dtableFilterType'];
        }
        return $parameter;
    }

    public function getGroupParameter_wrapText($class,$postFix){
        $parameter=array();
        $query = $this->db->query("SELECT pre_name, group_name, default_name FROM ref_parameter where class_name='$class' order by default_name");
        foreach($query->result_array() as $row) 
        { 
            $parameter[$row['group_name']] = preg_replace("/[\r\n]*/","",$row['pre_name'] . '<'.$postFix.'>'.$row['default_name'].'</'.$postFix.'>') ;
            $parameter['key-'.$row['group_name']] = $row['group_name'];
        }
        return $parameter;
    }

    public function singleLine($data,$style){
        if($style=="on")
        return $this->removeExtraSpaces(preg_replace("/[\r\n]*/","",trim($data)));
        else
        return $data;
    }

    public function removeExtraSpaces($data){
        return preg_replace("/\s\s+/", " ", $data);
    }

}