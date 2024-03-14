<?php
$app = $this->ParameterModel->getGroupParameter('app');
$page = $this->ParameterModel->getGroupParameter('register');
$input = $this->ParameterModel->getGroupParameter('input');
$button = $this->ParameterModel->getGroupParameter('button');
?>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <span  class="logo d-flex align-items-center">
            <img src="<?= base_url()?>assets/images/logo_revised.png" alt="">
            <span class="d-none d-lg-block">
                <?= $app['appProject'] ?>
            </span>
</span>
    </div>
    <!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li> <a></a></li>
        </ul>
    </nav>
    <!-- End Icons Navigation -->

</header>
<!-- End Header -->
<!-- start main -->
<main class="mt-4 pt-4">
<div class="content">
    <div class="row">
        <div class="col-lg-6">    

            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title" align=center>Mobile Screenshots</h5>
                    <div class="row">
                        <div class="col-lg-6">   
                            <!-- Slides with captions -->
                            <div class="d-flex justify-content-center">
                            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel"
                                style="height:450px;width:200px">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                        class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                        aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                                        aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="<?= base_url() ?>assets/images/downloads/1p_1.jpg" style="height:430px;"
                                            class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                        
                            
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?= base_url() ?>assets/images/downloads/1p_2.jpg" style="height:430px;"
                                            class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                    
                                    
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?= base_url() ?>assets/images/downloads/1p_3.jpg" style="height:430px;"
                                            class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                    
                                            <p>.</p>
                                        </div>
                                    </div>
                                

                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>

                            </div><!-- End Slides with captions -->
                        </div>

                        </div>
                        <div class="col-lg-6">   
                            <h4>G12 Lpz System</h4>
                            <p style="text-align:justify"> An application tools that boost the productivity of recording, and monitoring the people.</p>
                            <p><b>Main Features:</b></p>
                            <ul>
                                <li>Create An Account</li>
                                <li>Convenient Access of Guides for Evangelism</li>
                                <li>Monitor your Disciples</li>
                                <li>Provides analytics and data summary for the performance of the network.</li>
                                <li>Enables Light and Dark Mode Skins.</li>
                            </ul>
                            <p><b>Android OS Requirements:</b></p>
                            <ul>
                                <li>Minimum: API 23: Android 6.0 <i>(Marsmallow)</i></li>
                                <li>Maximum: API 32: Android 12L (5v2)</li>
                            </ul>
                            <div class="d-flex justify-content-end">
                              <a href="https://play.google.com/store/apps/details?id=com.lpzoutreach.g12project" target="_blank">  <img class="d-flex" src="<?= base_url() ?>assets/images/downloads/en_badge_web_generic.png" width=220 height=80/></a>
                            </div>
                        </div>
                    </div>        

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center">Android Released Update</h5>
                        <div class="row">
                                <div class="col-lg-12">    
                                    <div class="d-flex justify-content-center">
                                    <img class="d-flex" src="<?= base_url() ?>assets/images/downloads/Android-Logo.png" width=220 height=140>
                                    </div>
                                </div>
                        </div> 
                        
                     

                        <div class="row">
                                        <?=$list_app_updates?>            
                        </div>

                   

                </div>
            </div>
        </div>


</div>
    </div>
</main>
<!-- End #main -->