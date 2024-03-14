<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Popup {

    function __construct(){
        $this->CI = & get_instance();
    }

    public function Popup_Profile()
    {
        $userAccountInfo = $this->CI->AuthModel->getLoginInfo($_SESSION['username']);

        return $this->wrapper('
        <li class="nav-item dropdown pe-3">
             <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
               <img src="'. (isset($userAccountInfo['profile_photo_path']) ? $userAccountInfo['profile_photo_path'] : 'assets/images/default-photo_square.png' ) .'" alt="Profile" class="rounded-circle">
               <span class="d-none d-md-block dropdown-toggle ps-2">'. $_SESSION['username'] .'</span>
             </a><!-- End Profile Iamge Icon -->
   
             <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header" style="list-style-type: none">
                    <h6>'. $_SESSION['username'] .'</h6>
                    <span>' . $_SESSION['accessLevelName'] .'</span>
               </li>
          

               <li>
                 <div class="form-check form-switch">
                    <label class="custom-control-label" for="darkSwitch" style="margin-left:10px">Dark Mode</label>
                        <input type="checkbox" class="form-check-input" id="darkSwitch" style="margin-left:5px">
                             
                    </div>
                 </li>
                <li>
                 <a class="dropdown-item d-flex align-items-center" href="profile">
                    <i class="bi bi-person"></i>
                    <span>My Profile</span>
                 </a>
               </li>
               <li>
                    <hr class="dropdown-divider">
               </li>
   
            
           
   
               <li>
                 <a class="dropdown-item d-flex align-items-center" href="'.base_url('logout') .'">
                   <i class="bi bi-box-arrow-right"></i>
                   <span>Sign Out</span>
                 </a>
               </li>
   
             </ul><!-- End Profile Dropdown Items -->
           </li><!-- End Profile Nav -->    
        ');
    }

    private function wrapper($data){
        return $this->CI->ParameterModel->singleLine($data,"on");
    }

}