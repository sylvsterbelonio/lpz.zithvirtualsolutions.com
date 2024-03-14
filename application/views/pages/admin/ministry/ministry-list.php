<!-- Spinner Start -->
<link href="<?=base_url()?>assets/css/roles.css" rel="stylesheet">

<main id="main" class="main">

  <?= $this->breadcrumb->breadcrumb('Church') ?>
  
  <!-- Section -->
  <section class="section profile">
      <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-body pt-3">
                <!-- Tab Title -->
                <ul class="nav nav-tabs nav-tabs-bordered">
                  <li class="nav-item">
                    <button id="btnListSection" class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"><span class="bi bi-view-list me-2"></span>List</button>
                  </li>
                </ul>
                <!-- End of Tab Title -->
              <button id="btnCloseChurchForm" type="button" class="d-none btn btn-outline-danger btn-sm position-absolute end-0 top-0 mt-3 me-4" ><span class="bi bi-x-lg"></span></button>                        
              <div class="tab-content pt-2">
                  <!-- START LIST CHURCH -->
                  <div class="tab-pane fade show active profile-overview" id="profile-overview">   
                      <!-- ROW  -->           
                      <div class="row mb-3">
                          <!-- LEFT COLUMN -->                          
                          <div class="col-lg-6">
                          <div class="card">
                                  <div class="card-body">                              
                                                <!-- LOAD CHURCH DYNAMICALLY -->                                              
                                      <?php if(isset($currentChurchJoined)) { ?>
                                      <label for="profileImage" class="col-md-4 col-lg-8 col-form-label"><b> Church Joined</b></label>
                                      <div id="" class="list-group mt-2">
                                            <!-- LOAD CHURCH DYNAMICALLY -->                                                
                                            <div class="list-group mt-2" >                                                        
                                                <button  id="btnBrowseCurrentChurchJoined" onclick="browseCurrentChurch('<?=base_url()?>church/<?=$currentChurchJoined['url']?>')" class="list-group-item list-group-item-action">
                                                <img class="border border-light border-2 rounded-circle" src="<?=base_url() . $currentChurchJoined['url_photo']?>" style="height:50px;width:50px">  
                                                <?=$currentChurchJoined['church_name']?>
                                                <?php if($currentChurchJoined['user_status']=='approved'){ ?>
                                                    <span id="spBrowseCurrentChurchJoined_loading" class="badge rounded-pill bg-success fluid ms-auto position-absolute end-0 top-0 mt-4 me-3"><i class="bi bi-check-circle-fill me-2"></i><?=$currentChurchJoined['user_status']?></span>
                                                <?php }else{ ?>
                                                    <span id="spBrowseCurrentChurchJoined_loading" class="badge rounded-pill bg-warning fluid ms-auto position-absolute end-0 top-0 mt-4 me-3"><i class="bi bi-patch-exclamation me-2"></i><?=$currentChurchJoined['user_status']?></span>  
                                                <?php }?>                                               
                                                </button>
                                            </div>
                                      </div>
                                </div>  
                                      <?php }else{ ?>
                                                  <label for="profileImage" class="col-md-4 col-lg-8 col-form-label"><b>Current Church Joined</b></label>
                                                  <div id="" class="list-group mt-2">
                                                      <!-- LOAD CHURCH DYNAMICALLY -->                                                  
                                                  <p align=center class="mt-4 mb-4">Not join yet</p>
                                                  </div>
                                                  </div>  
                                                  <div class="text-end me-4 mb-4 ">
                                                      <button id="btnSearchChurchDialog" class="btn btn-primary btn-sm "><i class="bi bi-search me-2"></i>Search Church</button>                    
                                                  </div> 
                                                  <?php } ?>                                
                              </div>    
                              <div class="card">
                                <div class="card-body">                                
                                  <label for="profileImage" class="col-md-4 col-lg-8 col-form-label"><b>List of Church Founded</b></label>
                                      <div id="lstChurch" class="list-group mt-2">
                                          <!-- LOAD CHURCH DYNAMICALLY -->                                          
                                          <div class="d-flex align-items-center justify-content-center mt-4 ">                                            
                                            <div class="spinner-grow spinner-grow-sm me-3 mt-1 " role="status">
                                                <span class="visually-hidden">Loading...</span> 
                                            </div>Loading data...
                                          </div>
                                      </div>
                                  </div>        
                                  <div class="text-end me-4 mb-4 ">
                                      <button id="btnAdd" class="btn btn-success btn-sm "><i class="bi bi-plus-lg me-2"></i>Create Church</button>                    
                                  </div>
                              </div>    
                          </div>
                  <!-- END OF LEFT COLUMN -->
                  <!-- START OF RIGHT COLUMN -->                          
                  <div class="col-lg-6">
                      <div class="card">
                          <div id="frmAdd" class="card-body" style="display:none">
                          </div>
                      </div>
                      </div>
                      <!-- END OF RIGHT COLUMN -->  
                  </div>
                  <!-- END OF ROW  -->   
                  </div>
                  <div class="tab-pane fade profile-edit pt-3" id="profile-profile">
                    <div class="col-xl-12">
                        <div id="frmEditChurch" class="card">                  
                          <div class="d-flex align-items-center justify-content-center mt-4 ">
                              <div class="spinner-grow spinner-grow-sm me-3 mt-1 mb-3 " role="status">
                                  <span class="visually-hidden">Loading...</span> 
                              </div><span class="mb-3">Loading data...</span>
                          </div>
                        </div> 
                    </div>  
                </div><!-- End Bordered Tabs -->
              </div>
            </div>
          </div>
        </div>
  </section>
</main>

<div class="modal" id="mdSearchDialog" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Search Church</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body " >                
        <div class="row">
          <div class="col-md-5 col-lg-12 mx-auto">
            <div class="input-group">
              <input id="txtSearchChurch" class="form-control border-end-0 border" type="search" placeholder="Search Name" value="" id="example-search-input">
              <span class="input-group-append">
                <button id="iconSearchChurch" class="btn btn-outline-primary rounded-end border " type="button" style="border-top-left-radius: 0px 0px; border-bottom-left-radius: 0px 0px;">
                  <i class="bi bi-search"></i>
                </button>
              </span>
            </div>
          </div>
        </div>       
        <div id="contentSearch" class="" style="height:200px"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg me-2"></i>Cancel</button>
      </div>
    </div>
  </div>
</div><!-- End Modal Dialog Scrollable-->

<script>

var searchLoading = `<div class="mb-4 mt-4 pb-4 d-none" style="height:250px"><div class="d-flex align-items-center justify-content-center mt-4 "><div class="spinner-grow spinner-grow-sm me-3 mt-1 " role="status"><span class="visually-hidden">Loading...</span> </div>Loading data...</div>`;
var loading =`<div class="d-flex align-items-center justify-content-center"><div class="spinner-grow spinner-grow-sm me-3 " role="status"><span class="visually-hidden">Loading...</span> </div>Loading`;                

function browseCurrentChurch(url){
  $("#btnBrowseCurrentChurchJoined").addClass("active");
  $("#btnBrowseCurrentChurchJoined").attr('disabled','disabled');
  $("#spBrowseCurrentChurchJoined_loading").removeClass("bg-warning");
  $("#spBrowseCurrentChurchJoined_loading").removeClass("bg-success");
  $("#spBrowseCurrentChurchJoined_loading").html(loading);
  window.location.href = url;
}

$("#btnSearchChurchDialog").click(function(){
  $("#mdSearchDialog").modal("show");
  searchValue();
});

////SEARCH AREA/////////////////////////////////////////////////////////
function selectChurch(value){
  $("#mdSearchDialog").modal("hide");
  $("#btnSearchChurchDialog").attr("disabled","disabled");
  $("#btnSearchChurchDialog").html(loading);
  window.location.href = "<?=base_url()?>church/" + value;
}

$("#txtSearchChurch").keyup(function(e){ 
    var code = e.key; // recommended to use e.key, it's normalized across devices and languages
    if(code==="Enter") e.preventDefault();
    if(code===" " || code==="Enter" || code===","|| code===";"){
      searchValue($("#txtSearchChurch").val());
    } // missing closing if brace
});

$("#iconSearchChurch").click(function(){
    searchValue($("#txtSearchChurch").val());
});

function searchValue(searchKey){
  $("#contentSearch").html(searchLoading);
  $.ajax({
            url: "<?php echo base_url();?>church/search-church",
            type:"post",
            dataType: "json",
            data:{
                searchKey:searchKey
            },
            success: function(data){
                        if(data.response=="success"){$("#contentSearch").html(data.posts);}
                        else{toastr["error"](data.message);}
                    }
            });

}
////////////////////////////////////////////////////////////////////////
getChurchList();
function getChurchList(){
    $.ajax({
            url: "<?php echo base_url();?>church/get-list",
            type:"post",
            dataType: "json",
            data:{
                action:"get"
            },
            success: function(data){
                        if(data.response=="success")
                            {
                                $("#sprLoading").hide();
                                $("#lstChurch").html(data.posts);
                            }
                        else
                            {
                                toastr["error"](data.message);
                          
                            }
                    }
            });
}

$("#btnAdd").click(function(event) {
    $("#frmAdd").show();
    $("#frmAdd").html(loading);
    $.ajax({
            url: "<?php echo base_url();?>church/create-add-church-form",
            type:"post",
            dataType: "json",
            data:{
                action:"create add form"
                },
            success: function(data){
                        if(data.response=="success")
                            {
                                    $("#frmAdd").empty();
                                    $("#frmAdd").html(data.posts);
                            }
                    }
            });
});

function browseCreatedChurch(object){

  $(object).addClass("active");
  $(object).attr('disabled','disabled');
  $(object).append(`<span class="fluid ms-auto position-absolute end-0 top-0 mt-4 me-3">` + loading + `</span>`);

  $.ajax({url: "<?=base_url()?>church/roles/set-church",type:"post",dataType: "json",
          data:{id:$(object).attr("value")},success: function(data){}});
          window.location.href = "<?=base_url()?>church/roles";

}

$("#btnListSection").click(function(event) 
{
    $("#lstChurch").html(loading);
    getChurchList();
});

$("#btnCloseChurchForm").click(function(event) 
{
    $("#btnCloseChurchForm").addClass("d-none");
    $("#lnkChurchSection").addClass("d-none");
    $("#btnChurchSection").hide();
    $("#btnListSection").trigger("click");
});

toastr.options = {"closeButton": false,"debug": false, "newestOnTop": false,"progressBar": false,"positionClass": "toast-bottom-center","preventDuplicates": false,"onclick": null,"showDuration": "300","hideDuration": "1000","timeOut": "5000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}

//CROPPER INITIALIZATION//

$("#txtUplod_Photo_EditChurch").change(function(evt) { 
  $("#btnUploadPhotoEditChurch").attr("disabled","disabled");
  $("#btnUploadPhotoEditChurch").html("<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span><span class=\'visually-hidden\'>Loading...</span>");
  $("#btnRemovePhotoEditChurch").hide();
  $("#uploadPhotoModal").modal({  backdrop: "static", keyboard: false});
  $("#uploadPhotoModal").modal("show");
});

$("body").on("change", "#txtUplod_Photo_EditChurch", function(e) {

  var files = this.target.files;
  var done = function(url) {        
    $("#dvPhoto_Display_EditChurch").empty();
    $("#dvPhoto_Display_EditChurch").html("<img name=\'imgPhoto_Display_EditChurch\' id=\'imgPhoto_Display_EditChurch\' src=\'" + url + "\' alt=\'Uploaded Picture\'>");
  };
  if (files && files.length > 0) {
      file = files[0];
      if (URL) {
          done(URL.createObjectURL(file));
      } else if (FileReader) {
          reader = new FileReader();
          reader.onload = function(e) {
              done(reader.result);
          };
          reader.readAsDataURL(file);
      }
  }

  var image = document.getElementById("dvPhoto_Display_EditChurch");
  var button = document.getElementById("btnPhoto_Cropper_EditChurch");
  var result = document.getElementById("dvCropped_image_result_Photo_EditChurch");
  var croppable = false;
  var cropper = new Cropper(image, {
      aspectRatio         : 1,
      zoomOnTouch: true,
              zoomOnWheel: true,
              minContainerWidth: 360,
              minContainerHeight: 280,
              minCanvasWidth : 360,
              minCanvasHeight :360,
              minCropBoxWidth: 200,
              minCropBoxHeight: 200,
              maxCropBoxWidth: 200,
              maxCropBoxHeight: 200,
              dragMode: "move",
  ready: function () {
  croppable = true;
  },
  });

  button.onclick = function () {
  var croppedCanvas;
  var roundedCanvas;
  var roundedImage;

  if (!croppable) {return;}
  // Crop
  croppedCanvas = cropper.getCroppedCanvas();
  // Round
  roundedCanvas = getRoundedCanvas(croppedCanvas);
  // Show
  roundedImage = document.createElement("img");
  roundedImage.src = roundedCanvas.toDataURL();  
  result.innerHTML = "";
  result.appendChild(roundedImage);

  upload();

  };

});

//END OF CROPPER INITIALIZATION//
</script>


