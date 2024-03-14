
<?php $app = $this->ParameterModel->getGroupParameter('app'); ?>
<?php $value = 
   '<meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>'.$app['appName'].'</title>
    <meta name="description" content="'. (isset($page['meta-description']) ? $page['meta-description']: '') .'" >
    <meta name="keywords" content="'.(isset($page['meta-keywords']) ? $page['meta-keywords']: '').'" >
    <meta name="author" content="'.(isset($page['meta-author']) ? $page['meta-author']: '').'">
    <!-- Favicons -->
    <link href="'.(isset($app['appIcon']) ? base_url().$app['appIcon']: '').'" rel="icon">
    <link href="'.(isset($app['appIcon']) ? base_url().$app['appIcon']: '').'" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link rel="stylesheet" type="text/css" href="'.base_url().'assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="'.base_url().'assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="'.base_url().'assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="'.base_url().'assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="'.base_url().'assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="'.base_url().'assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="'.base_url().'assets/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="'.base_url().'assets/css/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="'.base_url().'assets/css/buttons.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="'.base_url().'assets/css/responsive.bootstrap5.min.css"/>
    <link rel="stylesheet" type="text/css" href="'.base_url().'assets/css/cropper.css"/>
    <link rel="stylesheet" type="text/css" href="'.base_url().'assets/css/jquery-ui.css"/>
    <!-- Template Main CSS File -->
    <link href="'. base_url("assets/css/style.css") .'" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="'.base_url().'assets/css/dark-mode.css"/>
    <link href="'.base_url().'assets/css/roles.css" rel="stylesheet">
    <!-- SCRIPT tag -->
    <script differ type="text/javascript" src="'.base_url().'assets/js/jquery-3.5.1.js"></script>
    <script differ type="text/javascript" src="'.base_url().'assets/js/jquery.dataTables.min.js"></script> 
    <script differ type="text/javascript" src="'.base_url().'assets/js/dataTables.bootstrap5.min.js"></script> 
    <script differ type="text/javascript" src="'.base_url().'assets/js/toastr.min.js"></script> 
    <script differ type="text/javascript" src="'.base_url().'assets/js/jszip.min.js"></script>
    <script differ type="text/javascript" src="'.base_url().'assets/js/pdfmake.min.js"></script>
    <script differ type="text/javascript" src="'.base_url().'assets/js/vfs_fonts.js"></script>
    <script differ type="text/javascript" src="'.base_url().'assets/js/jquery.dataTables.min.js"></script>
    <script differ type="text/javascript" src="'.base_url().'assets/js/dataTables.bootstrap5.min.js"></script>
    <script differ type="text/javascript" src="'.base_url().'assets/js/dataTables.buttons.min.js"></script>
    <script differ type="text/javascript" src="'.base_url().'assets/js/buttons.bootstrap5.min.js"></script>
    <script differ type="text/javascript" src="'.base_url().'assets/js/buttons.html5.min.js"></script>
    <script differ type="text/javascript" src="'.base_url().'assets/js/buttons.print.min.js"></script>
    <script differ type="text/javascript" src="'.base_url().'assets/js/dataTables.responsive.min.js"></script>
    <script differ type="text/javascript" src="'.base_url().'assets/js/responsive.bootstrap5.js"></script>
    <script differ type="text/javascript" src="'.base_url().'assets/js/sweetalert2@11.js"></script>   
    <script differ type="text/javascript" src="'.base_url().'assets/js/cropper.min.js"></script>'; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <?=$this->ParameterModel->singleLine($value,"on")?>
</head>
<body>