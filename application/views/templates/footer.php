<?php $app = $this->ParameterModel->getGroupParameter('app'); ?>

<?php $value='
<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        '.$app['appCopyRight'].'
    </div>
    <div class="credits">
        '.$app["appCredits"].'
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>'; ?>

<!-- Modal Dialog Scrollable -->
<?php $welcome_message = $this->NotificationModel->getWelcome_Message(); ?>
<?php if(isset($welcome_message)) $value .= $welcome_message;?>

<!-- Vendor JS Files -->
<?php $value.='
<script src="'.base_url().'assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="'.base_url().'assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="'.base_url().'assets/vendor/chart.js/chart.umd.js"></script>
<script src="'.base_url().'assets/vendor/echarts/echarts.min.js"></script>
<script src="'.base_url().'assets/vendor/quill/quill.min.js"></script>
<script src="'.base_url().'assets/vendor/tinymce/tinymce.min.js"></script>
<script src="'.base_url().'assets/vendor/php-email-form/validate.js"></script>
<script src="'.base_url().'assets/js/jquery-ui.js"></script> 
<script src="'.base_url().'assets/js/simple-datatables.js"></script> 
<!-- Template Main JS File -->
<script src="'.base_url().'assets/js/main.js"></script>
<script src="'.base_url().'assets/js/dark-mode-switch.min.js"></script>
<script differ type="text/javascript" src="'.base_url().'assets/js/myScript.js"></script> 

</body>

</html>';?>

<?= $this->ParameterModel->singleLine($value,"on");
