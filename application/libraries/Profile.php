<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile {

    function __construct(){
        $this->CI = & get_instance();
    }

    public function tabtitle(){

        $app = $this->CI->ParameterModel->getGroupParameter('app');
        $page = $this->CI->ParameterModel->getGroupParameter_wrapText('profile','span class="ms-2 mb-1"');

        return $this->wrapper('
        <!-- Tab Title -->
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body pt-3">  
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="mobile-tab nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">'.$page['nav-tabs-overview'].'</button>
                </li>
                <li class="mobile-tab nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-profile">'.$page['nav-tabs-profile'].'</button>
                </li>
                <li class="mobile-tab nav-item">
                  <button id="btnFamilyBackground" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-family-background">'.$page['nav-tabs-family-background'].'</button>
                </li>
                <li class="mobile-tab nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">'.$page['nav-tabs-settings'].'</button>
                </li>
              </ul>
              <!-- End of Tab Title -->
        ');
    }

    public function overviewtab($row,$churchInformation){
        $input = $this->CI->ParameterModel->getGroupParameter('input');
        $width = $this->CI->ParameterModel->getGroupParameter('col-width');
        $heading = $this->CI->ParameterModel->getGroupParameter('heading');

        return $this->wrapper('
        <div class="tab-pane fade show active profile-overview" id="profile-overview">   
            <div class="col-xl-12">
                <h2 class="mobile-tab-title" align=center>'.$heading['overview'].'</h2>
                  <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        
                        <img style="object-fit: cover;" id="imgProfile" src="'.$_SESSION['profilephoto'] .'" alt="Profile" class="rounded-circle">
                        <h2>'.$row['first_name'].' '.$row['last_name'].'</h2>
                        <h3>'.$_SESSION['accessLevelName'].'</h3>   


        <div class="social-links mt-2">'.
                    ($row['soc_facebook_url'] != '' ? '<a target="_blank" href="'.$row['soc_facebook_url'].'" class="facebook"><i class="bi bi-facebook"></i></a>' : '').
                    ($row['soc_youtube_url'] != '' ? '<a target="_blank" href="'.$row['soc_youtube_url'].'" class="youtube"><i class="bi bi-youtube"></i></a>' : '').
                    ($row['soc_twitter_url'] != '' ? '<a target="_blank" href="'.$row['soc_twitter_url'].'" class="twitter"><i class="bi bi-twitter"></i></a>' : '').
                    ($row['soc_tiktok_url'] != '' ? '<a target="_blank" href="'.$row['soc_tiktok_url'].'" class="tiktok"><i class="bi bi-tiktok"></i></a>' : '').
                    ($row['soc_instagram_url'] != '' ? '<a target="_blank" href="'.$row['soc_instagram_url'].'" class="instagram"><i class="bi bi-instagram"></i></a>' : '').
                    ($row['soc_linkin_url'] != '' ? '<a target="_blank" href="'.$row['soc_linkin_url'].'" class="linkedin"><i class="bi bi-linkedin"></i></a>' : '').
                    '
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                    '.
                    $this->CI->field->label_headings_overview($heading['prof-details'])
                    .'
                        '.
                        $this->CI->field->label_overview($input['about'],$row['about'],$width['label-overview'],$width['label-overview-data'])
                        .'       
                        '.
                        $this->CI->field->label_overview($input['nickname'],$row['nickname'],$width['label-overview'],$width['label-overview-data'])
                        .'
                        '.
                        $this->CI->field->label_overview($input['first_name'],$row['first_name'],$width['label-overview'],$width['label-overview-data'])
                        .'
                        '.
                        $this->CI->field->label_overview($input['middle_name'],$row['middle_name'],$width['label-overview'],$width['label-overview-data'])
                        .'
                        '.
                        $this->CI->field->label_overview($input['last_name'],$row['last_name'],$width['label-overview'],$width['label-overview-data'])
                        .'
                        '.
                        $this->CI->field->label_overview($input['name_ext'],$row['name_ext'],$width['label-overview'],$width['label-overview-data'])
                        .'
                        '.
                        $this->CI->field->label_overview($input['date_of_birth'],$row['date_of_birth'],$width['label-overview'],$width['label-overview-data'])
                        .' 
                        '.
                        $this->CI->field->label_overview($input['place_of_birth'],$row['place_of_birth'],$width['label-overview'],$width['label-overview-data'])
                        .'  
                        '.
                        $this->CI->field->label_overview($input['gender'],$row['sex'],$width['label-overview'],$width['label-overview-data'])
                        .' 
                        '.
                        $this->CI->field->label_overview($input['CivilStatus'],$row['civil_status'],$width['label-overview'],$width['label-overview-data'])
                        .' 
                        '.
                        $this->CI->field->label_overview($input['height'],$row['height'].' '.$row['height_metric'],$width['label-overview'],$width['label-overview-data'])
                        .'         
                        '.
                        $this->CI->field->label_overview($input['weight'],$row['weight'].' '.$row['weight_metric'],$width['label-overview'],$width['label-overview-data'])
                        .' 
                        '.
                        $this->CI->field->label_overview($input['BloodType'],$row['blood_type'],$width['label-overview'],$width['label-overview-data'])
                        .' 
                
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        '.
                        $this->CI->field->label_headings_overview($heading['educ-background'])
                        .'  
                            '.
                            $this->CI->field->label_overview($input['EducationalAttainment'],$row['educ_attainment'],$width['label-overview'],$width['label-overview-data'])
                            .'
                            '.
                            $this->CI->field->label_overview($input['elementaryschool'],$row['educ_elem'],$width['label-overview'],$width['label-overview-data'])
                            .'
                            '.
                            $this->CI->field->label_overview($input['elem_year_graduated'],$row['educ_elem_year_graduated'],$width['label-overview'],$width['label-overview-data'])
                            .'
                            '.
                            $this->CI->field->label_overview($input['highschool'],$row['educ_high_school'],$width['label-overview'],$width['label-overview-data'])
                            .'
                            '.
                            $this->CI->field->label_overview($input['high_year_graduated'],$row['educ_high_school_graduated'],$width['label-overview'],$width['label-overview-data'])
                            .'
                            '.
                            $this->CI->field->label_overview($input['collegeschool'],$row['educ_college'],$width['label-overview'],$width['label-overview-data'])
                            .'
                            '.
                            $this->CI->field->label_overview($input['college_year_graduated'],$row['educ_college_graduate'],$width['label-overview'],$width['label-overview-data'])
                            .'
                            '.
                            $this->CI->field->label_overview($input['course'],$row['educ_course'],$width['label-overview'],$width['label-overview-data'])
                            .'
                    </div>
                </div>
            </div>  
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        '.
                        $this->CI->field->label_headings_overview($heading['ministry'])
                        .' 
                            '.
                            $this->CI->field->label_overview($input['church-name'],$churchInformation['church_name'],$width['label-overview'],$width['label-overview-data'])
                            .' 
                            '.
                            $this->CI->field->label_overview($input['full-address'],$churchInformation['complete_address'],$width['label-overview'],$width['label-overview-data'])
                            .' 
                            '.
                            $this->CI->field->label_overview($input['servant-leader'],$churchInformation['pastor_leader'],$width['label-overview'],$width['label-overview-data'])
                            .' 
                            '.
                            $this->CI->field->label_overview($input['role'],"-",$width['label-overview'],$width['label-overview-data'])
                            .'                                                     
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">                    
                        '.
                        $this->CI->field->label_headings_overview($heading['home-address'])
                        .'
                        <div class="row">
                            <div class="col-lg-4 col-md-4 label ">'.$input['address'].'</div>
                            <div class="col-lg-8 col-md-8">'.
                            ($row['loc_address'] != '' ? $row['loc_address'].', ' : '').
                            ($row['loc_barangay'] != '' ? $row['loc_barangay'].', ' : '').
                            ($row['loc_city'] != '' ? $row['loc_city'].', ' : '').
                            ($row['loc_province'] != '' ? $row['loc_province'].', ' : '').
                            ($row['loc_zipcode'] != '' ? $row['loc_zipcode'].', ' : '').
                            ($row['loc_country'] != '' ? $row['loc_country'].'' : '').
                            '</div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">                    
                        '.
                        $this->CI->field->label_headings_overview($heading['contact-info'])
                        .' 
                            '.
                            $this->CI->field->label_overview($input['mobileno'],$row['con_tel_no'],$width['label-overview'],$width['label-overview-data'])
                            .'
                            '.
                            $this->CI->field->label_overview($input['telno'],$row['con_tel_no'],$width['label-overview'],$width['label-overview-data'])
                            .' 
                            '.
                            $this->CI->field->label_overview($input['email'],$row['email'],$width['label-overview'],$width['label-overview-data'])
                            .' 
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">                    
                        '.
                        $this->CI->field->label_headings_overview($heading['work-background'])
                        .' 
                            '.
                            $this->CI->field->label_overview($input['name_of_employer'],$row['occ_name_of_employer'],$width['label-overview'],$width['label-overview-data'])
                            .' 
                            '.
                            $this->CI->field->label_overview($input['occupation'],$row['occ_occupation'],$width['label-overview'],$width['label-overview-data'])
                            .' 
                            '.
                            $this->CI->field->label_overview($input['employeraddress'],$row['occ_address'],$width['label-overview'],$width['label-overview-data'])
                            .' 
                    </div>
                </div>                

             </div>

            </div>    
        </div>
        <!-- End Overview Tab -->
        ');
    }
    public function profiletab(){
        $input = $this->CI->ParameterModel->getGroupParameter('input');
        $width = $this->CI->ParameterModel->getGroupParameter('col-width');
        $heading = $this->CI->ParameterModel->getGroupParameter('heading');
        $profileInformation = $this->CI->ProfileModel->getProfileInformation($_SESSION['userID']);
        return $this->wrapper('
        <div class="tab-pane fade profile-edit" id="profile-profile">
        <h2 class="mobile-tab-title" align=center>'.$heading['prof-info'].'</h2>
        <div class="row mb-3">
            <!-- LEFT COLUMN -->
            
            <div class="col-lg-6">
            
                <div class="card">
                    <div class="card-body">
                        '.
                        $this->CI->field->label_profile("",$heading['prof-image'],$width['label-heading'])
                        .'
                        <div class="col-md-8 col-lg-9">
                            <div id="cropped_image_result">
                                <img id="imgEditProfile" src="'.base_url(). $_SESSION['profilephoto'] .'" alt="Profile" >
                            </div>
                            <div class="pt-2">
    
                                <form method="post" id="upload_form" enctype="multipart/form">
                                    <input style="display:none" id="image_file" name="image_file" type="file" accept=".png, .jpg, .jpeg" />
                                    <input style="display:none" type="submit" name="upload" id="upload" value="upload">
                                </form>
    
                                    <button id="btnUploadPhoto" class="btn btn-primary btn-sm"><i class="bi bi-upload"></i></button>
                                    <button id="btnRemovePhoto"  class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                        <form>
                    '.
                    $this->CI->field->input_textarea_profile($input['key-about'],$input['about'],$profileInformation['about'],$width['label'],$width['div-input'])
                    .'   
                    '.
                    $this->CI->field->input_text_profile($input['key-nickname'],$input['nickname'],$profileInformation['nickname'],$width['label'],$width['div-input'])
                    .' 
                    '.
                    $this->CI->field->input_text_profile($input['key-first_name'],$input['first_name'],$profileInformation['first_name'],$width['label'],$width['div-input'])
                    .' 
                    '.
                    $this->CI->field->input_text_profile($input['key-middle_name'],$input['middle_name'],$profileInformation['middle_name'],$width['label'],$width['div-input'])
                    .'         
                    '.
                    $this->CI->field->input_text_profile($input['key-last_name'],$input['last_name'],$profileInformation['last_name'],$width['label'],$width['div-input'])
                    .'        
                    '.
                    $this->CI->field->input_text_profile($input['key-name_ext'],$input['name_ext'],$profileInformation['name_ext'],$width['label'],$width['div-input'])
                    .'         
                    '.
                    $this->CI->field->input_date_profile($input['key-date_of_birth'],$input['date_of_birth'],$profileInformation['date_of_birth'],$width['label'],$width['div-input'])
                    .'       
                    '.
                    $this->CI->field->input_text_profile($input['key-place_of_birth'],$input['place_of_birth'],$profileInformation['place_of_birth'],$width['label'],$width['div-input'])
                    .'                  
                    '.
                    $this->CI->field->input_radio_profile($input['key-sex'],$input['sex'],$profileInformation['sex'],$input['mode-sex'],$width['label'],$width['div-input'])
                    .'  

                    '.
                    $this->CI->field->input_select_profile($input['key-CivilStatus'],$input['CivilStatus'],$this->CI->ParameterModel->getDefaultParameterList('Civil Status',$profileInformation['civil_status']),$width['label'],$width['div-input'])
                    .'     
                    '.
                    $this->CI->field->input_metric_profile($input['key-height'],$input['height'],$profileInformation['height'],$this->CI->ParameterModel->getDefaultParameterList('Height Metric',$profileInformation['height_metric']),$width['label'])
                    .'     
                    '.
                    $this->CI->field->input_metric_profile($input['key-weight'],$input['weight'],$profileInformation['weight'],$this->CI->ParameterModel->getDefaultParameterList('Weight Metric',$profileInformation['weight_metric']),$width['label'])
                    .' 
                    '.
                    $this->CI->field->input_select_profile($input['key-BloodType'],$input['BloodType'],$this->CI->ParameterModel->getDefaultParameterList('Blood Type',$profileInformation['blood_type']),$width['label'],$width['div-input'])
                    .' 

                </form>
            </div>        
        </div> 

        <div class="card">
            <div class="card-body">
                '.
                $this->CI->field->label_profile("",$heading['educ-background'],$width['label-heading'])
                .'         
                        '.
                        $this->CI->field->input_select_profile($input['key-EducationalAttainment'],$input['EducationalAttainment'],$this->CI->ParameterModel->getDefaultParameterList('Educational Attainment',$profileInformation['educ_attainment']),$width['label'],$width['div-input'])
                        .'                                
                        '.
                        $this->CI->field->input_text_profile($input['key-elementaryschool'],$input['elementaryschool'],$profileInformation['educ_elem'],$width['label'],$width['div-input'])
                        .'         
                        '.
                        $this->CI->field->input_date_profile($input['key-elem_year_graduated'],$input['elem_year_graduated'],$profileInformation['educ_elem_year_graduated'],$width['label'],$width['div-input'])
                        .' 
                        '.
                        $this->CI->field->input_text_profile($input['key-highschool'],$input['highschool'],$profileInformation['educ_high_school'],$width['label'],$width['div-input'])
                        .'                             
                        '.
                        $this->CI->field->input_date_profile($input['key-high_year_graduated'],$input['high_year_graduated'],$profileInformation['educ_high_school_graduated'],$width['label'],$width['div-input'])
                        .'         
                        '.
                        $this->CI->field->input_text_profile($input['key-collegeschool'],$input['collegeschool'],$profileInformation['educ_college'],$width['label'],$width['div-input'])
                        .'                         
                        '.
                        $this->CI->field->input_date_profile($input['key-college_year_graduated'],$input['college_year_graduated'],$profileInformation['educ_college_graduate'],$width['label'],$width['div-input'])
                        .'                             
                        '.
                        $this->CI->field->input_text_profile($input['key-course'],$input['course'],$profileInformation['educ_course'],$width['label'],$width['div-input'])
                        .'                 
                    </div>  
                </div>
            </div>
    <!-- END OF LEFT COLUMN -->
    <!-- START OF RIGHT COLUMN -->                               
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                '.
                $this->CI->field->label_profile("",$heading['home-address'],$width['label-heading'])
                .
                    $this->CI->field->input_textarea_profile($input['key-address'],$input['address'],$profileInformation['loc_address'],$width['label'],$width['div-input'])
                    .                                       
                    $this->CI->field->input_autocomplete_profile($input['key-Country'],$input['Country'],$profileInformation['country'],$width['label'],$width['div-input'],"NAME_0.spatial_location",10)                 
                    .                   
                    $this->CI->field->input_autocomplete_profile($input['key-Province'],$input['Province'],$profileInformation['province'],$width['label'],$width['div-input'],"NAME_1.spatial_location",10)
                    .
                    $this->CI->field->input_autocomplete_profile($input['key-City'],$input['City'],$profileInformation['city'],$width['label'],$width['div-input'],"NAME_2.spatial_location",10)              
                    .                   
                    $this->CI->field->input_autocomplete_profile($input['key-Barangay'],$input['Barangay'],$profileInformation['barangay'],$width['label'],$width['div-input'],"NAME_3.spatial_location",10)        
                    .
                    $this->CI->field->input_autocomplete_profile($input['key-zipcode'],$input['zipcode'],$profileInformation['loc_zipcode'],$width['label'],$width['div-input'],"loc_zipcode.profile",10)
                    .'                                    
                </div>
            </div>    
            <div class="card">
                <div class="card-body">
                    '.
                    $this->CI->field->label_profile("",$heading['contact-info'],$width['label-heading'])
                    .
                        $this->CI->field->input_text_profile($input['key-mobileno'],$input['mobileno'],$profileInformation['con_mobile_no'],$width['label'],$width['div-input'])
                        .
                        $this->CI->field->input_text_profile($input['key-telno'],$input['telno'],$profileInformation['con_tel_no'],$width['label'],$width['div-input'])
                        .'  
                </div>   
            </div>
            <!-- SOCIAL INFORMATION -->
            <div class="card">
                <div class="card-body">
                    '.
                    $this->CI->field->label_profile("",$heading['soc-info'],$width['label-heading'])
                    .' 
                        '.
                        $this->CI->field->input_text_profile($input['key-facebook'],$input['facebook'],$profileInformation['soc_facebook_url'],$width['label'],$width['div-input'])
                        .
                        $this->CI->field->input_text_profile($input['key-youtube'],$input['youtube'],$profileInformation['soc_youtube_url'],$width['label'],$width['div-input'])
                        .
                        $this->CI->field->input_text_profile($input['key-instagram'],$input['instagram'],$profileInformation['soc_instagram_url'],$width['label'],$width['div-input'])
                        .
                        $this->CI->field->input_text_profile($input['key-linkin'],$input['linkin'],$profileInformation['soc_linkin_url'],$width['label'],$width['div-input'])
                        .
                        $this->CI->field->input_text_profile($input['key-tiktok'],$input['tiktok'],$profileInformation['soc_tiktok_url'],$width['label'],$width['div-input'])
                        .
                        $this->CI->field->input_text_profile($input['key-twitter'],$input['twitter'],$profileInformation['soc_twitter_url'],$width['label'],$width['div-input'])
                        .' 
                </div>  
            </div>
            <!-- END OF SOCIAL INFORMATION -->
            <!-- WORK BACKGROUND -->
            <div class="card">
                <div class="card-body">
                        '.
                        $this->CI->field->label_profile("",$heading['work-background'],$width['label-heading'])
                        .' 
                            '.
                            $this->CI->field->input_text_profile($input['key-name_of_employer'],$input['name_of_employer'],$profileInformation['occ_name_of_employer'],$width['label'],$width['div-input'])
                            .'     
                            '.
                            $this->CI->field->input_text_profile($input['key-occupation'],$input['occupation'],$profileInformation['occ_occupation'],$width['label'],$width['div-input'])
                            .'                             
                            '.
                            $this->CI->field->input_text_profile($input['key-employeraddress'],$input['employeraddress'],$profileInformation['occ_address'],$width['label'],$width['div-input'])
                            .'     
                </div>
            </div>
            <!-- END OF WORK BACKGROUND -->
                </div>
            </div>
            <div class="text-center">
            <button id="btnProfileSave" type="submit" class="btn btn-primary"><span class="bi bi-save me-2"></span>Update</button>
        </div>
        </div>

       
        <!-- End Profile Edit Form -->


        <!-- DIALOG MODAL -->      
        <div class="modal" id="verticalycentered" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 id="dialog-title" class="modal-title"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="dialog-content" class="modal-body">                      
                </div>
                <div class="modal-footer">
                  <button id="btnPositive" type="button" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                  <button id="btnNegative" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>

        <!-- UPLOAD MODAL -->
        <div class="modal" id="uploadModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" >
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Select Image and Crop</h5>
                  <button id="btnCancelUpload" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body justify-content-center" style="height:100%">

                <div id="display_image_div" class="bg-secondary d-flex align-items-center justify-content-center" >
                  <img name="display_image_data" id="display_image_data" src="dummy-image.png" alt="Picture" class="img-fluid d-fluid" style="height:auto;width:100%">
                </div>  

                </div>
                <div class="modal-footer">
                  <label><small>Scroll the Mouse to Zoom in and out</small></label>
                  <button id="btnImageCropper" type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-crop me-2"></i>Crop</button>
                
                </div>
              </div>
            </div>
          </div><!-- End Large Modal-->                       


          <script>

          $("#btnCancelUpload").click(function(){
                  $("#btnUploadPhoto").removeAttr("disabled");
                  $("#btnUploadPhoto").html("<i class=\'bi bi-upload\'></i>");
                  $("#btnRemovePhoto").show();
          });
          
          $("body").on("change", "#image_file", function(e) {
            
              var files = $("#image_file")[0].files;
              var done = function(url) {        
                $("#display_image_div").html("");
                $("#display_image_div").html("<img name=\'display_image_data\' id=\'display_image_data\' src=" + url + " alt=\'Uploaded Picture\' class=\'img-fluid\'>");
             
              };
              if (files && files.length > 0) {
                  file = files[0];
          
                  if (URL) {
                      done(URL.createObjectURL(file));
                  } else if (FileReader) {
                      reader = new FileReader();
                      reader.onload = function(e) {
                          done(reader.result);
                      };
                      reader.readAsDataURL(file);
                  }
              }
          
          var image = document.getElementById("display_image_data");
          var button = document.getElementById("btnImageCropper");
          var result = document.getElementById("cropped_image_result");
          var croppable = false;
          var cropper = new Cropper(image, {
                  aspectRatio         : 1,
                  zoomOnTouch: true,
                          zoomOnWheel: true,
                          minContainerWidth: 360,
                          minContainerHeight: 280,
                          minCanvasWidth : 360,
                          minCanvasHeight :360,
                          minCropBoxWidth: 200,
                          minCropBoxHeight: 200,
                          maxCropBoxWidth: 200,
                          maxCropBoxHeight: 200,
                          dragMode: "move",
          ready: function () {
          croppable = true;
          },
          });
          
           button.onclick = function () {
              var croppedCanvas;
              var roundedCanvas;
              var roundedImage;
            
              if (!croppable) {return;}
              /* Crop */
              croppedCanvas = cropper.getCroppedCanvas();
              /* Round */
              roundedCanvas = getRoundedCanvas(croppedCanvas);
              /* Show */
              roundedImage = document.createElement("img");
              roundedImage.src = roundedCanvas.toDataURL();  
              result.innerHTML = "";
              result.appendChild(roundedImage);
        
              upload();
             
            };
          
          });
          
          function getRoundedCanvas(sourceCanvas) {
            var canvas = document.createElement("canvas");
            var context = canvas.getContext("2d");
            var width = sourceCanvas.width;
            var height = sourceCanvas.height;
          
            canvas.width = width;
            canvas.height = height;
            context.imageSmoothingEnabled = true;
            context.drawImage(sourceCanvas, 0, 0, width, height);
            context.globalCompositeOperation = "destination-in";
            context.beginPath();
            context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI, true);
            context.fill();
            return canvas;
          }
          
          function upload()
          {$("#upload").trigger("click");}
          
          $("#upload_form").on("submit",function(e){
            e.preventDefault();
            if($("#image_file").val()==""){
              alert("Please select file");
            }else{
            
                   
              $("#btnUploadPhoto").attr("disabled","disabled");
              $("#btnUploadPhoto").html("<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span><span class=\'visually-hidden\'>Loading...</span>");
              $("#btnRemovePhoto").hide();
          
              $("#uploadModal").modal({  backdrop: \'static\', keyboard: false});
              $("#uploadModal").modal(\'show\');
              var base64data = $(\'#cropped_image_result img\').attr(\'src\');
          
              $("#btnImageCropper").attr("disabled","disabled");
              $("#btnImageCropper").html("<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span><span class=\'visually-hidden me-2\'>Loading...</span><span class=\'ms-2\'>Crop</span>");
              
              
              $.ajax({
                url:"' . base_url() . 'profile/upload-profile-photo",
                method:"POST",
                data:{
                  image: base64data
                },
                success:function(data){
          
                  $("#btnImageCropper").removeAttr("disabled");
                  $("#btnImageCropper").html("<i class=\'bi bi-crop me-2\'></i>Crop");
          
                  $("#btnUploadPhoto").removeAttr("disabled");
                  $("#btnUploadPhoto").html("<i class=\'bi bi-upload\'></i>");
                  $("#btnRemovePhoto").show();
                  /* $("#upload_form").html(data); */
                  $("#imgEditProfile").attr("src",data);
                  $("#imgProfile").attr("src",data);

                  $("#uploadModal").modal("hide");
                }
              }); 
            }
          });
          
          
          
          $("#btnProfileSave").click(function() {
          
          $("#btnProfileSave").attr("disabled","disabled");
          $("#btnProfileSave").html("<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\' style=\'margin-right:10px\'></span><span class=\'visually-hidden\'>Loading...</span>Update");
          
          $.post("'. base_url() .'profile/update-profile", {
          about:$("#txtabout").val(), 
          nickname:$("#txtnickname").val(), 
          first_name:$("#txtfirst_name").val(), 
          middle_name:$("#txtmiddle_name").val(), 
          last_name:$("#txtlast_name").val(),
          name_ext: $("#txtname_ext").val(),
          date_of_birth: $("#txtdate_of_birth").val(),
          place_of_birth: $("#txtplace_of_birth").val(),
          sex: $("input[name=\'sex\']:checked").val(),
          civil_status: $("#cboCivilStatus").find(":selected").val(),
          height:$("#txtheight").val(),
          height_metric: $("#cboHeight").find(":selected").val(),
          weight:$("#txtweight").val(),
          weight_metric: $("#cboWeight").find(":selected").val(),
          blood_type:$("#cboBloodType").find(":selected").val(),
          loc_country: $("#txtCountry").val(),
          loc_province: $("#txtProvince").val(),
          loc_city: $("#txtCity").val(),
          loc_barangay: $("#txtBarangay").val(),
          loc_address: $("#txtaddress").val(),
          loc_zipcode: $("#txtzipcode").val(),
          con_mobile_no: $("#txtmobileno").val(),
          con_tel_no: $("#txttelno").val(),
          educ_elem:$("#txtelementaryschool").val(),
          educ_elem_year_graduated:$("#txtelem_year_graduated").val(),
          educ_high_school:$("#txthighschool").val(),
          educ_high_school_graduated:$("#txthigh_year_graduated").val(),
          educ_college:$("#txtcollegeschool").val(),
          educ_college_graduate:$("#txtcollege_year_graduated").val(),
          educ_attainment:$("#cboEducationalAttainment").find(":selected").val(),
          educ_course:$("#txtcourse").val(),
          occ_name_of_employer:$("#txtname_of_employer").val(),
          occ_occupation:$("#txtoccupation").val(),
          occ_address:$("#txtemployeraddress").val(),
          soc_facebook_url: $("#txtfacebook").val(),
          soc_youtube_url: $("#txtyoutube").val(),
          soc_instagram_url: $("#txtinstagram").val(),
          soc_linkin_url: $("#txtlinkin").val(),
          soc_tiktok_url: $("#txttiktok").val(),
          soc_twitter_url: $("#txttwitter").val(),
          action:"update-profile"
          }).done(function(response){

              set_success_alert("You have successfully updated the profile.");

              /* $("#verticalycentered").modal("show"); */
              $("#dialog-title").text("Profile Update");
              $("#btnPositive").hide();
              $("#btnNegative").html("<span class=\'bi bi-x-circle-fill me-2\'></span>Close");
              $("#dialog-content").text("You have successfully updated the profile.");
              $("#btnProfileSave").removeAttr("disabled");
              $("#btnProfileSave").html("<span class=\'bi bi-save me-2\'></span>Update");
          });
          
          });
          
          $("#btnUploadPhoto").click(function() {
          $("#image_file").trigger("click");
          });
          
          $("#image_file").change(function(evt) { 
          
              $("#btnUploadPhoto").attr("disabled","disabled");
              $("#btnUploadPhoto").html("<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span><span class=\'visually-hidden\'>Loading...</span>");
              $("#btnRemovePhoto").hide();
          
              $("#uploadModal").modal({  backdrop: "static", keyboard: false});
              $("#uploadModal").modal("show");
          
          });
          
          $("#upload_form").on("submit",function(e){
          e.preventDefault();
          if($("#image_file").val()==""){
          alert("Please select file");
          }else{
          
          }
          
          });
          
          
          $("#btnRemovePhoto").click(function() {
          $("#verticalycentered").modal("show");
                $("#dialog-title").text("Delete Profile Photo Confirm");
                $("#btnPositive").show();
                $("#btnPositive").html("<span class=\'bi bi-check-circle-fill me-2\'></span>Yes");
                $("#btnNegative").html("<span class=\'bi bi-x-circle-fill me-2\'></span>No");
                $("#dialog-content").text("Are you sure you want to delete this photo?");
          }); 
          
          $("#btnPositive").click(function() {
          $.post("'.base_url().'profile/remove-profile-photo", {
          action:"remove-profile-photo"
          }).done(function(response){
            $("#imgEditProfile").attr("src",response);
            $("#cropped_image_result").children("img").attr(response);
            $("#imgProfile").attr("src",response);
          });
          });
          
          /* load_country(); */
          
          function load_country(){
          $.ajax({
              url: "'. base_url() .'spatial",
              type: "post", dataType: "json",
              data:{search_value: $("#cboCountry").find(":selected").val(), type:"fetch-country"}, 
              success: function(data){

                  if(data.response=="success"){
                      $("#cboCountry").html(data.html);   
                  }
              }
          });
          }
          
          $("#cboCountry").on("change", function() {
          if($("#cboCountry").find(":selected").val()==""){
          $.ajax({
              url: "'.base_url() .'spatial",
              type: "post", dataType: "json",
              data:{search_value: $("#cboCountry").find(":selected").val(), type:"fetch-country"}, 
              success: function(data){
                  /*console.log(data);*/
                  if(data.response=="success"){
                      $("#cboCountry").html(data.html);   
                  }
              }
          });
          }else{
          $.ajax({
              url: "'.base_url() .'spatial",
              type: "post", dataType: "json",
              data:{search_value: $("#cboCountry").find(":selected").val(), type:"fetch-province"}, 
              success: function(data){
                  /*console.log(data);*/
                  if(data.response=="success"){
                      $("#cboProvince").html(data.html);   
                      $("#cboCity").val("- Select City/Municipality -");
                      $("#cboBarangay").val("- Select Barangay -");
                  }
              }
          });
          }
          });       
          
          $("#cboProvince").on("change", function() {
              $.ajax({
              url: "'.base_url() .'spatial",
              type: "post", dataType: "json",
              data:{search_value: $("#cboProvince").find(":selected").val(), type:"fetch-city"}, 
              success: function(data){
                  /*console.log(data);*/
                  if(data.response=="success"){
                      $("#cboCity").html(data.html);   
                      $("#cboBarangay").val(1);
                  }
              }
          });
          
          });
          
          $("#cboCity").on("change", function() {
          $.ajax({
              url: "'.base_url() .'spatial",
              type: "post", dataType: "json",
              data:{search_value: $("#cboCity").find(":selected").val(), type:"fetch-barangay"}, 
              success: function(data){
                  /*console.log(data);*/
                  if(data.response=="success"){
                      $("#cboBarangay").html(data.html);   
                  }
              }
          });
          });
          
          
          </script>                  
          


        ');
    }

    public function familytab(){
        $input = $this->CI->ParameterModel->getGroupParameter('input');
        $width = $this->CI->ParameterModel->getGroupParameter('col-width');
        $heading = $this->CI->ParameterModel->getGroupParameter('heading');

        return $this->wrapper('
        <div class="tab-pane fade" id="profile-family-background">
        <!-- ROW  -->           
        <h2 class="mobile-tab-title" align=center>'.$heading['family-background'].'</h2>
        <div class="row mb-3">
        
            <!-- LEFT COLUMN -->
            <div class="col-lg-6">
                <div class="card">
                
                    <div class="card-body">
                                <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                                '.
                                $this->CI->field->input_text_family($input['key-relName'],$input['relName'],"",$width['label'],$width['div-input'])
                                .
                                $this->CI->field->input_date_profile($input['key-relDateOfBirth'],$input['relDateOfBirth'],"",$width['label'],$width['div-input'])
                                .
                                $this->CI->field->input_number_profile($input['key-relAge'],$input['relAge'],"",$width['label'],$width['div-input'])
                                .
                                $this->CI->field->input_autocomplete_profile($input['key-relOccupation'],$input['relOccupation'],"",$width['label'],$width['div-input'],"rel_occupation.profile_family_background",10)                 
                                .'                               
                    </div>        
                </div>    
            </div>
            <!-- END OF LEFT COLUMN -->
            <!-- START OF RIGHT COLUMN -->                          
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>    
                        <input id="txtFamilyID" type="hidden" value="">
                                '.
                                $this->CI->field->input_select_profile($input['key-relCondition'],$input['relCondition'],$this->CI->ParameterModel->getDefaultParameterList('Condition',""),$width['label'],$width['div-input'])
                                .'                    
                                '.
                                $this->CI->field->input_select_profile($input['key-relRelationship'],$input['relRelationship'],$this->CI->ParameterModel->getDefaultParameterList('Relationship',""),$width['label'],$width['div-input'])
                                .' 
                                '.
                                $this->CI->field->input_text_profile($input['key-relMobileNo'],$input['relMobileNo'],"",$width['label'],$width['div-input'])
                                .'                  

                                <div class="text-end">
                                <button id="btnFamilyBackgroundClear" class="btn btn-primary"><span class="bi bi-arrow-repeat me-2"></span>Clear</button>
                                <button id="btnFamilyBackgroundAdd" class="btn btn-success"><span class="bi bi-plus-lg me-2"></span>Add</button>

                                <button id="btnFamilyBackgroundCancel" style="display:none" class="btn btn-danger"><span class="bi bi-x-lg me-2"></span>Cancel</button>
                                <button id="btnFamilyBackgroundUpdate" style="display:none" class="btn btn-primary"><span class="bi bi-save me-2"></span>Update</button>

                                </div>
                    </div>
                </div>
            </div>
            <!-- END OF RIGHT COLUMN -->  
        </div>
        <!-- END OF ROW  -->     

        <section class="section profile">

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th></th>
                                <th>Name</th>
                                <th>Birthdate</th>
                                <th>Age</th>
                                <th>Occupation</th>
                                <th>Relationship</th>
                                <th>Contact No</th>
                                <th>Condition</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>

        </section>

        </div>
        

        '.$this->CI->modal->swal_confirm_modal('family').'

        <script>


        fetch();

function loadTable(post){
    var i = "1";
    $("#example").DataTable({
        "data": post,
        "responsive":true,
       
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
        }],
        "columns": [
            {"render": function(){
                return a = i++;
            }},
            {"render": function( data, type, row, meta ){
                var a =`<img src="'.base_url().'${row.profile_photo_path}" height=32 width=32>`;
                return a; 
            }},
            {"data":"rel_name"},
            {"data":"rel_birthdate"},
            {"data":"rel_age"},
            {"data":"rel_occupation"},
            {"data":"relationship"},
            {"data":"rel_contact_no"},
            {"data":"rel_condition"},
            {"data":"rel_status"},
            {"render": function( data, type, row, meta ){
               var a = `
                        <a href="#" onclick="delete_now(${row.familyBackgroundID})" class="btn btn-sm btn-outline-danger"><span class="bi bi-trash"/></a>
                        <a href="#" onclick="edit_now(${row.familyBackgroundID})" class="btn btn-sm btn-outline-primary"><span class="bi bi-pencil-square"/></a>
                        `;
               return a; 
            }}
        ]
    });
}


 function fetch(){
                $.ajax({
                    url:"' . base_url() .'profile/datatable/populate-families",
                    type:"post",
                    dataType:"json",
                    success: function (data){
                        loadTable(data.post);
                    }
                });
            }



$("#btnFamilyBackgroundAdd").click(function(){

    $("#btnFamilyBackgroundAdd").html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-right:10px"></span>Loading...`);
    $("#btnFamilyBackgroundAdd").attr("disabled","disabled");
    $("#btnFamilyBackgroundClear").hide();

    $.ajax({
            url: "'.base_url().'profile/list-of-family/add",
            type:"post",
            dataType: "json",
            data:{
                rel_name: $("#txtrelName").val(),
                relationship: $("#cborelRelationship").find(":selected").val(),
                rel_birthdate: $("#txtrelDateOfBirth").val(),
                rel_age: $("#txtrelAge").val(),
                rel_occupation: $("#txtrelOccupation").val(),
                rel_contact_no: $("#txtrelMobileNo").val(),
                rel_status: $("#rel_status").text(),  
                rel_condition: $("#cborelCondition").find(":selected").val(),
                },
            success: function(data){
                console.log(data);

                $("#btnFamilyBackgroundAdd").html(`<span class="bi bi-plus-lg" style="margin-right:10px"></span>Add`);
                $("#btnFamilyBackgroundAdd").removeAttr("disabled");
                $("#btnFamilyBackgroundClear").show();

                if(data.response=="success")
                            {                                
                            $("#example").DataTable().destroy();
                            fetch();
                            clearField();
                            }
                        else
                            {    

                                set_validation_error(\''.$input['key-relName'].'\',data.rel_name,"txt");
                                set_validation_error(\''.$input['key-relRelationship'].'\',data.relationship,"txt");
                                                              
                            }
                    }  
            });

    });

        function delete_now(sel_id){
            swal_modal_confirm_family(sel_id);
        }


        $("#swal_response_family").click(function(){
            /* Do code here */

            $.ajax({
                url: "'.base_url().'profile/list-of-family/delete",
                type:"post",
                dataType: "json",
                data:{
                    del_id: sel_id
                    }, success: function(data){
                                            
                        /*console.log(data);*/
                        if(data.response=="success"){
                        
                        }else{
                            swalWithBootstrapButtons.fire("Delete Failed","There is an error from the server.","error");
                        }
                        /*alert(del_id);*/

                        $("#example").DataTable().destroy();
                        fetch();
                        
                    }  
                    });

        });

       

            function edit_now(id){

                $("#btnFamilyBackgroundClear").hide();
                $("#btnFamilyBackgroundAdd").hide();
                $("#btnFamilyBackgroundCancel").show();
                $("#btnFamilyBackgroundUpdate").show();
                
                $.ajax({
                    url: "'.base_url().'profile/list-of-family/edit",
                    type:"post",
                    dataType: "json",
                    data:{
                        edit_id: id,
                        },
                    success: function(data){

                        $("#txtFamilyID").val(id);
                        $("#txtrelName").val(data.post.rel_name);
                        $("#cborelRelationship").val(data.post.relationship);
                        $("#txtrelDateOfBirth").val(data.post.rel_birthdate);
                        $("#txtrelMobileNo").val(data.post.rel_contact_no);
                        $("#rel_status").text(data.post.rel_status);  
                        $("#cborelCondition").val(data.post.rel_condition);
                        $("#txtrelAge").val(data.post.rel_age);
                        $("#txtrelOccupation").val(data.post.rel_occupation);
                            }  
                    });
        
        
            }

            $("#btnFamilyBackgroundUpdate").click(function(){


                $("#btnFamilyBackgroundUpdate").html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-right:10px"></span>Loading...`);
                $("#btnFamilyBackgroundUpdate").attr("disabled","disabled");
                $("#btnFamilyBackgroundCancel").attr("disabled","disabled");
            
                $.ajax({
                        url: "'.base_url().'profile/list-of-family/update",
                        type:"post",
                        dataType: "json",
                        data:{
                            id: $("#txtFamilyID").val(),
                            rel_name: $("#txtrelName").val(),
                            relationship: $("#cborelRelationship").find(":selected").val(),
                            rel_birthdate: $("#txtrelDateOfBirth").val(),
                            rel_age: $("#txtrelAge").val(),
                            rel_occupation: $("#txtrelOccupation").val(),
                            rel_contact_no: $("#txtrelMobileNo").val(),
                            rel_status: $("#rel_status").text(),  
                            rel_condition: $("#cborelCondition").find(":selected").val(),
                            },
                        success: function(data){

            
                            $("#btnFamilyBackgroundUpdate").html(`<span class="bi bi-plus-lg" style="margin-right:10px"></span>Update`);
                            $("#btnFamilyBackgroundUpdate").removeAttr("disabled");
                            $("#btnFamilyBackgroundCancel").removeAttr("disabled");
            
                            if(data.response=="success")
                                        {                                
                                        $("#example").DataTable().destroy();
                                        fetch();
                                        $("#btnFamilyBackgroundClear").show();
                                        $("#btnFamilyBackgroundAdd").show(); 
                                        $("#btnFamilyBackgroundCancel").hide();
                                        $("#btnFamilyBackgroundUpdate").hide();
                                        clearField();
                                        }
                                    else
                                        {    
                                                                                       
                                            set_validation_error(\''.$input['key-relName'].'\',data.rel_name,"txt");
                                            set_validation_error(\''.$input['key-relRelationship'].'\',data.relationship,"cbo");

                                        }
                                }  
                        });


            });

            $("#btnFamilyBackgroundCancel").click(function(){
                $("#btnFamilyBackgroundClear").show();
                $("#btnFamilyBackgroundAdd").show(); 
                $("#btnFamilyBackgroundCancel").hide();
                $("#btnFamilyBackgroundUpdate").hide(); 
                clearField();
            });

            $("#btnFamilyBackgroundClear").click(function(){
                clearField();
            });

            function clearField(){
                $("#txtrelName").focus();
                $("#txtrelName").val("");
                $("#txtrelDateOfBirth").val("");
                $("#txtrelOccupation").val(""),
                $("#txtrelAge").val("");
                $("#txtRelMobileNo").val(""),
                $("#cborelRelationship").val("");
                $("#cborelCondition").val("");
                $("#txtrelMobileNo").val(""); 
                $("#feedback_relName").text("");
                $("#feedback_relRelationship").text("");

                $(".feedback-response").addClass("d-none");


            }  

            </script>

        ');
    }

    public function settingstab(){
        $profileInformation = $this->CI->ProfileModel->getProfileInformation($_SESSION['userID']);
        $input = $this->CI->ParameterModel->getGroupParameter('input');
        $width = $this->CI->ParameterModel->getGroupParameter('col-width');
        $prop = $this->CI->ParameterModel->getGroupParameter('swal-modal-delete');

        return $this->wrapper('
        <div class="tab-pane fade" id="profile-change-password">
            <!-- Change Password Form -->
            <!-- ROW  -->           
            <div class="row mb-3">
                <!-- LEFT COLUMN -->
                <h2 class="mobile-tab-title" align=center>Account Settings</h2>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>

                    <div class="row mb-3">
                        <label for="yourSystem_Role" class="col-md-4 col-lg-4 col-form-label">System Role</label>
                        <div class="col-md-8 col-lg-8"> 
                            <label for="yourSystem_Role" class="col-md-4 col-lg-8 col-form-label">'.$profileInformation['accessRoleName'].'</label>
                        </div>   
                    </div>          

              <div class="row mb-3">
                  <label for="yourSetting_Email_Address" class="col-md-4 col-lg-4 col-form-label">Email Address</label>
                        <div class="col-md-8 col-lg-8"> 
                        '.$this->verifier($profileInformation['email'],$profileInformation['email_status']).'
                        </div>
                    </div>   
              </div>  

                    '.
                    $this->CI->field->input_select_profile($input['key-privacySettings'],$input['privacySettings'],$this->CI->ParameterModel->getDefaultParameterList('Privacy Settings',$profileInformation['privacy_settings']),$width['label'],$width['div-input'])
                    .' 

            </div>        
            </div>    
        </div>
        <!-- END OF LEFT COLUMN -->
        <!-- START OF RIGHT COLUMN -->                          
        <div class="col-lg-6">

        <div class="card">
        <div class="card-body">
        <label for="profileImage" class="col-md-4 col-lg-9 col-form-label"></label>                
                    <div id="feedback_success_password_change" style="display:none" class="alert alert-success alert-dismissible fade show" roles="alert"></span></div>
                    <div class="row mb-3">
                        <label for="yourNickName" class="col-md-4 col-lg-4 col-form-label">Current Password</label>
                        <div class="col-md-8 col-lg-8"> 
                            <input id="txtSettings_CurrentPassword" type="password" name="nickname" class="form-control" id="yourNickName" required value="">
                            <div id="feedback_current_password" class="text-danger "></div>   
                            </div>   
                    </div>                
                    <div class="row mb-3">
                        <label for="yourNickName" class="col-md-4 col-lg-4 col-form-label">New Password</label>
                        <div class="col-md-8 col-lg-8"> 
                            <input id="txtSettings_NewPassword" type="password" name="nickname" class="form-control" id="yourNickName" required value="">
                            <div id="feedback_new_password" class="text-danger "></div> 
                            </div>   
                    </div>   
                    <div class="row mb-3">
                        <label for="yourNickName" class="col-md-4 col-lg-4 col-form-label">Confirm Password</label>
                        <div class="col-md-8 col-lg-8"> 
                            <input id="txtSettings_ConfirmPassword" type="password" name="nickname" class="form-control" id="yourNickName" required value="">
                            <div id="feedback_confirm_password" class="text-danger "></div> 
                            </div>   
                    </div>   

                    <div class="text-end">
                        <button id="btnSettingsChangePassword" type="submit" class="btn btn-primary"><span class="bi bi-file-earmark-lock" style="margin-right:10px"></span>Change Password</button>
                    </div>
                </div>

               
                </div>


                <div class="card">
                <div class="card-body">

                <div class="text-end mt-4">

                <div class="row mb-3  ">
                <label for="yourNickName" class="text-start col-md-7 col-lg-7 col-form-label">Delete your profile account permanently.</label>
                <div class="col-md-5 col-lg-5"> 
                <button id="btnDeleteAccount" type="submit" class="btn btn-primary">Delete Account</button>
                </div>
                </div>

                </div>
                </div>
                </div>

                </div>
                <!-- END OF RIGHT COLUMN -->  
                </div>
                <!-- END OF ROW  -->     
                </div>

            </div><!-- End Bordered Tabs -->
            </div>
            </div>
          </div>
    </div>
    </section>
    </main>
    <!-- End #main -->
        ' . $this->modalDialog($profileInformation['email_status']) .'
        
    <script>

        var loading_family = `
                    <div class="row mb-3">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center mt-4 ">
                                <div class="spinner-grow spinner-grow-sm me-3 mt-1 " role="status">
                                <span class="visually-hidden">Loading...</span> 
                                </div>Loading data...
                            </div>
                        </div>
                    </div>   `;
    
    var loading =`<div class="d-flex align-items-center justify-content-center mt-4 ">
                    <div class="spinner-grow spinner-grow-sm me-3 mt-1 " role="status">
                    <span class="visually-hidden">Loading...</span> 
                    </div>Loading data...`;  
    
    
   
    
    
    $(document).on("click","#btnSettingsChangePassword", function(e){

      $("#feedback_current_password").text("");
      $("#feedback_confirm_password").text("");
      $("#feedback_new_password").text("");
      $("#feedback_success_password_change").hide();
    
    $.ajax({
              url: "'. base_url() .'profile/changepassword",
              type:"post",
              dataType: "json",
              data:{
                  password:$("#txtSettings_CurrentPassword").val(),
                  newpassword:$("#txtSettings_NewPassword").val(),
                  confirmpassword:$("#txtSettings_ConfirmPassword").val(),
                  },
              success: function(data){

    
                  if(data.response=="success")
                              {                                
                                  $("#feedback_success_password_change").show();
                                  $("#feedback_success_password_change").text(data.message);
                                  $("#txtSettings_ConfirmPassword").val("");
                                  $("#txtSettings_NewPassword").val("");
                                  $("#txtSettings_CurrentPassword").val("");
                              }
                          else
                              {    
                                if(data.confirmpassword!=""){
                                  $("#txtSettings_ConfirmPassword").focus();
                                  $("#feedback_confirm_password").text("* "+ data.confirmpassword);}  
                                  if(data.newpassword!=""){
                                  $("#txtSettings_NewPassword").focus();
                                  $("#feedback_new_password").text("* "+ data.newpassword);} 
                                  if(data.password!=""){
                                  $("#txtSettings_CurrentPassword").focus();
                                  $("#feedback_current_password").text("* "+ data.password);}  
                                                                                                            
                              }
    
                            }
            });
    
    });
    
    
    $(document).on("click","#btnSettingsChangeEmail", function(e){
      $("#txtSettings_Email").removeAttr("disabled");
      $("#txtSettings_Email").val("");
      $("#txtSettings_Email").focus(); 
      $("#btnSettingsChangeEmail").hide();
      $("#btnSettingsUpdateEmail").show();
      $("#btnSettingsVerifyEmail").hide();
      
    });
    
    $(document).on("click","#btnSettingsUpdateEmail", function(e){
      
      $("#feedback_settings_email").text("");
    
      $.ajax({
                url: "'. base_url() .'profile/change-email",
                type:"post",
                dataType: "json",
                data:{
                    email: $("#txtSettings_Email").val(),
                    },
                success: function(data){

    
                    if(data.response=="success")
                                {                       
                                    $("#btnSettingsUpdateEmail").hide();         
                                    $("#btnSettingsSendCode").show();
                                    $("#txtSettings_Email").attr("disabled","disabled");
    
                                }
                            else
                                {    
                                    if(data.email!=""){
                                    $("#txtSettings_Email").focus();
                                    $("#feedback_settings_email").text("* "+ data.email);}                                                                                  
                                }
    
                              }
                        
    
              });
    
      
    });
    
    
    $(document).on("click","#btnSettingsSendCode,#btnSettingsVerifyEmail", function(e){
    
      $.ajax({
                url: "'. base_url() .'profile/send-code-email",
                type:"post",
                dataType: "json",
                data:{
                    email: $("#txtSettings_Email").val(),
                    },
                success: function(data){
                    if(data.response=="success")
                                {                                
                                    
                                    $("#feedback_code_verifier").text(data.message);
                                    $("#sendCodeModal").modal("show");
                                }
                            else
                                {    
                                    if(data.email!=""){
                                    $("#txtSettingsEmail").focus();
                                    $("#feedback_settings_email").text("* "+ data.email);}                                                                                  
                                }
    
                              }
                        
              });
    
              
    
    });
    
    $(document).on("click","#btnCodeVerifier", function(e){
    
      $("#feedback_verification_code").text("");
    
      $.ajax({
                url: "' . base_url() .'profile/verifycode",
                type:"post",
                dataType: "json",
                data:{
                    email: $("#txtSettings_Email").val(),
                    code: $("#txtSettings_VerificationCode").val()
                    },
                success: function(data){

    
                    if(data.response=="success")
                                {                                
                                    $("#feedback_code_verifier").text(data.message);
                                    $("#sendCodeModal").modal("show");
                                    $("#btnSettingsSendCode").hide();
                                    $("#sendCodeModal").modal("hide");
                                    $("#btnSettingsVerifyEmail").hide();
                                    $("#btnSettingsChangeEmail").hide();
                                    $("#feedback_email_status").html("<span  class=\'badge bg-success badge-number\'>"+data.email_status+"</span>")
                                }
                            else
                                {    
                                    if(data.code!=""){
                                    $("#txtSettings_VerificationCode").focus();
                                    $("#feedback_verification_code").text("* "+ data.code);}                                                                                  
                                }
                              }                   
              });
    });


    $("#btnDeleteAccount").click(function(){
       const swalWithBootstrapButtons_delete_account = Swal.mixin({
           customClass: {
               confirmButton: "'.$prop['confirmButton'].'",
               cancelButton: "'.$prop['cancelButton'].'"
           },
           buttonsStyling: false
           });
       swalWithBootstrapButtons_delete_account.fire({
           title: "'.$prop['title'].'",
           text: "'.$prop['text'].'",
           icon: "'.$prop['icon'].'",
           showCancelButton: true,
           confirmButtonText: "'.$prop['confirmButtonText'].'",
           cancelButtonText: "'.$prop['cancelButtonText'].'",
           reverseButtons: true
           }).then((result) => {
               if(result.value){

                $.ajax({
                    url: "' . base_url() .'profile/delete-account",
                    type:"post",
                    dataType: "json",
                    data:{
                        userID: '.$_SESSION['userID'].'
                        },
                    success: function(data){

                        if(data.response=="success")
                                    {                                
                                        window.location.href = "'.base_url().'login"; 
                                    }                 
                  }});



               }
           });



    });
    
    
    </script>    

        ');
    }

    private function modalDialog($email_status){
        if($email_status=="Unverified"){
            return '
            <div class="modal" id="sendCodeModal" tabindex="-1" data-bs-backdrop="false">
                          <div class="modal-dialog modal-dialog-centered" >
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title"></h5>
                              </div>
                              <div class="modal-body">
                                <div class="alert alert-success alert-dismissible fade show" roles="alert"><span id="feedback_code_verifier">The verification code has been sent to your email.</span></div>        
                                <div class="row mb-3">
                                      <label for="yourNickName" class="col-md-4 col-lg-4 col-form-label">Verify the code</label>
                                        <div class="col-md-8 col-lg-8"> 
                                          <input id="txtSettings_VerificationCode" type="number" name="verifycode" class="form-control" required value="">
                                          <div id="feedback_verification_code" class="text-danger "></div> 
                                        </div>   
                                </div>   
                            </div>
                              <div class="modal-footer">
                                <button id="btnCodeVerifier" type="button" class="btn btn-primary">Verify</button>
                              </div>
                            </div>
                          </div>
             </div><!-- End Vertically centered Modal-->';
              }
        return '';      
    }

    private function verifier($email,$email_status){
        $html='';
        if($email_status=="Unverified")
            {$html='<div id="feedback_email_status" class="text-end"><span class="badge bg-danger badge-number ">'.$email_status.'</span></div>';}
        else 
            {$html='<div id="feedback_email_status" class="text-end"><span  class="badge bg-success badge-number ">'.$email_status.'</span></div>';}
                
        $html.='<input id="txtSettings_Email" type="text" name="nickname" class="form-control" id="yourSetting_Email_Address" disabled required value="'.$email.'">
            <div id="feedback_settings_email" class="text-danger "></div>
            <div class="text-end">';

        if($email_status=="Unverified"){
            $html.='
            <button id="btnSettingsChangeEmail" type="submit" class="btn btn-primary"><i class="ri-mail-line me-2" ></i>Change Email</button>
            <button id="btnSettingsVerifyEmail" type="submit" class="btn btn-primary"><i class="ri-mail-line me-2" ></i>Verify Email</button>
            <button id="btnSettingsUpdateEmail" type="submit" style="display:none" class="btn btn-primary"><i class="bi bi-save2 me-2" ></i>Update</button>
            <button id="btnSettingsSendCode" type="submit" class="btn btn-primary" style="display:none"><i class="bi bi-folder-symlink me-2"></i>Send code</button>                            
            ';}  
               
        return $html;
    }

    private function wrapper($data){
        return $this->CI->ParameterModel->singleLine($data,"on");
    }


}