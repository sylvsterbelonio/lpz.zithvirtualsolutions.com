<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Member {

    function __construct(){
        $this->CI = & get_instance();
    }

    private function get_members(){

        $html='';
        $query = $this->CI->MembersModel->getMembers("","");

        foreach($query as $row) {
            $html.='
            <div class="col-lg-6">
            <div class="card mb-1">
                <div class="card-body p-0">
                    <div class="d-flex bd-highlight">
                        <div class="p-2 bd-highlight">
                            <img class="rounded mx-auto d-block" src="'.base_url($row['profile_photo_path']).'" style="width:100%;max-height:100px;max-width:100px;min-width:110px">
                        </div>
                        <div class="p-2 bd-highlight ">
                            <div class="d-flex flex-column-reverse bd-highlight mt-4">
                                <div class="bd-highlight"><i>'.$row['roleName'].'</i></div>
                                <div class="bd-highlight"><b>'.$row['first_name'].' ' . $row['middle_name'] . ' ' . $row['last_name']  .'</b></div>
                            </div>    
                        </div>
                      
                        <div class="ms-auto p-2 mt-2 bd-highlight">
                            <div class="filter mt-4 me-2 p-1 ps-2 pe-2 rounded-5 btn-sm more-button" data-bs-toggle="dropdown">
                                <a class="icon " href="#" ><i class="bi bi-three-dots-vertical"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow ms-2">
                                    <li><a class="dropdown-item" href="#">View Profile</a></li>
                                    <li><a class="dropdown-item" href="#">Remove</a></li>
                                    <li><a class="dropdown-item" href="#">Report</a></li>
                                </ul>
                                </div>
                            </div>
                        </div>    
                    </div>                   
                </div>             
            </div>
            ';


           }  

           return $html;

    }

    public function view_member(){

        return $this->wrapper('

        <div class="p-3 ">

            <div class="row g-2 mb-3">
            <div class="col-lg-3">
            <div class="card mb-0">
                <div class="input-group">
                    <input id="txtSearchChurch" class="form-control border-end-0 border" type="search" placeholder="Search Name" value="" id="example-search-input" />
                    <span class="input-group-append">
                        <button id="iconSearchChurch" class="search-button btn btn-outline-primary rounded-end border " type="button">
                            <i class="bi bi-search"></i>
                        </button>
                        </span>
                    </div>
                </div>    
            </div>

                    <div class="col-lg-9">
                    <div class="card mb-0">
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                            <label class="btn btn-outline-primary search-group" for="btnradio1">All</label>
                        
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                            <label class="btn btn-outline-primary search-group" for="btnradio2">Primary Leaders</label>
                        
                            <input type="radio" class="btn-check search-radio-group" name="btnradio" id="btnradio3" autocomplete="off">
                            <label class="btn btn-outline-primary search-radio-group" for="btnradio3">Disciples</label>

                            <input type="radio" class="btn-check search-radio-group" name="btnradio" id="btnradio4" autocomplete="off">
                            <label class="btn btn-outline-primary search-radio-group" for="btnradio4">Members</label>
                        </div>
                    </div>    
                    </div>
                  
            </div>

            <div class="row g-2">
                    <!-- START -->
                    '.$this->get_members().'
                    <!-- END OF START -->  
            </div>   
            
        </div> 
 
        
        </div>
        ');
    }

    public function quick_add_form($churchID){
       
        $button = $this->CI->ParameterModel->getGroupParameter('button');
        $modal = $this->CI->ParameterModel->getGroupParameter('modal');
        $input = $this->CI->ParameterModel->getGroupParameter('input');
        $width = $this->CI->ParameterModel->getGroupParameter('col-width');
        $heading =  $this->CI->ParameterModel->getGroupParameter('heading');

        
        return $this->wrapper('
        <div class="content pt-4 ps-4 pe-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body ps-4 pe-4 pt-2 ">
                        <label for="profileImage" class="col-md-4 col-lg-12 col-form-label"><b>PERSONAL INFORMATION</b></label>
                        

                        '.
                        $this->CI->field->input_text_profile($input['key-nickname'],$input['nickname'],"",$width['label'],$width['div-input'])
                        .'
                        '.
                        $this->CI->field->input_text_profile($input['key-first_name'],$input['first_name'],"",$width['label'],$width['div-input'])
                        .'
                        '.
                        $this->CI->field->input_text_profile($input['key-middle_name'],$input['middle_name'],"",$width['label'],$width['div-input'])
                        .'
                        '.
                        $this->CI->field->input_text_profile($input['key-last_name'],$input['last_name'],"",$width['label'],$width['div-input'])
                        .'
                        '.
                        $this->CI->field->input_text_profile($input['key-name_ext'],$input['name_ext'],"",$width['label'],$width['div-input'])
                        .'
                        '.
                        $this->CI->field->input_date_profile($input['key-date_of_birth'],$input['date_of_birth'],"",$width['label'],$width['div-input'])
                        .'                       
                        '.
                        $this->CI->field->input_text_profile($input['key-place_of_birth'],$input['place_of_birth'],"",$width['label'],$width['div-input'])
                        .'
                        '.
                        $this->CI->field->input_radio_profile($input['key-sex'],$input['sex'],"Unspecified",$input['mode-sex'],$width['label'],$width['div-input'])
                        .'                            
                                  
                        '.
                        $this->CI->field->input_select_profile($input['key-CivilStatus'],$input['CivilStatus'],$this->CI->ParameterModel->getDefaultParameterList('Civil Status',""),$width['label'],$width['div-input'])
                        .'                         
                                
                        '.
                        $this->CI->field->input_autocomplete_profile("occupation",'Occupation',"",$width['label'],$width['div-input'],"occupation.profile",10)        
                        .
                        '
                    </div>
                </div>    

                <div class="card">
                    <div class="card-body ps-4 pe-4 pt-2">
                        <label class="col-md-4 col-lg-12 col-form-label"><b>CONTACT INFORMATION</b></label>

                        <div class="row mb-3">
                            <label for="yourZipcode" class="col-md-4 col-lg-4 col-form-label">Mobile No.</label>
                            <div class="col-md-8 col-lg-8"> 
                                <input id="txtmobileno" type="text" name="contactno" class="form-control" id="yourcontactno" required value="">
                                <div id="feedback_contactno" class="text-danger feedback-panel"></div>
                            </div>   
                        </div>
                        <div class="row mb-3">
                            <label for="yourTelNo" class="col-md-4 col-lg-4 col-form-label">Telephone No.</label>
                            <div class="col-md-8 col-lg-8"> 
                                <input id="txttelno" type="text" name="telno" class="form-control" id="yourTelNo" required value="">
                                <div id="feedback_telno" class="text-danger feedback-panel"></div>
                            </div>   
                        </div>  

                    </div>
                </div>    

                <div class="card">
                    <div class="card-body ps-4 pe-4 pt-2 ">
                        <label class="col-md-4 col-lg-12 col-form-label"><b>SOCIAL INFORMATION</b></label>

                        <div class="row mb-3">
                            <label for="yourFacebook" class="col-md-4 col-lg-4 col-form-label">Facebook Url</label>
                            <div class="col-md-8 col-lg-8"> 
                                <input id="txtfacebook" type="text" name="telno" class="form-control" id="yourFacebook" required value="">
                                <div id="feedback_telno" class="text-danger feedback-panel"></div>
                            </div>   
                        </div>                          

                    </div>
                </div>                               
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body ps-4 pe-4 pt-2 mb-2">
                        <label for="profileImage" class="col-md-4 col-lg-12 col-form-label"><b>MINISTRY MEMBERS STATUS</b></label>

                        <div class="row mb-3">
                        <label class="col-md-4 col-lg-4 col-form-label">Church Role</label>
                        <div class="col-md-8 col-lg-8">
                            <select id="cboChurchRole" class="form-select" aria-label="- Select Church Role -">
                            '.$this->CI->ParameterModel->getChurchRoleParameterList("Member").'
                            </select>
                        </div>
                    </div>


                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chkVisitor" onclick="openDate(this,\'visitor\')">
                            <label class="form-check-label" for="chkVisitor">
                                Visitor
                            </label>
                        </div>
                        <div id="visitor" class="row mb-3 checkbox-panel d-none">
                            <label for="yourtxtDateVisited" class="col-md-4 col-lg-4 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date Visited</label>
                            <div class="col-md-8 col-lg-8 "> 
                                <input id="txtDateVisited" type="date" name="date_of_birth" class="form-control"  id="yourtxtDateVisited" required value="">
                            </div>   
                        </div>  

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chk1stTimer" onclick="openDate(this,\'1st-timer\')">
                            <label class="form-check-label" for="chk1stTimer">
                                1st Timer
                            </label>
                        </div>
                        <div id="1st-timer" class="row mb-3 checkbox-panel d-none">
                            <label for="yourtxtDateVisited" class="col-md-4 col-lg-4 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date Visited</label>
                            <div class="col-md-8 col-lg-8"> 
                                <input id="txtDateVisited_1stTimer" type="date" name="date_1st_timer" class="form-control"  id="yourtxtDateVisited" required value="">
                            </div>   
                        </div> 
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chk2ndTimer" onclick="openDate(this,\'2nd-timer\')">
                            <label class="form-check-label" for="chk2ndTimer">
                                2nd Timer
                            </label>
                        </div>
                        <div id="2nd-timer" class="row mb-3 checkbox-panel d-none">
                            <label for="yourtxtDateVisited" class="col-md-4 col-lg-4 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date Visited</label>
                            <div class="col-md-8 col-lg-8"> 
                                <input id="txtDateVisited_2ndTimer" type="date" name="date_2nd_timer" class="form-control"  id="yourtxtDateVisited" required value="">
                            </div>   
                        </div> 

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chkEvangelized" onclick="openDate(this,\'evangelized\')">
                            <label class="form-check-label" for="chkEvangelized">
                                Evangelized
                            </label>
                        </div>
                        <div id="evangelized" class="row mb-3 checkbox-panel d-none">
                            <label for="yourtxtDateEvangelized" class="col-md-4 col-lg-4 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;When</label>
                            <div class="col-md-8 col-lg-8"> 
                                <input id="txtDateEvangelized" type="date" name="date_evangelized" class="form-control"  id="yourtxtDateEvangelized" required value="">
                            </div>   
                        </div> 

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chkEncounter" onclick="openDate(this,\'encounter\')">
                            <label class="form-check-label" for="chkEncounter">
                                Encountered
                            </label>
                        </div>
                        <div id="encounter" class="row mb-3 checkbox-panel d-none">
                            <label for="yourtxtDateEncountered" class="col-md-4 col-lg-4 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;When</label>
                            <div class="col-md-8 col-lg-8"> 
                                <input id="txtDateEncountered" type="date" name="date_encountered" class="form-control"  id="yourtxtDateEncountered" required value="">
                            </div>   
                        </div>      
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chkReEncounter" onclick="openDate(this,\'reencounter\')">
                            <label class="form-check-label" for="chkReEncounter">
                                Reencountered
                            </label>
                        </div>
                        <div id="reencounter" class="row mb-3 checkbox-panel d-none">
                            <label for="yourtxtDateReEncountered" class="col-md-4 col-lg-4 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;When</label>
                            <div class="col-md-8 col-lg-8"> 
                                <input id="txtDateReEncountered" type="date" name="date_reencountered" class="form-control"  id="yourtxtDateReEncountered" required value="">
                            </div>   
                        </div>                            

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chkBaptized" onclick="openDate(this,\'Baptized\')">
                            <label class="form-check-label" for="chkBaptized">
                                Baptized
                            </label>
                        </div>
                        <div id="Baptized" class="row mb-3 checkbox-panel d-none">
                            <label for="yourtxtDateBaptized" class="col-md-4 col-lg-4 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;When</label>
                            <div class="col-md-8 col-lg-8"> 
                                <input id="txtDateBaptized" type="date" name="date_baptized" class="form-control"  id="yourtxtDateBaptized" required value="">
                            </div> 

                            <label for="yourLastName" class="col-md-4 col-lg-4 col-form-label pt-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Who</label>
                            <div class="col-md-8 col-lg-8 pt-3"> 
                                <input id="txtWhoBaptized" type="text" name="last_name" class="form-control" id="yourLastName" required value="">
                            </div>                           
                        </div> 

                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="chkRegularAttendant" onclick="openDate(this,\'regularchurchattendant\')">
                        <label class="form-check-label" for="chkRegularAttendant">
                            Regular Church Attendant
                        </label>
                    </div>
                    <div id="regularchurchattendant" class="row mb-3 checkbox-panel d-none">
                        <label for="yourtxtDateRegularAttendant" class="col-md-4 col-lg-4 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;When</label>
                        <div class="col-md-8 col-lg-8"> 
                            <input id="txtDateRegularAttendant" type="date" name="date_regular_attendant" class="form-control"  id="yourtxtDateRegularAttendant" required value="">
                        </div>   
                    </div>                         
                                 

                    </div>
                </div>    
                <div class="card">
                    <div class="card-body ps-4 pe-4 pt-2 mb-2">
                        <label class="col-md-4 col-lg-12 col-form-label"><b>SPIRITUAL TRAINING</b></label>
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="chkSimbanay" onclick="openDate(this,\'simbanay\')">
                        <label class="form-check-label" for="chkSimbanay">
                            SOYONEL / Simbanay Graduate
                        </label>
                    </div>
                    <div id="simbanay" class="row mb-3 checkbox-panel d-none">
                        <label for="yourtxtDateSimbanayGraduated" class="col-md-4 col-lg-4 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;When</label>
                        <div class="col-md-8 col-lg-8"> 
                            <input id="txtDateSimbanayGraduated" type="date" name="date_simbanay_graduated" class="form-control"  id="yourtxtDateSimbanayGraduated" required value="">
                        </div>   
                    </div>  

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="chkLifeClass" onclick="openDate(this,\'lifeclass\')">
                        <label class="form-check-label" for="chkLifeClass">
                            LifeClass Graduate
                        </label>
                    </div>
                    <div id="lifeclass" class="row mb-3 checkbox-panel d-none">
                        <label for="yourtxtDateLifeClassGraduated" class="col-md-4 col-lg-4 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;When</label>
                        <div class="col-md-8 col-lg-8"> 
                            <input id="txtDateLifeClassGraduated" type="date" name="date_lifeclass_graduated" class="form-control"  id="yourtxtDateLifeClassGraduated" required value="">
                        </div>   
                    </div> 

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="chkSOL1" onclick="openDate(this,\'sol1\')">
                        <label class="form-check-label" for="chkSOL1">
                            School of Leaders 1 Graduate
                        </label>
                    </div>
                    <div id="sol1" class="row mb-3 checkbox-panel d-none">
                        <label for="yourtxtDateSOL1Graduated" class="col-md-4 col-lg-4 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;When</label>
                        <div class="col-md-8 col-lg-8"> 
                            <input id="txtDateSOL1Graduated" type="date" name="date_sol1_graduated" class="form-control"  id="yourtxttxtDateSOL1Graduated" required value="">
                        </div>   
                    </div> 
                    
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="chkSOL2" onclick="openDate(this,\'sol2\')">
                        <label class="form-check-label" for="chkSOL2">
                            School of Leaders 2 Graduate
                        </label>
                    </div>
                    <div id="sol2" class="row mb-3 checkbox-panel d-none">
                        <label for="yourtxtDateSOL2Graduated" class="col-md-4 col-lg-4 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;When</label>
                        <div class="col-md-8 col-lg-8"> 
                            <input id="txtDateSOL2Graduated" type="date" name="date_sol2_graduated" class="form-control"  id="yourtxtDateSOL2Graduated" required value="">
                        </div>   
                    </div>   

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="chkSOL3" onclick="openDate(this,\'sol3\')">
                        <label class="form-check-label" for="chkSOL3">
                            School of Leaders 3 Graduate
                        </label>
                    </div>
                    <div id="sol3" class="row mb-3 checkbox-panel d-none">
                        <label for="yourtxtDateSOL2Graduated" class="col-md-4 col-lg-4 col-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;When</label>
                        <div class="col-md-8 col-lg-8"> 
                            <input id="txtDateSOL3Graduated" type="date" name="date_sol2_graduated" class="form-control"  id="yourtxtDateSOL2Graduated" required value="">
                        </div>   
                    </div>                       

                    </div>
                </div>      
                             
                <div class="card">
                    <div class="card-body ps-4 pe-4 pt-2">
                        <label class="col-md-4 col-lg-12 col-form-label"><b>PERMANENT ADDRESS</b></label>
                            '.
                            $this->CI->field->input_textarea_profile("RelAddress","Address","",$width['label'],$width['div-input'])
                            .
                            $this->CI->field->input_autocomplete_profile("RelCountry","Country","",$width['label'],$width['div-input'],"NAME_0.spatial_location",10)                 
                            .                   
                            $this->CI->field->input_autocomplete_profile("RelProvince","Province","",$width['label'],$width['div-input'],"NAME_1.spatial_location",10)
                            .
                            $this->CI->field->input_autocomplete_profile("RelCity","City","",$width['label'],$width['div-input'],"NAME_2.spatial_location",10)              
                            .                   
                            $this->CI->field->input_autocomplete_profile("RelBarangay",'Barangay',"",$width['label'],$width['div-input'],"NAME_3.spatial_location",10)        
                            .
                            $this->CI->field->input_autocomplete_profile("RelZipCode","Zipcode","",$width['label'],$width['div-input'],"loc_zipcode.profile",10)
                            .' 
                    </div>
                </div>

                <div class="card">
                    <div class="card-body ps-4 pe-4 pt-2 mb-2">
                        <label class="col-md-4 col-lg-12 col-form-label"><b>USER ACCOUNT</b></label>

                        <div id="user-account" class="row mb-3">
                            <label for="yourTelNo" class="col-md-4 col-lg-4 col-form-label">Email</label>
                            <div class="col-md-8 col-lg-8"> 
                                <input id="txtEmailAddress" type="text" name="telno" class="form-control" id="yourTelNo" required value="">
                             <div id="feedback_email_address" class="text-danger feedback-panel"></div>
                        </div>   
                            <label for="yourtxtDateBaptized" class="col-md-4 col-lg-4 col-form-label pt-3">Username</label>
                            <div class="col-md-8 col-lg-8 pt-3"> 
                                <input id="txtusername" type="text" name="date_baptized" class="form-control"  id="yourtxtDateBaptized" required value="">
                                    <div id="feedback_username" class="text-danger feedback-panel"></div>
                                </div> 
                            <label for="yourLastName" class="col-md-4 col-lg-4 col-form-label pt-3">Password</label>
                            <div class="col-md-8 col-lg-8 pt-3"> 
                                <input id="txtdefault_password" type="text" name="last_name" class="form-control" id="yourLastName" required value="'.$this->CI->ParameterModel->getDefaultParameter('Password').'">
                                <div id="feedback_password" class="text-danger feedback-panel"></div>
                            </div>     
                        
                        </div> 

                    </div>
                </div>                    

            </div>        
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <dic class="col-lg-12">
                        <div class="card">
                            <div class="row">
                                <div class="card-body  col-lg-6">                                   
                                    '.
                                    $this->CI->field->label_quick_add("FAMILY BACKGROUND",'ms-3 mt-4')
                                    .
                                    $this->CI->field->input_text_profile_rowClass($input['key-relName'],$input['relName'],"",$width['label'],$width['div-input'],'me-1 ms-1')
                                    .
                                    $this->CI->field->input_date_profile_rowClass($input['key-relDateOfBirth'],$input['relDateOfBirth'],"",$width['label'],$width['div-input'],'me-1 ms-1')
                                    .
                                    $this->CI->field->input_number_profile_rowClass($input['key-relAge'],$input['relAge'],"",$width['label'],$width['div-input'],'me-1 ms-1')
                                    .
                                    $this->CI->field->input_autocomplete_profile_rowClass($input['key-relOccupation'],$input['relOccupation'],"",$width['label'],$width['div-input'],"rel_occupation.profile_family_background",10,'me-1 ms-1')       
                                    .'                                   
                                </div>
                                <div class="card-body ps-4 pe-4 pt-2 col-lg-6">
                                    
                                    <div class="row mb-3 me-1 ms-1 mt-4">
                                        <label class="col-md-4 col-lg-4 col-form-label">Condition</label>
                                        <div class="col-md-8 col-lg-8">
                                            <select id="cboRelCondition" class="form-select" aria-label="- Select Condition -">   
                                                '.$this->CI->ParameterModel->getDefaultParameterList("Condition","").'
                                            </select>   
                                            <div id="feedback_relative" class="text-danger feedback-panel"></div>    
                                        </div>
                                    </div>                                   
                                                
                                    <div class="row mb-3 me-1 ms-1">
                                        <label class="col-md-4 col-lg-4 col-form-label">Relationship</label>
                                        <div class="col-md-8 col-lg-8">
                                            <select id="cboRelRelationship" class="form-select" aria-label="- Select Relationship -">
                                                '.$this->CI->ParameterModel->getDefaultParameterList("Relationship","").'
                                            </select>
                                            <div id="feedback_relationship" class="text-danger alert alert-danger mt-2 d-none feedback-response"></div>    
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3 me-1 ms-1">
                                        <label for="yourtxtfamilyContactNo" class="col-md-4 col-lg-4 col-form-label">Contact No.</label>
                                        <div class="col-md-8 col-lg-8"> 
                                            <input id="txtRelContactNo" type="text" name="txtfamilyContactNo" placeholder="Contact No." class="form-control" id="yourtxtfamilyContactNo" required value="">
                                            <div id="feedback_txtfamilyContactNo" class="text-danger feedback-panel"></div>
                                        </div>   
                                    </div> 

                                    <div class="text-end me-3">
                                        <button id="btnFamilyBackgroundClear" onclick="clearFamilyField()" class="btn btn-primary"><span class="bi bi-arrow-repeat me-2"></span>Clear</button>
                                        <button id="btnFamilyBackgroundAdd" onclick="addFamily()" class="btn btn-success"><span class="bi bi-plus-lg me-2"></span>Add</button>
                                    </div>

                                </div>
                            </div>

                            <!-- Table with hoverable rows -->
                            <div class="card-body">
                                <table id="table-family-background" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Birthdate</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Occupation</th>
                                        <th scope="col">Condition</th>
                                        <th scope="col">Relationship</th>
                                        <th scope="col">Contact No</th>
                                        <th scope="col">Options</th>                                    
                                    </tr>
                                </thead>
                                <tbody>                         
                                </tbody>
                                </table>
                                <!-- End Table with hoverable rows -->
                            </div>
                        </div>
                    </div>         
                </div>     
                
                <div class="text-center me-3 mb-4">
                    <button onclick="clearAllFields()" class="btn btn-primary"><span class="bi bi-arrow-repeat me-2"></span>New Record</button>           
                    <button id="btnAddRecord" onclick="addMember(\'preview\')" class="btn btn-success"><span class="bi bi-plus me-2"></span>Add Member</button>
                </div>

            </div>
        </div>
    </div>
    

    <div class="modal" id="modalDialogQuickAddMember" tabindex="-1">
                <div class="modal-dialog modal-dialog-scrollable modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Quick Preview</h5>
                      <button type="button" onclick="cancelAddMember()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="QuickPreview" class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button id="btnQCancelAddMember" onclick="cancelAddMember()" class="btn btn-danger"><span class="bi bi-x-lg me-2"></span>Cancel</button>
                        <button id="btnQSaveMember" onclick="addMember(\'add\')" type="button" class="btn btn-primary"><i class="bi bi-save me-2"></i>Confirm</button>
                    </div>
                  </div>
                </div>
    </div><!-- End Modal Dialog Scrollable-->

    <script>

    var temp_country, temp_province, temp_city, temp_barangay,temp_zipcode;

    function clearAllFields(){
        $(":input")
        .not(":button, :submit, :reset, :hidden")
        .val("")
        .prop("checked", false)
        .prop("selected", false);
        $(".checkbox-panel").addClass("d-none");
        $(".feedback-panel").text("");
        $("#table-family-background > tbody").html("");
        $("#txtnickname").focus();
        $("#txtdefault_password").val('. $this->CI->ParameterModel->getDefaultParameter('Password') .');

        set_validatino_error_clear();
    }

    function cancelAddMember(){
        $("#modalDialogQuickAddMember").modal("hide");
        $("#btnAddRecord").removeAttr("disabled");
        $("#btnAddRecord").html("<span class=\'bi bi-plus me-2\'></span>Add Member");
    }

    function addMember(action){
       

        set_validatino_error_clear();

        if(action=="preview"){
            $("#btnAddRecord").attr("disabled","disabled");
            $("#btnAddRecord").html("<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\' style=\'margin-right:10px\'></span><span class=\'visually-hidden\'>Loading...</span>Verifying");    
        }else{
            $("#btnQCancelAddMember").hide();
            $("#btnQSaveMember").attr("disabled","disabled");
            $("#btnQSaveMember").html("<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\' style=\'margin-right:10px\'></span><span class=\'visually-hidden\'>Loading...</span>Saving");    
        }
       
        $.ajax({
            url: "' . base_url() .'church/roles/quick-add-members/" + action,
            type: "post", dataType: "json",
            data:{
                nickname: $("#txtnickname").val(),
                first_name: $("#txtfirst_name").val(),
                middle_name: $("#txtmiddle_name").val(),
                last_name: $("#txtlast_name").val(),
                name_ext: $("#txtname_ext").val(),
                date_of_birth: $("#txtdate_of_birth").val(),
                place_of_birth: $("#txtplace_of_birth").val(),
                sex: $("input[name=\'sex\']:checked").val(),
                civil_status: $("#cboCivilStatus").find(":selected").val(),
                occupation: $("#txtoccupation").val(),
                con_mobile_no: $("#txtmobileno").val(),
                con_tel_no:  $("#txttelno").val(),
                soc_facebook_url:  $("#txtfacebook").val(),
                loc_country: $("#txtRelCountry").val(),
                loc_province: $("#txtRelProvince").val(),
                loc_city: $("#txtRelCity").val(),
                loc_barangay: $("#txtRelBarangay").val(),
                loc_address: $("#txtRelAddress").val(),
                loc_zipcode:  $("#txtRelZipCode").val(),
                visitor: $("#chkVisitor").is(":checked"),
                visitor_dt: $("#txtDateVisited").val(),
                f_timer: $("#chk1stTimer").is(":checked"),
                f_timer_dt: $("#txtDateVisited_1stTimer").val(),
                s_timer: $("#chk2ndTimer").is(":checked"),
                s_timer_dt: $("#txtDateVisited_2ndTimer").val(),
                evangelized: $("#chkEvangelized").is(":checked"),
                evangelized_dt: $("#txtDateEvangelized").val(),
                encountered: $("#chkEncounter").is(":checked"),
                encountered_dt: $("#txtDateEncountered").val(),
                reencountered: $("#chkReEncounter").is(":checked"),
                reencountered_dt: $("#txtDateReEncountered").val(),
                baptized: $("#chkBaptized").is(":checked"),
                baptized_who: $("#txtWhoBaptized").val(),
                baptized_dt: $("#txtDateBaptized").val(),
                regular_attendant: $("#chkRegularAttendant").is(":checked"),
                regular_attendant_dt:  $("#txtDateRegularAttendant").val(),
                simbanay:  $("#chkSimbanay").is(":checked"),
                simbanay_dt: $("#txtDateSimbanayGraduated").val(),
                lifeclass: $("#chkLifeClass").is(":checked"),
                lifeclass_dt: $("#txtDateLifeClassGraduated").val(),
                sol_o: $("#chkSOL1").is(":checked"),
                sol_o_dt: $("#txtDateSOL1Graduated").val(),
                sol_tw: $("#chkSOL2").is(":checked"),
                sol_tw_dt: $("#txtDateSOL2Graduated").val(),
                sol_th: $("#chkSOL3").is(":checked"),
                sol_th_dt: $("#txtDateSOL3Graduated").val(),
                churchRoleID: $("#cboChurchRole").find(":selected").val(),
                family: getAllRows(),
                userAccount: $("#chkUserAccount").is(":checked"),
                username: $("#txtusername").val(),
                email: $("#txtEmailAddress").val(),
                password: $("#txtdefault_password").val(),
            }, 
            success: function(data){
                console.log(data);
                if(data.response=="success"){
                    
                    if(action=="preview"){
                        $("#QuickPreview").html(data.posts);
                        $("#modalDialogQuickAddMember").modal({backdrop: "static", keyboard: false});
                        $("#modalDialogQuickAddMember").modal("show");
                    }else{
                        toastr["success"](data.message);
                        $("#modalDialogQuickAddMember").modal("hide");
                        $("#btnAddRecord").removeAttr("disabled");
                        $("#btnAddRecord").html("<span class=\'bi bi-plus me-2\'></span>Add Member");
                        $("#btnQCancelAddMember").show();
                        $("#btnQSaveMember").removeAttr("disabled","disabled");
                        $("#btnQSaveMember").html("<i class=\'bi bi-save me-2\'></i>Confirm");    

                        setTempAddress();
                            clearAllFields();
                        retriveTempAddress();

                       

                    }
                
                }else{

                    if(action=="preview"){
                    $("#btnAddRecord").removeAttr("disabled");
                    $("#btnAddRecord").html("<span class=\'bi bi-plus me-2\'></span>Add Member");
                    }

                    set_validation_error(\''.$input['key-password'].'\',data.password,"txt");
                    set_validation_error(\''.$input['key-email'].'\',data.email,"txt");
                    set_validation_error(\''.$input['key-username'].'\',data.username,"txt");
                    set_validation_error(\''.$input['key-last_name'].'\',data.last_name,"txt");
                    set_validation_error(\''.$input['key-first_name'].'\',data.first_name,"txt");

                    
                }
            }
        });


    }

    function setTempAddress(){
        temp_country = $("#txtRelCountry").val();
        temp_province = $("#txtRelProvince").val();
        temp_city = $("#txtRelCity").val();
        temp_barangay =  $("#txtRelBarangay").val();
        temp_zipcode =  $("#txtRelZipCode").val();
    }
    function retriveTempAddress(){
        $("#txtRelCountry").val(temp_country);
        $("#txtRelProvince").val(temp_province);
        $("#txtRelCity").val(temp_city);
        $("#txtRelBarangay").val(temp_barangay);
        $("#txtRelZipCode").val(temp_zipcode);
        $("#cboChurchRole").val("Member");
    }

    var number=1;

    function openDate(object,target){ if (!$(object).is(":checked")) $("#" + target).addClass("d-none");  else $("#" + target).removeClass("d-none"); }

    function clearFamilyField(){ $("#txtrelName").focus(); $("#txtrelName").val(""); $("#txtrelDateOfBirth").val("");  $("#txtrelAge").val(""); $("#txtrelOccupation").val(""); $("#cboRelCondition").val(""); $("#cboRelRelationship").val(""); $("#txtRelContactNo").val(""); $("#feedback_relName").text(""); $("#feedback_relationship").text(""); }

    function addFamily(){

        set_validatino_error_clear();
        $("#feedback_relName").text("");
        $("#feedback_relationship").text("");

        if($("#txtrelName").val()=="") {
            $("#feedback_relName").text("* The Name field is required.");
            $("#feedback_relName").removeClass("d-none");
            $("#txtrelName").focus();
        }
        else if($("#cboRelRelationship").find(":selected").val()==""){
            $("#feedback_relationship").text("* Please select a Relationship");
            $("#feedback_relationship").removeClass("d-none");
            $("#cboRelRelationship").focus();
        }
        else{

            $("#table-family-background > tbody:last").append(`
            <tr>
            <th scope="row">` + number + `</th>
            <td>` + $("#txtrelName").val() + `</td>
            <td>` + $("#txtrelDateOfBirth").val() + `</td>
            <td>` + $("#txtrelAge").val() + `</td>
            <td>` + $("#txtrelOccupation").val() + `</td>
            <td>` + $("#cboRelCondition").find(":selected").val() + `</td>
            <td>` + $("#cboRelRelationship").find(":selected").val() + `</td>
            <td>` + $("#txtRelContactNo").val()  + `</td>
            <td><span onclick="deleteRow(this)" class="btn btn-sm btn-outline-danger"><span class="bi bi-trash"/></span></td>
            </tr>
            <tr>
            `);

            number+=1;

            clearFamilyField();
        }

    }

    function deleteRow(object) {$(object).parent().parent().remove();}

    function getAllRows(){
        var data="";
        $("#table-family-background > tbody  > tr").each(function(index, tr) {
            
            if($(tr).find("td:eq(0)").text()){
                if(data=="")
                    {
                        data = $(tr).find("td:eq(0)").text() + "␦" + $(tr).find("td:eq(1)").text() + "␦" + $(tr).find("td:eq(2)").text() + "␦" + $(tr).find("td:eq(3)").text() + "␦" + $(tr).find("td:eq(4)").text() + "␦" + $(tr).find("td:eq(5)").text()  + "␦" + $(tr).find("td:eq(6)").text(); 
                    }
                else{
                    data += "♮" + $(tr).find("td:eq(0)").text() + "␦" + $(tr).find("td:eq(1)").text() + "␦" + $(tr).find("td:eq(2)").text() + "␦" + $(tr).find("td:eq(3)").text() + "␦" + $(tr).find("td:eq(4)").text() + "␦" + $(tr).find("td:eq(5)").text()  + "␦" + $(tr).find("td:eq(6)").text(); 
                    }
   
            }
            
         });
         return data;
    }

    $("#txtfirst_name,#txtlast_name").on("keyup", function(event) {autogenerateAccount();});

    function autogenerateAccount(){
        var data = $("#txtfirst_name").val().trim().replace(" ", "").toLowerCase() + $("#txtlast_name").val().trim().replace(" ", "").toLowerCase();
        $("#txtusername").val(data);
        $("#txtEmailAddress").val(data + "@lpz.com");
    }

    rel_country();
    function rel_country(country_value){$.ajax({ url: "'.base_url().'spatial",type: "post", dataType: "json",data:{search_value: $("#cboRelCountry").find(":selected").val(), type:"fetch-country"}, success: function(data){ if(data.response=="success"){ $("#cboRelCountry").html(data.html); }  } });}
    $("#cboRelCountry").on("change", function() { if($("#cboRelCountry").find(":selected").val()==""){ rel_country(); }else{ $.ajax({ url: "'. base_url().'spatial", type: "post", dataType: "json",  data:{search_value: $("#cboRelCountry").find(":selected").val(), type:"fetch-province"},  success: function(data){ if(data.response=="success"){$("#cboRelProvince").html(data.html);   $("#cboRelCity").val("- Select City/Municipality -");$("#cboRelBarangay").val("- Select Barangay -");} } }); }});       
    $("#cboRelProvince").on("change", function() {  $.ajax({  url: "'.base_url().'spatial", type: "post", dataType: "json", data:{search_value: $("#cboRelProvince").find(":selected").val(), type:"fetch-city"},  success: function(data){if(data.response=="success"){$("#cboRelCity").html(data.html);   $("#cboRelBarangay").val(1);}} }); });
    $("#cboRelCity").on("change", function() { $.ajax({ url: "'. base_url() .'spatial",  type: "post", dataType: "json",  data:{search_value: $("#cboRelCity").find(":selected").val(), type:"fetch-barangay"},   success: function(data){if(data.response=="success"){ $("#cboRelBarangay").html(data.html);    } } }); });

    toastr.options = {"closeButton": false,"debug": false, "newestOnTop": false,"progressBar": false,"positionClass": "toast-bottom-center","preventDuplicates": false,"onclick": null,"showDuration": "300","hideDuration": "1000","timeOut": "5000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}
    </script>


    
        
        ');
    }


    private function wrapper($data){
        return $this->CI->ParameterModel->singleLine($data,"on");
    }

}