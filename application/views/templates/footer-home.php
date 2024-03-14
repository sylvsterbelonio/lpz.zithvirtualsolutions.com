    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h1 class="fw-bold text-primary mb-4"><?=$App['appProject']?></h1>
                    <p><?=$App['appDescription']?></p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square me-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square me-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Address</h5>
                    <p><i class="fa fa-map-marker-alt me-3"></i><?=$App['appAddress']?></p>
                    <p><i class="fa fa-phone-alt me-3"></i><?=$App['appContactNo']?></p>
                    <p><i class="fa fa-envelope me-3"></i><?=$App['appContactEmail']?></p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Quick Links</h5>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Newsletter</h5>
                    <p>You can freely subscribe here for more updates and news.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a href="#"><?=$App['appTitle']?></a>, <?=$App['appRights']?>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                      Powered By <a href="<?=base_url()?>"><?=$App['appPoweredBy']?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="<?=base_url()?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>assets/js/wow/wow.min.js"></script>
    <script src="<?=base_url()?>assets/js/easing/easing.min.js"></script>
    <script src="<?=base_url()?>assets/js/waypoints/waypoints.min.js"></script>
    <script src="<?=base_url()?>assets/js/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?=base_url()?>assets/js/parallax/parallax.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?=base_url()?>assets/js/home/main.js"></script>
</body>

</html>