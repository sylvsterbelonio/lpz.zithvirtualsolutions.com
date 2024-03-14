<?php
 $achievementList = $this->AchievementModel->get_achievement_list();
 $points = $this->AchievementModel->get_status_points();
 $totalAPPoints = $points['totalAPEarned'];

 $data = '
 
  <main id="main" class="main">
  ' . $this->breadcrumb->breadcrumb('Achievements') .'
    <section class="section">
      <p class="text-end">
        <span class="bi bi-award" style="color:#fd7e14"></span> <b>Total Achievement Points (AP): </b> <span id="totalAchievementPoints">'. $totalAPPoints .'</span>
      </p>
      <div class="iconslist">
          '. $achievementList .'
      </div>
    </section>
  </main>
  <!-- End #main -->

  <div class="modal" id="verticalycentered" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Claim Reward</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body">
            
      <div id="reward_content">
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
  </div>
  </div>
  </div><!-- End Vertically centered Modal-->

  <script>

    $(document).on("click","#claim", function(e){

    $(this).hide();

    $.ajax({
                  url: "'.base_url().'achievements/claim",
                  type:"post",
                  dataType: "json",
                  data:{
                      sel_id: $(this).attr("value")
                  }, success: function(data){
                      
                      /* console.log(data); */
                      if(data.response=="success"){
                  
                          var total = parseInt($("#totalAchievementPoints").html());

                          $("#icon"+data.posts.id).html(data.posts.value);

                          $("#totalAchievementPoints").text(total + parseInt(data.posts.ap));

                  
                          $("#verticalycentered").modal("show");

                          $("#reward_content").html(`
                          <p align=center>You earn Rewards</p>
                          <div class="text-center"><span class="bi bi-award" style="color:#fd7e14"></span> `+ data.posts.ap  +` <span class="bi bi-capslock" style="color:#20c997"></span>
                          <span >`+data.posts.tp+` </span> 
                          <span class="ri-hand-coin-line" style="color:#0dcaf0;margin-top:"></span> 
                          <span>`+data.posts.rp+`</span></div>`);

                      }
                      /*alert(del_id);*/
                  }  
                  });

  });

  </script>';

  echo $this->ParameterModel->singleLine($data,"on");