<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RolesController extends CI_Controller {

	public function index(){

        if(isset($_SESSION['username']) )  {
            $this->NotificationModel->setMenu_Notified("Roles");
           
            if($this->MenuModel->checkMenu_If_Allowed($_SESSION['accessLevelID'],"Roles")){   

                $this->load->view('templates/header');
                $this->load->view('templates/dashboard-toolbar');
                $this->load->view('templates/dashboard-sidebar',['page'=>'Roles']);
                $this->load->view('pages/admin/roles/roles');
                $this->load->view('templates/footer');

            }else{
                $this->load->view('templates/header');
                $this->load->view('templates/dashboard-toolbar');
                $this->load->view('templates/dashboard-sidebar',['page'=>'Roles']);
                $this->load->view('errors/restricted');
                $this->load->view('templates/footer');
            }

        }else{
            redirect('login');
        }

    }

   

    public function preview_members(){
        if($this->input->is_ajax_request()){
            if(isset($_SESSION['currentChurchID'])){

                $this->form_validation->set_rules('first_name',"First Name",'required');
                $this->form_validation->set_rules('last_name',"Last Name",'required');
                $this->form_validation->set_rules('username',"username","required|is_unique[users.username]");
                $this->form_validation->set_rules('email',"Email Address","required|valid_email|is_unique[users.email]");
                $this->form_validation->set_rules('password',"Password",'required');
    
                if($this->form_validation->run() == FALSE)
                    {
                    $data = array('response' => 'error', 
                                'message' => validation_errors(),
                                'first_name' => form_error('first_name'),
                                'last_name' => form_error('last_name'),
                                'username' => form_error('username'),
                                'email' => form_error('email'),
                                'password' => form_error('password'),
                                );
                    echo json_encode($data);  
                    }
                else{

                        $quickData = array(
                            'nickname' => $this->input->post('nickname'),
                            'first_name' => $this->input->post('first_name'),
                            'middle_name' => $this->input->post('middle_name'),
                            'last_name' => $this->input->post('last_name'),
                            'name_ext' => $this->input->post('name_ext'),
                            'date_of_birth' => $this->input->post('date_of_birth'),
                            'place_of_birth' => $this->input->post('place_of_birth'),
                            'sex' => $this->input->post('sex'),
                            'civil_status' => $this->input->post('civil_status'),
                            'occupation' => $this->input->post('occupation'),
                            'chu_churchID' => $_SESSION['currentChurchID'],
                            'con_mobile_no' => $this->input->post('con_mobile_no'),
                            'con_tel_no' =>  $this->input->post('con_tel_no'),
                            'soc_facebook_url' =>  $this->input->post('soc_facebook_url'),
                            'loc_country' =>  $this->input->post('loc_country'),
                            'loc_province' =>  $this->input->post('loc_province'),
                            'loc_city' =>  $this->input->post('loc_city'),
                            'loc_barangay' =>  $this->input->post('loc_barangay'),
                            'loc_address' =>  $this->input->post('loc_address'),
                            'loc_zipcode' =>  $this->input->post('loc_zipcode'),
                            '1st_timer' => $this->checkbox_checker($this->input->post('f_timer')),
                            '1st_timer_dt' => $this->input->post('f_timer_dt'),
                            '2nd_timer' => $this->checkbox_checker($this->input->post('s_timer')),
                            '2nd_timer_dt' => $this->input->post('s_timer_dt'),
                            'visitor' => $this->checkbox_checker($this->input->post('visitor')),
                            'visitor_dt' => $this->input->post('visitor_dt'),
                            'evangelized' => $this->checkbox_checker($this->input->post('evangelized')),
                            'evangelized_dt' => $this->input->post('evangelized_dt'),
                            'encountered' => $this->checkbox_checker($this->input->post('encountered')),
                            'encountered_dt' => $this->input->post('encountered_dt'),
                            'reencountered' => $this->checkbox_checker($this->input->post('reencountered')),
                            'reencountered_dt' => $this->input->post('reencountered_dt'),
                            'baptized' => $this->checkbox_checker($this->input->post('baptized')),
                            'baptized_who' => $this->input->post('baptized_who'),
                            'baptized_dt' => $this->input->post('baptized_dt'),
                            'regular_attendant' => $this->checkbox_checker($this->input->post('regular_attendant')),
                            'regular_attendant_dt' => $this->input->post('regular_attendant_dt'),
                            'simbanay' => $this->checkbox_checker($this->input->post('simbanay')),
                            'simbanay_dt' => $this->input->post('simbanay_dt'),
                            'lifeclass' => $this->checkbox_checker($this->input->post('lifeclass')),
                            'lifeclass_dt' => $this->input->post('lifeclass_dt'),
                            'sol1' => $this->checkbox_checker($this->input->post('sol_o')),
                            'sol1_dt' => $this->input->post('sol_o_dt'),
                            'sol2' => $this->checkbox_checker($this->input->post('sol_tw')),
                            'sol2_dt' => $this->input->post('sol_tw_dt'),
                            'sol3' => $this->checkbox_checker($this->input->post('sol_th')),
                            'sol3_dt' => $this->input->post('sol_th_dt'),
                            'family' => $this->input->post('family'),
                            'userAccount' =>  $this->input->post('userAccount'),
                            'username' => $this->input->post('username'),
                            'email' => $this->input->post('email'),
                            'password' => $this->input->post('password')
                        );

                            //ESCAPE USER ACCOUNT//

                            $data = array('response'=>'success','message' => 'you have successfully added.',
                                'posts' => $this->MembersFormModel->get_quick_preview($quickData));
                            echo json_encode($data);

                    }        

            }else{
                $this->load->view('templates/header');
                $this->load->view('errors/restricted');
                $this->load->view('templates/footer');	
            }
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }
    }

    public function add_members(){
        if($this->input->is_ajax_request()){
            if(isset($_SESSION['currentChurchID'])){

                $this->form_validation->set_rules('first_name',"First Name",'required');
                $this->form_validation->set_rules('last_name',"Last Name",'required');
                $this->form_validation->set_rules('username',"username","required|is_unique[users.username]");
                $this->form_validation->set_rules('email',"Email Address","required|valid_email|is_unique[users.email]");
                $this->form_validation->set_rules('password',"Password",'required');

    
                if($this->form_validation->run() == FALSE)
                    {
                    $data = array('response' => 'error', 
                                'message' => validation_errors(),
                                'first_name' => form_error('first_name'),
                                'last_name' => form_error('last_name'),
                                'username' => form_error('username'),
                                'email' => form_error('email'),
                                'password' => form_error('password'),
                                );
                    echo json_encode($data);  
                    }
                else{

                        $profile = array(
                            'nickname' => $this->input->post('nickname'),
                            'first_name' => $this->input->post('first_name'),
                            'middle_name' => $this->input->post('middle_name'),
                            'last_name' => $this->input->post('last_name'),
                            'name_ext' => $this->input->post('name_ext'),
                            'date_of_birth' => $this->input->post('date_of_birth'),
                            'place_of_birth' => $this->input->post('place_of_birth'),
                            'sex' => $this->input->post('sex'),
                            'civil_status' => $this->input->post('civil_status'),
                            'occupation' => $this->input->post('occupation'),
                            'chu_churchID' => $_SESSION['currentChurchID'],
                            'con_mobile_no' => $this->input->post('con_mobile_no'),
                            'con_tel_no' =>  $this->input->post('con_tel_no'),
                            'soc_facebook_url' =>  $this->input->post('soc_facebook_url'),
                            'loc_country' =>  $this->input->post('loc_country'),
                            'loc_province' =>  $this->input->post('loc_province'),
                            'loc_city' =>  $this->input->post('loc_city'),
                            'loc_barangay' =>  $this->input->post('loc_barangay'),
                            'loc_address' =>  $this->input->post('loc_address'),
                            'loc_zipcode' =>  $this->input->post('loc_zipcode'),
                        );

                        $family = array('family' => $this->input->post('family'));

                        $account = array( 'userAccount' =>  $this->input->post('userAccount'),
                        'username' => $this->input->post('username'),
                        'email' => $this->input->post('email'),
                        'password' => $this->input->post('password'));

                        $member = array(
                            '1st_timer' => $this->checkbox_checker($this->input->post('f_timer')),
                            '1st_timer_dt' => $this->input->post('f_timer_dt'),
                            '2nd_timer' => $this->checkbox_checker($this->input->post('s_timer')),
                            '2nd_timer_dt' => $this->input->post('s_timer_dt'),
                            'visitor' => $this->checkbox_checker($this->input->post('visitor')),
                            'visitor_dt' => $this->input->post('visitor_dt'),
                            'evangelized' => $this->checkbox_checker($this->input->post('evangelized')),
                            'evangelized_dt' => $this->input->post('evangelized_dt'),
                            'encountered' => $this->checkbox_checker($this->input->post('encountered')),
                            'encountered_dt' => $this->input->post('encountered_dt'),
                            'reencountered' => $this->checkbox_checker($this->input->post('reencountered')),
                            'reencountered_dt' => $this->input->post('reencountered_dt'),
                            'baptized' => $this->checkbox_checker($this->input->post('baptized')),
                            'baptized_who' => $this->input->post('baptized_who'),
                            'baptized_dt' => $this->input->post('baptized_dt'),
                            'regular_attendant' => $this->checkbox_checker($this->input->post('regular_attendant')),
                            'regular_attendant_dt' => $this->input->post('regular_attendant_dt'),
                            'simbanay' => $this->checkbox_checker($this->input->post('simbanay')),
                            'simbanay_dt' => $this->input->post('simbanay_dt'),
                            'lifeclass' => $this->checkbox_checker($this->input->post('lifeclass')),
                            'lifeclass_dt' => $this->input->post('lifeclass_dt'),
                            'churchRoleID' => $this->input->post('churchRoleID'),
                            'sol1' => $this->checkbox_checker($this->input->post('sol_o')),
                            'sol1_dt' => $this->input->post('sol_o_dt'),
                            'sol2' => $this->checkbox_checker($this->input->post('sol_tw')),
                            'sol2_dt' => $this->input->post('sol_tw_dt'),
                            'sol3' => $this->checkbox_checker($this->input->post('sol_th')),
                            'sol3_dt' => $this->input->post('sol_th_dt'),
                        );

                     
                            //ESCAPE USER ACCOUNT//

                            $this->MembersModel->createProfile($profile,$account,$member,$family);

                            $data = array('response'=>'success','message' => 'You have successfully added new member.');
                            echo json_encode($data);

                    
                    

                    
                    }        

            }else{
                $this->load->view('templates/header');
                $this->load->view('errors/restricted');
                $this->load->view('templates/footer');	
            }
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }
    }

    private function checkbox_checker($data){
        if ($data=="true"){
            return 1;
        }
        return 0;
    }

    public function get_basic_information_form(){
        if($this->input->is_ajax_request()){
            if(isset($_SESSION['currentChurchID'])){
                $data = array(
                    'response' => 'success',
                    'post' => $this->ChurchFormModel->create_edit_church_form($_SESSION['currentChurchID'])
                );
                echo json_encode($data);
            }else{
                $this->load->view('templates/header');
                $this->load->view('errors/restricted');
                $this->load->view('templates/footer');	
            }
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }
    }

    public function get_view_church_form(){
        if($this->input->is_ajax_request()){
            if(isset($_SESSION['currentChurchID'])){
                $data = array(
                    'response' => 'success',
                    'post' => $this->ChurchFormModel->create_edit_church_form($_SESSION['currentChurchID'])
                );
                echo json_encode($data);
            }else{
                $this->load->view('templates/header');
                $this->load->view('errors/restricted');
                $this->load->view('templates/footer');	
            }
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }
    }
    public function get_address_form(){
        if($this->input->is_ajax_request()){
            if(isset($_SESSION['currentChurchID'])){
                $data = array(
                    'response' => 'success',
                    'post' => $this->ChurchFormModel->create_address_form($_SESSION['currentChurchID'])
                );
    
                echo json_encode($data);

            }
           else
           {
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
           } 
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }
    }

    public function get_view_members_form(){
        if($this->input->is_ajax_request()){
            if($_SESSION['currentChurchID']>0){

                $post = $this->member->view_member();

                $data = array(
                    'response' => 'success',
                    'post' => $post);
    
                echo json_encode($data);

            }
           else
           {
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
           } 
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }
    }

    public function select_church(){
        if($this->input->is_ajax_request()){

            $_SESSION['currentChurchID'] = $this->input->post('id');

            $data = array(
                'response' => 'success',
                'post' => $this->RolesFormModel->createTabControls($this->input->post('id'))
            );
            
            echo json_encode($data);
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }
    }

    public function get_church(){
        if($this->input->is_ajax_request()){
            $id=0;
            if($_SESSION['currentChurchID']>0) $id=$_SESSION['currentChurchID'];
            $data = array(
                'response' => 'success',
                'post' => $this->RolesFormModel->createTabControls($id)
            );

            echo json_encode($data);
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }
    }
    public function set_church(){
        if($this->input->is_ajax_request()){
            $_SESSION['currentChurchID'] = $this->input->post('id');
            echo base_url() . 'church/roles';
        }
        else{
            $this->load->view('templates/header');
            $this->load->view('errors/restricted');
            $this->load->view('templates/footer');	
        }
    }
}