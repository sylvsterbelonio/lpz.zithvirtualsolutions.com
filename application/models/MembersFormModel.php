<?php
 if (!defined('BASEPATH')) exit('No direct script access allowed');

class MembersFormModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    private function setFamily($data){
        $html='';
        $row = explode("♮",$data);

        if($row[0]!=""){
            for($i=0; $i< count($row); $i++)
            {
            $col = explode("␦",$row[$i]);
                if($html==''){
                    $html='
                    <div class="row align-items-start">
                    <div class="col">
                        <label class="col-md-4 col-lg-12 col-form-label"><i>'.$col[0].'</i></label>   
                    </div>
                    <div class="col">
                        <label class="col-md-4 col-lg-12 col-form-label"><i>'.$col[1].'</i></label>   
                    </div>
                    <div class="col">
                        <label class="col-md-4 col-lg-12 col-form-label"><i>'.$col[2].'</i></label>    
                    </div>
                    <div class="col">
                        <label class="col-md-4 col-lg-12 col-form-label"><i>'.$col[3].'</i></label>    
                    </div>    
                    <div class="col">
                        <label class="col-md-4 col-lg-12 col-form-label"><i>'.$col[4].'</i></label>    
                    </div>  
                    <div class="col">
                        <label class="col-md-4 col-lg-12 col-form-label"><i>'.$col[5].'</i></label>    
                    </div>       
                    <div class="col">
                        <label class="col-md-4 col-lg-12 col-form-label"><i>'.$col[6].'</i></label>    
                    </div>                                                          
                    </div>';
                }else{
                    $html.='
                    <div class="row align-items-start">
                    <div class="col">
                        <label class="col-md-4 col-lg-12 col-form-label"><i>'.$col[0].'</i></label>   
                    </div>
                    <div class="col">
                        <label class="col-md-4 col-lg-12 col-form-label"><i>'.$col[1].'</i></label>   
                    </div>
                    <div class="col">
                        <label class="col-md-4 col-lg-12 col-form-label"><i>'.$col[2].'</i></label>    
                    </div>
                    <div class="col">
                        <label class="col-md-4 col-lg-12 col-form-label"><i>'.$col[3].'</i></label>    
                    </div>    
                    <div class="col">
                        <label class="col-md-4 col-lg-12 col-form-label"><i>'.$col[4].'</i></label>    
                    </div>  
                    <div class="col">
                        <label class="col-md-4 col-lg-12 col-form-label"><i>'.$col[5].'</i></label>    
                    </div>       
                    <div class="col">
                        <label class="col-md-4 col-lg-12 col-form-label"><i>'.$col[6].'</i></label>    
                    </div>                                                          
                    </div>';
                }
            }

        }
       

        return $html;
    }
    private function setCheckBox($data,$date,$who){

    if($data==1){

        if($who==""){
            return '
            <label class="col-md-3 col-lg-12 col-form-label"><i>Yes</i></label>     
                        <label class="col-md-4 col-lg-3 col-form-label"><small>When</small></label>     
                        <label class="col-md-4 col-lg-6 col-form-label"><i>'.$date.'</i></label>   
            ';
        }else{
            return '
            <label class="col-md-3 col-lg-12 col-form-label"><i>Yes</i></label>     
                        <label class="col-md-4 col-lg-3 col-form-label"><small>When</small></label>     
                        <label class="col-md-4 col-lg-6 col-form-label"><i>'.$date.'</i></label> 
                        <label class="col-md-4 col-lg-3 col-form-label"><small>Who</small></label>     
                        <label class="col-md-4 col-lg-6 col-form-label"><i>'.$who.'</i></label>     
            ';
        }

       
    }else{
        return '
        <label class="col-md-4 col-lg-3 col-form-label"><i>N/A</i></label>';
    }
    }

    public function get_quick_preview($data){
        return '
            <label class="col-md-4 col-lg-4 col-form-label"><b class="text-primary">PERSONAL INFORMATION</b></label>
            <div class="row align-items-start">
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Nickname</b></label>
                    <label class="col-md-8 col-lg-12 col-form-label"><i>'.$data['nickname'].'</i></label>         
                </div>
                <div class="col">
                <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">First Name</b></label>
                    <label class="col-md-8 col-lg-12 col-form-label"><i>'.$data['first_name'].'</i></label>         
                </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Middle Name</b></label>
                    <label class="col-md-8 col-lg-12 col-form-label"><i>'.$data['middle_name'].'</i></label>         
                </div>                
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Last Name</b></label>
                    <label class="col-md-8 col-lg-12 col-form-label"><i>'.$data['last_name'].'</i></label>      
                </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Name Ext</b></label>
                    <label class="col-md-8 col-lg-12 col-form-label"><i>'.$data['name_ext'].'</i></label>      
                </div>                


            </div>
            <div class="row align-items-start">
            <div class="col">
                <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Date of Birth</b></label>
                <label class="col-md-4 col-lg-12 col-form-label"><i>'.$data['date_of_birth'].'</i></label>      
            </div>

            <div class="col">
                <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Place of Birth</b></label>
                <label class="col-md-8 col-lg-12 col-form-label"><i>'.$data['place_of_birth'].'</i></label>      
            </div>
            <div class="col">
                <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Gender</b></label>
                <label class="col-md-8 col-lg-12 col-form-label"><i>'.$data['sex'].'</i></label>      
            </div>

            <div class="col">
            <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Civil Status</b></label>
            <label class="col-md-4 col-lg-12 col-form-label"><i>'.$data['civil_status'].'</i></label>      
            </div>

            <div class="col">
                <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Occupation</b></label>
                <label class="col-md-4 col-lg-12 col-form-label"><i>'.$data['occupation'].'</i></label>         
            </div>

            </div>
              

            <label class="col-md-4 col-lg-4 col-form-label"><b class="text-primary">FAMILY BACKGROUND</b></label>
            <div class="row align-items-start">
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Name</b></label>   
                </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Birthdate</b></label>   
                </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Age</b></label>    
                </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Occupation</b></label>    
                </div>    
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Condition</b></label>    
                </div>  
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Relationship</b></label>    
                </div>       
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Contact No</b></label>    
                </div>                                                          
            </div>
            '.$this->setFamily($data['family']).'


            <label class="col-md-4 col-lg-4 col-form-label"><b class="text-primary">CONTACT/SOCIAL INFORMATION</b></label>  
            <div class="row align-items-start">
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Mobile No</b></label>
                    <label class="col-md-4 col-lg-12 col-form-label"><i>'.$data['con_mobile_no'].'</i></label>         
                </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Tel No</b></label>
                    <label class="col-md-4 col-lg-12 col-form-label"><i>'.$data['con_tel_no'].'</i></label>   
                </div>
                <div class="col">
                <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Facebook</b></label>
                    <label class="col-md-4 col-lg-12 col-form-label"><i>'.$data['soc_facebook_url'].'</i></label>         
                </div>
               
            </div>

            <label class="col-md-4 col-lg-4 col-form-label"><b class="text-primary">PERMANENT ADDRESS</b></label>  
            <div class="row align-items-start">
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Address</b></label>
                    <label class="col-md-4 col-lg-12 col-form-label"><i>'.$data['loc_address'].'</i></label>         
                </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Barangay</b></label>
                    <label class="col-md-4 col-lg-12 col-form-label"><i>'.$data['loc_barangay'].'</i></label>                 
                </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Municipality / City</b></label>
                    <label class="col-md-4 col-lg-12 col-form-label"><i>'.$data['loc_city'].'</i></label> 
                </div>
            </div>  
            <div class="row align-items-start">
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Province</b></label>
                    <label class="col-md-4 col-lg-12 col-form-label"><i>'.$data['loc_province'].'</i></label>         
                </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Zipcode</b></label>
                    <label class="col-md-4 col-lg-12 col-form-label"><i>'.$data['loc_zipcode'].'</i></label>                 
                </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Country</b></label>
                    <label class="col-md-4 col-lg-12 col-form-label"><i>'.$data['loc_country'].'</i></label> 
                </div>
            </div>   


            <label class="col-md-4 col-lg-4 col-form-label"><b class="text-primary">MINISTRY MEMBERS STATUS</b></label>  
            <div class="row align-items-start">
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Visitor</b></label>
                    '.$this->setCheckBox($data['visitor'],$data['visitor_dt'],"").'   
                </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">1st Timer</b></label>
                        '.$this->setCheckBox($data['1st_timer'],$data['1st_timer_dt'],"").'  
                </div>                        
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">2nd Timer</b></label>
                    '.$this->setCheckBox($data['2nd_timer'],$data['2nd_timer_dt'],"").'                  
                </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Evangelized</b></label>
                        '.$this->setCheckBox($data['evangelized'],$data['evangelized_dt'],"").'                  
                </div>                
            </div>  
            <div class="row align-items-start">
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Encountered</b></label>
                    '.$this->setCheckBox($data['encountered'],$data['encountered_dt'],"").'   
                </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Reencountered</b></label>
                        '.$this->setCheckBox($data['reencountered'],$data['reencountered_dt'],"").'  
                </div>                        
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Baptized</b></label>
                    '.$this->setCheckBox($data['baptized'],$data['baptized_dt'],$data['baptized_who']).'                  
                </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Regular Attendant</b></label>
                        '.$this->setCheckBox($data['regular_attendant'],$data['regular_attendant_dt'],"").'                  
                </div>                
            </div>  
            
            <label class="col-md-4 col-lg-4 col-form-label"><b class="text-primary">SPIRITUAL TRAINING</b></label>  
            <div class="row align-items-start">
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">SOYONEL</b></label>
                    '.$this->setCheckBox($data['simbanay'],$data['simbanay_dt'],"").'   
                </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Life Class</b></label>
                        '.$this->setCheckBox($data['lifeclass'],$data['lifeclass_dt'],"").'  
                </div>                        
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">SOL 1</b></label>
                    '.$this->setCheckBox($data['sol1'],$data['sol1_dt'],"").'                  
                </div>           
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">SOL 2</b></label>
                    '.$this->setCheckBox($data['sol2'],$data['sol2_dt'],"").'   
                </div>                   
            </div>  
            <div class="row align-items-start">
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">SOL 3</b></label>
                        '.$this->setCheckBox($data['sol3'],$data['sol3_dt'],"").'  
                </div>                        
                <div class="col">                 
                </div>    
                <div class="col">                 
                </div>    
                <div class="col">                 
                </div>              
            </div>  


            <label class="col-md-4 col-lg-4 col-form-label"><b class="text-primary">USER ACCOUNT</b></label>  
            <div class="row align-items-start">
               
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Email Address</b></label>
                    <label class="col-md-4 col-lg-12 col-form-label"><i>'.$data['email'].'</i></label>   
                </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Username</b></label>
                    <label class="col-md-4 col-lg-12 col-form-label"><i>'.$data['username'].'</i></label>   
                    </div>
                <div class="col">
                    <label class="col-md-4 col-lg-12 col-form-label"><b class="text-secondary">Password</b></label>
                    <label class="col-md-4 col-lg-12 col-form-label"><i>'.$data['password'].'</i></label>   
                </div>
            </div>  
           

        </div>  

    ';
}

    public function get_quick_add_form($churchID){
    $button = $this->ParameterModel->getGroupParameter('button');
    $modal = $this->ParameterModel->getGroupParameter('modal');
    $input = $this->ParameterModel->getGroupParameter('input');
    $width = $this->ParameterModel->getGroupParameter('col-width');
    return 
    '
    asda
   ';
}


}





    