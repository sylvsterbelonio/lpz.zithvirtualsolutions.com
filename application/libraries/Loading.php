<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Loading {

    function __construct(){
        $this->CI = & get_instance();
    }

    public function button_loading($button,$text,$mode){
        if($mode=='wait'){
            return $this->wrapper('
            <span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span><span class=\'visually-hidden me-2\'>Loading...</span><span class=\'ms-2\'>'.$text.'</span>
            ');
        }else{
            
        }
        
    }

    public function loading(){
        return $this->wrapper('
        <div class="d-flex align-items-center justify-content-center mt-4 ">
            <div class="spinner-grow spinner-grow-sm me-3 mt-1 " role="status">
            <span class="visually-hidden">Loading...</span> 
            </div>Loading data...
            ');
       }    

    public function loading_family(){
     return $this->wrapper('<div class="row mb-3">
     <div class="col-lg-12">
         <div class="card">
             <div class="card-body">
             <div class="d-flex align-items-center justify-content-center mt-4 ">
                 <div class="spinner-grow spinner-grow-sm me-3 mt-1 " role="status">
                 <span class="visually-hidden">Loading...</span> 
                 </div>Loading data...
             </div>
         </div>
     </div>');
    }

    private function wrapper($data){
        return $this->CI->ParameterModel->singleLine($data,"on");
    }

}