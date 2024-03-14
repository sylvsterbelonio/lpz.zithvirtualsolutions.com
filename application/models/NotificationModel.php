<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class NotificationModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function welcome_close(){
        $notification = array(
            'userID' => $_SESSION['userID'],
            'reminderID' => 1,
            'dtNotified' => date('Y-m-d H:i:s')
        );
      return $this->db->insert('users_sign_marker',$notification);
    }

    public function notify_levelup($newLevel){
        $notification = array(
            'notificationType' => 'level up',
            'notificationTitle' => "Level Up!",
            'notificationPreviewContent' => "<b>Congratulations!</b> you are now Level " . $newLevel,
            'notificationContent' => '<p align=center><b>Congratulations!</b><br> you are now Level '.$newLevel.'!<br>Achieve more task to level up more.</p> ',
            'actionCommand' => 'Read',
            'notifiedBy' => $_SESSION['userID'],
            'notifyTo' => $_SESSION['userID'],
            'dtNotified' => date('Y-m-d H:i:s')
        );
      return $this->db->insert('notification',$notification);
    }

    public function notify_levelup_Android($userID, $newLevel){
        $notification = array(
            'notificationType' => 'level up',
            'notificationTitle' => "Level Up!",
            'notificationPreviewContent' => "<b>Congratulations!</b> you are now Level " . $newLevel,
            'notificationContent' => '<p align=center><b>Congratulations!</b><br> you are now Level '.$newLevel.'!<br>Achieve more task to level up more.</p> ',
            'actionCommand' => 'Read',
            'notifiedBy' => $userID,
            'notifyTo' => $userID,
            'dtNotified' => date('Y-m-d H:i:s')
        );
      return $this->db->insert('notification',$notification);
    }
    public function notify_accessLevelUpgrade($OldAccessName,$NewAccessName,$section){
        $notification = array(
            'notificationType' => 'System Access Upgraded',
            'notificationTitle' => "System Access Upgraded",
            'notificationPreviewContent' => "<b>Congratulations!</b> you upgraded your account.",
            'notificationContent' => '<p align=center><b>Congratulations!</b><br> you are upgraded into from <b>'.$OldAccessName.'</b> to <b>'.$NewAccessName.'</b>!<br>
            <br>* New unlocks <b>'.$section.'</b> Section.</p> ',
            'actionCommand' => 'Read',
            'notifiedBy' => $_SESSION['userID'],
            'notifyTo' => $_SESSION['userID'],
            'dtNotified' => date('Y-m-d H:i:s')
        );
      return $this->db->insert('notification',$notification);
    }

    public function notify_accessLevelUpgrade_Android($userID, $OldAccessName,$NewAccessName,$section){
        $notification = array(
            'notificationType' => 'System Access Upgraded',
            'notificationTitle' => "System Access Upgraded",
            'notificationPreviewContent' => "<b>Congratulations!</b> you upgraded your account.",
            'notificationContent' => '<p align=center><b>Congratulations!</b><br> you are upgraded into from <b>'.$OldAccessName.'</b> to <b>'.$NewAccessName.'</b>!<br>
            <br>* New unlocks <b>'.$section.'</b> Section.</p> ',
            'actionCommand' => 'Read',
            'notifiedBy' => $userID,
            'notifyTo' => $userID,
            'dtNotified' => date('Y-m-d H:i:s')
        );
      return $this->db->insert('notification',$notification);
    }



    public function notify_achievement($data,$level){

        if($level==0){
            $notification = array(
                'notificationType' => "Achievement",
                'notificationTitle' => "New Achievement Unlock!",
                'notificationPreviewContent' => "
                <b>Congratulations!</b> you have unlock the <b>" . $data['achievementName'].' '.$data['0_award_name'] . '</b> award.',
                'notificationContent' => '
                <div class="d-flex aligns-items-center justify-content-center"><img src="'.base_url().$data['1_logo'].'" width=100 height=100><br></div><br>
                <p align=center><b>Congratulations!</b><br> you have unlock the  <b>'. $data['achievementName'].' '.$data['0_award_name'] . '</b> award.</p>',
                'actionCommand' => 'Read',
                'notifiedBy' => $_SESSION['userID'],
                'notifyTo' => $_SESSION['userID'],
                'dtNotified' => date('Y-m-d H:i:s')
            );
        }else if($level==1){
            $notification = array(
                'notificationType' => "Achievement",
                'notificationTitle' => "New Achievement Unlock!",
                'notificationPreviewContent' => "
                <b>Congratulations!</b> you have unlock the <b>" . $data['achievementName'].' '.$data['0_award_name'] . '</b> award.',
                'notificationContent' => '
                <div class="d-flex aligns-items-center justify-content-center"><img src="'.base_url().$data['2_logo'].'" width=100 height=100></div><br>
                <p align=center><b>Congratulations!</b> you have unlock the  <b>'. $data['achievementName'].' '.$data['1_award_name'] . '</b> award.</p> ',
                'actionCommand' => 'Read',
                'notifiedBy' => $_SESSION['userID'],
                'notifyTo' => $_SESSION['userID'],
                'dtNotified' => date('Y-m-d H:i:s')
            );
        }else if($level==2){
            $notification = array(
                'notificationType' => "Achievement",
                'notificationTitle' => "New Achievement Unlock!",
                'notificationPreviewContent' => "
                <b>Congratulations!</b> you have unlock the <b>" . $data['achievementName'].' '.$data['2_award_name'] . '</b> award.',
                'notificationContent' => '
                <div class="d-flex aligns-items-center justify-content-center"><img src="'.base_url().$data['3_logo'].'" width=100 height=100><br></div><br>
                <p align=center><b>Congratulations!</b> you unlock the  <b>'. $data['achievementName'].' '.$data['2_award_name'] . '</b> award. </p>',
                'actionCommand' => 'Read',
                'notifiedBy' => $_SESSION['userID'],
                'notifyTo' => $_SESSION['userID'],
                'dtNotified' => date('Y-m-d H:i:s')
            );
        }




      return $this->db->insert('notification',$notification);
    }    

    public function getWelcome_Message(){
        $query = $this->db->query('SELECT * FROM users_sign_marker where reminderID = 1 AND userID='.$_SESSION['userID']);
        if(count( $query->result() ) == 0){
           
            $query = $this->db->query('SELECT * FROM ref_reminder where reminderID = 1');
            foreach($query->result_array() as $row)
            {
                $html='
                <div class="modal" id="modalDialogScrollable" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">'.$row['title'].'</h5>
                    </div>
                    <div class="modal-body">
                        <h4><b>WELCOME '.$_SESSION['username'].'</b>;</h4>'
                    . $row['content'] .                     
                    '</div>
                    <div class="modal-footer">
                      <button id="btnNext" type="button" class="btn btn-primary" ><span class="bi bi-check-lg" style="margin-right:10px"></span>Ok</button>
                    </div>
                  </div>
                </div>
                 </div><!-- End Modal Dialog Scrollable-->
                </div>
                <script>
                    $( document ).ready(function() {
                        console.log( "ready!" );
                        $("#modalDialogScrollable").modal("show");
                    });

                    $("#btnNext").click(function() {
                    $("#modalDialogScrollable").modal("hide");
                    $.ajax({
                        url: "' . base_url() . 'notify/welcome-close",
                        type: "post", dataType: "json",
                        data:{action: "done"}, 
                        success: function(data){
                            console.log(data);
                            
                        }
                    });


                    });
                </script>';
        }    

            return $html;

        }else{
            return "";
        }
    }

    public function getMenu_Notification($menuID){
        $query = $this->db->query('SELECT * FROM users_sign_marker where menuID = ' . $menuID . ' AND userID='.$_SESSION['userID']);
        if(count( $query->result() ) == 0){
            return "New";
        }else{
            return "";
        }
    }

    public function setMenu_Notified($menutitle){
        $menuID = $this->MenuModel->getMenuID($menutitle);
        $query = $this->db->query('SELECT * FROM users_sign_marker where menuID = ' . $menuID . ' AND userID='.$_SESSION['userID']);
        if(count( $query->result() ) == 0){
            $notification = array(
                'userID' => $_SESSION['userID'],
                'menuID' => $menuID,
                'dtNotified' => date('Y-m-d H:i:s')
            );
          return $this->db->insert('users_sign_marker',$notification);
        }
        return false;       
    }

    public function getNotification(){
        $query = $this->db->query('SELECT * FROM notification where notifyTo = '.$_SESSION['userID'] . ' and read_by_reader=0');
        $allUnreadNotification = count( $query->result() );
        $query = $this->db->query('SELECT notification.notificationID, first_name, last_name, username,profile_photo_path,notificationType, notificationTitle, notificationPreviewContent, notificationContent, dtNotified, read_by_reader FROM `users` INNER JOIN `notification`   ON (`users`.`userID` = `notification`.`notifiedBy`)  INNER JOIN `profile`    ON (`profile`.`userID` = `users`.`userID`) WHERE notifyTo='.$_SESSION['userID'].' ORDER BY dtNotified DESC LIMIT 0,10');
       

        
        $html=' <li class="nav-item dropdown">';
        if($allUnreadNotification>0){
            $html .= '
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-danger badge-number"><span id="header_remaining_unread">'.$allUnreadNotification.'</span></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
            You have <span id="body_remaining_unread">'.$allUnreadNotification.'</span> new notifications
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>';
        }else{
            $html .= '
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
            You have <span id="body_remaining_unread">no</span> notification
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
            <hr class="dropdown-divider">
            </li>';
        }

       
        foreach($query->result_array() as $row){
            if($row['first_name'] !="" && $row['last_name']!=""){

                if($row['notificationType']=="level up"){
                    $html.='  <li id="view_notification" value="'.$row['notificationID'].'" class="notification-item">
                                    <img src="'.base_url().$row['profile_photo_path'].'" alt="Profile" class="rounded-circle" height=60 width=60 style="margin-right:10px">
                                        <div class="col-lg-9 col-md-9">
                                            <h4><b>'.$row['first_name'].' '.$row['last_name'].'</b></h4>
                                            <p >'.$row['notificationPreviewContent'].'</p>
                                            <p>'.$this->calculate_time_span($row['dtNotified']).'</p>
                                        </div>
                                    '.$this->check_if_read_or_unread($row['read_by_reader']).' 
                             </li>';
                }else{
                    $html.='  <li id="view_notification" value="'.$row['notificationID'].'" class="notification-item">
                                    <img src="'.base_url().$row['profile_photo_path'].'" alt="Profile" class="rounded-circle" height=60 width=60 style="margin-right:10px">
                                            <div class="col-lg-9 col-md-9">
                                                    <h4><b>'.$row['first_name'].' '.$row['last_name'].'</b></h4>
                                                    <p >'.$row['notificationPreviewContent'].'</p>
                                                    <p>'.$this->calculate_time_span($row['dtNotified']).'</p>
                                            </div>
                                    '.$this->check_if_read_or_unread($row['read_by_reader']).' 
                                </li>';
                }
                
            }else{
                $html.='  <li id="view_notification" value="'.$row['notificationID'].'" class="notification-item">
                            <img src="'.base_url().$row['profile_photo_path'].'" alt="Profile" class="rounded-circle" height=60 width=60 style="margin-right:10px">
                                <div class="col-lg-9 col-md-9">
                                    <h4><b>'.$row['username'].'</b></h4>
                                    <p>'.$row['notificationPreviewContent'].'</p>
                                    <p>'.$this->calculate_time_span($row['dtNotified']).'</p>
                                </div>
                                '.$this->check_if_read_or_unread($row['read_by_reader']).'  
                        </li>';    
            }
        }

        $html.='<li>
                    <hr class="dropdown-divider">
                </li>
                <li class="dropdown-footer">
                    <a href="#">Show all notifications</a>
                </li>
                
                </ul><!-- End Notification Dropdown Items -->
                
                </li><!-- End Notification Nav -->';

        return $html;

    }

    public function readNotificationMessage(){
        $id = $this->input->post('id');
        $notify = array(
            'read_by_reader' => 1,
            'dtRead' => date('Y-m-d H:i:s')
        );
        $this->db->update('notification',$notify,array('notificationID'=>$id)); 

        $query = $this->db->query('SELECT notification.notificationID, first_name, last_name, username,profile_photo_path, notificationTitle, notificationPreviewContent, notificationContent, dtNotified, read_by_reader, actionCommand FROM `users` INNER JOIN `notification`   ON (`users`.`userID` = `notification`.`notifiedBy`)  INNER JOIN `profile`    ON (`profile`.`userID` = `users`.`userID`) WHERE notification.notificationID='.$id.' ORDER BY dtNotified DESC LIMIT 0,10');
        return $query->row();
    }


    private function check_if_read_or_unread($indicator){
        if ($indicator){
            return '<div class="col-lg-2 col-md-2"></div>';
        }else{
            return ' <div class="col-lg-2 col-md-2">
                    <span class="bi bi-record-fill" style="margin-left:-10px;color:#3B71CA"></span>
                    </div>';
        }
    }

    private function calculate_time_span($date){
        $seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime($date);
    
            $months = floor($seconds / (3600*24*30));
            $day = floor($seconds / (3600*24));
            $hours = floor($seconds / 3600);
            $mins = floor(($seconds - ($hours*3600)) / 60);
            $secs = floor($seconds % 60);
    
            if($seconds < 60)
                $time = $secs." seconds ago";
            else if($seconds < 60*60 )
                $time = $mins." min ago";
            else if($seconds < 24*60*60)
                $time = $hours." hours ago";
            else if($seconds < 24*60*60)
                $time = $day." day ago";
            else
                $time = $months." month ago";
    
            return $time;
    }
}