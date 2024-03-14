

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
<div class="d-flex align-items-center justify-content-between">
  <a href="https://www.lpzoutreach.com/" class="logo d-flex align-items-center">
    <img src="assets/images/logo.png" alt="">
    <span class="d-none d-lg-block">Project</span>
  </a>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
<?php if(isset($_SESSION['username']) )  { ?>

  <ul class="d-flex align-items-center">

<li class="nav-item dropdown pe-3">

  <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
   <img src="<?= isset($userAccountInfo['profile_photo_path']) ? $userAccountInfo['profile_photo_path'] : 'assets/images/default-photo_square.png'?>" alt="Profile" class="rounded-circle">
    <span class="d-none d-md-block dropdown-toggle ps-2"><?=$_SESSION['username']?></span>
  </a><!-- End Profile Iamge Icon -->

  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
    <li class="dropdown-header">
      <h6><?=$_SESSION['username']?></h6>
      <span><?=$_SESSION['accessLevelName']?></span>
    </li>
    <li>
      <hr class="dropdown-divider">
    </li>
    <li>
      <a class="dropdown-item d-flex align-items-center" href="dashboard">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li>
      <a class="dropdown-item d-flex align-items-center" href="profile">
        <i class="bi bi-person"></i>
        <span>My Profile</span>
      </a>
    </li>
    <li>
      <hr class="dropdown-divider">
    </li>

    <li>
      <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
        <i class="bi bi-gear"></i>
        <span>Account Settings</span>
      </a>
    </li>
    <li>
      <hr class="dropdown-divider">
    </li>

    <li>
      <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
        <i class="bi bi-question-circle"></i>
        <span>Need Help?</span>
      </a>
    </li>
    <li>
      <hr class="dropdown-divider">
    </li>

    <li>
      <a class="dropdown-item d-flex align-items-center" href="<?= base_url('logout')?>">
        <i class="bi bi-box-arrow-right"></i>
        <span>Sign Out</span>
      </a>
    </li>

  </ul><!-- End Profile Dropdown Items -->


<?php }else{ ?>

  <ul class="d-flex align-items-center">
  <li><a href="/login" ><span id="linkLogIn" class="badge rounded-pill bg-primary p-3 " style="margin-right:20px"><span class="ri-login-box-line">&nbsp;&nbsp;&nbsp;Log In</span></a></li>
    <li><a href="/register" ><span id="linkRegister" class="badge rounded-pill bg-success p-3 ms-2" style="margin-right:20px"><span class="bi bi-person-plus">&nbsp;&nbsp;&nbsp;Register</span></a></li>
  </ul>

<?php }?>
</nav><!-- End Icons Navigation -->



</header><!-- End Header -->

  <main style="margin-top:80px">
    <div class="container">

    </div>
  </main><!-- End #main -->


<ul>
<?php foreach($users as $row){ ?>

<li><a href="<?= base_url() ?><?= $row['userID'] ?>"><?= $row['email'] ?></a></li>

<?php } ?>

</ul>