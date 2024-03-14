<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Toolbar {

    function __construct(){
        $this->CI = & get_instance();
    }

    public function Admin_Toolbar(){
       $notification =  $this->CI->NotificationModel->getNotification();
       $app = $this->CI->ParameterModel->getGroupParameter('app');

       return $this->wrapper('
       <div class="d-flex align-items-center justify-content-between">
       <a href="'.$app['appDomain'].'" class="logo d-flex align-items-center">
         <img class="mobile-logo" src="'.base_url($app['appLogo']).'" alt="">
           <span class="d-none d-lg-block">'.$app['appProject'].'</span>
       </a>
       
       <i class="bi bi-list toggle-sidebar-btn"></i>
       </div><!-- End Logo -->
   
       <div class="search-bar" style="display:">
         <form class="search-form d-flex align-items-center" method="POST" action="#">
           <input type="text" name="query" placeholder="Search" title="Enter search keyword">
           <button type="submit" title="Search"><i class="bi bi-search"></i></button>
         </form>
       </div><!-- End Search Bar -->
   
       <nav class="header-nav ms-auto">
         <ul class="d-flex align-items-center">
   
           <li class="nav-item d-block d-lg-none">
             <a class="nav-link nav-icon search-bar-toggle " href="#">
               <i class="bi bi-search"></i>
             </a>
           </li><!-- End Search Icon-->
   
           <li class="nav-item dropdown" style="display:none">
   
             <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
               <i class="bi bi-chat-left-text"></i>
               <span class="badge bg-success badge-number">3</span>
             </a><!-- End Messages Icon -->
   
             <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
               <li class="dropdown-header">
                 You have 3 new messages
                 <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
               </li>
               <li>
                 <hr class="dropdown-divider">
               </li>
   
               <li class="message-item">
                 <a href="#">
                   <img src="assets/images/messages-1.jpg" alt="" class="rounded-circle">
                   <div>
                     <h4>Maria Hudson</h4>
                     <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                     <p>4 hrs. ago</p>
                   </div>
                 </a>
               </li>
               <li>
                 <hr class="dropdown-divider">
               </li>
   
               <li class="message-item">
                 <a href="#">
                   <img src="assets/images/messages-2.jpg" alt="" class="rounded-circle">
                   <div>
                     <h4>Anna Nelson</h4>
                     <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                     <p>6 hrs. ago</p>
                   </div>
                 </a>
               </li>
               <li>
                 <hr class="dropdown-divider">
               </li>
   
               <li class="message-item">
                 <a href="#">
                   <img src="assets/images/messages-3.jpg" alt="" class="rounded-circle">
                   <div>
                     <h4>David Muldon</h4>
                     <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                     <p>8 hrs. ago</p>
                   </div>
                 </a>
               </li>
               <li>
                 <hr class="dropdown-divider">
               </li>
   
               <li class="dropdown-footer">
                 <a href="#">Show all messages</a>
               </li>
   
             </ul><!-- End Messages Dropdown Items -->
   
           </li><!-- End Messages Nav -->
   
         ' . (isset($notification) ? $notification : '') . '
   
         ' . $this->CI->popup->Popup_Profile() . '
           
   
         </ul>
       </nav><!-- End Icons Navigation -->


       ');

    }

    
    private function wrapper($data){
        return $this->CI->ParameterModel->singleLine($data,"on");
    }

}