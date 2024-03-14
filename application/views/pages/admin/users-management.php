
<main id="main" class="main">

  <!-- Page Title -->
  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
        <li class="breadcrumb-item active">Users Management</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->

  <!-- Section -->
  <section class="section profile">
    <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Tab Title -->   
              <button id="btnAdd" class="btn btn-sm btn-success  float-end" style="margin-right:3px" ><span class="bi bi-plus-lg" style=""></span></Button>

              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button id="tabListChurch" class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"><span class="bi bi-view-list" style="margin-right:10px"></span>List of Users</button>
                </li>
                <li id="lnkFamilyBackground" class="nav-item" style='display:none'>
                  <button id="tabAddChurch" class="nav-link" data-bs-toggle="tab" data-bs-target="#family-background-users"><span class="bi bi-house-door-fill" style="margin-right:10px"></span>Family Background&nbsp;&nbsp;&nbsp;<span id="btnClossFamilyBackground" class="class='bi bi-x-lg ms-auto" style="color:red;margin-left:10px"></button>
                </li>
                <li id="lnkSettingsUsers" class="nav-item" style='display:nne'>
                  <button id="tabSettingsUsers" class="nav-link" data-bs-toggle="tab" data-bs-target="#settings-users"><span class="bi bi-house-door-fill" style="margin-right:10px"></span></button>
                </li>                
              </ul>
              <!-- End of Tab Title -->
            <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">   

                            <div class="table-responsive">
                                    <table id="example" class="table table-striped table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Photo</th>
                                            <th>Username</th>
                                            <th>Last Name</th>
                                            <th>Middle Name</th>
                                            <th>Date of Birth</th>
                                            <th>Gender</th>
                                            <th>Ministry Name</th>
                                            <th>Province</th>
                                            <th>Municipality/City</th>
                                            <th>Barangay</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>

                </div>        
                <!-- FAMILY BACKGROUND -->
                <div class="tab-pane fade profile-edit pt-3" id="family-background-users">   


                    <?php $this->load->view('pages/admin/users-management-family-background'); ?>



                </div>      
                <!-- END OF FAMILY BACKGROUND -->           

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>

    </section>

 <!-- Modal Dialog Scrollable -->
              <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Details</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
              <!-- THIS CONTENT -->
              <form id="form" action="" method="post">

                    <input id="txtuserID" type="hidden" name="userID" class="form-control" id="yourFirstName" required value=""></input>
               
                    <div class="row mb-3">  
                        <input id="txtchurchID" type="hidden" name="churchID">
                        <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                        <div class="col-md-8 col-lg-9">
                            <textarea id="txtabout" name="about" class="form-control" style="height: 100px"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="yourFirstName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtfirst_name" type="text" name="first_name" class="form-control" id="yourFirstName" required value="">
                            <div id="feedback_first_name" class="text-danger "></div>
                        </div>   
                    </div>

                    <div class="row mb-3">
                        <label for="yourMiddleName" class="col-md-4 col-lg-3 col-form-label">Middle Name</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtmiddle_name" type="text" name="middle_name" class="form-control" id="yourMiddleName" required value="">
                            <div id="feedback_middle_name" class="text-danger "></div>
                        </div>   
                    </div>

                    <div class="row mb-3">
                        <label for="yourLastName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtlast_name" type="text" name="last_name" class="form-control" id="yourLastName" required value="">
                            <div id="feedback_last_name" class="text-danger "></div>
                        </div>   
                    </div>

                    <div class="row mb-3">
                        <label for="yourNameExt" class="col-md-4 col-lg-3 col-form-label">Name Extension</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtname_ext" type="text" name="name_ext" class="form-control" id="yourNameExt" required value="">
                            <div id="feedback_name_ext" class="text-danger "></div>
                        </div>   
                    </div>

                    <div class="row mb-3">
                        <label for="yourNickname" class="col-md-4 col-lg-3 col-form-label">Nickname</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtnickname" type="text" name="name_ext" class="form-control" id="yourNickname" required value="">
                            <div id="feedback_nickname" class="text-danger "></div>
                        </div>   
                    </div>

                    <div class="row mb-3">
                      <label for="yourDateofBirth" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                      <div class="col-md-8 col-lg-9"> 
                      <input id="txtdate_of_birth" type="date" name="date_of_birth" class="form-control" id="yourDateofBirth" required value="">
                      </div>   
                    </div>  

                    <div class="row mb-3">
                        <label for="yourPlaceofBirth" class="col-md-4 col-lg-3 col-form-label">Place of Birth</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtplace_of_birth" type="text" name="place_of_birth" class="form-control" id="yourPlaceofBirth" required value="">
                            <div id="feedplace_of_birth" class="text-danger "></div>
                        </div>   
                    </div>

                    <div class="row mb-3 bg-">
                    <fieldset class="row mb-3">
                     <legend class="col-md-4 col-lg-3 col-form-label"><label>Gender</label></legend>
                    <div class="col-md-8 col-lg-9" style="">

                      <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gridGender1" value="Male">
                      <label class="form-check-label" for="gridRadios1">Male</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gridGender2" value="Female">
                      <label class="form-check-label" for="gridRadios2">Female</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="gridGender3" value="Unspecified" checked>
                      <label class="form-check-label" for="gridRadios3">Unspecified</label>
                    </div>                   
                    
                  </div>
                </fieldset>
                </div>

                <div class="row mb-3">
                  <label class="col-md-4 col-lg-3 col-form-label">Civil Status</label>
                  <div class="col-md-8 col-lg-9">
                    <select id="cboCivilStatus" class="form-select" aria-label="- Select Civil Status -">
                      <option value="" selected>- Select Civil Status -</option>   
                      <option value="Single">Single</option>
                      <option value="In A Relationship">In A Relationship</option>
                      <option value="Married">Married</option>
                      <option value="Separated">Separated</option>
                      <option value="Divorced">Divorced</option>
                      <option value="Widowed">Widowed</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                        <label for="yourOccupation" class="col-md-4 col-lg-3 col-form-label">Occupation</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtoccupation" type="text" name="name_ext" class="form-control" id="yourOccupation" required value="">
                            <div id="feedback_occupation" class="text-danger "></div>
                        </div>   
                </div>

                <h5 class="card-title">MINISTRY INFORMATION</h5>  

                <div class="row mb-3">
                        <label for="yourChurchName" class="col-md-4 col-lg-3 col-form-label">Church Name</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtchurch_name" type="text" name="name_ext" class="form-control" id="yourChurchName" required value="">
                            <div id="feedback_church_name" class="text-danger "></div>
                        </div>   
                </div>

                <div class="row mb-3">
                        <label for="yourCellLeader" class="col-md-4 col-lg-3 col-form-label">Cell Leader</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtcell_leader" type="text" name="cell_leader" class="form-control" id="yourCellLeader" required value="">
                            <div id="feedback_cell_leader" class="text-danger "></div>
                        </div>   
                </div>                

                <h5 class="card-title">OTHER INFORMATION</h5>

                <div class="row mb-3">
                      <label for="height" class="col-md-4 col-lg-3 col-form-label">Height</label>
                      <div class="col-md-2 col-lg-2">
                        <input id="txtheight" name="height" type="number" class="form-control" id="height" value="">
                      </div>
                      <div class="col-md-2 col-lg-4">
                    <select id="cboHeight" class="form-select" aria-label="">    
                    <option value="" selected>- Select metric scale -</option>   
                      <option value="CM">CM</option>
                      <option value="INCH">INCH</option>
                      <option value="M">M</option>
                    </select>
                  </div>                      
                    </div>

                    <div class="row mb-3">
                      <label for="weight" class="col-md-4 col-lg-3 col-form-label">Weight</label>
                      <div class="col-md-2 col-lg-2">
                        <input id="txtweight" name="weight" type="number" class="form-control" id="weight" value="">
                      </div>
                      <div class="col-md-2 col-lg-4">
                    <select id="cboWeight" class="form-select" aria-label="">  
                      <option value="" selected>- Select weighing scale -</option>     
                      <option value="KG">KG</option>
                      <option value="LBS">LBS</option>
                    </select>
                  </div>
                    </div>

                    <div class="row mb-3">
                  <label class="col-md-4 col-lg-3 col-form-label">Blood Type</label>
                  <div class="col-md-8 col-lg-9">
                    <select id="cboBloodType" class="form-select" aria-label="- Select Blood Type -">
                      <option value="" selected>- Select Blood Type -</option>                   
                      <option value="A-">A-</option>
                      <option value="B-">B-</option>
                      <option value="AB-">AB-</option>
                      <option value="O-">O-</option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="AB">AB</option>
                      <option value="O">O</option>
                      <option value="A+">A+</option>
                      <option value="B+">B+</option>
                      <option value="AB+">AB+</option>
                      <option value="O+">O+</option>
                    </select>
                  </div>
                </div>                

                <h5 class="card-title">HOME ADDRESS</h5>

                <div class="row mb-3">  
                        <label for="about" class="col-md-4 col-lg-3 col-form-label">Address</label>
                        <div class="col-md-8 col-lg-9">
                            <textarea id="txtaddress" name="adress" class="form-control" style="height: 100px"></textarea>
                        </div>
                </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Country</label>
                        <div class="col-md-8 col-lg-9">
                            <select id="cboCountry" class="form-select" aria-label="- Select Country -">
                            <?= $country?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Province</label>
                        <div class="col-md-8 col-lg-9">
                            <select id="cboProvince" class="form-select" aria-label="- Select Province -">
                            <?= $province?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">City/Municipality</label>
                        <div class="col-md-8 col-lg-9">
                            <select id="cboCity" class="form-select" aria-label="- Select Municipality/City -">
                            <?= $city?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Barangay</label>
                        <div class="col-md-8 col-lg-9">
                            <select id="cboBarangay" class="form-select" aria-label="- Select Barangay -">
                            <?= $barangay?>
                            </select>
                        </div>
                    </div>                                        

                    <div class="row mb-3">
                        <label for="yourZipcode" class="col-md-4 col-lg-3 col-form-label">Zipcode</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtzipcode" type="text" name="zipcode" class="form-control" id="yourZipcode" required value="">
                            <div id="feedback_zipcode" class="text-danger "></div>
                        </div>   
                    </div>

                    <h5 class="card-title">CONTACT INFORMATION</h5>                    

                    <div class="row mb-3">
                        <label for="yourZipcode" class="col-md-4 col-lg-3 col-form-label">Mobile No.</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtmobileno" type="text" name="contactno" class="form-control" id="yourcontactno" required value="">
                            <div id="feedback_contactno" class="text-danger "></div>
                        </div>   
                    </div>

                    <div class="row mb-3">
                        <label for="yourTelNo" class="col-md-4 col-lg-3 col-form-label">Telephone No.</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txttelno" type="text" name="telno" class="form-control" id="yourTelNo" required value="">
                            <div id="feedback_telno" class="text-danger "></div>
                        </div>   
                    </div>                    

                    <h5 class="card-title">SOCIAL ACCOUNT INFORMATION</h5> 

                    <div class="row mb-3">
                        <label for="yourFacebook" class="col-md-4 col-lg-3 col-form-label">Facebook</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtfacebook" type="text" name="facebook" class="form-control" id="yourFacebook" required value="">
                            <div id="feedback_facebook" class="text-danger "></div>
                        </div>   
                    </div>
                    
                    <div class="row mb-3">
                        <label for="yourYoutube" class="col-md-4 col-lg-3 col-form-label">Youtube</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtyoutube" type="text" name="youtube" class="form-control" id="yourYoutube" required value="">
                            <div id="feedback_youtube" class="text-danger "></div>
                        </div>   
                    </div>
                    
                    <div class="row mb-3">
                        <label for="yourInstagram" class="col-md-4 col-lg-3 col-form-label">Instagram</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtinstagram" type="text" name="instagram" class="form-control" id="yourInstagram" required value="">
                            <div id="feedback_instagram" class="text-danger "></div>
                        </div>   
                    </div>
                    
                    <div class="row mb-3">
                        <label for="yourlinkin" class="col-md-4 col-lg-3 col-form-label">LinkedIn</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtlinkin" type="text" name="linkin" class="form-control" id="yourlinkin" required value="">
                            <div id="feedback_linkin" class="text-danger "></div>
                        </div>   
                    </div>     
                    
                    <div class="row mb-3">
                        <label for="yourtiktok" class="col-md-4 col-lg-3 col-form-label">Tiktok</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txttiktok" type="text" name="tiktok" class="form-control" id="yourtiktok" required value="">
                            <div id="feedback_tiktok" class="text-danger "></div>
                        </div>   
                    </div>  
                    
                    <div class="row mb-3">
                        <label for="yourtwitter" class="col-md-4 col-lg-3 col-form-label">Twitter</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txttwitter" type="text" name="twitter" class="form-control" id="yourtwitter" required value="">
                            <div id="feedback_twitter" class="text-danger "></div>
                        </div>   
                    </div>  

                    <h5 class="card-title">ACCOUNT INFORMATION</h5> 

                    <div class="row mb-3">
                        <label for="yourUsername" class="col-md-4 col-lg-3 col-form-label">Username</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtusername" type="text" name="zipcode" class="form-control" id="yourUsername" required value="">
                            <div id="feedback_username" class="text-danger "></div>
                        </div>   
                    </div>

                    <div class="row mb-3">
                        <label for="yourEmailAddress" class="col-md-4 col-lg-3 col-form-label">Email Address</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtemailaddress" type="text" name="zipcode" class="form-control" id="yourEmailAddress" required value="">
                            <div id="feedback_emailaddress" class="text-danger "></div>
                        </div>   
                    </div>                    

                    <div class="row mb-3">
                      <label for="yourPassword" class="col-md-4 col-lg-3 col-form-label">Password</label>
                      <div class="col-md-8 col-lg-9"> 
                      <input id="txtpassword" type="password" name="church_name" class="form-control" id="yourPassword" required value="">
                      <div id="feedback_password" class="text-danger "></div>
                      </div>   
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">System Access Level</label>
                        <div class="col-md-8 col-lg-9">
                            <select id="cboSystemAccessLevel" class="form-select" aria-label="- Select System Access Level -">
                            <?= $getAccessLevelList?>
                            </select>
                        </div>
                    </div>                    

                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Privacy Settings</label>
                        <div class="col-md-8 col-lg-9">
                            <select id="cboPrivacySettings" class="form-select" aria-label="- Select Privacy Settings -">
                            <option value="" selected>- Select Privacy Settings -</option>
                            <option value="Private">Private</option>
                            <option value="Friends Only">Friends Only</option>
                            <option value="Ministry Only">Ministries Only</option>
                            <option value="Access Link Only">Link Access Only</option>
                            <option value="Public">Public</option>
                            </select>
                        </div>
                    </div>                      
                </form>
              <!-- END OF CONTENT -->                  
                    </div>
                    <div class="modal-footer">
                      <button id="btnNegative" type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="bi bi-x-lg" style="margin-right:10px"></span>Cancel</button>
                      <button id="btnPositive" type="button" class="btn btn-success" data-bs-dismiss=""><span class="bi bi-plus-lg" style="margin-right:10px"></span>Add</button>
                      <button id="btnUpdate" style="display:none" type="button" class="btn btn-primary" data-bs-dismiss=""><span class="bi bi-save" style="margin-right:10px"></span>Update</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Modal Dialog Scrollable-->
    
  </main><!-- End #main -->

<script>



fetch();

function fetch(){
    $.ajax({
        url:'<?php echo base_url();?>users-management/list',
        type:'post',
        dataType:'json',
        success: function (data){
            //console.log(data);
            var i = "1";
            $("#example").DataTable({
                "data": data.posts,
                "responsive":true,
                dom: 
                "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    {extend:'copy'},{extend:'excel'},
                    {extend: "pdfHtml5",orientation: 'landscape',pageSize: 'LEGAL'},
                    {
                    extend: "print",
                        customize: function(win){
                            var last = null; var current = null; var bod = [];        
                            var css = '@page { size: landscape; }',head = win.document.head || win.document.getElementsByTagName('head')[0],style = win.document.createElement('style');           
                            style.type = 'text/css';style.media = 'print';            
                            if (style.styleSheet){style.styleSheet.cssText = css;}
                            else{style.appendChild(win.document.createTextNode(css));}
                            head.appendChild(style);}         
                    },                                                      
                ],
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                "columns": [
                    {"render": function(){
                        return a = i++;
                    }},
                    {"render": function( data, type, row, meta ){
                        var a =`<img src="<?php echo base_url()?>${row.profile_photo_path}" height=50 width=50>`;
                        return a; 
                    }},
                    {"data":"username"},
                    {"data":"last_name"},
                    {"data":"first_name"},
                    {"data":"date_of_birth"},
                    {"data":"sex"},
                    {"data":"chu_church_name"},
                    {"data":"loc_province"},
                    {"data":"loc_city"},
                    {"data":"loc_barangay"},
                    {"render": function( data, type, row, meta ){
                       var a = `
                                <a href="#" value="${row.userID}" id="del" class="btn btn-sm btn-outline-danger"><span class="bi bi-trash"/></a>
                                <a href="#" value="${row.userID}" id="edit" class="btn btn-sm btn-outline-primary"><span class="bi bi-pencil-square"/></a>
                                <a href="#" value="${row.userID}" id="view" class="btn btn-sm btn-outline-secondary"><span class="bi bi-gear"/></a>
                                `;
                       return a; 
                    }}
                ]
            });
        }
    });

   
}

$("#txtusername,#txtemailaddress,#txtpassword,#txtconfirmpassword,#txtfirst_name,#txtlast_name").keyup(function(){
    $(this).next("div.text-danger").text("");
    
});


$(document).on("click","#btnPositive", function(e){

    $("#btnPositive").html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-right:10px"></span>Loading...`);
    $("#btnPositive").attr("disabled","disabled");
    $("#btnNegative").hide(); 
    $("#txtpassword").show();           

    $.ajax({
            url: "<?php echo base_url();?>users-management/add",
            type:"post",
            dataType: "json",
            data:{
                about: $("#txtabout").val(),
                first_name: $("#txtfirst_name").val(),
                middle_name: $("#txtmiddle_name").val(),
                last_name: $("#txtlast_name").val(),
                name_ext: $("#txtname_ext").val(),
                nickname: $("#txtnickname").val(),
                date_of_birth: $("#txtdate_of_birth").val(),
                place_of_birth: $("#txtplace_of_birth").val(),
                sex: $('input[name="gender"]:checked').val(),
                civil_status: $('#cboCivilStatus').find(":selected").val(),
                occupation: $("#txtoccupation").val(),
                height: $("#txtheight").val(),
                height_metric: $('#cboHeight').find(":selected").val(),
                weight: $("#txtweight").val(),
                weight_metric: $('#cboWeight').find(":selected").val(),
                blood_type: $('#cboBloodType').find(":selected").val(),
                chu_church_name: $("#txtchurch_name").val(),
                chu_cellLeader: $("#txtcell_leader").val(),
                loc_country: $('#cboCountry').find(":selected").val(),
                loc_province: $('#cboProvince').find(":selected").val(),
                loc_city: $('#cboCity').find(":selected").val(),
                loc_barangay: $('#cboBarangay').find(":selected").val(),
                loc_address: $("#txtaddress").val(),
                loc_zipcode: $("#txtzipcode").val(),
                con_mobile_no: $("#txtmobileno").val(),
                con_tel_no: $("#txttelno").val(),
                soc_facebook_url: $("#txtfacebook").val(),
                soc_youtube_url: $("#txtyoutube").val(),
                soc_instagram_url: $("#txtinstagram").val(),
                soc_linkin_url: $("#txtlinkin").val(),
                soc_tiktok_url: $("#txttiktok").val(),
                soc_twitter_url: $("#txttwitter").val(),
                privacy_settings: $('#cboPrivacySettings').find(":selected").val(),
                accessLevelID: $('#cboSystemAccessLevel').find(":selected").val(),
                username: $("#txtusername").val(),
                email:  $("#txtemailaddress").val(),
                password: $("#txtpassword").val()        
                },
            success: function(data){
                //console.log(data);

                $("#btnPositive").html(`<span class="bi bi-plus-lg" style="margin-right:10px"></span>Add`);
                $("#btnPositive").removeAttr("disabled");
                $("#btnNegative").show();  

                if(data.response=="success")
                            {                                
                            toastr["success"](data.message);
                            $("#example").DataTable().destroy();
                            fetch();
                            $("#form")[0].reset();
                            $("#modalDialogScrollable").modal('hide');     
                             
                            }
                        else
                            {                           
                                if(data.confirmpassword!=""){
                                $("#txtconfirmpassword").focus()
                                $("#feedback_confirmpassword").text("* "+ data.confirmpassword);}
                                if(data.password!=""){
                                $("#txtpassword").focus()
                                $("#feedback_password").text("* "+ data.password);}
                                if(data.email!="") {
                                $("#txtemailaddress").focus();
                                $("#feedback_emailaddress").text("* "+ data.email);} 
                                if(data.username!=""){
                                $("#txtusername").focus()
                                $("#feedback_username").text("* "+ data.username);}
                                if(data.last_name!=""){
                                $("#txtlast_name").focus()
                                $("#feedback_last_name").text("* "+ data.last_name);}
                                if(data.first_name!=""){
                                $("#txtfirst_name").focus()
                                $("#feedback_first_name").text("* "+ data.first_name);}
                            }
                    

                    }  
            });
        });


$(document).on("click","#btnUpdate", function(e){

    $("#btnUpdate").html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-right:10px"></span>Loading...`);
    $("#btnUpdate").attr("disabled","disabled");
    $("#btnNegative").hide();                                            

    $.ajax({
            url: "<?php echo base_url();?>users-management/update",
            type:"post",
            dataType: "json",
            data:{
                userID:$("#txtuserID").val(),
                about: $("#txtabout").val(),
                first_name: $("#txtfirst_name").val(),
                middle_name: $("#txtmiddle_name").val(),
                last_name: $("#txtlast_name").val(),
                name_ext: $("#txtname_ext").val(),
                nickname: $("#txtnickname").val(),
                date_of_birth: $("#txtdate_of_birth").val(),
                place_of_birth: $("#txtplace_of_birth").val(),
                sex: $('input[name="gender"]:checked').val(),
                civil_status: $('#cboCivilStatus').find(":selected").val(),
                occupation: $("#txtoccupation").val(),
                height: $("#txtheight").val(),
                height_metric: $('#cboHeight').find(":selected").val(),
                weight: $("#txtweight").val(),
                weight_metric: $('#cboWeight').find(":selected").val(),
                blood_type: $('#cboBloodType').find(":selected").val(),
                chu_church_name: $("#txtchurch_name").val(),
                chu_cellLeader: $("#txtcell_leader").val(),
                loc_country: $('#cboCountry').find(":selected").val(),
                loc_province: $('#cboProvince').find(":selected").val(),
                loc_city: $('#cboCity').find(":selected").val(),
                loc_barangay: $('#cboBarangay').find(":selected").val(),
                loc_address: $("#txtaddress").val(),
                loc_zipcode: $("#txtzipcode").val(),
                con_mobile_no: $("#txtmobileno").val(),
                con_tel_no: $("#txttelno").val(),
                soc_facebook_url: $("#txtfacebook").val(),
                soc_youtube_url: $("#txtyoutube").val(),
                soc_instagram_url: $("#txtinstagram").val(),
                soc_linkin_url: $("#txtlinkin").val(),
                soc_tiktok_url: $("#txttiktok").val(),
                soc_twitter_url: $("#txttwitter").val(),
                privacy_settings: $('#cboPrivacySettings').find(":selected").val(),
                accessLevelID: $('#cboSystemAccessLevel').find(":selected").val(),
                username: $("#txtusername").val(),
                email:  $("#txtemailaddress").val(),
                password: $("#txtpassword").val()        
                },
            success: function(data){
                //console.log(data);

                $("#btnUpdate").html(`<span class="bi bi-save" style="margin-right:10px"></span>Update`);
                $("#btnUpdate").removeAttr("disabled");
                $("#btnNegative").show();

                        if(data.response=="success")
                            {
                            toastr["success"](data.message);
                            $("#example").DataTable().destroy();
                            fetch();
                            $("#form")[0].reset();
                            $("#modalDialogScrollable").modal('hide');
                            }
                        else
                            {
                                if(data.confirmpassword!=""){
                                $("#txtconfirmpassword").focus()
                                $("#feedback_confirmpassword").text("* "+ data.confirmpassword);}
                                if(data.password!=""){
                                $("#txtpassword").focus()
                                $("#feedback_password").text("* "+ data.password);}
                                if(data.email!="") {
                                $("#txtemailaddress").focus();
                                $("#feedback_emailaddress").text("* "+ data.email);} 
                                if(data.username!=""){
                                $("#txtusername").focus()
                                $("#feedback_username").text("* "+ data.username);}
                                if(data.last_name!=""){
                                $("#txtlast_name").focus()
                                $("#feedback_last_name").text("* "+ data.last_name);}
                                if(data.first_name!=""){
                                $("#txtfirst_name").focus()
                                $("#feedback_first_name").text("* "+ data.first_name);}
                            }
                    }
            });
        });

$(document).on("click","#del", function(e){


    e.preventDefault();
       const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger me-3'
        },
        buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '<span class="bi bi-person me-8" ></spa>Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {

            if(result.value){

                var del_id = $(this).attr("value");
                $.ajax({
                url: "<?php echo base_url();?>users-management/delete",
                type:"post",
                dataType: "json",
                data:{
                    del_id: del_id
                }, success: function(data){
                    
                    $("#example").DataTable().destroy();
                    fetch();

                    //console.log(data);
                    if(data.response=="success"){
                        swalWithBootstrapButtons.fire('Deleted!','Your record has been deleted.','success');
                    }else{
                        swalWithBootstrapButtons.fire('Delete Failed','There is an error from the server.','error');
                    }
                    //alert(del_id);
                }  
                });

            }else{
                swalWithBootstrapButtons.fire('Cancelled','Your imaginary file is safe :)','error');
            }
             
        });
});

$(document).on("click","#edit", function(e){
    $("#btnPositive").hide();
    $("#btnUpdate").show();
    $("#modalDialogScrollable").modal('show');
    $("#txtpassword").hide(); 
    $('input[type=text]').next("div.text-danger").text("");
    e.preventDefault();

    $("#btnUpdate").html(`<span class="bi bi-save" style="margin-right:10px"></span>Update`);
    $("#btnUpdate").removeAttr("disabled");
    $("#btnNegative").show();

    var edit_id = $(this).attr("value");

    $.ajax({
        url: "<?php echo base_url();?>users-management/edit",
        type: "post", dataType: "json",
        data:{edit_id: edit_id}, 
        success: function(data){
            console.log(data);
            if(data.response=="success"){
                
                $("#txtuserID").val(data.posts.userID);
                $("#txtabout").val(data.posts.about);
                $("#txtfirst_name").val(data.posts.first_name);
                $("#txtmiddle_name").val(data.posts.middle_name);
                $("#txtlast_name").val(data.posts.last_name);
                $("#txtname_ext").val(data.posts.name_ext);
                $("#txtnickname").val(data.posts.nickname);
                $("#txtdate_of_birth").val(data.posts.date_of_birth);
                $("#txtplace_of_birth").val(data.posts.place_of_birth);


                if(data.posts.sex=="Male") $("#gridGender1").prop('checked',true);
                else if(data.posts.sex=="Female") $("#gridGender2").prop('checked',true);
                else $("#gridGender3").prop('checked',true);

                $("#txtoccupation").val(data.posts.occupation);

                
                $('#cboCivilStatus').val(data.posts.civil_status);
                $("#txtheight").val(data.posts.height);
                $('#cboHeight').val(data.posts.height_metric);
                $("#txtweight").val(data.posts.weight);
                $('#cboWeight').val(data.posts.weight_metric);
                $('#cboBloodType').val(data.posts.blood_type);
                $("#txtchurch_name").val(data.posts.chu_church_name);
                $("#txtcell_leader").val(data.posts.chu_cellLeader);
              
                var html = `<option value="" selected>- Select Country -</option>
                            <option value="`+ data.posts.loc_country +`" selected>`+data.posts.loc_country+`</option>`;
                $("#cboCountry").html(html);  
              
                html = `<option value="" selected>- Select Country -</option><option value="`+ data.posts.loc_province +`" selected>`+data.posts.loc_province+`</option>`;
                $("#cboProvince").html(html);  
              
                html = `<option value="" selected>- Select Provincey -</option><option value="`+ data.posts.loc_city +`" selected>`+data.posts.loc_city+`</option>`;
                $("#cboCity").html(html);  

                html = `<option value="" selected>- Select City -</option><option value="`+ data.posts.loc_barangay +`" selected>`+data.posts.loc_barangay+`</option>`;
                $("#cboBarangay").html(html);  

             
                 $("#txtaddress").val(data.posts.loc_address);
                 $("#txtzipcode").val(data.posts.loc_zipcode);

                 $("#txtmobileno").val(data.posts.con_mobile_no);
                 $("#txttelno").val(data.posts.con_tel_no);

                 $("#txtfacebook").val(data.posts.soc_facebook_url);
                 $("#txtyoutube").val(data.posts.soc_youtube_url);
                 $("#txtinstagram").val(data.posts.soc_instagram_url);
                 $("#txtlinkin").val(data.posts.soc_linkin_url);
                 $("#txttiktok").val(data.posts.soc_tiktok_url);
                 $("#txttwitter").val(data.posts.soc_twitter_url);
                 $('#cboPrivacySettings').val(data.posts.privacy_settings);
                 $('#cboSystemAccessLevel').val(data.posts.accessLevelID);
                 $("#txtusername").val(data.posts.username);
                 $("#txtemailaddress").val(data.posts.email);
                 $("#txtpassword").val(data.posts.password);        
            }
        }
    });
});

function load_country(){
    $.ajax({
        url: '<?php echo base_url();?>church/spatial',
        type: "post", dataType: "json",
        data:{search_value: $('#cboCountry').find(":selected").val(), type:'fetch-country'}, 
        success: function(data){
            console.log(data);
            if(data.response=="success"){
                $("#cboCountry").html(data.html);   
            }
        }
    });
}

$('#cboCountry').on('change', function() {
if($('#cboCountry').find(":selected").val()==""){
    $.ajax({
        url: '<?php echo base_url();?>church/spatial',
        type: "post", dataType: "json",
        data:{search_value: $('#cboCountry').find(":selected").val(), type:'fetch-country'}, 
        success: function(data){
            console.log(data);
            if(data.response=="success"){
                $("#cboCountry").html(data.html);   
            }
        }
    });
}else{
    $.ajax({
        url: '<?php echo base_url();?>church/spatial',
        type: "post", dataType: "json",
        data:{search_value: $('#cboCountry').find(":selected").val(), type:'fetch-province'}, 
        success: function(data){
            console.log(data);
            if(data.response=="success"){
                $("#cboProvince").html(data.html);   
                $("#cboCity").val('- Select City/Municipality -');
                $("#cboBarangay").val('- Select Barangay -');
            }
        }
    });
}
});       

$('#cboProvince').on('change', function() {
        $.ajax({
        url: '<?php echo base_url();?>church/spatial',
        type: "post", dataType: "json",
        data:{search_value: $('#cboProvince').find(":selected").val(), type:'fetch-city'}, 
        success: function(data){
            console.log(data);
            if(data.response=="success"){
                $("#cboCity").html(data.html);   
                $("#cboBarangay").val(1);
            }
        }
    });

});

$('#cboCity').on('change', function() {
  $.ajax({
        url: '<?php echo base_url();?>church/spatial',
        type: "post", dataType: "json",
        data:{search_value: $('#cboCity').find(":selected").val(), type:'fetch-barangay'}, 
        success: function(data){
            console.log(data);
            if(data.response=="success"){
                $("#cboBarangay").html(data.html);   
            }
        }
    });
});


$("#btnAdd").click(function() {
  $("#form")[0].reset();
  $("#btnPositive").show();
  $("#btnUpdate").hide();
  $("#modalDialogScrollable").modal('show');
  load_country();
});




toastr.options = {"closeButton": false,"debug": false, "newestOnTop": false,"progressBar": false,"positionClass": "toast-bottom-center","preventDuplicates": false,"onclick": null,"showDuration": "300","hideDuration": "1000","timeOut": "5000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}

</script>

