<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChurchController extends CI_Controller {

    public function index(){
        if(isset($_SESSION['username']) )  {
            $this->NotificationModel->setMenu_Notified("Church");

            if($this->MenuModel->checkMenu_If_Allowed($_SESSION['accessLevelID'],"Church")){        

              
                $data['currentChurchJoined'] = $this->ChurchModel->getCurrent_Church_Joined();
                
        
                $this->load->view('templates/header');
                $this->load->view('templates/dashboard-toolbar');
                $this->load->view('templates/dashboard-sidebar',['page'=>'Church']);
                $this->load->view('pages/admin/ministry/ministry-list');
                $this->load->view('templates/footer');

            }else{
                $this->load->view('templates/header');
                $this->load->view('templates/dashboard-toolbar');
                $this->load->view('templates/dashboard-sidebar',['page'=>'Church']);
                $this->load->view('errors/restricted');
                $this->load->view('templates/footer');
            }    
            
        }
        else
        {
            redirect('login');
        }
    }

    public function android_leave_church(){
        if(isset($_POST['userID'])){
        $this->ChurchModel->android_leave_church($this->input->post('userID'));
        echo "You have successfully left from the church";
        }else{
            $this->load->view('errors/restricted');
        }
    }

    public function android_join_church(){
        if(isset($_POST['userID'])){
        $data = $this->ChurchModel->android_join_church($this->input->post('userID'),$this->input->post('churchID'));
            echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }
    }

    public function android_getChurch(){
        if(isset($_POST['churchID'])){
        $data = $this->ChurchModel->getChurchInfo_by_ID_Android($this->input->post('churchID'));
        echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }
    }

    public function android_get_church_members(){
        if(isset($_POST['churchID'])){
        $data = $this->ChurchModel->get_church_members_android($this->input->post('churchID'));
        echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }
    }

    public function android_search_church_ministry_name(){
        if(isset($_POST['searchValue'])){
        $data = $this->ChurchModel->search_church($this->input->post('searchValue'),$this->input->post('churchID'));
        echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }
    }

    public function android_get_church_members_count(){
        if(isset($_POST['churchID'])){
        $data = $this->ChurchModel->get_church_members_count_android($this->input->post('churchID'));
        echo json_encode($data);
        }else{
             $data = $this->ChurchModel->get_church_members_count_android(50);
        echo json_encode($data);
            //$this->load->view('errors/restricted');
        }
    }

    public function android_search_church_name(){
        if(isset($_POST['church_name'])){
            if($data = $this->ChurchModel->getChurchInfo_Android($this->input->post('church_name'))){
                echo "success~" . $data['churchID'] . "~" . $data['church_name'] . "~" . $data['url_photo'] . "~"
                
                . $data['barangay'] . ", " . $data['city'] . ", " . $data['province']
                ;
            }else{
                echo "error-No Church Existed. Please try another.";
            }
        }
    else
        {
            //$data = $this->ChurchModel->getChurchInfo_Android('Living Praise of Zion');
            //echo $data['church_name'];
            echo "error-page outside.";  

        }    
    }

    public function android_get_all_church_name(){
        
            $data = $this->ChurchModel->get_all_Church_Android();

            $raw = array('response'=>'success',
                'data' =>$data);

            $xdata =  json_encode($raw );

            $xdata = str_replace("[","",$xdata);
            $xdata = str_replace("]","",$xdata);  
             
            echo json_encode($data);
          
    }

    public function profile($url){
    
        if(isset($_SESSION['username']) )  {
            $this->NotificationModel->setMenu_Notified("Church");
            $data['userAccountInfo'] = $this->AuthModel->getLoginInfo($_SESSION['username']);
            $data['populateSideMenu'] = $this->MenuModel->populateSideMenu('Church');
            if($this->MenuModel->checkMenu_If_Allowed($_SESSION['accessLevelID'],"Church")){        

                $data['notification'] = $this->NotificationModel->getNotification();
                
                if($data['church'] = $this->ChurchModel->searchChurchUrl($url)){

                    if($data['church']['privacy_settings']!="Private"){

                        $data['currentChurchJoined'] = $this->ChurchModel->getCurrent_Church_Joined();
                        
                        $this->load->view('templates/header');
                        $this->load->view('templates/dashboard-toolbar');
                        $this->load->view('templates/dashboard-sidebar',['page'=>'Church']);
                        $this->load->view('pages/admin/ministry/view-church-profile',$data);
                        $this->load->view('templates/footer');
                    }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/dashboard-toolbar');
                        $this->load->view('templates/dashboard-sidebar',['page'=>'Church']);
                        $this->load->view('errors/restricted');
                        $this->load->view('templates/footer');                       
                    }

                }else{
                    $this->load->view('templates/header');
                    $this->load->view('templates/dashboard-toolbar');
                    $this->load->view('templates/dashboard-sidebar',['page'=>'Church']);
                    $this->load->view('errors/restricted');
                    $this->load->view('templates/footer');

                }
                

            }else{
                $this->load->view('templates/header');
                $this->load->view('templates/dashboard-toolbar');
                $this->load->view('templates/dashboard-sidebar',['page'=>'Church']);
                $this->load->view('errors/restricted');
                $this->load->view('templates/footer');
            }    
        }else{
            redirect('login');
        }    
    }

   

    public function simple_list_church(){
        if($this->input->is_ajax_request()){

            if($posts = $this->ChurchModel->get_simple_list_churches()){
                $data = array('response'=>'success', 'message'=>'You have successfully loaded the data.', 'posts'=> $posts);
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
	public function church(){
    
        if(isset($_SESSION['username']) )  {
            $this->NotificationModel->setMenu_Notified("Church Management");
            $data['userAccountInfo'] = $this->AuthModel->getLoginInfo($_SESSION['username']);
            $data['populateSideMenu'] = $this->MenuModel->populateSideMenu('Church');
            if($this->MenuModel->checkMenu_If_Allowed($_SESSION['accessLevelID'],"Church Management")){        

                $data['notification'] = $this->NotificationModel->getNotification();
                
                $data['country'] = $this->ChurchModel->populateCountry("");
                $data['province'] = '<option value="" selected>- Select Province -</option> ';
                $data['city'] = '<option value="" selected>- Select Municipality/City -</option> ';
                $data['barangay'] = '<option value="" selected>- Select Barangay -</option> ';;


                $data['input'] = $this->ParameterModel->getGroupParameter('input');
                $data['button'] = $this->ParameterModel->getGroupParameter('button');
                $data['app'] = $this->ParameterModel->getGroupParameter('app');
                $data['page'] = $this->ParameterModel->getGroupParameter('profile');

                $this->load->view('templates/header',$data);
                $this->load->view('templates/dashboard-toolbar',$data);
                $this->load->view('templates/dashboard-sidebar',$data);
                $this->load->view('pages/admin/church',$data);
                $this->load->view('templates/footer',$data);

            }else{
                $this->load->view('templates/header');
                $this->load->view('templates/dashboard-toolbar',$data);
                $this->load->view('templates/dashboard-sidebar',$data);
                $this->load->view('errors/restricted');
                $this->load->view('templates/footer');
            }    
            
        }
        else
        {
            redirect('login');
        }
    }

    public function get_church_list(){

        if($this->input->is_ajax_request()){

            if($posts = $this->ChurchModel->fetch_all()){
                $data = array('response'=>'success', 'posts'=> $posts);
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

    public function delete_church(){
        if($this->input->is_ajax_request()){
                $del_id = $this->input->post('del_id');     
                if($this->ChurchModel->delete_entry($del_id)){
                    $data = array('response'=>'success', 'message'=> 'Successfully updated.');    
                }else{
                    $data = array('response'=>'error', 'message'=> 'Unable to delete record.');   
                }
            echo json_encode($data);  
        }else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');
        } 
    }

    public function edit_church(){
        if($this->input->is_ajax_request())
            {
                $edit_id = $this->input->post('edit_id');  
                if($posts = $this->ChurchModel->edit_entry($edit_id))
                    {
                    $data = array('response'=>'success', 'post'=> $posts);
                    }
                else{
                    $data = array('response'=>'error', 'message'=> 'failed to fetch record.');   
                    }
                echo json_encode($data);          
            }
        else{
                $this->load->view('templates/header');
                $this->load->view('errors/restricted');
                $this->load->view('templates/footer');   
            }
    }

    public function add_church(){
        if($this->input->is_ajax_request()){

            $this->form_validation->set_rules('church_name','Church Name','required');
            $this->form_validation->set_rules('privacy_settings','Privacy Settings','required');
            $this->form_validation->set_rules('invitationMode','Invitation Mode','required');

            if($this->form_validation->run() == FALSE)
                {
                $data = array(
                    'response' => 'error', 
                    'message' => validation_errors(),
                    'privacy_settings' => form_error('privacy_settings'),
                    'church_name' => form_error('church_name'),
                    'invitationMode' => form_error('invitationMode')
                            );
                }
            else
                {
                $ajax_data = $this->input->post();

                if(!$this->ChurchModel->checkChurchName_if_Existed($this->input->post('church_name')))
                {
                    if($this->ChurchModel->insert_entry($ajax_data)){
                        $data = array('response'=>'success', 'message'=> 'Record added successfully.');
                    }
                    else{
                        $data = array('response'=>'error', 'message'=> 'Failed to add record.');     
                    }
                }
                else
                {
                    $data = array(
                        'response' => 'error', 
                        'message' => validation_errors(),
                        'privacy_settings' => "",
                        'church_name' => "Church name is already existed. Please try another.",
                        "message" => "Church name is already existed. Please try another."
                                );    
                }
                
            }

            //$this->ChurchModel->insertChurch();
            echo json_encode($data);  

        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }
    }

    public function update_church(){
        if($this->input->is_ajax_request())
        {

            $this->form_validation->set_rules('church_name','Church Name','required');

            if($this->form_validation->run() == FALSE)
                {
                $data = array(  'response' => 'error', 
                                'message' => validation_errors(),'type'=>'insert',
                                'church_name' => form_error('church_name')            
                        );
                }
            else
                {
                if($this->ChurchModel->check_ChurchID_ChurchName_Existed($this->input->post('churchID'),$this->input->post('church_name')))
                    {
                        $data = array(
                            'churchID' => $this->input->post('churchID'),
                            'dtUpdated' => date('Y-m-d H:i:s'),
                            'updatedBy' => $_SESSION['userID']
                            );    

                            if($this->input->post('about')) $data['about'] = $this->input->post('about');
                            if($this->input->post('date_founded')) $data['date_founded'] = $this->input->post('date_founded');
                            if($this->input->post('country')) $data['country'] = $this->input->post('country');
                            if($this->input->post('province')) $data['province'] = $this->input->post('province');
                            if($this->input->post('city')) $data['city'] = $this->input->post('city');
                            if($this->input->post('barangay')) $data['barangay'] = $this->input->post('barangay');
                            if($this->input->post('address')) $data['address'] = $this->input->post('address');
                            if($this->input->post('zipcode')) $data['zipcode'] = $this->input->post('zipcode');
                            if($this->input->post('embed_map')) $data['embed_map'] = $this->input->post('embed_map');
        
                        if($this->ChurchModel->update_entry($data)){
                            $data = array('response'=>'success', 'message'=> 'Record updated successfully.');
                        }
                        else{
                            $data = array('response'=>'error', 'message'=> 'Failed to update record.');     
                        }
                    }
                    else
                    {

                        if(!$this->ChurchModel->checkChurchName_if_Existed($this->input->post('church_name')))
                            {

                                $data = array(
                                    'churchID' => $this->input->post('churchID'),
                                    'dtUpdated' => date('Y-m-d H:i:s'),
                                    'updatedBy' => $_SESSION['userID']
                                    );    

                                if($this->input->post('about')) $data['about'] = $this->input->post('about');
                                if($this->input->post('date_founded')) $data['date_founded'] = $this->input->post('date_founded');
                                if($this->input->post('church_name')) $data['church_name'] = $this->input->post('church_name');
                                if($this->input->post('country')) $data['country'] = $this->input->post('country');
                                if($this->input->post('province')) $data['province'] = $this->input->post('province');
                                if($this->input->post('city')) $data['city'] = $this->input->post('city');
                                if($this->input->post('barangay')) $data['barangay'] = $this->input->post('barangay');
                                if($this->input->post('address')) $data['address'] = $this->input->post('address');        
                                if($this->input->post('zipcode')) $data['zipcode'] = $this->input->post('zipcode');
                                if($this->input->post('embed_map')) $data['embed_map'] = $this->input->post('embed_map');       
                
                                if($this->ChurchModel->update_entry($data)){
                                    $data = array('response'=>'success', 'message'=> 'Record updated successfully.');
                                }
                                else{
                                    $data = array('response'=>'error', 'message'=> 'Failed to update record.');     
                                }

                            }
                        else
                            {
                            $data = array('response'=>'error', 'message'=> 'Failed to upload record.',
                                                'church_name' => 'Church name is already existed. Please try again.');    
                            }

                    }    
                }

            //$this->ChurchModel->insertChurch();
            echo json_encode($data);  

        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }
    }

    public function upload_profile_photo(){
        if($this->input->post('image')){
            $folderPath =  'assets/upload/church/profile/';
            $image_parts = explode(";base64,", $this->input->post('image'));
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.png';
    
            file_put_contents($file, $image_base64);
            
                        $oldPhoto = $this->ChurchModel->getProfilePhoto($this->input->post('churchID'));
                        $this->ChurchModel->updatePhoto($this->input->post('churchID'),$file,"profile-photo");                            
                        $oldFullPath = FCPATH . $oldPhoto;

                        if (file_exists($oldFullPath))
                            {
                                if($oldPhoto!="assets/images/default-photo.png"){
                                unlink($oldFullPath);
                                }
                            }
                        
               
                        echo base_url().$file;
    
         }else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');					
        }   
    }


    public function upload_default_cover_photo(){
        $config['upload_path'] = 'assets/upload/church/coverphoto';
        $config['allowed_types'] = 'gif|png|jpg';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload',$config);

        if($this->upload->do_upload('file_name')){
            $data = array('upload_data' => $this->upload->data());
            $title = $this->input->post('title');
            $image = $data['upload_data']['file_name'];
            //$result = $this->upload_model->save_upload($title,$image);

            $oldPhoto = $this->ChurchModel->getCoverPhoto($_SESSION['churchID']);
            $this->ChurchModel->updatePhoto($_SESSION['churchID'],'assets/upload/church/coverphoto/'. $data['upload_data']['file_name'],"cover-photo");                            
            $oldFullPath = FCPATH . $oldPhoto;

            if (file_exists($oldFullPath))
                {
                    if($oldPhoto!="assets/images/default-cover-photo.png"){
                    unlink($oldFullPath);
                    }
                }
            
            echo base_url(). 'assets/upload/church/coverphoto/'. $data['upload_data']['file_name'];

        }else{
            $data = array('error'=>'fail');
            echo json_encode($data);
        }
    }

    public function upload_cover_photo(){
        if($this->input->post('image')){
            $folderPath =  'assets/upload/church/coverphoto/';
            $image_parts = explode(";base64,", $this->input->post('image'));
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.jpg';
    
            file_put_contents($file, $image_base64);
            
                        $oldPhoto = $this->ChurchModel->getCoverPhoto($this->input->post('churchID'));
                        $this->ChurchModel->updatePhoto($this->input->post('churchID'),$file,"cover-photo");                         
                        $oldFullPath = FCPATH . $oldPhoto;

                        if (file_exists($oldFullPath))
                            {
                                if($oldPhoto!="assets/images/default-cover-photo.png"){
                                unlink($oldFullPath);
                                }
                            }
                                    
                        echo base_url().$file;
    
         }else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');					
        }   
    }

    public function remove_photo(){
 
        if($this->input->is_ajax_request()){

            $defaultPhoto = "assets/images/default-photo.png";
            $defaultCoverPhoto = "assets/images/default-cover-photo.png";

            if($this->input->post('action')=="profile-photo"){

              if (file_exists($this->input->post('photo')))
              {
                  if($this->input->post('photo')!=$defaultPhoto){
                      unlink($this->input->post('photo'));
                  }
              }
              $this->ChurchModel->updatePhoto($this->input->post('churchID'),$defaultPhoto,$this->input->post('action'));

              echo base_url().$defaultPhoto;

            }
            else
            {
                if (file_exists($this->input->post('coverphoto')))
                {
                    if($this->input->post('coverphoto')!=$defaultCoverPhoto){
                        unlink($this->input->post('coverphoto'));
                    }
                }

                $this->ChurchModel->updatePhoto($this->input->post('churchID'),$defaultCoverPhoto,$this->input->post('coverphoto'));  

                echo base_url().$defaultCoverPhoto;
            }
        }else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');					
        }
    }

    public function join_church(){
        if($this->input->is_ajax_request()){
            if($post = $this->ChurchModel->join_church($this->input->post('id'))){
                $data = array('response'=>'success','type'=>'join','message'=>$post);
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

    public function search_church(){
        if($this->input->is_ajax_request()){
    
            if($posts = $this->ChurchModel->searchChurchName($this->input->post('searchKey'))){
                $data = array('response'=>'success', 'message'=>'You have successfully loaded the data.', 'posts'=> $posts);
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

        //////FORM CONTROLS/////////////////

        public function create_add_form(){
            if($this->input->is_ajax_request()){
    
                if($posts = $this->ChurchFormModel->create_add_form()){
                    $data = array('response'=>'success', 'message'=>'You have successfully loaded the data.', 'posts'=> $posts);
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
    
        public function create_edit_church_form(){
            if($this->input->is_ajax_request()){
                if($posts = $this->ChurchFormModel->create_edit_church_form($this->input->post("id"))){
                    $data = array('response'=>'success', 'message'=>'You have successfully loaded the data.', 'posts'=> $posts);
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
