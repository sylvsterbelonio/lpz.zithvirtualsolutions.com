<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class ChurchFormModel extends CI_Model{

    public function __construct(){
        $this->load->database();}

    public function create_add_form(){

        return '
        <div class="text-end mb-4 me-2 mt-1 position-absolute end-0 top-0">
                  
        </div>
        <label for="profileImage" class="col-md-4 col-lg-4 col-form-label"><b>Church Details</b></label>                                                       
        <input id="txtchurchID" type="hidden" name="churchID">
        <div class="row mb-3">
            <label for="about" class="col-md-4 col-lg-4 col-form-label">About</label>
            <div class="col-md-8 col-lg-8">
            <textarea id="txtabout" name="about" class="form-control" style="height: 100px"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            <label for="yourChurchName" class="col-md-4 col-lg-4 col-form-label">Church Name</label>
            <div class="col-md-8 col-lg-8"> 
            <input id="txtchurch_name" type="text" name="church_name" class="form-control" id="yourChurchName" required value="">
            <div id="feedback_church_name" class="text-danger "></div>
            </div>   
        </div>
        <div class="row mb-3">
            <label for="yourDateFounded" class="col-md-4 col-lg-4 col-form-label">Date Founded</label>
            <div class="col-md-8 col-lg-8"> 
            <input id="txtdate_founded" type="date" name="date_founded" class="form-control" id="yourDateFounded" required value="">
            </div>   
        </div> 
     
        <label for="profileImage" class="col-md-4 col-lg-9 col-form-label"><b>Permanent Address</b></label>                
            <div class="row mb-3">
                <label class="col-md-4 col-lg-4 col-form-label">Country</label>
                <div class="col-md-8 col-lg-8">
                    <select id="cboCountry" class="form-select" aria-label="- Select Country -">
                    <?= $country?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-4 col-lg-4 col-form-label">Province</label>
                <div class="col-md-8 col-lg-8">
                    <select id="cboProvince" class="form-select" aria-label="- Select Province -">
                    <?= $province?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-4 col-lg-4 col-form-label">City/Municipality</label>
                <div class="col-md-8 col-lg-8">
                    <select id="cboCity" class="form-select" aria-label="- Select Municipality/City -">
                    <?= $city?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-4 col-lg-4 col-form-label">Barangay</label>
                <div class="col-md-8 col-lg-8">
                    <select id="cboBarangay" class="form-select" aria-label="- Select Barangay -">
                    <?= $barangay?>
                    </select>
                </div>
            </div>      
                                              
            <div class="row mb-3">  
            <label for="about" class="col-md-4 col-lg-4 col-form-label">Address</label>
            <div class="col-md-8 col-lg-8">
                <textarea id="txtaddress" name="adress" class="form-control" style="height: 100px"></textarea>
            </div>
            </div> 

            <div class="row mb-3">
            <label class="col-md-4 col-lg-4 col-form-label">Invitation Mode</label>
            <div class="col-md-8 col-lg-8">
                <select id="cboSelectInvitation" class="form-select" aria-label="- Select Invitation -">
                <option value="" selected>- Select Invitation -</option>
                <option value="Anyone">Anyone</option>
                <option value="Invite Only">Invite Only</option>
                <option value="Close">Close</option>
                </select>
                <div id="feedback_select_invitation" class="text-danger "></div>
            </div>
            </div>

            <div class="row mb-3">
            <label class="col-md-4 col-lg-4 col-form-label">Privacy Settings</label>
                <div class="col-md-8 col-lg-8">
                    <select id="cboPrivacySettings" class="form-select" aria-label="- Select Privacy Settings -">
                    <option value="" selected>- Select Privacy Settings -</option>
                    <option value="Private">Private</option>
                    <option value="Access Link Only">Access Link Only</option>
                    <option value="Public">Public</option>
                    </select>
                    <div id="feedback_privacy_settings" class="text-danger "></div>
                </div>
             </div>  



            
        </div>     
        <button id="btnCloseAddChurchForm" type="button" class="btn btn-danger float-end " ><span class="bi bi-x-lg me-2"></span>Cancel</button>                        
                                                           
        <button id="btnAddChurchForm" type="button" class="btn btn-success float-end me-2" ><span class="bi bi-plus-lg me-2"></span>Add</button>
       
    <script>

    $("#btnAddChurchForm").click(function(event) 
    {
        $("#btnCloseAddChurchForm").attr("disabled","disabled");      
        $("#btnAddChurchForm").attr("disabled","disabled");
        $("#btnAddChurchForm").html("<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\' style=\'margin-right:10px\'></span><span class=\'visually-hidden\'>Loading...</span>Add");
        
        $("#feedback_church_name").text("");
        $("#feedback_select_invitation").text("");
        $("#feedback_privacy_settings").text(""); 

        $.ajax({
                    url: "'. base_url() .'church/add",
                    type:"post",
                    dataType: "json",
                    data:{
                        about: $("#txtabout").val(),
                        church_name: $("#txtchurch_name").val(),
                        date_founded: $("#txtdate_founded").val(),     
                        country: $("#cboCountry").find(":selected").val(),
                        province: $("#cboProvince").find(":selected").val(),
                        city: $("#cboCity").find(":selected").val(),
                        barangay: $("#cboBarangay").find(":selected").val(),
                        address: $("#txtaddress").val(),  
                        privacy_settings: $("#cboPrivacySettings").find(":selected").val(),
                        invitationMode:  $("#cboSelectInvitation").find(":selected").val()
                        },
                    success: function(data){
                        //console.log(data);
                                if(data.response=="success")
                                    {
                                        window.location.href = "'.base_url("church").'";
                                        toastr["success"](data.message);
                                        //$("#btnAddChurchForm").removeAttr("disabled");
                                        //$("#btnAddChurchForm").html("<span class=\'bi bi-plus-lg me-2\'></span>Add");                               
                                    }
                                else
                                    {
                                        toastr["error"](data.message);

                                        if(data.invitationMode!=""){
                                            $("#cboPrivacySettings").focus();
                                            $("#feedback_select_invitation").text(data.invitationMode);    
                                        }                                        

                                        if(data.privacy_settings!=""){
                                            $("#cboPrivacySettings").focus();
                                            $("#feedback_privacy_settings").text(data.privacy_settings);    
                                        }   

                                        if(data.church_name!=""){
                                            $("#txtchurch_name").focus();
                                            $("#feedback_church_name").text(data.church_name);    
                                        }     
                                        
                                        $("#btnAddChurchForm").removeAttr("disabled");
                                        $("#btnAddChurchForm").html("<span class=\'bi bi-plus-lg me-2\'></span>Add");
                                        $("#btnCloseAddChurchForm").removeAttr("disabled");   
                                    }
                            }
            });
        });

        $(document).on("click","#btnCloseAddChurchForm", function(e){
            $("#frmAdd").empty();
            $("#frmAdd").hide();
    });

        country();

        function country(){
        $.ajax({
                        url: "'.base_url().'spatial",
                        type: "post", dataType: "json",
                        data:{search_value: $("#cboCountry").find(":selected").val(), type:"fetch-country"}, 
                        success: function(data){ if(data.response=="success"){ $("#cboCountry").html(data.html);    }  } });
    }

                $("#cboCountry").on("change", function() {
                if($("#cboCountry").find(":selected").val()==""){
                country();
                }else{
                    $.ajax({
                        url: "'. base_url().'spatial",
                        type: "post", dataType: "json",  data:{search_value: $("#cboCountry").find(":selected").val(), type:"fetch-province"}, 
                        success: function(data){ if(data.response=="success"){$("#cboProvince").html(data.html);   $("#cboCity").val("- Select City/Municipality -");$("#cboBarangay").val("- Select Barangay -");} } });
                }
                });       

                $("#cboProvince").on("change", function() {
                        $.ajax({
                        url: "'.base_url().'spatial",
                        type: "post", dataType: "json", data:{search_value: $("#cboProvince").find(":selected").val(), type:"fetch-city"}, 
                        success: function(data){if(data.response=="success"){$("#cboCity").html(data.html);   $("#cboBarangay").val(1);}} });
                });

                $("#cboCity").on("change", function() {
                $.ajax({
                        url: "'. base_url() .'spatial",
                        type: "post", dataType: "json",  data:{search_value: $("#cboCity").find(":selected").val(), type:"fetch-barangay"},  
                        success: function(data){if(data.response=="success"){ $("#cboBarangay").html(data.html);    } } });
                });

                toastr.options = {"closeButton": false,"debug": false, "newestOnTop": false,"progressBar": false,"positionClass": "toast-bottom-center","preventDuplicates": false,"onclick": null,"showDuration": "300","hideDuration": "1000","timeOut": "5000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}

                </script>';

    }

    public function create_edit_church_form($id){

        $data = $this->ChurchModel->getChurchInfo($id);

        $_SESSION['churchID'] = $data['churchID'];

        return '

        <div id="dvCropped_image_result_CoverPhoto_EditChurch" class=" col-xl-12" >
            <img id="imgCoverPhotoEditChurch" src="'. base_url() . $data['url_cover_photo'] . '"  class="img-fluid d-block" alt="...">
        </div>

        <div class="card-body m-0 p-0">
            <div class="position-absolute  end-0 me-3 mt-2" >
                <form method="post" id="frmUpload_CoverPhoto_EditChurch" enctype="multipart/form">
                    <input class="d-none" id="txtUplod_CoverPhoto_EditChurch" name="file_name" type="file" accept=".png, .jpg, .jpeg" />
                    <input id="txtID" type="hidden" name="id" value="'.$data['churchID'].'"> 
                    <input class="d-none" type="submit" name="upload" id="btnUpload_CoverPhoto_EditChurch" value="upload">
                </form>
                <button id="btnUploadCoverPhotoEditChurch" class="btn btn-primary btn-sm " style="margin-top:-110px"><i class="bi bi-upload" ></i></button>
                <button id="btnRemoveCoverPhotoEditChurch"  class="btn btn-danger btn-sm" title="Remove my profile image" style="margin-top:-110px"><i class="bi bi-trash" ></i></button>
            </div>
        </div>   
    
        <!-- ROW  -->           
        <div class="row">
            <div id="pbUploadCoverPhoto" class="progress" style="height: 3px;display:none">
                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <!-- LEFT COLUMN -->
            <div class="col-lg-12 ">
                <div class="card col-lg-6">                                                                
                    <!---- THIS IS TO INSERT DATA --->
                    <div class="position-absolute bottom-0 start-0 ms-3 mb-3 pb-0">
                        <div id="dvCropped_image_result_Photo_EditChurch">
                            <img id="imgPhotoEditChurch" class="border border-light border-5 rounded-circle" src="'. base_url() . $data['url_photo'] . '" alt="Profile" style="">
                        </div>
                        <div class="position-absolute bottom-0 end-0 " >
                            <form method="post" id="frmUpload_Photo_EditChurch" enctype="multipart/form">
                                <input class="d-none" id="image_file" name="image_file" type="file" accept=".png, .jpg, .jpeg" />
                                <input class="d-none" type="submit" name="upload" id="submitUpload_Photo_EditChurch" value="upload">
                        </form>
                        <button id="btnUploadPhotoEditChurch" class="btn btn-primary btn-sm mb-0"><i class="bi bi-upload"></i></button>
                        <button id="btnRemovePhotoEditChurch"  class="btn btn-danger btn-sm mb-0" title="Remove my profile image"><i class="bi bi-trash"></i></button>
                    </div>
                    <!---- END OF INSERR DATA --->  
                    </div>                                                  
                </div>
                <div class="card p-4 m-4">
                    <div class="card-body p-1 m-1">             
                        <label for="profileImage" class="col-md-4 col-lg-6 col-form-label"><b>Church Details</b></label>                   
                        <div class="row mb-3">
                            <label for="about" class="col-md-4 col-lg-4 col-form-label">About</label>
                            <div class="col-md-8 col-lg-8 mt-3">
                                <textarea id="txtaboutEditChurch" name="about" class="form-control" style="height: 100px">'.$data['about'].'</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="yourChurchName" class="col-md-4 col-lg-4 col-form-label">Church Name</label>
                            <div class="col-md-8 col-lg-8"> 
                                <input id="txtIDEditChurch" type="hidden" name="" class="form-control" id="" required value="'.$data['churchID'].'">                                
                                <input id="txtchurch_nameEditChurch" type="text" name="church_name" class="form-control" id="yourChurchName" required value="'.$data['church_name'].'">
                                <div id="feedback_church_nameEditChurch" class="text-danger "></div>
                            </div>   
                        </div>
                        <div class="row mb-3">
                            <label for="yourDateFounded" class="col-md-4 col-lg-4 col-form-label">Date Founded</label>
                            <div class="col-md-8 col-lg-8"> 
                                <input id="txtdate_foundedEditChurch" type="date" name="date_founded" class="form-control" id="yourDateFounded" required value="'.$data['date_founded'].'">
                            </div>   
                        </div> 
                        <button id="btnUpdateDetailsChurchForm" type="button" class="btn btn-primary float-end " ><span class="bi bi-save me-2"></span>Update</button>     
                    </div>
                    </div>                      
                </div>
                <!-- END OF LEFT COLUMN -->
        </div>
        <!-- END OF ROW  -->       
        <!-- START REMOVE PHOTO PROFILE DIALOG MODAL -->      
        <div class="modal" id="mdRemoveConfirmation" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 id="mdRemoveConfirmationTitle" class="modal-title"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="mdRemoveConfirmContent" class="modal-body">                      
                </div>
                <div class="modal-footer">
                  <button id="btnRemoveConfirmationYes" type="button" class="btn btn-primary" data-bs-dismiss="modal">Yes</button>
                  <button id="btnRemoveConfirmationNo" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
        </div>
        <!-- END OF COVER PHOTO PROFILE DIALOG MODAL -->
        <!-- START PROFILE PHOTO UPLOAD MODAL -->
        <div class="modal" id="uploadPhotoModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" >
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Select Image and Crop</h5>
                  <button id="btnCancelUploadPhotoEditChurch" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center" style="height:300px">
                <div id="dvPhoto_Display_EditChurch" class="bg-primary wh-100" >
                  <img name="imgPhoto_Display_EditChurch" id="imgPhoto_Display_EditChurch" src="dummy-image.png" alt="Picture" class="img-fluid" style="height:auto;width:100%">
                </div>  
                </div>
                <div class="modal-footer">
                  <label><small>Scroll the Mouse to Zoom in and out</small></label>
                  <button id="btnPhoto_Cropper_EditChurch" type="button"class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-crop me-2"></i>Crop</button>                
                </div>
              </div>
            </div>
          </div>
          <!-- END PROFILE PHOTO UPLOAD MODAL-->  
          <!-- START COVER PROFILE PHOTO UPLOAD MODAL -->
          <div class="modal" id="uploadCoverPhotoModal" tabindex="-1">
              <div class="modal-dialog modal-xl modal-dialog-centered" >
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Select Image and Crop</h5>
                    <button id="btnCancelUploadCoverPhotoEditChurch" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body d-flex justify-content-center" style="height:500px">
                  <div id="display_image_div_cover_photo" class="bg-primary wh-100" >
                    <img name="display_image_data_cover_photo" id="display_image_data_cover_photo" src="dummy-image.png" alt="Picture" class="img-fluid" style="height:auto;width:100%">
                  </div>  
                  </div>
                  <div class="modal-footer">
                    <label><small>Scroll the Mouse to Zoom in and out</small></label>
                    <button id="btnImageCropper_cover_photo" type="button"class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-crop me-3"></i>Crop</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- END COVER PROFILE PHOTO UPLOAD MODAL-->     

        <script>

        var deletePhoto = "";

          $( "#txtUplod_CoverPhoto_EditChurch" ).change(function() {
                $("#btnUpload_CoverPhoto_EditChurch").trigger("click");
          });

            $("#frmUpload_CoverPhoto_EditChurch").on("submit",function(e){
     
                e.preventDefault();
            
                $("#btnUploadCoverPhotoEditChurch").html("<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span><span class=\'visually-hidden me-2\'>Loading...</span>");
                $("#btnUploadCoverPhotoEditChurch").attr("disabled","disabled");
                $("#btnRemoveCoverPhotoEditChurch").hide();

                    $.ajax({
                        url: "'.base_url().'church/upload-default-cover-photo",
                        method:"POST",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        cache: false,
                        async: false,                       
                        success:function(data){
                                $("#imgCoverPhotoEditChurch").attr("src",data);
                                $("#pbUploadCoverPhoto").hide();
                                $("#btnUploadCoverPhotoEditChurch").removeAttr("disabled");
                                $("#btnUploadCoverPhotoEditChurch").html("<i class=\'bi bi-upload\' ></i>");
                                $("#btnRemoveCoverPhotoEditChurch").show();
                        } });
    
                });


        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        //TRIGER BUTTON TO BROWSE FILES//
        $("#btnUploadPhotoEditChurch").click(function() {
            $("#image_file").trigger("click");
        });
        //TRIGER BUTTON TO BROWSE FILES//
        $("#btnUploadCoverPhotoEditChurch").click(function() {
            $("#txtUplod_CoverPhoto_EditChurch").trigger("click");
        });        

        //CANCEL CROP FROM DIALOG
        $("#btnCancelUploadPhotoEditChurch").click(function(){
            $("#btnUploadPhotoEditChurch").removeAttr("disabled");
            $("#btnUploadPhotoEditChurch").html("<i class=\'bi bi-upload\'></i>");
            $("#btnRemovePhotoEditChurch").show();
          });


        //CROPPER INITIALIZATION//

        $("#image_file").change(function(evt) { 

            $("#btnUploadPhotoEditChurch").attr("disabled","disabled");
            $("#btnUploadPhotoEditChurch").html("<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span><span class=\'visually-hidden\'>Loading...</span>");
            $("#btnRemovePhotoEditChurch").hide();
        
            $("#uploadPhotoModal").modal({  backdrop: "static", keyboard: false});
            $("#uploadPhotoModal").modal("show");
        
        });



        ////START PROFILE PHOTO UPLOAD//////
        $( "#image_file" ).change(function() {

             var files = $("#image_file")[0].files;

            console.log(files);

            var done = function(url) {        
              $("#dvPhoto_Display_EditChurch").empty();
              $("#dvPhoto_Display_EditChurch").html("<img name=\'imgPhoto_Display_EditChurch\' id=\'imgPhoto_Display_EditChurch\' src=\'" + url + "\' alt=\'Uploaded Picture\' class=\'img-fluid\'>");
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
        
        var image = document.getElementById("imgPhoto_Display_EditChurch");
        var button = document.getElementById("btnPhoto_Cropper_EditChurch");
        var result = document.getElementById("dvCropped_image_result_Photo_EditChurch");
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
            // Crop
            croppedCanvas = cropper.getCroppedCanvas();
            // Round
            roundedCanvas = getRoundedCanvas(croppedCanvas);
            // Show
            roundedImage = document.createElement("img");
            roundedImage.src = roundedCanvas.toDataURL();  
            result.innerHTML = "";
            result.appendChild(roundedImage);
        
            upload();
           
          };
        
        });


        //END OF CROPPER INITIALIZATION//
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
          {$("#submitUpload_Photo_EditChurch").trigger("click");}
          
          $("#frmUpload_Photo_EditChurch").on("submit",function(e){
            e.preventDefault();

            if($("#image_file").val()==""){
              alert("Please select file");
            }else{
            
              $("#btnPhoto_Cropper_EditChurch").attr("disabled","disabled");
              $("#btnPhoto_Cropper_EditChurch").html("<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span><span class=\'visually-hidden me-2\'>Loading...</span><span class=\'ms-2\'>Crop</span>");
              $("#btnRemovePhotoEditChurch").hide();
          
              $("#uploadPhotoModal").modal({  backdrop: "static", keyboard: false});
              $("#uploadPhotoModal").modal("show");

              var base64data = $("#dvCropped_image_result_Photo_EditChurch img").attr("src");
              
              $("#dvCropped_image_result_Photo_EditChurch img").attr("id","imgPhotoEditChurch");
          
              $.ajax({
                url:"'.base_url().'church/upload-profile-photo",
                method:"POST",
                data:{
                  churchID:$("#txtIDEditChurch").val(),
                  photo:$("#imgPhotoEditChurch").attr("src"),
                  image: base64data,
                  action: "profile-photo",
                },
                success:function(data){
 
                  $("#btnPhoto_Cropper_EditChurch").removeAttr("disabled");
                  $("#btnPhoto_Cropper_EditChurch").html("<i class=\'bi bi-crop me-2\'></i>Crop");

                  $("#btnUploadPhotoEditChurch").removeAttr("disabled");
                  $("#btnUploadPhotoEditChurch").html("<i class=\'bi bi-upload\'></i>");
                  $("#btnRemovePhotoEditChurch").show();
                  $("#imgPhotoEditChurch").attr("src",data);
                  $("#uploadPhotoModal").modal("hide");
                }
              }); 
            }
          });


        $("#btnRemoveCoverPhotoEditChurch").click(function() {
            deletePhoto = "cover-photo";
            $("#mdRemoveConfirmation").modal("show");
                  $("#mdRemoveConfirmationTitle").text("Delete Cover Photo Confirm");
                  $("#btnPositive").show();
                  $("#btnPositive").html("<span class=\'bi bi-check-circle-fill me-2\'></span>Yes");
                  $("#btnNegative").html("<span class=\'bi bi-x-circle-fill me-2\'></span>No");
                  $("#mdRemoveConfirmContent").text("Are you sure you want to delete this cover photo?");
            }); 

        $("#btnRemovePhotoEditChurch").click(function() {
            deletePhoto = "profile-photo";
            $("#mdRemoveConfirmation").modal("show");
                  $("#mdRemoveConfirmationTitle").text("Delete Profile Photo Confirm");
                  $("#btnPositive").show();
                  $("#btnPositive").html("<span class=\'bi bi-check-circle-fill me-2\'></span>Yes");
                  $("#btnNegative").html("<span class=\'bi bi-x-circle-fill me-2\'></span>No");
                  $("#mdRemoveConfirmContent").text("Are you sure you want to delete this profile photo?");
            }); 

        $("#btnRemoveConfirmationYes").click(function() {

            $("#btnUploadPhotoEditChurch").attr("disabled","disabled");
            $("#btnRemovePhotoEditChurch").attr("disabled","disabled");

            $.post("'.base_url().'church/remove-photo", {
                churchID:$("#txtIDEditChurch").val(),
                action:deletePhoto,
                photo:$("#imgPhotoEditChurch").attr("src"),
                coverphoto: $("#imgCoverPhotoEditChurch").attr("src"),
                }).done(function(response){
                  if(deletePhoto=="profile-photo")
                        $("#imgPhotoEditChurch").attr("src",response);
                  else
                        $("#imgCoverPhotoEditChurch").attr("src",response);

                        $("#btnUploadPhotoEditChurch").removeAttr("disabled");
                        $("#btnRemovePhotoEditChurch").removeAttr("disabled");
                });
        });    
            
        function country(){
                    $.ajax({
                        url: "'.base_url().'spatial",
                        type: "post", dataType: "json",
                        data:{search_value: $("#cboCountryEditChurch").find(":selected").val(), type:"fetch-country"}, 
                        success: function(data){ if(data.response=="success"){ 
                        $("#cboCountryEditChurch").html(data.html);                   
                    }  } });
                    }

                $("#cboCountryEditChurch").on("change", function() {
                if($("#cboCountryEditChurch").find(":selected").val()==""){
                country();
                }else{
                    $.ajax({
                        url: "'. base_url().'spatial",
                        type: "post", dataType: "json",  data:{search_value: $("#cboCountryEditChurch").find(":selected").val(), type:"fetch-province"}, 
                        success: function(data){ if(data.response=="success"){$("#cboProvinceEditChurch").html(data.html);   $("#cboCityEditChurch").val("- Select City/Municipality -");$("#cboBarangayEditChurch").val("- Select Barangay -");} } });
                }
                });       

                $("#cboProvinceEditChurch").on("change", function() {
                        $.ajax({
                        url: "'.base_url().'spatial",
                        type: "post", dataType: "json", data:{search_value: $("#cboProvinceEditChurch").find(":selected").val(), type:"fetch-city"}, 
                        success: function(data){if(data.response=="success"){$("#cboCityEditChurch").html(data.html);   $("#cboBarangayEditChurch").val(1);}} });
                });

                $("#cboCityEditChurch").on("change", function() {
                $.ajax({
                        url: "'. base_url() .'spatial",
                        type: "post", dataType: "json",  data:{search_value: $("#cboCityEditChurch").find(":selected").val(), type:"fetch-barangay"},  
                        success: function(data){if(data.response=="success"){ $("#cboBarangayEditChurch").html(data.html);    } } });
                });


                $("#btnUpdateDetailsChurchForm").click(function(event) {

                    $("#btnUpdateDetailsChurchForm").attr("disabled","disabled");
                    $("#btnUpdateDetailsChurchForm").html("<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\' style=\'margin-right:10px\'></span><span class=\'visually-hidden\'>Loading...</span>Update");
                     

                    $.ajax({
                            url: "'. base_url() .'church/update",
                            type:"post",
                            dataType: "json",
                            data:{
                                churchID:$("#txtIDEditChurch").val(),
                                about: $("#txtaboutEditChurch").val(),
                                church_name: $("#txtchurch_nameEditChurch").val(),
                                date_founded: $("#txtdate_foundedEditChurch").val(),                     
                                },
                            success: function(data){
                                console.log(data);
                                        if(data.response=="success")
                                            {
                                            toastr["success"](data.message);
                                            }
                                        else
                                            {
                                            toastr["error"](data.message);
                                            }
                                            $("#btnUpdateDetailsChurchForm").removeAttr("disabled");
                                            $("#btnUpdateDetailsChurchForm").html("<span class=\'bi bi-save me-2\'></span>Update");        
                                    }
                            });
                        });


                toastr.options = {"closeButton": false,"debug": false, "newestOnTop": false,"progressBar": false,"positionClass": "toast-bottom-center","preventDuplicates": false,"onclick": null,"showDuration": "300","hideDuration": "1000","timeOut": "5000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}


        </script>';

    }

    public function create_address_form($id){

        $data = $this->ChurchModel->getChurchInfo($id);


        return 
        '
        <div class="card p-4 m-4">

        <label for="profileImage" class="col-md-4 col-lg-9 col-form-label"><b>Permanent Address</b></label>                
            <div class="row mb-3">
                <label class="col-md-4 col-lg-4 col-form-label">Country</label>
                <div class="col-md-8 col-lg-8">
                    <select id="cboCountry" class="form-select" aria-label="- Select Country -">
                    <option value="" selected>- Select Country -</option>
                    <option value="'.$data['country'].'" selected>'.$data['country'].'</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-4 col-lg-4 col-form-label">Province</label>
                <div class="col-md-8 col-lg-8">
                    <select id="cboProvince" class="form-select" aria-label="- Select Province -">
                    <option value="" selected>- Select Province -</option>
                    <option value="'.$data['province'].'" selected>'.$data['province'].'</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-4 col-lg-4 col-form-label">City/Municipality</label>
                <div class="col-md-8 col-lg-8">
                    <select id="cboCity" class="form-select" aria-label="- Select Municipality/City -">
                    <option value="" selected>- Select Municipality/City -</option>
                    <option value="'.$data['city'].'" selected>'.$data['city'].'</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-md-4 col-lg-4 col-form-label">Barangay</label>
                <div class="col-md-8 col-lg-8">
                    <select id="cboBarangay" class="form-select" aria-label="- Select Barangay -">
                    <option value="" selected>- Select Barangay -</option>
                    <option value="'.$data['barangay'].'" selected>'.$data['barangay'].'</option>
                    </select>
                </div>
            </div>      
                                              
            <div class="row mb-3">
            <label for="yourChurchName" class="col-md-4 col-lg-4 col-form-label">Zip Code</label>
            <div class="col-md-8 col-lg-8"> 
            <input id="txtzipcode" type="number" name="zipcode" class="form-control" id="yourChurchName" required value="'.$data['zipcode'].'">
            <div id="feedback_zipcode" class="text-danger "></div>
            </div>   
        </div>

            <div class="row mb-3">  
            <label for="about" class="col-md-4 col-lg-4 col-form-label">Address</label>
                <div class="col-md-8 col-lg-8">
                    <textarea id="txtaddress" name="adress" class="form-control" style="height: 100px">'.$data['address'].'</textarea>
                </div>
            </div> 

            <div class="row mb-3">  
            <label for="about" class="col-md-4 col-lg-4 col-form-label">Embed Google Map</label>
                <div class="col-md-8 col-lg-8">
                    <textarea id="txtEmbedMap" name="adress" class="form-control" style="height: 100px">'.$data['embed_map'].'</textarea>
                </div>
            </div>             

            <div class="card-body m-0 p-0">
            <button id="btnUpdateAddressChurchForm" type="button" class="btn btn-primary float-end" ><span class="bi bi-save me-2"></span>Update</button>     
            </div>

        </div>    

        <script>

        $("#btnUpdateAddressChurchForm").click(function(){

            $(this).attr("disabled","disabled");
            $(this).html("<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\' style=\'margin-right:10px\'></span><span class=\'visually-hidden\'>Loading...</span>Update");
                     
                    $.ajax({
                            url: "'. base_url() .'church/update",
                            type:"post",
                            dataType: "json",
                            data:{
                                churchID:'.$data['churchID'].',   
                                church_name: "'.$data['church_name'].'",
                                country: $("#cboCountry").find(":selected").val(),
                                province: $("#cboProvince").find(":selected").val(),
                                city: $("#cboCity").find(":selected").val(),
                                barangay: $("#cboBarangay").find(":selected").val(),
                                zipcode: $("#txtzipcode").val(),
                                address: $("#txtaddress").val(),
                                embed_map: $("#txtEmbedMap").val(),                
                                },
                            success: function(data){
                                console.log(data);
                                        if(data.response=="success")
                                            {
                                            toastr["success"](data.message);
                                            }
                                        else
                                            {
                                            toastr["error"](data.message);
                                            }
                                            $("#btnUpdateAddressChurchForm").removeAttr("disabled");
                                            $("#btnUpdateAddressChurchForm").html("<span class=\'bi bi-save me-2\'></span>Update");        
                                    }
                            });
                  
        });

        country();
        function country(country_value){
          
                    $.ajax({
                        url: "'.base_url().'spatial",
                        type: "post", dataType: "json",
                        data:{search_value: $("#cboCountry").find(":selected").val(), type:"fetch-country"}, 
                        success: function(data){ if(data.response=="success"){ 
                        $("#cboCountry").html(data.html);                            
                        $("#cboCountry").val("'.$data['country'].'");
                        }  } });
                  
        }

        $("#cboCountry").on("change", function() {
            if($("#cboCountry").find(":selected").val()==""){
            country();
            }else{
                $.ajax({
                    url: "'. base_url().'spatial",
                    type: "post", dataType: "json",  data:{search_value: $("#cboCountry").find(":selected").val(), type:"fetch-province"}, 
                    success: function(data){ if(data.response=="success"){$("#cboProvince").html(data.html);   $("#cboCity").val("- Select City/Municipality -");$("#cboBarangay").val("- Select Barangay -");} } });
            }
            });       

            $("#cboProvince").on("change", function() {
                    $.ajax({
                    url: "'.base_url().'spatial",
                    type: "post", dataType: "json", data:{search_value: $("#cboProvince").find(":selected").val(), type:"fetch-city"}, 
                    success: function(data){if(data.response=="success"){$("#cboCity").html(data.html);   $("#cboBarangay").val(1);}} });
            });

            $("#cboCity").on("change", function() {
            $.ajax({
                    url: "'. base_url() .'spatial",
                    type: "post", dataType: "json",  data:{search_value: $("#cboCity").find(":selected").val(), type:"fetch-barangay"},  
                    success: function(data){if(data.response=="success"){ $("#cboBarangay").html(data.html);    } } });
            });

            toastr.options = {"closeButton": false,"debug": false, "newestOnTop": false,"progressBar": false,"positionClass": "toast-bottom-center","preventDuplicates": false,"onclick": null,"showDuration": "300","hideDuration": "1000","timeOut": "5000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}

        </script>

        ';

    }
    public function create_members_form($id){

    }

}    