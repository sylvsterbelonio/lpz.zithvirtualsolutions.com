<script differ type="text/javascript" src="<?= base_url();?>assets/js/jquery-3.5.1.js"></script>
<script differ type="text/javascript" src="<?= base_url();?>assets/js/jquery.dataTables.min.js"></script> 
<script differ type="text/javascript" src="<?= base_url();?>assets/js/dataTables.bootstrap5.min.js"></script> 
<script differ type="text/javascript" src="<?= base_url();?>assets/js/toastr.min.js"></script> 
<script differ type="text/javascript" src="<?= base_url();?>assets/js/jszip.min.js"></script>
<script differ type="text/javascript" src="<?= base_url();?>assets/js/pdfmake.min.js"></script>
<script differ type="text/javascript" src="<?= base_url();?>assets/js/vfs_fonts.js"></script>
<script differ type="text/javascript" src="<?= base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script differ type="text/javascript" src="<?= base_url();?>assets/js/dataTables.bootstrap5.min.js"></script>
<script differ type="text/javascript" src="<?= base_url();?>assets/js/dataTables.buttons.min.js"></script>
<script differ type="text/javascript" src="<?= base_url();?>assets/js/buttons.bootstrap5.min.js"></script>
<script differ type="text/javascript" src="<?= base_url();?>assets/js/buttons.html5.min.js"></script>
<script differ type="text/javascript" src="<?= base_url();?>assets/js/buttons.print.min.js"></script>
<script differ type="text/javascript" src="<?= base_url();?>assets/js/dataTables.responsive.min.js"></script>
<script differ type="text/javascript" src="<?= base_url();?>assets/js/responsive.bootstrap5.js"></script>
<script differ type="text/javascript" src="<?= base_url();?>assets/js/sweetalert2@11.js"></script>    


<main id="main" class="main">

  <!-- Page Title -->
  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
        <li class="breadcrumb-item active">System Access</li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->

  <!-- Section -->
  <section class="section profile">

    <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Tab Title -->   
              <button id="btnAdd" class="btn btn-sm btn-success  float-end" style="margin-right:3px" ><span class="bi bi-plus-lg" style=""></span></Button>

              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button id="tabListChurch" class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"><span class="bi bi-view-list" style="margin-right:10px"></span>List of Access Names</button>
                </li>
                <li id="lnkSystemAccessSettings" class="nav-item" style='display:nne'>
                  <button id="tabSystemAccessSettings" class="nav-link" data-bs-toggle="tab" data-bs-target="#settings"><span class="bi bi-gear" style="margin-right:10px"></span><span id="tab-header" style="margin-right:10px">Form Details</span><span id="btnClossChurch" class="class='bi bi-x ms-auto"></button>
                </li>
              </ul>
              <!-- End of Tab Title -->
            <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">   
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Access Name</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="settings">

              

<!-- sadasddddddddddddddddddddddddddddddddddddddddddddddd-->


<div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">

              <h5 class="card-title">Default</h5>

                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Access Name</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                    
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>




            </div>
          </div>    

        </div>

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Default Solid Color</h5>

              asdads

            </div>
          </div>

          
        </div>
      </div>


<! -- sada sda sdaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa -->
               
                    



                </div>
         
              
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>

    </section>

 <!-- Modal Dialog Scrollable -->
              <div class="modal" id="modalDialogScrollable" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Details</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
              <!-- THIS CONTENT -->
              <form id="form" action="" method="post">

                    <input id="txtaccessLevelID" type="hidden" name="userID" class="form-control" id="yourFirstName" required value=""></input>
               
                    <div class="row mb-3">
                        <label for="yourAccessLevelName" class="col-md-4 col-lg-3 col-form-label">Access Level Name</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtaccessLevelName" type="text" name="accessLevelName" class="form-control" id="yourAccessLevelName" required value="">
                            <div id="feedback_accessLevelName" class="text-danger "></div>
                        </div>   
                    </div>

                    <div class="row mb-3">
                        <label for="yourPosition" class="col-md-4 col-lg-3 col-form-label">Position</label>
                        <div class="col-md-8 col-lg-9"> 
                            <input id="txtposition" type="number" name="position" class="form-control" id="yourPosition" required value="">
                            <div id="feedback_position" class="text-danger "></div>
                        </div>   
                    </div>
            
                </form>
              <!-- END OF CONTENT -->                  
                    </div>
                    <div class="modal-footer">
                      <button id="btnNegative" type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="bi bi-x-lg" style="margin-right:10px"></span>Cancel</button>
                      <button id="btnPositive" type="button" class="btn btn-success" data-bs-dismiss=""><span class="bi bi-plus-lg" style="margin-right:10px"></span>Add</button>
                      <button id="btnUpdate" style="display:none" type="button" class="btn btn-primary" data-bs-dismiss=""><span class="bi bi-save" style="margin-right:10px"></span>Update</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Modal Dialog Scrollable-->
    
  </main><!-- End #main -->

<script>

$(document).on("click","#settings", function(e){

e.preventDefault();

$("#lnkSystemAccessSettings").show();
$("#tabSystemAccessSettings").trigger('click');

var edit_id = $(this).attr("value");

$.ajax({
    url: "<?php echo base_url();?>system-access/edit",
    type: "post", dataType: "json",
    data:{edit_id: edit_id}, 
    success: function(data){
        console.log(data);
        if(data.response=="success"){
            $("#txtaccessLevelID").val(data.posts.accessLevelID);
            $("#txtaccessLevelName").val(data.posts.accessLevelName);
            $("#txtposition").val(data.posts.position);
        }
    }
});

});




fetch();

function fetch(){
    $.ajax({url:'<?php echo base_url();?>system-access/list',
        type:'post',dataType:'json',
        success: function (data){var i = "1";
            $("#example").DataTable({
                "data": data.posts,"responsive":true,
                dom: 
                "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    {extend:'copy'},{extend:'excel'},
                    {extend: "pdfHtml5",orientation: 'landscape',pageSize: 'LEGAL'},
                    {extend: "print",customize: function(win){var last = null; var current = null; var bod = [];        
                            var css = '@page { size: landscape; }',head = win.document.head || win.document.getElementsByTagName('head')[0],style = win.document.createElement('style');           
                            style.type = 'text/css';style.media = 'print';if (style.styleSheet){style.styleSheet.cssText = css;}else{style.appendChild(win.document.createTextNode(css));}head.appendChild(style);}},                                                      
                ],columnDefs: [{"defaultContent": "-","targets": "_all"}],
                "columns": [
                    {"render": function(){
                        return a = i++;
                    }},
                    {"data":"accessLevelName"},
                    {"render": function( data, type, row, meta ){
                       var a = `
                                <a href="#" value="${row.accessLevelID}" id="del" class="btn btn-sm btn-outline-danger"><span class="bi bi-trash"/></a>
                                <a href="#" value="${row.accessLevelID}" id="edit" class="btn btn-sm btn-outline-primary"><span class="bi bi-pencil-square"/></a>
                                <a href="#" value="${row.accessLevelID}" id="view" class="btn btn-sm btn-outline-secondary"><span class="bi bi-gear"/></a>
                                `;
                       return a; 
                    }}]});}});
}

$("#txtaccessLevelName,#txtposition").keyup(function(){
    $(this).next("div.text-danger").text("");
});


$(document).on("click","#btnPositive", function(e){

    $("#btnPositive").html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-right:10px"></span>Loading...`);
    $("#btnPositive").attr("disabled","disabled");
    $("#btnNegative").hide(); 
    $("#txtpassword").show();           


    $("#btnUpdate").html(`<span class="bi bi-save" style="margin-right:10px"></span>Update`);
    $("#btnUpdate").removeAttr("disabled");
    $("#btnNegative").show();

    $.ajax({
            url: "<?php echo base_url();?>system-access/add",
            type:"post",
            dataType: "json",
            data:{
                accessLevelName: $("#txtaccessLevelName").val(),
                position: $("#txtposition").val()
                },
            success: function(data){
                console.log(data);

                $("#btnPositive").html(`<span class="bi bi-plus-lg" style="margin-right:10px"></span>Add`);
                $("#btnPositive").removeAttr("disabled");
                $("#btnNegative").show();  

                if(data.response=="success")
                            {                                
                            toastr["success"](data.message);
                            $("#example").DataTable().destroy();
                            fetch();
                            $("#form")[0].reset();
                            $("#modalDialogScrollable").modal('hide');                          
                            }
                        else
                            {     
                                if(data.position!=""){
                                $("#txtposition").focus()
                                $("#feedback_position").text("* "+ data.position);}

                                if(data.accessLevelName!=""){
                                $("#txtaccessLevelName").focus()
                                $("#feedback_accessLevelName").text("* "+ data.accessLevelName);}
                               
                            }
                    }  
            });
        });


$(document).on("click","#btnUpdate", function(e){

    $("#btnUpdate").html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-right:10px"></span>Loading...`);
    $("#btnUpdate").attr("disabled","disabled");
    $("#btnNegative").hide();                                            

    $.ajax({
            url: "<?php echo base_url();?>system-access/update",
            type:"post",
            dataType: "json",
            data:{
                accessLevelID:$("#txtaccessLevelID").val(),
                accessLevelName: $("#txtaccessLevelName").val(),
                position: $("#txtposition").val(),
                },
            success: function(data){
                console.log(data);

                $("#btnUpdate").html(`<span class="bi bi-save" style="margin-right:10px"></span>Update`);
                $("#btnUpdate").removeAttr("disabled");
                $("#btnNegative").show();

                        if(data.response=="success")
                            {
                            toastr["success"](data.message);
                            $("#example").DataTable().destroy();
                            fetch();
                            $("#form")[0].reset();
                            $("#modalDialogScrollable").modal('hide');
                            }
                        else
                            {
                                if(data.position!=""){
                                $("#txtposition").focus()
                                $("#feedback_position").text("* "+ data.position);}

                                if(data.accessLevelName!=""){
                                $("#txtaccessLevelName").focus()
                                $("#feedback_accessLevelName").text("* "+ data.accessLevelName);}
                            }
                    }
            });
        });

$(document).on("click","#del", function(e){

    e.preventDefault();
       const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger me-3'
        },
        buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '<span class="bi bi-person me-8" ></spa>Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {

            if(result.value){

                var del_id = $(this).attr("value");
                $.ajax({
                url: "<?php echo base_url();?>system-access/delete",
                type:"post",
                dataType: "json",
                data:{
                    del_id: del_id
                }, success: function(data){
                    
                    $("#example").DataTable().destroy();
                    fetch();

                    console.log(data);
                    if(data.response=="success"){
                        swalWithBootstrapButtons.fire('Deleted!','Your record has been deleted.','success');
                    }else{
                        swalWithBootstrapButtons.fire('Delete Failed','There is an error from the server.','error');
                    }
                    //alert(del_id);
                }  
                });

            }else{
                swalWithBootstrapButtons.fire('Cancelled','Your imaginary file is safe :)','error');
            }
             
        });
});

$(document).on("click","#edit", function(e){
    $("#btnPositive").hide();
    $("#btnUpdate").show();
    $("#modalDialogScrollable").modal('show');
    $("#txtpassword").hide(); 
    $('input[type=text]').next("div.text-danger").text("");
    e.preventDefault();

    $("#btnUpdate").html(`<span class="bi bi-save" style="margin-right:10px"></span>Update`);
    $("#btnUpdate").removeAttr("disabled");
    $("#btnNegative").show();

    var edit_id = $(this).attr("value");

    $.ajax({
        url: "<?php echo base_url();?>system-access/edit",
        type: "post", dataType: "json",
        data:{edit_id: edit_id}, 
        success: function(data){
            console.log(data);
            if(data.response=="success"){
                $("#txtaccessLevelID").val(data.posts.accessLevelID);
                $("#txtaccessLevelName").val(data.posts.accessLevelName);
                $("#txtposition").val(data.posts.position);
            }
        }
    });
});

$("#btnAdd").click(function() {
  $("#form")[0].reset();
  $("#btnPositive").show();
  $("#btnUpdate").hide();
  $("#modalDialogScrollable").modal('show');
});

$("#btnClossChurch").click(function() {
  $("#lnkAddChurch").hide();
  $("#tabListChurch").trigger("click");
});


toastr.options = {"closeButton": false,"debug": false, "newestOnTop": false,"progressBar": false,"positionClass": "toast-bottom-center","preventDuplicates": false,"onclick": null,"showDuration": "300","hideDuration": "1000","timeOut": "5000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}

</script>

