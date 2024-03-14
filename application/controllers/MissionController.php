<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MissionController extends CI_Controller {

	public function index()
	{}

    public function evangelize_form(){
        if($this->input->is_ajax_request()){
                    $data = array('response'=>'success', 
                    'message'=>'You have successfully loaded the data.', 
                    'post'=> $this->mission->evangelize_form());
            echo json_encode($data);  
        }else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');
        }
    }


    public function android_delete_all_syn_data(){
        if(isset($_POST['userID'])){
                $this->MissionModel->android_delete_all($this->input->post('userID'));
                echo "You have successfully reset the data from server." . $this->input->post('userID');
        }else{
            echo "You must provide your user id.";
        }
    }

    public function android_consolidate_list_reset(){
        if(isset($_POST['userID'])){
            $this->MissionModel->android_consolidate_delete_all($this->input->post('userID'));
            echo "You have successfully reset the data from server." . $this->input->post('userID');
    }else{
        echo "You must provide your user id.";
    }
    }

    public function android_consolidate_get(){
        if(isset($_POST['userID'])){
            $data =  $this->MissionModel->android_consolidate_get(96);
            echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }
    }

    public function android_consolidate_list_sync(){
        if(isset($_POST['userID'])){
            $consolidate = array(
                'consolidateID' => $this->input->post('consolidateID'),
                'tempProfileID' => $this->input->post('tempProfileID'),
                'userID' => $this->input->post('userID'),
                'book_name' => $this->input->post('book_name'),
                'lessonNo' => $this->input->post('lessonNo'),
                'lessonTitle' => $this->input->post('lessonTitle'),
                'dtTrain' => $this->dateparser->androidDate_to_serverDate($this->input->post('dtTrain'))
            );
            $this->MissionModel->android_consolidate_add_row($consolidate);
        }else{
            echo "You must provide your user id.";
        }
    }

    public function android_individual_sync(){
        if(isset($_POST['action'])){
            $evangelize = array(
                'evangelizeID' => $this->input->post('temp_profileID').$this->input->post('userID'),
                'temp_profileID' => $this->input->post('temp_profileID'),
                'userID' => $this->input->post('userID'),
                'first_name' => $this->input->post('first_name'),
                'middle_name' => $this->input->post('middle_name'),
                'last_name' => $this->input->post('last_name'),
                'date_of_birth' => $this->dateparser->androidDate_to_serverDate($this->input->post('date_of_birth')),
                'sex' => $this->input->post('sex'),
                'civil_status' => $this->input->post('civil_status'),
                'loc_country' => $this->input->post('loc_country'),
                'loc_province' => $this->input->post('loc_province'),
                'loc_city' => $this->input->post('loc_city'),
                'loc_barangay' => $this->input->post('loc_barangay'),

                'loc_address' => $this->input->post('loc_address'),
                'con_mobile_no' => $this->input->post('con_mobile_no'),
                'email' => $this->input->post('email'),

                'isEvangelize' => $this->input->post('isEvangelize'),
                'evangelizeDt' => $this->dateparser->androidDate_to_serverDate($this->input->post('evangelizeDt')),
                'isDrop' => $this->input->post('isDrop'),
                'dropDt' => $this->dateparser->androidDate_to_serverDate($this->input->post('dropDt')),
                'isConsolidate' => $this->input->post('isConsolidate'),
                'consolidateDt' => $this->dateparser->androidDate_to_serverDate($this->input->post('consolidateDt')),
                'delFlag' => $this->input->post('delFlag'),

                'delFlag' => $this->input->post('delFlag'),
                'actionFlag' => $this->input->post('actionFlag'),
                'createdBy' => ('createdBy'),
                'dtCreated' => $this->dateparser->androidDate_to_serverDate($this->input->post('dtCreated')),
                'updatedBy' => $this->input->post('updatedBy'),
                'dtUpdated' => $this->dateparser->androidDate_to_serverDate($this->input->post('dtUpdated')),

            );

            //THIS IS HOW TO UPLOAD PHOTOS
            $file="assets/images/default-photo_square.png";

            if($this->input->post('raw_photo_bitmap')!=""){
                    $raw = $this->input->post('raw_photo_bitmap');

                    $folderPath =  'assets/upload/evangelize/';
                    $image_base64 = base64_decode($raw);
                    $file = $folderPath . $this->input->post('userID').$this->input->post('temp_profileID') . '.png';

                    file_put_contents($file, $image_base64);
             }else if($this->input->post('profile_photo_path')!="assets/images/default-photo_square.png"){
                $file = $this->input->post('profile_photo_path');
                $file = str_replace(base_url(),"",$file);
             }

             $evangelize['profile_photo_path'] = $file;



            $this->MissionModel->android_add_row($evangelize);

            $data = array('data' => 
                        array('response'=>'success', 'message'=> 'You have successfully entered',
                        'action' => $evangelize
                        ));
            echo json_encode($data);

        }else{

            $data = array('data' => 
                        array('response'=>'error', 'message'=> 'Restricted query. Please contact the administrator.',
                        'action' => $this->input->post("action")
                        ));
            echo json_encode($data); 
        }
      
    }

    public function android_get_evangelize_list(){
        if(isset($_POST['userID'])){

            $data = $this->MissionModel->android_get_evangelized_list($this->input->post('userID'));
   
            echo json_encode($data);
           
           }else{
            echo "You are not allowed to visit here.";
           }    
    }


    public function get_evangelized_list(){
            if($this->input->is_ajax_request()){
                if($posts = $this->MissionModel->get_evangelized_list()){

                    $data = array('response'=>'success', 'posts'=> $posts['post'],
                    'header' => $posts['header'], 'key' => $posts['key']
                    );
                }else{
                    $data = array('response'=>'error', 'message'=> 'failed to fetch data from server.');   
                }
                echo json_encode($data);  
            }else{
                $this->load->view('templates/header');
                $this->load->view('errors/restricted');
                $this->load->view('templates/footer');
            }
    }

}