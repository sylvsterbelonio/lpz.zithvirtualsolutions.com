<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class MenuModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }


 

    private function notify_menu($menuID){
        if($menuID!=1){
            return $this->NotificationModel->getMenu_Notification($menuID);
        }else{
            return "";
        }
    }

    public function getMenuID($title){
        $menuID=0;
        $query = $this->db->query("SELECT * from menu where menu_title='".$title."'");
        foreach($query->result_array() as $row){return $row['menuID'];}
        return $menuID;
    }

    public function populateSideMenu($selectedTitle,$menuID=0){
        
        $query = $this->db->query("SELECT * FROM  accessLevel INNER JOIN system_access  ON (`accessLevel`.`accessLevelID` = `system_access`.`accessLevelID`) INNER JOIN `menu`  ON (`system_access`.`menuID` = `menu`.`menuID`)
        WHERE menu_category='side-menu' AND menu.parentMenuID=$menuID AND `accessLevel`.`accessLevelID`=".$_SESSION['accessLevelID']." ORDER BY menu_order"); 
        $menu_html='';

        foreach($query->result_array() as $row)
            {
            //    echo $row->title;
            if($row['menu_type']=='item')
                {
                    if($selectedTitle==$row['menu_title'])
                        {
                            $menu_html .="
                            <li class='nav-item'>
                                <a class='nav-link' href='" . base_url($row['menu_url']) . "'>
                                    <i class='" . $row['menu_icon'] . "'></i>
                                    <span>" . $row['menu_title'] . "</span><span class='badge bg-danger badge-number ms-auto'>".$this->notify_menu($row['menuID'])."</span>
                                </a>
                                
                           </li>";
                        }
                    else{
                        $menu_html .="
                        <li class='nav-item'>
                            <a class='nav-link collapsed' href='" . base_url($row['menu_url']) . "'>
                                <i class='" . $row['menu_icon'] . "'></i>
                                <span>" . $row['menu_title'] . "</span><span class='badge bg-danger badge-number ms-auto'>".$this->notify_menu($row['menuID'])."</span>
                            </a>
                       </li>";
                        }
   
                        if($row['hasSubMenu']>0) $menu_html=$this->populateSideSubMenu($row['hasSubMenu'],$selectedTitle,$menu_html);
                      
                }
            else if($row['menu_type']=='dropdown')
                {
                $menu_html.="<li class='nav-item'>";
                $menu_html .="
                <a class='nav-link collapsed' data-bs-target='#".$row['menu_nav_id']."' data-bs-toggle='collapse' href='#'>
                <i class='".$row['menu_icon']."'></i><span>".$row['menu_title']."</span><i class='bi bi-chevron-down ms-auto'></i>
                </a>
                <ul id='".$row['menu_nav_id']."' class='nav-content collapse ' data-bs-parent='#sidebar-nav'>
                ";
                $menu_html=$this->populateSideSubMenu_DirectFrom_Dropdown($row['hasSubMenu'],$selectedTitle,$menu_html);
                $menu_html.="</ul></li>";
                } 
            else if($row['menu_type']=='nav-heading'){
                $menu_html .="
                <li class='nav-heading'>".$row['menu_title']."</li>";
                }       
            }
        
        return  $this->ParameterModel->singleLine($menu_html,"on");   

    }


    private function populateSideSubMenu_DirectFrom_Dropdown($menuID,$selectedTitle,$menu_html){
        
        $query = $this->db->query("SELECT * FROM menu WHERE menu_category='side-menu' AND parentMenuID=$menuID ORDER BY menu_order"); 
        foreach($query->result_array() as $row)
        {
            $menu_html .="<li>
            <a href='".base_url($row['menu_url'])."'>
              <i class='".$row['menu_icon']."'></i><span>".$row['menu_title']."</span><span class='badge bg-danger badge-number ms-auto'>".$this->notify_menu($row['menuID'])."</span>
            </a>";
        }
        return $menu_html;         
    }

    private function populateSideSubMenu($menuID,$selectedTitle,$menu_html){

        $menu_html.="<li class='nav-item'>";

        $query = $this->db->query("SELECT * FROM  accessLevel INNER JOIN system_access  ON (`accessLevel`.`accessLevelID` = `system_access`.`accessLevelID`) INNER JOIN `menu`  ON (`system_access`.`menuID` = `menu`.`menuID`)
        WHERE menu_category='side-menu' AND menu.parentMenuID=$menuID AND `accessLevel`.`accessLevelID`=".$_SESSION['accessLevelID']." ORDER BY menu_order"); 
        foreach($query->result_array() as $row)
        {

            if($row['menu_type']=='dropdown')
                {
                    $menu_html .="
                    <a class='nav-link collapsed' data-bs-target='#".$row['menu_nav_id']."' data-bs-toggle='collapse' href='#'>
                    <i class='".$row['menu_icon']."'></i><span>".$row['menu_title']."</span><i class='bi bi-chevron-down ms-auto'></i>
                    </a>
                    <ul id='".$row['menu_nav_id']."' class='nav-content collapse ' data-bs-parent='#sidebar-nav'>
                    ";

                }
            else if($row['menu_type']=='sub-item')
                {
                    $menu_html .="<li>
                    <a href='".base_url($row['menu_url'])."'>
                      <i class='".$row['menu_icon']."'></i><span>".$row['menu_title']."</span><span class='badge bg-danger badge-number ms-auto'>".$this->notify_menu($row['menuID'])."</span>
                    </a>";
                }
            else if($row['menu_type']=='nav-heading'){
                    $menu_html .="
                    <li class='nav-heading'>".$row['menu_title']."</li>";
                    }          

        }    

        $menu_html.="</ul></li>";
        return $menu_html;
    }

    public function checkMenu_If_Allowed($accessLevelID, $menu_title){
        $query = $this->db->query("SELECT * FROM `system_access`  INNER JOIN `menu`   ON (`system_access`.`menuID` = `menu`.`menuID`) WHERE accessLevelID=".$accessLevelID." AND menu_title='".$menu_title."'");
        return $query->num_rows();
    }



}