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
                
                 <h3> Copyright © 2023 G12 LPZ. All rights reserved.</h3>
<p><b>Ownership:</b><br>
The G12 LPZ web application, including its design, layout, content, graphics, logos, and software, is the intellectual property of G12 LPZ and is protected by copyright laws. All elements of the web application are either owned by G12 LPZ or used under license from third-party providers.
</p>

<p><b>Copyright Protection:</b><br>
The content and materials on the G12 LPZ web application are protected by copyright laws and international treaties. Unauthorized reproduction, distribution, modification, or use of any materials without the explicit written permission of G12 LPZ may result in legal action.
</p>

<p><b>Permissible Use:</b><br>
You are granted a limited, non-exclusive, revocable license to access and use the G12 LPZ web application for personal, non-commercial purposes. This license does not permit you to:
</p>

<ol type="a">
    <li>Copy, reproduce, or modify any content or materials from the web application.</li>
    <li>Use the content or materials for any commercial purpose or public display.</li>
    <li>Remove or modify any copyright notices or other proprietary designations.</li>
</ol>    



<p><b>Trademarks:</b><br>
The trademarks, service marks, logos, and trade names displayed on the G12 LPZ web application are the property of G12 LPZ or their respective owners. Use of any trademarks without prior written consent from the trademark owner is strictly prohibited.
</p>

<p><b>User-Generated Content:</b><br>
If you contribute user-generated content to the G12 LPZ web application, you retain the copyright to your own content. However, by submitting the content, you grant G12 LPZ a worldwide, royalty-free, perpetual, irrevocable, and non-exclusive license to use, reproduce, modify, adapt, publish, translate, distribute, display, and sublicense the content in any media.
</p>

<p><b>Copyright Infringement:</b><br>
G12 LPZ respects the intellectual property rights of others and expects the same from its users. If you believe that any content on the G12 LPZ web application infringes upon your copyright, please notify us promptly with the following information:
</p>

<ol type="a">
    <li>A description of the copyrighted work you believe has been infringed.</li>
    <li>Identification of the specific content claimed to be infringing, including its location on the web application.</li>
    <li>Your contact information, including name, address, telephone number, and email address.</li>
    <li>A statement that you have a good-faith belief that the use of the copyrighted material is not authorized by the copyright owner, its agent, or the law.</li>
    <li>A statement, made under penalty of perjury, that the information provided in your notice is accurate and that you are the copyright owner or authorized to act on behalf of the copyright owner.</li>
</ol> 

<p>
Please send copyright infringement notices or any related inquiries to the designated copyright representative of G12 LPZ.
</p>

<p><b>Amendments:</b><br>
G12 LPZ reserves the right to modify or update this copyright information at any time without prior notice. It is your responsibility to review this information periodically to stay informed of any changes.
Note: This copyright information is provided for general informational purposes and does not constitute legal advice. For specific legal concerns, it is recommended to consult with a qualified attorney.
</p>



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