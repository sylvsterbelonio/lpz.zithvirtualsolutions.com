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
            <div class="col-lg-12 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                  <?= $this->ParameterModel->getDefaultParameter("Terms & Condition") ?> 

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