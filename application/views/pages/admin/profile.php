<?php $profileInformation = $this->ProfileModel->getProfileInformation($_SESSION['userID']); ?>
<main id="main" class="main">
  <?= $this->breadcrumb->breadcrumb('Profile')?>
  <!-- Section -->
  <section class="section profile">
    <div class="row">
        <?= $this->profile->tabtitle() ?>
      <div class="tab-content pt-2">                        
        <!-- Overview Tab --><?= $profileInformation['overviewtab'] ?>
        <!-- Profile Tab --><?=$this->profile->profiletab()?>
        <!-- Profile Tab --><?=$this->profile->familytab()?>
        <!-- Settings Tab --><?=$this->profile->settingstab()?>