<?php $input = $this->ParameterModel->getGroupParameter('input');
			$button = $this->ParameterModel->getGroupParameter('button');
      $app = $this->ParameterModel->getGroupParameter('app');
      $page = $this->ParameterModel->getGroupParameter('login'); ?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
<div class="d-flex align-items-center justify-content-between">
  <a href="<?=$app['appDomain']?>" class="logo d-flex align-items-center">
    <img src="<?=base_url().$app['appLogo']?>" alt="">
    <span class="d-none d-lg-block"><?=$app['appProject']?></span>
  </a>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">
    <li><a href="<?=base_url('register')?>" class="btn btn-success me-4" ><?=$button['register']?></a></li>
  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->

  <main>

 <style>.my-background-image{margin-left:0px;background-image: url('<?=base_url().$page['background-image']?>');}</style>

 <div class="pt-4 mt-4 b-primary">
    <div class="my-background-image row justify-content-end ps-1 w-100">

      <div class="col-md-4 col-lg-3 float-right pe-4 ms-4 ps-3 pt-3" style="min-width:350px">

      <div class="card pt-4 mt-4">
          <div class="card-body">
              <div class="pt-0 pb-2">
                <h5 class="card-title text-center pb-0 fs-4"><?=$page['h5']?></h5>
                <p class="text-center small"><?=$page['p']?></p>
              </div>
              <?= form_open('login') ?>
                <?= isset($login_validate) ? $login_validate : '' ?> 
                <?= isset($success) ? $success : '' ?>  
                <div class="col-12">
                  <?= $this->field->input_text_required($input['key-email'],$input['email'],set_value('email'))?>
                  <?= form_error('email')?>     
                  <?= isset($email_validate) ? $email_validate : '' ?>  
                </div>

                <div class="col-12">
                  <?= $this->field->input_password_required($input['key-password'],$input['password'],set_value('password'))?>
               </div>

                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                    <label class="form-check-label" for="rememberMe"><?=$page['remember']?></label>
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary w-100" type="submit"><?=$button['login']?></button>
                </div>
                <div class="col-12 mb-1 text-center" style="margin-top:10px">
                  <p class="small mb-1"><?=$page['forgot']?> <a href="<?=base_url('forgot-password')?>"><?=$page['click']?></a></p>
                </div>
                <div class="col-12 mb-1 text-center">
                  <p class="small mb-1"><?=$page['dont']?> <a href="<?=base_url('register')?>"><?=$page['create']?></a></p>
                </div>
              </form>
            </div>  
        </div>

      </div>
    </div>
</div>

  </main><!-- End #main -->