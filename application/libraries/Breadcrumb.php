<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Breadcrumb {

    function __construct(){
        $this->CI = & get_instance();
    }

    public function single_breadcrumb($name){

      return $this->wrapper('
      <!-- Page Title -->
      <div class="pagetitle">
        <h1>'.$name.'</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item active">'.$name.'</li>
          </ol>
        </nav>
      </div>
      <!-- End Page Title -->
      ');
  }

    public function breadcrumb($name){

        $app = $this->CI->ParameterModel->getGroupParameter('app');

        return $this->wrapper('
        <!-- Page Title -->
        <div class="pagetitle">
          <h1>'.$name.'</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="'.base_url('dashboard').'">'.$app['appDashboard'].'</a></li>
              <li class="breadcrumb-item active">'.$name.'</li>
            </ol>
          </nav>
        </div>
        <!-- End Page Title -->
        ');
    }

    
    public function subBreadcrump($name,$url,$subname){

        $app = $this->CI->ParameterModel->getGroupParameter('app');

        return $this->wrapper('
        <!-- Page Title -->
        <div class="pagetitle">
          <h1>'.$name.'</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="'.$app['appDomain'].'">'.$app['appDashboard'].'</a></li>
              <li class="breadcrumb-item"><a href="'.base_url($url).'">'.$name.'</a></li>
              <li class="breadcrumb-item active">'.$subname.'</li>
            </ol>
          </nav>
        </div>
        <!-- End Page Title -->
        ');
    }


    private function wrapper($data){
        return $this->CI->ParameterModel->singleLine($data,"on");
    }


}