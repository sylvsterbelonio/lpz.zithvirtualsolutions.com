<?php $populateSideMenu = $this->MenuModel->populateSideMenu($page); ?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
<ul class="sidebar-nav" id="sidebar-nav">
    <?= $populateSideMenu ?>
</ul>
</aside><!-- End Sidebar-->