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
                
<h1>Data Privacy</h1>  

<p>
At G12 LPZ, we prioritize the privacy and security of our web application users. This Privacy Policy explains how we collect, use, and protect your personal information when you interact with our web application. By using the G12 LPZ web application, you consent to the practices described in this policy.
</p>

<p><b>Information Collection:</b><br>
We may collect personal information from you when you use our web application. This information may include your name, email address, contact details, and any other information you voluntarily provide.
</p>

<p><b>
Information Usage:</b><br>
We use the collected information to enhance your experience within the G12 LPZ web application. The purposes of data usage include, but are not limited to:
</p>

<p>
Providing personalized content, resources, and services to meet your needs.
Facilitating communication and interaction among users.
Sending important updates, notifications, and newsletters related to the web application.
Improving and optimizing the performance and functionality of the web application.
</p>

<p><b>Information Sharing:</b><br>
We respect your privacy and do not sell, trade, or rent your personal information to third parties without your explicit consent. However, we may share your information in the following cases:
</p>

<p>
With trusted third-party service providers who assist us in operating and maintaining the web application. These providers have agreed to maintain the confidentiality and security of your information.
When required by law, regulation, or legal process to protect the rights, property, or safety of G12 LPZ, its users, or others.
</p>

<p><b>Data Security:</b><br>
We implement appropriate technical and organizational measures to safeguard your personal information from unauthorized access, disclosure, alteration, or destruction. However, please note that no data transmission over the internet or storage method can be guaranteed to be 100% secure. We strive to protect your information, but we cannot guarantee absolute security.
</p>

<p><b>Cookies and Tracking Technologies:</b><br>
We may utilize cookies and similar tracking technologies to enhance your browsing experience and gather non-personal information such as IP addresses, browser types, and usage patterns. You can adjust your browser settings to disable cookies if desired.
</p>

<p><b>Third-Party Links:</b><br>
The G12 LPZ web application may contain links to external websites or services. We are not responsible for the privacy practices or content of those third-party sites. We encourage you to review their respective privacy policies when visiting them.
</p>

<p><b>Children's Privacy:</b><br>
The G12 LPZ web application is not intended for children under the age of 13. We do not knowingly collect personal information from children. If we become aware of unintentional collection of personal information from a child, we will take appropriate steps to remove it from our records.
</p>

<p><b>
Changes to the Privacy Policy:</b><br>
We reserve the right to update this Privacy Policy as needed to reflect changes in our practices or legal obligations. We will notify you of any significant updates by posting a prominent notice on our website or sending you a direct communication.
</p>

<p>
If you have any questions or concerns regarding our Privacy Policy or the practices described herein, please contact us using the provided contact information. We value your privacy and will make reasonable efforts to address your inquiries promptly.                 
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