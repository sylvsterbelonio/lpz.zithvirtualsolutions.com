<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class RolesFormModel extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function createSelectionBar(){

        if(isset($_SESSION['currentChurchID'])){
            if($_SESSION['currentChurchID']>0){
                $church = $this->ChurchModel->getChurchInfo($_SESSION['currentChurchID']);
                if ($church == null){
                    $html='
                    <li class="nav-item dropdown"><button id="btnChurchSelector" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Select Church</button>
                    <ul class="dropdown-menu dropdown-menu-light">';   
                }else{
                    $html='
                    <li class="nav-item dropdown"><button id="btnChurchSelector" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">'.$church['church_name'].'</button>
                    <ul class="dropdown-menu dropdown-menu-light">';
                }
                
            }else{
                $html='
            <li class="nav-item dropdown"><button id="btnChurchSelector" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Select Church</button>
            <ul class="dropdown-menu dropdown-menu-light">';   
            }
            
        }else{
            $html='
            <li class="nav-item dropdown"><button id="btnChurchSelector" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Select Church</button>
            <ul class="dropdown-menu dropdown-menu-light">';
        }

        $query = $this->db->query('SELECT churchID, church_name, url_photo FROM  `church` INNER JOIN `profile`   ON (`church`.`churchID` = `profile`.`chu_churchID`) WHERE profile.`userID`='.$_SESSION['userID']);
        foreach($query->result_array() as $row) {
            $html.='<li class="d-flex flex-row">
            <a class="dropdown-item" href="#" onclick="select_church('.$row['churchID'].',\''.$row['church_name'].'\')">
            <img src="'. base_url() . $row['url_photo'].'" width=32 height=32 class="rounded-circle me-2">'
            .$row['church_name'].'</a></li><li><hr class="dropdown-divider"></li>';
        }

        $query = $this->db->query("select churchID, church_name, url_photo from church where userID=". $_SESSION['userID']);
        foreach($query->result_array() as $row) {
            $html.='<li class="d-flex flex-row">
            <a class="dropdown-item" href="#" onclick="select_church('.$row['churchID'].',\''.$row['church_name'].'\')">
            <img src="'. base_url() . $row['url_photo'].'" width=32 height=32 class="rounded-circle me-2">'
            .$row['church_name'].'</a></li>';
        }

        $html.='</ul></li>';

        return $html;
    }

    private function getMenuType(){
        $query = $this->db->query('SELECT distinct menuType from church_menu order by menuType');  
        $menu = array();
        $i = 0;
            foreach($query->result_array() as $row)
            {
                $menu[$i] = $row['menuType'];
                $i+=1;
            }
        return $menu;
    }

    private function createDashboardMenu($query){

        $menu = $this->getMenuType();

        $accordion = array();
        $btn=array();    
        $typeIcon = array();
        $typeDescription = array();

        for($i=0;$i<count($menu);$i++){
            $accordion[$menu[$i]] = '';
            $btn[$menu[$i]] = '';
            $typeIcon[$menu[$i]] = '';
            $typeDescription[$menu[$i]] = '';
        }

        $dashboard = array('header'=>'','content'=>'','footer'=>'');
         

        $accordion['header']='
        <div class="col-lg-12 pt-0 mt-0">
            <div class="card">
                <div class="card-body p-0">
                    <div class="accordion" id="accordionLeftPanel">';
        $accordion['content']='';
        $accordion['footer']='
                    </div>
                </div>
            </div>
        </div>';


        foreach($query->result_array() as $row) {
                    for($i=0;$i<count($menu);$i++){
                        if($row['menuType']==$menu[$i])
                        {
                            $btn[$menu[$i]]='btn' . $row['menuType'];
                            $typeIcon[$menu[$i]] = $row['typeIcon'];
                            $typeDescription[$menu[$i]] = $row['menuDescription'];
                            $accordion[$menu[$i]].='
                            <div class="icon border border-disabled" onclick="selectMenu(\''. $row['targetID'] .'-tab\',\''. $row['menuTitle'] .'\',\'frm'.$row['targetID'].'\',\''.$row['url'].'\')">
                                <i class="'.$row['menuIcon'].' myicon"></i>
                                <div class="label"><b>'.$row['menuTitle'].'</b></div>
                            </div>
                            ';
                        }
                    }
        }

        for($i=0;$i<count($menu);$i++){
            if($accordion[$menu[$i]]!='') $accordion[$menu[$i]] = $this->createGroupAccordion($accordion[$menu[$i]],$btn[$menu[$i]],$menu[$i],$typeIcon[$menu[$i]], $typeDescription[$menu[$i]]);
        }

        //CONCATINATION OF ALL SECTIONS//
        for($i=0;$i<count($menu);$i++){ $accordion['content'].= $accordion[$menu[$i]]; }

        $dashboard['content'] = $accordion['header'] . $accordion['content'] . $accordion['footer'];

        return $dashboard['header'] . $dashboard['content'] . $dashboard['footer'];

    }

    private function createGroupAccordion($data,$buttonID,$title,$typeIcon,$Titledescription){
            $header='
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading-'.$buttonID.'">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#'.$buttonID.'" aria-expanded="true" aria-controls="'.$buttonID.'">
                    <b class="text-primary">'.$typeIcon.'<b>'.$Titledescription.'</b></b>
                    </button>
                </h2>
                <div id="'.$buttonID.'" class="accordion-collapse collapse show" aria-labelledby="heading-'.$buttonID.'" data-bs-parent="#accordionRightPanel">
                    <div class="accordion-body">
                        <div class="iconslist">';
                        
            $footer ='
                        </div>
                    </div>
                </div>
            </div>';
        return $header . $data . $footer;
    }

    public function createTabControls($id){

        $roleID = $this->MembersModel->getChurchRoles();

        $query = $this->db->query('SELECT church_menu.church_menuID,menuDescription, typeIcon, menuIcon, menuTitle, menuType, church_menu.`order`, church_menu.`targetID`, church_menu.`url` FROM`church_access` INNER JOIN `church_menu`  ON (`church_access`.`church_menuID` = `church_menu`.`church_menuID`)  WHERE `church_access`.`churchRoleID`='.$roleID.'  ORDER BY menuType, church_menu.`order`');

        if($_SESSION['currentChurchID']==0){
            $query=$this->db->query('SELECT church_menu.church_menuID,menuDescription, typeIcon, menuIcon, menuTitle, menuType, church_menu.`order`, church_menu.`targetID`, church_menu.`url` FROM`church_access` INNER JOIN `church_menu`  ON (`church_access`.`church_menuID` = `church_menu`.`church_menuID`)  WHERE `church_access`.`churchRoleID`=-1  ORDER BY menuType, church_menu.`order`');
            return '
            <div class="opacity-25">
                <img src="'.base_url().'assets/images/select-church.png" class="img-fluid  mt-4 pt-4 mb-4 pb-4">
            </div>';
        }

        $tabControl_header='<ul class="nav nav-pills mb-0 mt-1 ms-1" id="pills-tab" role="tablist">';

        $tabControl_body='
        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-0 rounded-top" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="bi bi-grid"></i><span class="mobile-role-text ms-2">Dashboard</span></button>
        </li>';

        $tabControl_footer='</ul>';

        $content_header='<div class="tab-content mt-0 pt-0 rounded-0" id="myTabContent">';
        $content_content='<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="home-tab">
        
        '. $this->createDashboardMenu($query) .'

        </div>';
        $content_footer='</div>';


        foreach($query->result_array() as $row) {
     
            $tabControl_body.='
            <li class="roles-mobile nav-item d-none" role="presentation">
            <button class="nav-link rounded-0 rounded-top" id="'.$row['targetID'].'-tab" onclick="onTabClick(this)" data-bs-toggle="pill" data-bs-target="#'.$row['targetID'].'" type="button" role="tab"  aria-selected="false"><i class="'. $row['menuIcon'] .'"></i><span class="mobile-role-text ms-2">'.$row['menuTitle'].'</span>
            <span class="bnt btn-outline-danger ms-1"><i class="bi bi-x d-none" onclick="closeTab(this)"></i></span>
            </button>
            </li>
            ';

            $content_content.='
            <div class="tab-pane fade" id="'.$row['targetID'].'" role="tabpanel" aria-labelledby="'.$row['targetID'].'-tab">
            
                <div id="frm'.$row['targetID'].'" class="card">                                                          
               
                </div> 
            </div>';

        }

        return  $this->wrapper($tabControl_header . $tabControl_body . $tabControl_footer . $content_header . $content_content . $content_footer);
    }

    public function view_church($url){

        return 
        '
        <div class="row">


        </div>

        ';

    }

    private function wrapper($data){
        return $this->ParameterModel->singleLine($data,"on");
    }

}