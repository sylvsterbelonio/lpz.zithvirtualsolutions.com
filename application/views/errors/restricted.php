<?php $error = $this->ParameterModel->getGroupParameter('error-page');?>

<main style="margin-top:100px">
    <div class="container" >
      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1 align=center><?= $error['headings']?></h1>
        <h2 align=center><?= $error['content']?></h2>
        <p align=center ><a class="btn" href="<?=base_url()?>"><?= $error['link']?></a></p
        <br>
        <img style="width:50%;display: block;margin-left: auto;margin-right: auto;" src="<?=base_url()?>assets/images/not-found.svg" class="img-fluid py-5" alt="Page Not Found">
        <div class="credits"> 
        </div>
      </section>
    </div>
  </main><!-- End #main -->