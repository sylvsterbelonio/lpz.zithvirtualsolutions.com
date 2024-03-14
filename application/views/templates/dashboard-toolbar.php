<header id="header" class="header fixed-top d-flex align-items-center">
  <?=$this->toolbar->Admin_Toolbar()?>
  <?php $data = '
    <script>
      var selKeyVal=0;
   
      function update_remaining_value(data){
        if(data.html().length > 0 ){
          var total_unread = $("#header_remaining_unread").text();
          var newValue = total_unread - 1;
          $("#header_remaining_unread").text(newValue);
      }
   
      }
   
      $(document).on("click","#view_notification", function(e){
   
      selKeyVal = $(this).attr("value");
     
      /*remove dots*/
      update_remaining_value($(this).children("div").eq(1));
      $(this).children("div").eq(1).html("");
   
     $.ajax({
                   url: "'.base_url().'notify/read-notification-message",
                   type:"post",
                   dataType: "json",
                   data:{
                       id: selKeyVal
                   }, success: function(data){
                       if(data.response=="success"){
         
                         $("#notification_dialog_header").html("Notification");
                         $("#notification_dialog_content").html(data.posts.notificationContent);
   
                         if(data.posts.actionCommand=="Accept|Decline"){
                             $("#btnNotificationRead").hide();
                             $("#btnNotificationAccept").show();
                             $("#btnNotificationDecline").show();
                         }else{
                           $("#btnNotificationRead").show();
                             $("#btnNotificationAccept").hide();
                             $("#btnNotificationDecline").hide();
                         }
   
                         $("#notification_dialog").modal("show");
                       }
                       /*alert(del_id);*/
                   }  
                   });
   
   });
   
   $(document).on("click","#btnNotificationAccept", function(e){
   alert(selKeyVal);
   });
   
   $(document).on("click","#btnNotificationDecline", function(e){
   alert("decline" + selKeyVal);
   });
   
   </script>
    
    '; ?>
  <?= $this->ParameterModel->singleLine($data,"on") ?>  
</header>
  <!-- End Header -->
  <?= $this->modal->toolbar_modal_notification()?>