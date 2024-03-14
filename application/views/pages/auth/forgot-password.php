<?php 
$app = $this->ParameterModel->getGroupParameter('app');
$page = $this->ParameterModel->getGroupParameter('forgot-password');
$input = $this->ParameterModel->getGroupParameter('input');
$button = $this->ParameterModel->getGroupParameter('button');
?>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="<?=$app['appDomain']?>" class="logo d-flex align-items-center">
      <img src="<?=$app['appLogo']?>" alt="">
        <span class="d-none d-lg-block"><?=$app['appProject']?></span>
    </a>
  </div>
  <!-- End Logo -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
      <li><a href="<?=base_url("login")?>" class="btn btn-primary me-2"><?=$button['login']?></a></li>
      <li><a href="<?=base_url("register")?>" class="btn btn-success me-2"><?=$button['register']?></a></li>
    </ul>
  </nav>
  <!-- End Icons Navigation -->

</header>

  <main style="margin-top:50px">
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div id="contentForgotPassword" class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4"><?=$page['title']?></h5>
                    <p class="text-center small"><?=$page['subtitle']?></p>
                  </div>


                  <div class="col-12">
                      <label for="your<?=$input['key-email']?>" class="form-label"><?=$input['email']?></label>
                      <input id="txtSettings_Email" type="text" name="<?=$input['email']?>" class="form-control" id="your<?=$input['key-email']?>" required>
                      <div id="feedback_settings_email" class="text-danger "></div>
                    </div>

                    <div class="col-12" style="margin-top:10px">
                      <button id="btnSettingsSendCode" class="btn btn-primary w-100" type="submit"><i class="bi bi-file-earmark-lock" style="margin-right:10px"></i>Send Code</button>
                    </div>
                </div>

                <div id="contentPassword" class="card-body" style="display:none">

                          <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4"></h5>
                            <p class="text-center small">Enter your new password</p>
                          </div>

                          <div class="col-12">
                              <label for="yourNewPassword" class="form-label">New Password</label>
                              <input id="txtnewpassword" type="password" name="newpassword" class="form-control" id="yourNewPassword" required>
                              <div id="feedback_newpassword" class="text-danger "></div>
                            </div>

                            <div class="col-12">
                              <label for="yourConfirmPasword" class="form-label">Confirm Password</label>
                              <input id="txtconfirmpassword" type="password" name="confirmpassword" class="form-control" id="yourConfirmPasword" required>
                              <div id="feedback_confirmpassword" class="text-danger "></div>
                            </div>

                            <div class="col-12" style="margin-top:10px">
                              <button id="btnConfirmPassword" class="btn btn-primary w-100" type="submit"><i class="bi bi-file-earmark-lock" style="margin-right:10px"></i>Confirm</button>
                            </div>
                          </div>

              </div>



            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

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
   </div><!-- End Vertically centered Modal-->

  <script>

$(document).on("click","#btnConfirmPassword", function(e){
  
  $.ajax({
          url: "<?php echo base_url();?>profile/new-password",
          type:"post",
          dataType: "json",
          data:{
              email: $('#txtSettings_Email').val(),
              newpassword: $('#txtnewpassword').val(),
              confirmpassword: $('#txtconfirmpassword').val(),
              },
          success: function(data){
            console.log(data);
              if(data.response=="success")
                          {                    
                            
                            alert("im here");
                            window.location.href = "<?=base_url()?>login";
                              $("#lnkLogIn").trigger('click');

                              $("#contentForgotPassword").hide();
                              $("#contentPassword").hide();
                              $("#feedback_verification_code").text(data.message);
                              $("#sendCodeModal").modal('show');
                              $("#txtnewpassword").focus();
                          }
                      else
                          {    
                              if(data.newpassword!=""){
                              $("#txtnewpassword").focus()
                              $("#feedback_newpassword").text("* "+ data.newpassword);}  
                              if(data.confirmpassword!=""){
                              $("#txtconfirmpassword").focus()
                              $("#feedback_confirmpassword").text("* "+ data.confirmpassword);}                                                                                    
                          }

                        }
                  
        });


});


$(document).on("click","#btnSettingsSendCode", function(e){

$("#feedback_settings_email").text("");

$.ajax({
          url: "<?php echo base_url();?>profile/send-code-email-forgot-password",
          type:"post",
          dataType: "json",
          data:{
              email: $('#txtSettings_Email').val(),
              },
          success: function(data){
            console.log(data);
              if(data.response=="success")
                          {                                
                              $("#feedback_verification_code").text(data.message);
                              $("#sendCodeModal").modal('show');
                              $("#txtnewpassword").focus();
                          }
                      else
                          {    
                              if(data.email!=""){
                              $("#txtSettings_Email").focus()
                              $("#feedback_settings_email").text("* "+ data.email);}                                                                                  
                          }

                        }
                  
        });

        

});


$(document).on("click","#btnCodeVerifier", function(e){

$("#feedback_verification_code").text("");

$.ajax({
          url: "<?php echo base_url();?>profile/verifycode-forgot-password",
          type:"post",
          dataType: "json",
          data:{
              email: $('#txtSettings_Email').val(),
              code: $("#txtSettings_VerificationCode").val()
              },
          success: function(data){
            console.log(data);

              if(data.response=="success")
                          {                                
                             
                              $("#sendCodeModal").modal('hide');
                              $("#contentForgotPassword").hide();
                              $("#contentPassword").show();

                              
                          }
                      else
                          {    
                              if(data.code!=""){
                              $("#txtSettings_VerificationCode").focus()
                              $("#feedback_verification_code").text("* "+ data.code);}                                                                                  
                          }
                        }                   
        });
});

  </script>  