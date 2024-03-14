<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard {

    function __construct(){
        $this->CI = & get_instance();
    }

    public function rewardpoints($row){
        return $this->wrapper('
        <!-- Reward Points -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Options</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">RP<span> | Reward Points</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="color:white;background-color:#0dcaf0">
                      <i class="ri-hand-coin-line"></i>
                    </div>
                    <div class="ps-3">
                      <h6>'.number_format($row['available_RP'],0).'</h6>
                      <span class="text-black-50 small pt-1 fw-bold">Total</span><span class="text-muted small pt-2 ps-1">Earned</span>
                      <small><i>'.number_format($row['total_RP_earned'], 0).'</i></small>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Reward Points -->
        ');
    }

    public function tasklist($query){
        $html = '
        <!-- Recent Task List -->
        <div class="card">
            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                    </li>
                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
            </div>
        <div class="card-body">
            <h5 class="card-title">Recent Task <span>| Today</span></h5>
                <div class="activity">
        ';

        foreach($query->result_array() as $row)
        { 
         $html.='
                <div class="activity-item d-flex">
                    <div class="activite-label">'.$row['taskPoints'].' <span class="bi bi-capslock" style="color:#20c997"></span>  '.$row['rewardPoints'].' <span class="ri-hand-coin-line" style="color:#0dcaf0;margin-top:"></span></div>
                        <i class="bi bi-circle-fill activity-badge text-danger align-self-start"></i>
                        <div class="activity-content">
                            '.$row['taskTitle'].'<p><small>'.$row['taskDescription'].'</small></p>
                        </div>
                    </div>
                ';   
        }

        $html.='<!-- End activity item-->    
                </div>
            </div>
        </div><!-- End Recent Task list -->    
        ';

        return $this->wrapper($html);
    }

    public function achievementpoints($data){
        return $this->wrapper('
        <!-- Achievement Points -->
        <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                     <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>options</h6>
                        </li>
                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                </div>
            <div class="card-body">
                <h5 class="card-title">AP <span>| Achievement Points</span></h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="color:white;background-color:#fd7e14">
                    <i class="bi bi-award-fill"></i>
                    </div>
                    <div class="ps-3">
                        <h6>'.$data['totalAPEarned'].'</h6>
                            <span class="text-success small pt-1 fw-bold">'.$data['achieverLevel'].'</span> <span class="text-muted small pt-2 ps-1"></span>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <!-- End Achievement Points -->
        ');
    }

    public function taskpoints($row){

        $decimal = ($row['currentTP'] / $row['nextLevel']) * 100;

        return $this->wrapper('
        <!-- Task Points -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card revenue-card">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body">
              
              <h5 class="card-title">TP<span> | Task Points</span></h5>

              <div class="d-flex align-items-center">
                
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="color:white;background-color:#20c997">
                  <i class="bi bi-capslock"></i>
                </div>
                <div class="ps-3">
                  <h6>Lv '.$row['currentLevel'].'</h6>
                  <span class="text-success small pt-1 fw-bold">Next </span> <span class="text-muted small pt-2 ps-1">Exp</span>
                  <div class="progress"  role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 2px;">
                    <div class="progress-bar" style="width: '.number_format($decimal,2).'%"></div>
                  </div>
                </div>
              </div>
             
            </div>

          </div>
        </div><!-- End Task Points -->
        ');
    }

    private function wrapper($data){
        return $this->CI->ParameterModel->singleLine($data,"on");
    }



}