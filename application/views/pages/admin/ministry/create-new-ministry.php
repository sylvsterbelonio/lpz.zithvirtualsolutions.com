<!-- Spinner Start -->
<style>
@media(min-width: 100px) { 
          #imgPhoto
          { height: 100px; 
            width:100px;
          }
          #imgCoverPhoto{
            min-height:150px;
          }  
      }

@media(min-width: 200px) { 
          #imgPhoto
          { height: 100px; 
            width:100px;
          }
          #imgCoverPhoto{
            min-height:150px;
          }  
      }

      @media(min-width: 300px) { 
          #imgPhoto
          { height: 100px; 
            width:100px;
          }
          #imgCoverPhoto{
            min-height:150px;
          } 
      }

      @media(min-width: 560px) { 
          #imgPhoto
          { height: 150px; 
            width:150px;
          }  
      }

      @media(min-width: 800px) { 
          #imgPhoto
          { height: 200px; 
            width:200px;
          }  
      }

      #imgPhoto{
        max-height:200px;
        max-width:200px;
      }
      

    </style>


<main id="main" class="main">

  <!-- Page Title -->
  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title --> 
 
  <div class="col-lg-12">
        <div class="card">
            <div class="card-body m-0 p-0">
                        <div class="position-absolute bottom-0 end-0 me-2 mb-2" >
                        <button id="btnUploadPhoto" class="btn btn-primary btn-sm "><i class="bi bi-upload"></i></button>
                              <button id="btnRemovePhoto"  class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></button>
                        </div>
                        <img id="imgCoverPhoto" src="<?=base_url()?>assets/images/default-cover-photo.png"  class="img-fluid d-block" alt="..." style="height:150">

            </div>   
            
            <div class="position-absolute bottom-0 start-0 ms-4 mb-2">

              <img id="imgPhoto" class="border border-light border-5 rounded-circle" src="<?=base_url()?>assets/images/default-photo.png ?>" alt="Profile" style="">

              <div class="position-absolute bottom-0 end-0  " >
              <button id="btnUploadPhoto" class="btn btn-primary btn-sm "><i class="bi bi-upload"></i></button>
                              <button id="btnRemovePhoto"  class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></button>
                  
              </div>

            </div>

        </div>    
    </div>

 <!-- ROW  -->           
  <div class="row mb-3">
    <!-- LEFT COLUMN -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"><b>Ministry Profile</b></label>
             
                        
                  <input id="txtchurchID" type="hidden" name="churchID">
                  <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea id="txtabout" name="about" class="form-control" style="height: 100px"></textarea>
                      </div>
                  </div>

                  <div class="row mb-3">
                      <label for="yourChurchName" class="col-md-4 col-lg-3 col-form-label">Church Name</label>
                      <div class="col-md-8 col-lg-9"> 
                      <input id="txtchurch_name" type="text" name="church_name" class="form-control" id="yourChurchName" required value="">
                      <div id="feedback_church_name" class="text-danger "></div>
                      </div>   
                  </div>

                  <div class="row mb-3">
                      <label for="yourDateFounded" class="col-md-4 col-lg-3 col-form-label">Date Founded</label>
                      <div class="col-md-8 col-lg-9"> 
                      <input id="txtdate_founded" type="date" name="date_founded" class="form-control" id="yourDateFounded" required value="">
                      </div>   
                    </div> 

                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Privacy Settings</label>
                        <div class="col-md-8 col-lg-9">
                            <select id="cboPrivacySettings" class="form-select" aria-label="- Select Privacy Settings -">
                            <option value="" selected>- Select Privacy Settings -</option>
                            <option value="Private">Private</option>
                            <option value="Access Link Only">Access Link Only</option>
                            <option value="Public">Public</option>
                            </select>
                        </div>
                    </div>       
 

            </div>        
        </div>    
    </div>
    <!-- END OF LEFT COLUMN -->
    <!-- START OF RIGHT COLUMN -->                          
    <div class="col-lg-6">

        <div class="card">
            <div class="card-body">
            <label for="profileImage" class="col-md-4 col-lg-9 col-form-label"><b>Permanent Address</b></label>                

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
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">Address</label>
                    <div class="col-md-8 col-lg-9">
                        <textarea id="txtaddress" name="adress" class="form-control" style="height: 100px"></textarea>
                    </div>
                </div>        
                
                
                <button id="btnAdd" type="button" class="btn btn-success float-end" ><span class="bi bi-plus-lg me-2"></span>Add</button>
             

            </div>
        </div>
    </div>
    <!-- END OF RIGHT COLUMN -->  
</div>
 <!-- END OF ROW  -->     


</main>


<script>

$(document).on("click","#btnAdd", function(e){


  $("#btnAdd").attr('disabled','disabled');
  $("#btnAdd").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true' style='margin-right:10px'></span><span class='visually-hidden'>Loading...</span>Add");
  $("#feedback_church_name").text("");

    $.ajax({
            url: "<?php echo base_url();?>church/add",
            type:"post",
            dataType: "json",
            data:{
                about: $("#txtabout").val(),
                church_name: $("#txtchurch_name").val(),
                date_founded: $("#txtdate_founded").val(),     
                country: $('#cboCountry').find(":selected").val(),
                province: $('#cboProvince').find(":selected").val(),
                city: $('#cboCity').find(":selected").val(),
                barangay: $('#cboBarangay').find(":selected").val(),
                address: $("#txtaddress").val(),  
                privacy_settings: $('#cboPrivacySettings').find(":selected").val()
                },
            success: function(data){
                //console.log(data);
                        if(data.response=="success")
                            {
                                toastr["success"](data.message);
                                $("#btnAdd").removeAttr('disabled');
                                $("#btnAdd").html('<span class="bi bi-plus-lg me-2"></span>Add');
                            }
                        else
                            {
                                toastr["error"](data.message);
                                $("#txtchurch_name").focus();
                                $("#feedback_church_name").text(data.message);    
                                $("#btnAdd").removeAttr('disabled');
                                $("#btnAdd").html('<span class="bi bi-plus-lg me-2"></span>Add');                            
                            }
                    }
            });
        });

country();
function country(){
  $.ajax({
        url: '<?php echo base_url();?>church/spatial',
        type: "post", dataType: "json",
        data:{search_value: $('#cboCountry').find(":selected").val(), type:'fetch-country'}, 
        success: function(data){ if(data.response=="success"){ $("#cboCountry").html(data.html);    }  } });
}

$('#cboCountry').on('change', function() {
if($('#cboCountry').find(":selected").val()==""){
  country();
}else{
    $.ajax({
        url: '<?php echo base_url();?>church/spatial',
        type: "post", dataType: "json",  data:{search_value: $('#cboCountry').find(":selected").val(), type:'fetch-province'}, 
        success: function(data){ if(data.response=="success"){$("#cboProvince").html(data.html);   $("#cboCity").val('- Select City/Municipality -');$("#cboBarangay").val('- Select Barangay -');} } });
}
});       

$('#cboProvince').on('change', function() {
        $.ajax({
        url: '<?php echo base_url();?>church/spatial',
        type: "post", dataType: "json", data:{search_value: $('#cboProvince').find(":selected").val(), type:'fetch-city'}, 
        success: function(data){if(data.response=="success"){$("#cboCity").html(data.html);   $("#cboBarangay").val(1);}} });
});

$('#cboCity').on('change', function() {
  $.ajax({
        url: '<?php echo base_url();?>church/spatial',
        type: "post", dataType: "json",  data:{search_value: $('#cboCity').find(":selected").val(), type:'fetch-barangay'},  
        success: function(data){if(data.response=="success"){ $("#cboBarangay").html(data.html);    } } });
});


toastr.options = {"closeButton": false,"debug": false, "newestOnTop": false,"progressBar": false,"positionClass": "toast-bottom-center","preventDuplicates": false,"onclick": null,"showDuration": "300","hideDuration": "1000","timeOut": "5000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}

</script>


