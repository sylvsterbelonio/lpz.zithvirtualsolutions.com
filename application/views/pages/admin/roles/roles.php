<?php  $churchSelectionBar = $this->RolesFormModel->createSelectionBar();?>


<main id="main" class="main">
  <?=$this->breadcrumb->subBreadcrump('Church','church','Roles') ?>
    <section class="section">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary rounded-top rounded-start rounded-end">
          <div class="container-fluid">
          
            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li id="load-church" class="nav-item text-light"></li>
                <?=$churchSelectionBar?>
              </ul>
              <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>
              </form>
            </div>
          </div>
        </nav>


      <div id="content-menu" class="row g-2 pt-0 mt-0">
          <div class="opacity-25">
            <img src="<?=base_url()?>assets/images/select-church.png" class="img-fluid  mt-4 pt-4 mb-4 pb-4">
          </div>
      </div> 

    </section>       
</main>

<script>

var loading =`<div class="d-flex align-items-center justify-content-center"><div class="spinner-grow spinner-grow-sm me-3 " role="status"><span class="visually-hidden">Loading...</span> </div>Loading`;  
var loadChurch = `<button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm me-2" role="status" aria-hidden="true"></span>Loading...</button>`;
  
get_church();

function get_church(){
  
  $("#load-church").html(loadChurch);
  $("#btnChurchSelector").hide();

  $.ajax({
            url: "<?=base_url()?>church/roles/get-church",
            type:"post",dataType: "json",
            data:{},
            success: function(data){
                $("#load-church").empty();
                $("#content-menu").html(data.post);
                $("#btnChurchSelector").show();
                }
            });
}        

function select_church(id,name){

  $("#load-church").html(loadChurch);
  $("#btnChurchSelector").html( name );
  $("#btnChurchSelector").hide();

  $.ajax({
            url: "<?php echo base_url();?>church/roles/select-church",
            type:"post",dataType: "json",
            data:{id:id,name: name},
            success: function(data){
                $("#load-church").empty();
                $("#content-menu").html(data.post);
                $("#btnChurchSelector").show();
                    }
            });

}

function selectMenu(tab,title,target,url){
  $("#"+tab).parent().removeClass("d-none");
  $("#"+tab).trigger("click");
  openMenu(target,url);
}

function openMenu(target,url){
  var load= `<div class="d-flex align-items-center justify-content-center mt-4 "><div class="spinner-grow spinner-grow-sm me-3 mt-1 mb-3 " role="status"><span class="visually-hidden">Loading...</span> </div><span class="mb-3">Loading data...</span></div>`;
  $("#"+target).html(load);
  $.ajax({url: "<?php echo base_url();?>" + url,type:"post",dataType: "json",data:{action:"get-form"},
  success: function(data){
    /* console.log(data); */
    $("#"+target).html(data.post);}});
}

function closeTab(object){
  $(object).parent().parent().parent().addClass("d-none");
  $("#pills-home-tab").trigger("click");
}

function onTabClick(object){

  $("#pills-tab").find('li').each(function(){
    $(this).find('span').find('i').addClass("d-none");
  });

  $(object).find('span').find('i').removeClass("d-none");
}





</script>