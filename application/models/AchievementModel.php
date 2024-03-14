<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class AchievementModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    //FILL UP YOUR FULL NAME taskID=1 
    public function task_controller($id,$achievementName){
       if(!$this->TaskModel->check_completed_task($id)){

            $this->TaskModel->add_users_completion($id);
            
            $data = $this->TaskModel->get_task_data($id);

            $this->RewardModel->addRewardPoints($data['rewardPoints']);
            $this->TaskModel->addTaskPoints($data['taskPoints']);

            //ACCUMULATION OF ACHIEVEMENT REWARDS//
            $this->set_achievement_completed($achievementName);
            $this->achievement_reward_indicator($achievementName);
       }
    }

    public function task_controller_Android($userID,$id,$achievementName){
      if(!$this->TaskModel->check_completed_task_Android($userID,$id)){

           $this->TaskModel->add_users_completion_Android($userID, $id);
           
           $data = $this->TaskModel->get_task_data($id);

           $this->RewardModel->addRewardPoints_Android($userID, $data['rewardPoints']);
           $this->TaskModel->addTaskPoints_Android($data['taskPoints']);

           //ACCUMULATION OF ACHIEVEMENT REWARDS//
           $this->set_achievement_completed_Android($userID, $achievementName);
           $this->achievement_reward_indicator_Android($userID,$achievementName);
      }
   }


   private function achievement_reward_indicator_Android($userID, $achievementName){
    $query = $this->db->query("SELECT * FROM users_achievement_completion where userID=".$_SESSION['userID']." and achievementName='".$achievementName."'");
    if(count( $query->result() ) > 0)
        { 
          foreach($query->result_array() as $row) 
          {
              //CHECK IF THE REWARDS IS STARTING
                     if($row['0_rewards']==0)
                      {
                      $achievment = $this->db->query("SELECT * FROM achievements where achievementName='".$achievementName."'");
                      
                      foreach($achievment->result_array() as $Achievementrow) 
                            {                             
                                if($Achievementrow['max_limit']>1)
                                    {
                                        $maxlimit = $Achievementrow['0_limit'];
                                        //THIS IS THE TIME THAT WILL TRIGGER NEW ACHIEVEMENT FROM SPECIFIC REWARDS//
                                        if($row['counter']>=$maxlimit){
                                          $data = array(
                                            'achievementCompletionID'=>$row['achievementCompletionID'],
                                            '0_rewards' => 1);
                                        $this->db->update('users_achievement_completion',$data,array('achievementCompletionID'=>$row['achievementCompletionID']));  
                                        $this->NotificationModel->notify_achievement($Achievementrow,0);
                                        $this->renew_badge(9);
                                        }
                                    }
                                else
                                    {
                                    $maxlimit = $Achievementrow['0_limit'];
                                    //THIS IS THE TIME THAT WILL TRIGGER NEW ACHIEVEMENT FROM SPECIFIC REWARDS//
                                    if($row['counter']>=$maxlimit)
                                        {
                                          $data = array(
                                            'achievementCompletionID'=>$row['achievementCompletionID'],
                                            '0_rewards' => 1);
                                        $this->db->update('users_achievement_completion',$data,array('achievementCompletionID'=>$row['achievementCompletionID']));  
                                        $this->NotificationModel->notify_achievement($Achievementrow,3);
                                        $this->renew_badge(9);
                                        }
                                    }                         
                              }
                      }
              else if($row['1_rewards']==0){
                $achievment = $this->db->query("SELECT * FROM achievements where achievementName='".$achievementName."'");
                foreach($achievment->result_array() as $Achievementrow) 
                      {
                            $maxlimit = $Achievementrow['1_limit'];
                            //THIS IS THE TIME THAT WILL TRIGGER NEW ACHIEVEMENT FROM SPECIFIC REWARDS//
                            if($row['counter']>=$maxlimit){
                              $data = array(
                                'achievementCompletionID'=>$row['achievementCompletionID'],
                                '1_rewards' => 1);
                            $this->db->update('users_achievement_completion',$data,array('achievementCompletionID'=>$row['achievementCompletionID']));  
                            $this->NotificationModel->notify_achievement($Achievementrow,1);
                            $this->renew_badge(9);
                            }
                      }  
              }        
              else if($row['2_rewards']==0){
                $achievment = $this->db->query("SELECT * FROM achievements where achievementName='".$achievementName."'");
                foreach($achievment->result_array() as $Achievementrow) 
                      {
                            $maxlimit = $Achievementrow['2_limit'];
                            //THIS IS THE TIME THAT WILL TRIGGER NEW ACHIEVEMENT FROM SPECIFIC REWARDS//
                            if($row['counter']>=$maxlimit){
                              $data = array(
                                'achievementCompletionID'=>$row['achievementCompletionID'],
                                '2_rewards' => 1);
                            $this->db->update('users_achievement_completion',$data,array('achievementCompletionID'=>$row['achievementCompletionID']));  
                            $this->NotificationModel->notify_achievement($Achievementrow,2);
                            $this->renew_badge(9);
                            }
                      }  
              }

          }
        }

  }  

    private function achievement_reward_indicator($achievementName){
      $query = $this->db->query("SELECT * FROM users_achievement_completion where userID=".$_SESSION['userID']." and achievementName='".$achievementName."'");
      if(count( $query->result() ) > 0)
          { 
            foreach($query->result_array() as $row) 
            {
                //CHECK IF THE REWARDS IS STARTING
                       if($row['0_rewards']==0)
                        {
                        $achievment = $this->db->query("SELECT * FROM achievements where achievementName='".$achievementName."'");
                        
                        foreach($achievment->result_array() as $Achievementrow) 
                              {                             
                                  if($Achievementrow['max_limit']>1)
                                      {
                                          $maxlimit = $Achievementrow['0_limit'];
                                          //THIS IS THE TIME THAT WILL TRIGGER NEW ACHIEVEMENT FROM SPECIFIC REWARDS//
                                          if($row['counter']>=$maxlimit){
                                            $data = array(
                                              'achievementCompletionID'=>$row['achievementCompletionID'],
                                              '0_rewards' => 1);
                                          $this->db->update('users_achievement_completion',$data,array('achievementCompletionID'=>$row['achievementCompletionID']));  
                                          $this->NotificationModel->notify_achievement($Achievementrow,0);
                                          $this->renew_badge(9);
                                          }
                                      }
                                  else
                                      {
                                      $maxlimit = $Achievementrow['0_limit'];
                                      //THIS IS THE TIME THAT WILL TRIGGER NEW ACHIEVEMENT FROM SPECIFIC REWARDS//
                                      if($row['counter']>=$maxlimit)
                                          {
                                            $data = array(
                                              'achievementCompletionID'=>$row['achievementCompletionID'],
                                              '0_rewards' => 1);
                                          $this->db->update('users_achievement_completion',$data,array('achievementCompletionID'=>$row['achievementCompletionID']));  
                                          $this->NotificationModel->notify_achievement($Achievementrow,3);
                                          $this->renew_badge(9);
                                          }
                                      }                         
                                }
                        }
                else if($row['1_rewards']==0){
                  $achievment = $this->db->query("SELECT * FROM achievements where achievementName='".$achievementName."'");
                  foreach($achievment->result_array() as $Achievementrow) 
                        {
                              $maxlimit = $Achievementrow['1_limit'];
                              //THIS IS THE TIME THAT WILL TRIGGER NEW ACHIEVEMENT FROM SPECIFIC REWARDS//
                              if($row['counter']>=$maxlimit){
                                $data = array(
                                  'achievementCompletionID'=>$row['achievementCompletionID'],
                                  '1_rewards' => 1);
                              $this->db->update('users_achievement_completion',$data,array('achievementCompletionID'=>$row['achievementCompletionID']));  
                              $this->NotificationModel->notify_achievement($Achievementrow,1);
                              $this->renew_badge(9);
                              }
                        }  
                }        
                else if($row['2_rewards']==0){
                  $achievment = $this->db->query("SELECT * FROM achievements where achievementName='".$achievementName."'");
                  foreach($achievment->result_array() as $Achievementrow) 
                        {
                              $maxlimit = $Achievementrow['2_limit'];
                              //THIS IS THE TIME THAT WILL TRIGGER NEW ACHIEVEMENT FROM SPECIFIC REWARDS//
                              if($row['counter']>=$maxlimit){
                                $data = array(
                                  'achievementCompletionID'=>$row['achievementCompletionID'],
                                  '2_rewards' => 1);
                              $this->db->update('users_achievement_completion',$data,array('achievementCompletionID'=>$row['achievementCompletionID']));  
                              $this->NotificationModel->notify_achievement($Achievementrow,2);
                              $this->renew_badge(9);
                              }
                        }  
                }

            }
          }

    }  

    private function set_achievement_completed($achievementName){
      
      $query = $this->db->query("SELECT * FROM users_achievement_completion where userID=".$_SESSION['userID']." and achievementName='".$achievementName."'");
      //IN CASE IF THERE IS NO DATA RECORD.//
      if(count( $query->result() ) == 0)
          {      
            $data = array(
                'userID' => $_SESSION['userID'],
                'achievementName' => $achievementName,
                'counter' => 1
            );
            return $this->db->insert('users_achievement_completion',$data);
          }
      //IN CASE IF THERE IS NEW DATA//    
          else
          {
          foreach($query->result_array() as $row) 
              {
              $data = array(
                  'achievementName' => $achievementName,
                  'userID'=>$_SESSION['userID'],
                  'counter' => 1 + $row['counter']);
             
              $this->db->query("UPDATE users_achievement_completion set counter=" . 1 + $row['counter']. " where userID=".$_SESSION['userID']. " AND achievementName='".$achievementName."'");  
            
            }
          }
    }

    private function set_achievement_completed_Android($userID, $achievementName){
      
      $query = $this->db->query("SELECT * FROM users_achievement_completion where userID=".$userID." and achievementName='".$achievementName."'");
      //IN CASE IF THERE IS NO DATA RECORD.//
      if(count( $query->result() ) == 0)
          {      
            $data = array(
                'userID' => $userID,
                'achievementName' => $achievementName,
                'counter' => 1
            );
            return $this->db->insert('users_achievement_completion',$data);
          }
      //IN CASE IF THERE IS NEW DATA//    
          else
          {
          foreach($query->result_array() as $row) 
              {
              $data = array(
                  'achievementName' => $achievementName,
                  'userID'=>$userID,
                  'counter' => 1 + $row['counter']);
             
              $this->db->query("UPDATE users_achievement_completion set counter=" . 1 + $row['counter']. " where userID=".$userID. " AND achievementName='".$achievementName."'");  
            
            }
          }
    }


    public function get_status_points(){
        $query = $this->db->query('SELECT * FROM users_points where userID='.$_SESSION['userID']);
        if(count( $query->result() ) > 0){
           
            foreach($query->result_array() as $row) {
            return $row;
            }

        }else{
            return 0;
        }
    }

    public function get_current_AP(){
        $data = $this->get_status_points();
        return $this->dashboard->achievementpoints($data);
    }

    private function get_achievement_info($achivementName){
      $query = $this->db->query("SELECT * FROM achievements where achievementName='".$achivementName."'");
      foreach($query->result_array() as $row) {
        return $row;
      }
    }
    public function get_achievement_list(){
        $sample_comple = '    <div class="icon">
        <img src="<?=base_url()?>assets/images/badges/unknown-badge.png">
        <div class="label"></div>
        <div class="alert alert-success ms-4 me-4" style="font-size: 12px">Completed</div>
        </div>';
        $claimable ='
        <div class="icon">
              <img src="<?=base_url()?>assets/images/badges/profile-badge-bronze.png">
              <div class="label"></div>
              <div class="alert alert-secondary ms-4 me-4" style="font-size: 12px">Complete your <b>Profile Task</b> 4 times.
              <br>(1/4)</div>
              <small>Rewards</small>
              <span class="bi bi-award-fill" style="color:#20c997"></span><small>100</small> <span class="bi bi-capslock" style="color:#20c997"></span>500 <span class="ri-hand-coin-line" style="color:#0dcaf0;margin-top:"></span> 700
              <span id="claim" class="badge bg-danger" value="23" style="display:nne"><span class="bi bi-arrow-bar-down" style="color:white;margin-right:5px"></span>Claim Now</span>
        </div>';

        $html = "";
        $query = $this->db->query('SELECT * FROM users_achievement_completion where userID='.$_SESSION['userID']);
        
        //IN CASE IF THERE IS A RECORD//
        $excludedID="";
        if(count( $query->result() ) > 0)
            {

                    foreach($query->result_array() as $row) {

                        $achievement = $this->get_achievement_info($row['achievementName']);
                        //ADDING A DATA TO BE EXCLUDED FROM OTHER LIST
                        if($excludedID=="") $excludedID =" where achievementID!=".$achievement['achievementID'];
                        else $excludedID .=" and achievementID!=".$achievement['achievementID'];

                        //NO REWARDS GRANTED YET//
                        if($row['0_rewards']==0){
                              $html.='
                              <div class="icon" id="icon"'.$row['achievementCompletionID'].'>
                              <h5>'.$achievement['achievementName'].'</h5>
                              <img id="img'.$achievement['achievementID'].'" src="'.base_url().$achievement['0_logo'].'">
                              <div class="label"></div>
                              <div class=" alert-light ms-4 me-4" style="font-size: 12px"><span id="requirements'.$achievement['achievementID'].'">'.$achievement['0_requirements'].'</span>
                              <br>'.$row['counter'].'/<span id="limit'.$achievement['achievementID'].'">'.$achievement['0_limit'].'</span></div>
                              <small>Rewards</small>
                              <span class="bi bi-award" style="color:#fd7e14"></span><small id="ap'.$achievement['achievementID'].'">'.$achievement['0_ap'].'</small> <span class="bi bi-capslock" style="color:#20c997"></span><span id="tp'.$achievement['achievementID'].'">'.$achievement['0_tp'].' </span><span class="ri-hand-coin-line" style="color:#0dcaf0;margin-top:"></span> <span id="rp'.$achievement['achievementID'].'">'.$achievement['0_rp'].'</span>
                              <br><span></span>
                              </div>';    
                        }
                        else if($row['0_rewards']==1){
                          $html.='
                          <div class="icon" id="icon'.$row['achievementCompletionID'].'">
                              <h5>'.$achievement['achievementName'].'</h5>
                              <img id="img'.$achievement['achievementID'].'" src="'.base_url().$achievement['0_logo'].'">
                              <div class="label"></div>
                              <div class=" alert-light ms-4 me-4" style="font-size: 12px"><span id="requirements'.$achievement['achievementID'].'">'.$achievement['0_requirements'].'</span>
                              <br>'.$row['counter'].'/<span id="limit'.$achievement['achievementID'].'">'.$achievement['0_limit'].'</span></div>
                              <small>Rewards</small>
                              <span class="bi bi-award" style="color:#fd7e14"></span><small id="ap'.$achievement['achievementID'].'">'.$achievement['0_ap'].'</small> <span class="bi bi-capslock" style="color:#20c997"></span><span id="tp'.$achievement['achievementID'].'">'.$achievement['0_tp'].' </span><span class="ri-hand-coin-line" style="color:#0dcaf0;margin-top:"></span> <span id="rp'.$achievement['achievementID'].'">'.$achievement['0_rp'].'</span>
                              <br><span id="claim" class="badge bg-danger" value="'.$row['achievementCompletionID'].'" style="display:nne"><span class="bi bi-arrow-bar-down" style="color:white;margin-right:5px"></span>Claim Now</span>
                              </div>';                          
                        }else if($row['0_rewards']==2 && $achievement['max_limit']==1){
                          $html.='
                          <div class="icon" id="icon'.$row['achievementCompletionID'].'">
                              <h5>'.$achievement['achievementName'].'</h5>
                              <img id="img'.$achievement['achievementID'].'" src="'.base_url().$achievement['1_logo'].'">
                              <div class="label"></div>
                              <div class=" alert-light ms-4 me-4" style="font-size: 12px"><span><b>'.$achievement['1_requirements'].'</b></span>
                              <br><span></span></div>
                              <small></small>
                              <span  style="color:#fd7e14"></span><small></small> <span style="color:#20c997"></span><span ></span><span  style="color:#0dcaf0;margin-top:"></span> <span></span>
                              <br><span  style="display:nne"></span>
                              </div>';  
                        }
                         
                        else if($row['0_rewards']==2 && $row['1_rewards']==0){
                          $html.='
                          <div class="icon" id="icon'.$row['achievementCompletionID'].'">
                              <h5>'.$achievement['achievementName'].'</h5>
                              <img id="img'.$achievement['achievementID'].'" src="'.base_url().$achievement['1_logo'].'">
                              <div class="label"></div>
                              <div class=" alert-light ms-4 me-4" style="font-size: 12px"><span id="requirements'.$achievement['achievementID'].'">'.$achievement['1_requirements'].'</span>
                              <br>'.$row['counter'].'/<span id="limit'.$achievement['achievementID'].'">'.$achievement['1_limit'].'</span></div>
                              <small>Rewards</small>
                              <span class="bi bi-award" style="color:#fd7e14"></span><small id="ap'.$achievement['achievementID'].'">'.$achievement['1_ap'].'</small> <span class="bi bi-capslock" style="color:#20c997"></span><span id="tp'.$achievement['achievementID'].'">'.$achievement['1_tp'].' </span><span class="ri-hand-coin-line" style="color:#0dcaf0;margin-top:"></span> <span id="rp'.$achievement['achievementID'].'">'.$achievement['1_rp'].'</span>
                              <br><span  style="display:nne"></span>
                              </div>';   
                        }else if($row['0_rewards']==2 && $row['1_rewards']==1){
                          $html.='
                          <div class="icon" id="icon'.$row['achievementCompletionID'].'">
                              <h5>'.$achievement['achievementName'].'</h5>
                              <img id="img'.$achievement['achievementID'].'" src="'.base_url().$achievement['1_logo'].'">
                              <div class="label"></div>
                              <div class=" alert-light ms-4 me-4" style="font-size: 12px"><span id="requirements'.$achievement['achievementID'].'">'.$achievement['1_requirements'].'</span>
                              <br>'.$row['counter'].'/<span id="limit'.$achievement['achievementID'].'">'.$achievement['1_limit'].'</span></div>
                              <small>Rewards</small>
                              <span class="bi bi-award" style="color:#fd7e14"></span><small id="ap'.$achievement['achievementID'].'">'.$achievement['1_ap'].'</small> <span class="bi bi-capslock" style="color:#20c997"></span><span id="tp'.$achievement['achievementID'].'">'.$achievement['1_tp'].' </span><span class="ri-hand-coin-line" style="color:#0dcaf0;margin-top:"></span> <span id="rp'.$achievement['achievementID'].'">'.$achievement['1_rp'].'</span>
                              <br><span id="claim" class="badge bg-danger" value="'.$row['achievementCompletionID'].'" style="display:nne"><span class="bi bi-arrow-bar-down" style="color:white;margin-right:5px"></span>Claim Now</span>
                              </div>';       
                        }else if($row['0_rewards']==2 && $row['1_rewards']==2 && $row['2_rewards']==0){
                          $html.='
                          <div class="icon" id="icon'.$row['achievementCompletionID'].'">
                              <h5>'.$achievement['achievementName'].'</h5>
                              <img id="img'.$achievement['achievementID'].'" src="'.base_url().$achievement['2_logo'].'">
                              <div class="label"></div>
                              <div class=" alert-light ms-4 me-4" style="font-size: 12px"><span id="requirements'.$achievement['achievementID'].'">'.$achievement['2_requirements'].'</span>
                              <br>'.$row['counter'].'/<span id="limit'.$achievement['achievementID'].'">'.$achievement['2_limit'].'</span></div>
                              <small>Rewards</small>
                              <span class="bi bi-award" style="color:#fd7e14"></span><small id="ap'.$achievement['achievementID'].'">'.$achievement['2_ap'].'</small> <span class="bi bi-capslock" style="color:#20c997"></span><span id="tp'.$achievement['achievementID'].'">'.$achievement['2_tp'].' </span><span class="ri-hand-coin-line" style="color:#0dcaf0;margin-top:"></span> <span id="rp'.$achievement['achievementID'].'">'.$achievement['2_rp'].'</span>
                              <br><span  style="display:nne"></span>
                              </div>';                            
                        }else if($row['0_rewards']==2 && $row['1_rewards']==2 && $row['2_rewards']==1){
                          $html.='
                          <div class="icon" id="icon'.$row['achievementCompletionID'].'">
                              <h5>'.$achievement['achievementName'].'</h5>
                              <img id="img'.$achievement['achievementID'].'" src="'.base_url().$achievement['2_logo'].'">
                              <div class="label"></div>
                              <div class=" alert-light ms-4 me-4" style="font-size: 12px"><span id="requirements'.$achievement['achievementID'].'">'.$achievement['2_requirements'].'</span>
                              <br>'.$row['counter'].'/<span id="limit'.$achievement['achievementID'].'">'.$achievement['2_limit'].'</span></div>
                              <small>Rewards</small>
                              <span class="bi bi-award" style="color:#fd7e14"></span><small id="ap'.$achievement['achievementID'].'">'.$achievement['2_ap'].'</small> <span class="bi bi-capslock" style="color:#20c997"></span><span id="tp'.$achievement['achievementID'].'">'.$achievement['2_tp'].' </span><span class="ri-hand-coin-line" style="color:#0dcaf0;margin-top:"></span> <span id="rp'.$achievement['achievementID'].'">'.$achievement['2_rp'].'</span>
                              <br><span id="claim" class="badge bg-danger" value="'.$row['achievementCompletionID'].'" style="display:nne"><span class="bi bi-arrow-bar-down" style="color:white;margin-right:5px"></span>Claim Now</span>
                              </div>';  

                        }else if ($row['0_rewards']==2 && $row['1_rewards']==2 && $row['2_rewards']==2){
                          $html.='
                          <div class="icon" id="icon'.$row['achievementCompletionID'].'">
                              <h5>'.$achievement['achievementName'].'</h5>
                              <img id="img'.$achievement['achievementID'].'" src="'.base_url().$achievement['3_logo'].'">
                              <div class="label"></div>
                              <div class=" alert-light ms-4 me-4" style="font-size: 12px"><span><b>'.$achievement['3_requirements'].'</b></span>
                              <br><span></span></div>
                              <small></small>
                              <span  style="color:#fd7e14"></span><small></small> <span style="color:#20c997"></span><span ></span><span  style="color:#0dcaf0;margin-top:"></span> <span></span>
                              <br><span  style="display:nne"></span>
                              </div>';  
                        }


                    }
        
                    $query = $this->db->query('SELECT * FROM achievements '.$excludedID.' order by `order`');
            
                    foreach($query->result_array() as $row) {
        
                        
                        if($row['0_rp']>0 && $row['0_rp']> 0 && $row['0_rp']>0){
        
                            $html.='                              
                            <div class="icon">
                            <h5>'.$row['achievementName'].'</h5>
                            <img src="'.base_url().$row['0_logo'].'">
                            <div class="label"></div>
                            <div class=" alert-light ms-4 me-4" style="font-size: 12px"><span>'.$row['0_requirements'].'</span>
                            <br>'.$row['0_default_parameter'].'</span></div>
                            <small>Rewards</small>
                            <span class="bi bi-award" style="color:#fd7e14"></span><small">'.$row['0_ap'].'</small> <span class="bi bi-capslock" style="color:#20c997"></span><span>'.$row['0_tp'].' </span><span class="ri-hand-coin-line" style="color:#0dcaf0;margin-top:"></span> <span>'.$row['0_rp'].'</span>
                            <br><span ></span>
                            </div>';    

                        //THIS IS FOR COMING SOONG    
                        }else{
                            $html.='
                            <div class="icon text-center" >
                               
                                <div class="label"></div>
                                <div class="alert alert-light ms-4 me-4" style="font-size: 12px">'.$row['0_requirements'].'
                                <br>'.$row['0_default_parameter'].'</div>
                            </div>';                   
                        }
        
                    }

            return $html;
        

            }
        //THIS IS FOR DEFAULT DATA// NO ACHIEVEMENT TAKEN YET////
        else{
            $query = $this->db->query('SELECT * FROM achievements order by `order`');
            
            foreach($query->result_array() as $row) {

                
                if($row['0_rp']>0 && $row['0_rp']> 0 && $row['0_rp']>0){

                  $html.='                              
                          <div class="icon">
                          <h5>'.$row['achievementName'].'</h5>
                          <img src="'.base_url().$row['0_logo'].'">
                          <div class="label"></div>
                          <div class=" alert-light ms-4 me-4" style="font-size: 12px"><span>'.$row['0_requirements'].'</span>
                          <br>'.$row['0_default_parameter'].'</span></div>
                          <small>Rewards</small>
                          <span class="bi bi-award" style="color:#fd7e14"></span><small">'.$row['0_ap'].'</small> <span class="bi bi-capslock" style="color:#20c997"></span><span>'.$row['0_tp'].' </span><span class="ri-hand-coin-line" style="color:#0dcaf0;margin-top:"></span> <span>'.$row['0_rp'].'</span>
                          <br><span ></span>
                          </div>';   
                //THIS IS FOR COMING SOONG    
                }else{
                    $html.='
                    <div class="icon">
                    
                    
                    <div class="container d-flex align-items-center justify-content-center" style="height:100%">
                    
                   
                    
                    <div>
                    <h5>'.$row['achievementName'].'</h5>
                    <p>'.$row['0_requirements'].'
                </div>

                    </div>
                    

                    </div>';                    
                }


            }

            return $html;
            
        }
    }

    public function addAchievementPoints($ap){
      $query = $this->db->query("select * from users_points where userID=". $_SESSION['userID']);
      foreach($query->result_array() as $row) {

        $totalAPEarned = $row['totalAPEarned'];

        $task = array(
          'userID'=>$_SESSION['userID'],
          'totalApEarned' => $totalAPEarned + $ap
        );
  
      $this->db->update('users_points',$task,array('userID'=>$_SESSION['userID']));   



      }

    }

    public function update_claim($level,$id,$ap,$tp,$rp){
      if($level==1){
        $data = array(
          'userID'=>$_SESSION['userID'],
          '0_dtClaim' => date('Y-m-d H:i:s'),
          '0_rewards' => 2);
        $this->db->update('users_achievement_completion',$data,array('achievementCompletionID'=>$id));   
      }else if($level==2){
        $data = array(
          'userID'=>$_SESSION['userID'],
          '1_dtClaim' => date('Y-m-d H:i:s'),
          '1_rewards' => 2);
        $this->db->update('users_achievement_completion',$data,array('achievementCompletionID'=>$id));           
      }else if($level==3){
        $data = array(
          'userID'=>$_SESSION['userID'],
          '2_dtClaim' => date('Y-m-d H:i:s'),
          '2_rewards' => 2);
        $this->db->update('users_achievement_completion',$data,array('achievementCompletionID'=>$id));           
      }

      $this->addAchievementPoints($ap);
      $this->TaskModel->addTaskPoints($tp);
      $this->RewardModel->addRewardPoints($rp);    

    }

    public function claim($id){
      $query = $this->db->query('SELECT * FROM users_achievement_completion where achievementCompletionID = '.$id.'');
      foreach($query->result_array() as $row) {

          if($row['0_rewards']==1){
              
            $achievement = $this->db->query("SELECT * FROM achievements where achievementName = '".$row['achievementName']."'");
              foreach($achievement->result_array() as $Achievementrow) {

                //in case if there is another reward to earn//
                $this->update_claim(1,$row['achievementCompletionID'],$Achievementrow['0_ap'],$Achievementrow['0_tp'],$Achievementrow['0_rp']);

                if($Achievementrow['max_limit']==1){
                  $data = Array(
                    'level' => 3,
                    'id' => $row['achievementCompletionID'],
                    'ap' => $Achievementrow['0_ap'],
                    'tp' => $Achievementrow['0_tp'],
                    'rp' => $Achievementrow['0_rp'],
                    'value' => '
                    <h5>'.$Achievementrow['achievementName'].'</h5>
                    <img id="img'.$Achievementrow['achievementID'].'" src="'.base_url().$Achievementrow['1_logo'].'">
                    <div class="label"></div>
                    <div class=" alert-light ms-4 me-4" style="font-size: 12px"><span><b>'.$Achievementrow['1_requirements'].'</b></span>
                    <br><span></span></div>
                    <small></small>
                    <span  style="color:#fd7e14"></span><small></small> <span style="color:#20c997"></span><span ></span><span  style="color:#0dcaf0;margin-top:"></span> <span></span>
                    <br><span  style="display:nne"></span>
                    </div>'               
                  );
                }
                else if($row['1_rewards']==1){

                  $data = Array(
                    'level' => 2,
                    'id' => $row['achievementCompletionID'],
                    'ap' => $Achievementrow['0_ap'],
                    'tp' => $Achievementrow['0_tp'],
                    'rp' => $Achievementrow['0_rp'],
                    'value' => '
                    <h5>'.$Achievementrow['achievementName'].'</h5>
                    <img src="'.base_url().$Achievementrow['1_logo'].'">
                    <div class="label"></div>
                    <div class=" alert-light ms-4 me-4" style="font-size: 12px"><span>'.$Achievementrow['1_requirements'].'</span>
                    <br>'.$row['counter'].'/<span>'.$Achievementrow['1_limit'].'</span></div>
                    <small>Rewards</small>
                    <span class="bi bi-award" style="color:#fd7e14"></span><small>'.$Achievementrow['1_ap'].'</small> <span class="bi bi-capslock" style="color:#20c997"></span><span>'.$Achievementrow['1_tp'].' </span><span class="ri-hand-coin-line" style="color:#0dcaf0;margin-top:"></span> <span>'.$Achievementrow['1_rp'].'</span>
                    <br><span id="claim" class="badge bg-danger" value="'.$row['achievementCompletionID'].'" style="display:nne"><span class="bi bi-arrow-bar-down" style="color:white;margin-right:5px"></span>Claim Now</span>
                    '               
                  );       
                  
                }else{

                  $data = Array(
                    'level' => 2,
                    'id' => $row['achievementCompletionID'],
                    'ap' => $Achievementrow['0_ap'],
                    'tp' => $Achievementrow['0_tp'],
                    'rp' => $Achievementrow['0_rp'],
                    'value' => '
                              <h5>'.$Achievementrow['achievementName'].'</h5>
                              <img src="'.base_url().$Achievementrow['1_logo'].'">
                              <div class="label"></div>
                              <div class=" alert-light ms-4 me-4" style="font-size: 12px"><span>'.$Achievementrow['1_requirements'].'</span>
                              <br>'.$row['counter'].'/<span>'.$Achievementrow['1_limit'].'</span></div>
                              <small>Rewards</small>
                              <span class="bi bi-award" style="color:#fd7e14"></span><small>'.$Achievementrow['1_ap'].'</small> <span class="bi bi-capslock" style="color:#20c997"></span><span>'.$Achievementrow['1_tp'].' </span><span class="ri-hand-coin-line" style="color:#0dcaf0;margin-top:"></span> <span>'.$Achievementrow['1_rp'].'</span>
                              <br><span></span>                    
                    ');

             
                }
                return $data;
              }

          }
          else if($row['0_rewards']==2 && $row['1_rewards']==1){

            $achievement = $this->db->query("SELECT * FROM achievements where achievementName = '".$row['achievementName']."'");
            foreach($achievement->result_array() as $Achievementrow) {

              //in case if there is another reward to earn//
              $this->update_claim(2,$row['achievementCompletionID'],$Achievementrow['1_ap'],$Achievementrow['1_tp'],$Achievementrow['1_rp']);
              if($row['2_rewards']==1){
                $data = Array(
                  'level' => 2,
                  'id' => $row['achievementCompletionID'],
                  'ap' => $Achievementrow['1_ap'],
                  'tp' => $Achievementrow['1_tp'],
                  'rp' => $Achievementrow['1_rp'],
                  'value' => '
                  <img src="'.base_url().$Achievementrow['2_logo'].'">
                  <div class="label"></div>
                  <div class=" alert-light ms-4 me-4" style="font-size: 12px"><span id="requirements'.$Achievementrow['achievementID'].'">'.$Achievementrow['2_requirements'].'</span>
                  <br>'.$row['counter'].'/<span>'.$Achievementrow['2_limit'].'</span></div>
                  <small>Rewards</small>
                  <span class="bi bi-award" style="color:#fd7e14"></span><small>'.$Achievementrow['2_ap'].'</small> <span class="bi bi-capslock" style="color:#20c997"></span><span>'.$Achievementrow['2_tp'].' </span><span class="ri-hand-coin-line" style="color:#0dcaf0;margin-top:"></span> <span>'.$Achievementrow['2_rp'].'</span>
                  <br><span id="claim" class="badge bg-danger" value="'.$row['achievementCompletionID'].'" style="display:nne"><span class="bi bi-arrow-bar-down" style="color:white;margin-right:5px"></span>Claim Now</span>
                  '                
                );
              }else{
                $data = Array(
                  'level' => 2,
                  'id' => $row['achievementCompletionID'],
                  'ap' => $Achievementrow['1_ap'],
                  'tp' => $Achievementrow['1_tp'],
                  'rp' => $Achievementrow['1_rp'],
                  'value' => '
                  <h5>'.$Achievementrow['achievementName'].'</h5>
                  <img src="'.base_url().$Achievementrow['2_logo'].'">
                  <div class="label"></div>
                  <div class=" alert-light ms-4 me-4" style="font-size: 12px"><span>'.$Achievementrow['2_requirements'].'</span>
                  <br>'.$row['counter'].'/<span>'.$Achievementrow['2_limit'].'</span></div>
                  <small>Rewards</small>
                  <span class="bi bi-award" style="color:#fd7e14"></span><small>'.$Achievementrow['2_ap'].'</small> <span class="bi bi-capslock" style="color:#20c997"></span><span>'.$Achievementrow['3_tp'].' </span><span class="ri-hand-coin-line" style="color:#0dcaf0;margin-top:"></span> <span>'.$Achievementrow['2_rp'].'</span>
                  <br><span></span>'                     
                );                  
              }
              return $data;
            }
          }
          else if($row['0_rewards']==2 && $row['1_rewards']==2 && $row['2_rewards']==1){


            $achievement = $this->db->query("SELECT * FROM achievements where achievementName = '".$row['achievementName']."'");
            foreach($achievement->result_array() as $Achievementrow) {

              //in case if there is another reward to earn//
              $this->update_claim(3,$row['achievementCompletionID'],$Achievementrow['2_ap'],$Achievementrow['2_tp'],$Achievementrow['2_rp']);
          
                $data = Array(
                  'level' => 3,
                  'id' => $row['achievementCompletionID'],
                  'ap' => $Achievementrow['2_ap'],
                  'tp' => $Achievementrow['2_tp'],
                  'rp' => $Achievementrow['2_rp'],
                  'value' => '
                  <h5>'.$Achievementrow['achievementName'].'</h5>
                  <img id="img'.$Achievementrow['achievementID'].'" src="'.base_url().$Achievementrow['3_logo'].'">
                  <div class="label"></div>
                  <div class=" alert-light ms-4 me-4" style="font-size: 12px"><span><b>'.$Achievementrow['3_requirements'].'</b></span>
                  <br><span></span></div>
                  <small></small>
                  <span  style="color:#fd7e14"></span><small></small> <span style="color:#20c997"></span><span ></span><span  style="color:#0dcaf0;margin-top:"></span> <span></span>
                  <br><span  style="display:nne"></span>
                  </div>'               
                );
              
              return $data;
            }
          }
          
      }

    }

    public function renew_badge($menuID){
      return  $this->db->delete('users_sign_marker',array('userID'=>$_SESSION['userID'],'menuID'=>$menuID));   
    }

}