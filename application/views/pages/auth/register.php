<?php 
$app = $this->ParameterModel->getGroupParameter('app');
$page = $this->ParameterModel->getGroupParameter('register');
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
    </ul>
  </nav>
  <!-- End Icons Navigation -->

</header>
<!-- End Header -->
<!-- start main -->
<main class="mt-4 pt-4">
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4"><?=$page['h5']?></h5>
                      <p class="text-center small"><?=$page['p']?></p>
                  </div>
                      <?= form_open('register') ?>       
                      <?= isset($validation) ? "<div class='alert alert-danger' role='alert'>".$validation."</div>" : '' ?>
                      <?= isset($success) ? $success : '' ?>  
                    <div class="col-12">
                        <?= $this->field->input_text_required($input['key-first_name'],$input['first_name'],set_value('first_name'))?>
                        <?= form_error('first_name')?>     
                        <?= isset($first_name_validate) ? $first_name_validate : '' ?>        
                      </div>
                      <div class="col-12">
                        <?= $this->field->input_text_required($input['key-middle_name'],$input['middle_name'],set_value('middle_name'))?>
                        <?= form_error('middle_name')?>     
                        <?= isset($middle_name_validate) ? $middle_name_validate : '' ?>        
                      </div>  
                      <div class="col-12">
                        <?= $this->field->input_text_required($input['key-last_name'],$input['last_name'],set_value('last_name'))?>
                        <?= form_error('last_name')?>     
                        <?= isset($last_name_validate) ? $last_name_validate : '' ?>        
                      </div>   
                    <div class="col-12">
                        <?= $this->field->input_text_required($input['key-email'],$input['email'],set_value('email'))?>
                        <?= form_error('email')?>     
                        <?= isset($email_validate) ? $email_validate : '' ?>        
                    </div>
                    <div class="col-12">
                        <?= $this->field->input_password_required($input['key-password'],$input['password'],set_value('password'))?>
                        <?= form_error('password'); ?>        
                    </div>
                    <div class="col-12">
                      <?= $this->field->input_password_required($input['key-confirmPassword'],$input['confirmPassword'],set_value('confirmPassword'))?>
                      <?= form_error('confirmPassword')?>        
                    </div>
                    <div class="col-12" style="margin-top:10px">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms"><?=$page['terms-a']?> <a id="lnkTermsAndCondition" href="#"><?=$page['terms-b']?></a></label>
                        <div class="invalid-feedback"><?=$page['agree']?></div>
                      </div>
                    </div>
                    <div class="col-12" class="mt-4">
                      <button id="btnCreate" class="btn btn-success w-100 mt-4" type="submit" name="submit"><?=$button['createaccount']?></button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0 text-center"><?=$page['already']?> <a href="<?=base_url("login")?>"> <?=$page['login']?></a></p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
  </div>
</main>
<!-- End #main -->

<?= $this->modal->large_modal_scrollable("modalDialogScrollable", $this->ParameterModel->getDefaultParameter("appName"),$this->ParameterModel->getDefaultParameter("Terms & Condition"),"close")?>

 
<script> $(document).on("click","#lnkTermsAndCondition", function(e){$("#modalDialogScrollable").modal("show");}); </script>  