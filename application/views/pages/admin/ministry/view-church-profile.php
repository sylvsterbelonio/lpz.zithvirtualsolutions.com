
<main id="main" class="main">

  <!-- Page Title -->
  <div class="pagetitle">
    <h1><?=$church['church_name']?></h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('dashboard')?>">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="<?=base_url('church')?>">Church</a></li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title --> 
 
        <div class="row">

            <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body p-0">

                  <div class="filter position-absolute end-0 top-0 me-3 mt-1">
                  <a class="icon btn btn-outline-secondary btn-sm" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots-vertical" style="color:white"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                            <div class="bg-primary p-0 m-0">
                                <img src="<?=base_url() . $church['url_cover_photo'] ?>" class="img-fluid" style="width:100%;height:"> 
                            </div>

                            <img src="<?=base_url() . $church['url_photo'] ?>" class="ms-3 mb-3 position-absolute start-0 bottom-0 border border-light rounded-circle border border-3" style="width:18%;height:50%;min-width:18%;min-height:50%"> 
                        
                            <?php if(isset($currentChurchJoined)){
                                      if($currentChurchJoined['user_status']=="approved") {?>
                                              <button onclick="actionChurch(this,'remove','Do you want to remove this church? All of your data will be permanently deleted.')" class="me-3 mb-3 position-absolute end-0 bottom-0 btn btn-danger float-end"><i class="bi bi-x-lg me-2"></i>Remove</button>
                                            <?php }else{ ?>
                                              <button onclick="actionChurch(this,'cancel','Do you want to cancel your request?')" style="z-index:1" class="me-3 mb-3 position-absolute end-0 bottom-0   btn btn-danger float-end"><i class="bi bi-x-lg  me-2"></i>Cancel Request</button>                                 
                                              <div class="position-absolute end-0 bottom-0 mb-4 pb-4">
                                                  <span class="me-3 mb-3 bg-warning p-2 rounded-start rounded-end float-end"><i class="bi bi-patch-exclamation  me-2"></i>Pending</span>
                                              </div>
                                            <?php } ?>  
                            <?php }else{ ?> 
                            <button onclick="actionChurch(this,'join','Do you want to join this church?')" class="me-3 mb-3 position-absolute end-0 bottom-0 btn btn-primary float-end"><i class="bi bi-box-arrow-in-right  me-2"></i>Join</button>
                                <?php }?>
                        </div>
                    </div><!-- End Default Badges -->

                    <div class="card">
                        <div class="card-body">

    <!-- Defa <!-- Bordered Tabs Justified -->
    <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Members</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Organization</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">About</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">
            
                <div style="width: 560px; height: 315px; float: none; clear: both; margin: 2px auto;">
  <embed
    src="https://www.youtube.com/embed/zqOe1OGCE8o?autohide=1&autoplay=1&modestbranding=1&autohide=1&showinfo=0"
    wmode="transparent"
    type="video/mp4"
    width="100%" height="100%"
    allow="autoplay; encrypted-media; picture-in-picture"
    allowfullscreen
    title="Keyboard Cat"
  >
</div>



             
                </div>
                <div class="tab-pane fade" id="bordered-justified-profile" role="tabpanel" aria-labelledby="profile-tab">
           
           
    <!-- Default Tabs -->
    <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-justified" type="button" role="tab" aria-controls="home" aria-selected="true">Servant Leaders</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                  <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-justified" type="button" role="tab" aria-controls="profile" aria-selected="false">Members</button>
                </li>
              </ul>
              <div class="tab-content pt-2" id="myTabjustifiedContent">

              <!-- SERVANT LEADERS -->
                <div class="tab-pane fade show active" id="home-justified" role="tabpanel" aria-labelledby="home-tab">
           
<div class="row g-2">

<div class="col-lg-6">
        <div class="card">
            <div class="card-body p-0">
                <div class="row mt-1 mb-1 ps-0 pt-0 pb-0 pe-0">
                    <div class="col-lg-4 bg-">
                        <img class="rounded mx-auto d-block" src="<?=base_url()?>assets/images/default-photo_square.png" style="width:100%;max-height:200px;max-width:200px;min-width:110px">
                    </div>
                    <div class="col-lg-8 mt-2">
                        <span class="text-primary text-center align-items-center justify-content-center"><h6 align=center><a href=""><b>Ptr. Ariel Edroso</b></a></h6></span>
                        <hr>
                        <p align=center class="bg- me-3 mb-0 " ><i><small>Senior Pastor » Co-Founder » Bible Teacher</small></i></p>
                    </div>                    
                </div>                   
            </div>
        </div>     
</div> 
<div class="col-lg-6">
        <div class="card" >
            <div class="card-body p-0">
                <div class="row mt-1 mb-1 ps-0 pt-0 pb-0 pe-0">
                    <div class="col-lg-4 bg- pt-0">
                        <img class="rounded mx-auto d-block pt-0" src="<?=base_url()?>assets/images/default-photo_square.png" style="width:100%;max-height:200px;max-width:200px;min-width:110px">
                    </div>
                    <div class="col-lg-8 mt-2">
                        <span class="text-primary text-center align-items-center justify-content-center" style="margin-top:-10px"><h6 align=center><a href=""><b>Ptr. Ariel Edroso</b></a></h6></span>
                        <hr>
                        <p align=center class="bg- me-3 mb-0" ><i><small>Associate Pastor » Primary Leader » Preacher » Bible Teacher</small></i></p>
                    </div>                    
                </div>                   
            </div>
        </div>     
</div> 




<!-- END OF -->
</div>
            
            
            </div>
                <div class="tab-pane fade" id="profile-justified" role="tabpanel" aria-labelledby="profile-tab">
                  Nesciunt totam et. Consequuntur magnam aliquid eos nulla dolor iure eos quia. Accusantium distinctio omnis et atque fugiat. Itaque doloremque aliquid sint quasi quia distinctio similique. Voluptate nihil recusandae mollitia dolores. Ut laboriosam voluptatum dicta.
                </div>

              </div><!-- End Default Tabs -->       
           
           
           
            </div>
                <div class="tab-pane fade" id="bordered-justified-contact" role="tabpanel" aria-labelledby="contact-tab">
                  Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                </div>
              </div><!-- End Bordered Tabs Justified -->           

                        </div>
                    </div>            

            </div>

            <div class="col-lg-4">
            <div class="card">
                        <div class="card-body">
                
                        
                        <div class="col-md-12 col-lg-12"> 
                            <div for="yourSystem_Role" class="col-md-12 col-lg-12 col-form-label"><span class="text-primary"><b>ADDRESS</b></span></div>
                            <label for="yourSystem_Role" class="">Purok 4, Barangay Catumbalon, Valencia City, Bukidnon, 8709</label>
                            </div> 
                        

                            <div class="d-flex justify-content-center align-items-center mt-2 mb-2 border border-primary" style="width:100%;height:100%">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d433.81340754616053!2d125.11278291467222!3d7.87701980374973!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x21bfab83c8b4c9bf%3A0xaaa4eca6b5b9fb69!2sLPZ%20Outreach!5e0!3m2!1sen!2sph!4v1677768541350!5m2!1sen!2sph"  style="border:0;width:100%;height:auto" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>        


                            <div class="col-md-12 col-lg-12"> 
                            <div for="yourSystem_Role" class="col-md-12 col-lg-12 col-form-label"><span class="text-primary"><b>SUNDAY SERVICE</b></span></div>
                            <label for="yourSystem_Role" class="">9:30AM-12:00PM</label>
                            <p align=justify><small><i>An official schedule for Sunday Service in the church.</i></small></p>
                            </div>   
                            <div class="col-md-12 col-lg-12"> 
                            <div for="yourSystem_Role" class="col-md-12 col-lg-12 col-form-label"><span class="text-primary"><b>HOLY COMMUNION</b></span></div>
                            <label for="yourSystem_Role" class="">Every <b class="text-secondary">1st Week</b> of the <b class="text-secondary">Month</b></label>
                            <p align=justify><small><i>A Christian ceremony in which people eat bread and drink wine in memory of Christ's death.</i></small></p>
                            <div class="col-md-12 col-lg-12"> 
                            <div for="yourSystem_Role" class="col-md-12 col-lg-12 col-form-label"><span class="text-primary"><b>FAMILY DAY</b></span></div>
                            <label for="yourSystem_Role" class="">Every <b class="text-secondary">3rd Week</b> of the <b class="text-secondary">Month</b></label>
                            <p align=justify><small><i>Where everyone is gathered after Sunday Service and to give a small celebration of eating together and give time for bonding.</i></small></p>
                            </div>   
                            <div class="col-md-12 col-lg-12"> 
                            <div for="yourSystem_Role" class="col-md-12 col-lg-12 col-form-label"><span class="text-primary"><b>THANKSGIVING ANNIVERSARY</b></span></div>
                            <label for="yourSystem_Role" class="">Every <b class="text-secondary">3rd Week</b> of <b class="text-secondary">November</b></label>
                            </div>                              
                        </div>
                        
                    </div><!-- End Default Badges -->
            </div>

        </div>

</main>

<script>
var action_button = "";  
var loadingJoin =`<div class="d-flex align-items-center justify-content-center">
                <div class="spinner-grow spinner-grow-sm me-3" role="status">
                <span class="visually-hidden">Loading...</span> 
                </div>Loading`; 


function actionChurch(parent, action, message){


  const swalWithBootstrapButtons = Swal.mixin({
        customClass: {confirmButton: 'btn btn-success',cancelButton: 'btn btn-danger me-3'},buttonsStyling: false})
        swalWithBootstrapButtons.fire({
            title: '',text: message,icon: 'warning',showCancelButton: true,reverseButtons: true,
            confirmButtonText: '<i class="bi bi-check-circle me-2"></i>Yes',
            cancelButtonText: '<i class="bi bi-x-lg me-2"></i>No',}).then((result) => {
            if(result.value){
              //////////////////////DISPLAY YOUR CONTENT HERE//////////////////////////
              $(parent).attr("disabled","disabled");
              $(parent).html(loadingJoin);

              $.ajax({
                    url: "<?php echo base_url();?>church/join-church",
                    type:"post",
                    dataType: "json",
                    data:{
                    id:<?=$church['churchID']?>,
                    action: action
              },
              success: function(data){
                        if(data.response=="success")
                            {
                                window.location.href = "<?=base_url()?>church";
                                toastr["success"](data.message)
                            }
                        else
                            {toastr["error"](data.message);}
                    }
            });
            ///////////////////////END OF CODE HERE///////////////////////////////////
            }});


         

}

$("#btnRemoveJoinChurch").click(function(){

  $("#btnRemoveJoinChurch").html(loadingJoin);
  $("#btnRemoveJoinChurch").attr("disabled","disabled"); 

});



var searchLoading = `
                        <div class="mb-4 mt-4 pb-4 d-none" style="height:250px">
                          <div class="d-flex align-items-center justify-content-center mt-4 ">
                            <div class="spinner-grow spinner-grow-sm me-3 mt-1 " role="status">
                              <span class="visually-hidden">Loading...</span> 
                            </div>Loading data...
                        </div>
`;

var loading =`<div class="d-flex align-items-center justify-content-center mt-4 ">
                <div class="spinner-grow spinner-grow-sm me-3 mt-1 " role="status">
                <span class="visually-hidden">Loading...</span> 
                </div>Loading data...`;  
var buttonLoading = ``;                

//END OF CROPPER INITIALIZATION//
</script>


