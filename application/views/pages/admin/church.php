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
        <li class="breadcrumb-item active">Church</li>
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
           
              <button id="btnRefresh" class="btn btn-sm btn-outline-primary  float-end"><span class="bi bi-arrow-repeat" style=""></span></Button>
              <button id="btnAdd" class="btn btn-sm btn-success  float-end" style="margin-right:3px" ><span class="bi bi-plus-lg" style=""></span></Button>

              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button id="tabListChurch" class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"><span class="bi bi-view-list" style="margin-right:10px"></span>List of Churces</button>
                </li>
                <li id="lnkAddChurch" class="nav-item" style='display:none'>
                  <button id="tabAddChurch" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-profile"><span class="bi bi-house-door-fill" style="margin-right:10px"></span>Form Details&nbsp;&nbsp;&nbsp;<span id="btnClossChurch" class="class='bi bi-x-lg ms-auto" style="color:red;margin-left:10px"></button>
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
                <th>Church Parent</th>
                <th>Church Name</th>
                <th>Date Founded</th>
                <th>Province</th>
                <th>Municipality/City</th>
                <th>Barangay</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
   
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Church Parent</th>
                <th>Church Name</th>
                <th>Date Founded</th>
                <th>Province</th>
                <th>Municipality/City</th>
                <th>Barangay</th>
                <th>Options</th>
            </tr>
        </tfoot>
    </table>
    </div>

                </div>


            
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>

    </section>

 <!-- Modal Dialog Scrollable -->
              <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Details</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
              <!-- THIS CONTENT -->
              <form id="form" action="" method="post">
              <div class="row mb-3">
                
                      <input id="txtchurchID" type="hidden" name="churchID">

                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea id="txtabout" name="about" class="form-control" style="height: 100px"></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="yourChurchName" class="col-md-4 col-lg-3 col-form-label">Church Name</label>
                      <div class="col-md-8 col-lg-9"> 
                      <input id="txtchurch_name" type="text" name="church_name" class="form-control" id="yourChurchName" required value="">
                      <div id="feedback_church_name" class="text-danger "></div>
                      </div>   
                      
                    </div>

                    <div class="row mb-3">
                      <label for="yourDateFounded" class="col-md-4 col-lg-3 col-form-label">Date Founded</label>
                      <div class="col-md-8 col-lg-9"> 
                      <input id="txtdate_founded" type="date" name="date_founded" class="form-control" id="yourDateFounded" required value="">
                      </div>   
                    </div>  

                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Country</label>
                        <div class="col-md-8 col-lg-9">
                            <select id="cboCountry" class="form-select" aria-label="- Select Country -">
                            <?= $country?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Province</label>
                        <div class="col-md-8 col-lg-9">
                            <select id="cboProvince" class="form-select" aria-label="- Select Province -">
                            <?= $province?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">City/Municipality</label>
                        <div class="col-md-8 col-lg-9">
                            <select id="cboCity" class="form-select" aria-label="- Select Municipality/City -">
                            <?= $city?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Barangay</label>
                        <div class="col-md-8 col-lg-9">
                            <select id="cboBarangay" class="form-select" aria-label="- Select Barangay -">
                            <?= $barangay?>
                            </select>
                        </div>
                    </div>                                        


                    <div class="row mb-3">
                      <label for="yourStreet" class="col-md-4 col-lg-3 col-form-label">Street</label>
                      <div class="col-md-8 col-lg-9"> 
                      <input id="txtstreet" type="text" name="church_name" class="form-control" id="yourStreet" required value="">
                      </div>   
                    </div>


                    <div class="row mb-3">
                      <label for="yourSubdivision" class="col-md-4 col-lg-3 col-form-label">Subdivision</label>
                      <div class="col-md-8 col-lg-9"> 
                      <input id="txtsubdivision" type="text" name="church_name" class="form-control" id="yourSubdivision" required value="">
                      </div>   
                    </div>
                    

                    <div class="row mb-3">
                      <label for="yourHouseBlock" class="col-md-4 col-lg-3 col-form-label">House Block</label>
                      <div class="col-md-8 col-lg-9"> 
                      <input id="txthouseblock" type="text" name="church_name" class="form-control" id="yourHouseBlock" required value="">
                      </div>   
                    </div>       
                    
                    <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Privacy Settings</label>
                        <div class="col-md-8 col-lg-9">
                            <select id="cboPrivacySettings" class="form-select" aria-label="- Select Privacy Settings -">
                            <option value="" selected>- Select Privacy Settings -</option>
                            <option value="Private">Private</option>
                            <option value="Access Link Only">Access Link Only</option>
                            <option value="Public">Public</option>
                            </select>
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

fetch();

function fetch(){
    $.ajax({
        url:'<?php echo base_url();?>church/list',
        type:'post',
        dataType:'json',
        success: function (data){
            //console.log(data);
            var i = "1";
            $("#example").DataTable({
                "data": data.posts,
                "responsive":true,
                dom: 
                "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    {extend:'copy'},{extend:'excel'},
                    {extend: "pdfHtml5",orientation: 'landscape',pageSize: 'LEGAL'},
                    {
                    extend: "print",
                        customize: function(win){
                            var last = null; var current = null; var bod = [];        
                            var css = '@page { size: landscape; }',head = win.document.head || win.document.getElementsByTagName('head')[0],style = win.document.createElement('style');           
                            style.type = 'text/css';style.media = 'print';            
                            if (style.styleSheet){style.styleSheet.cssText = css;}
                            else{style.appendChild(win.document.createTextNode(css));}
                            head.appendChild(style);}         
                    },                                                      
                ],
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                "columns": [
                    {"render": function(){
                        return a = i++;
                    }},
                    {"data":"church_parent"},
                    {"data":"church_name"},
                    {"data":"date_founded"},
                    {"data":"province"},
                    {"data":"city"},
                    {"data":"barangay"},
                    {"render": function( data, type, row, meta ){
                       var a = `
                                <a href="#" value="${row.churchID}" id="del" class="btn btn-sm btn-outline-danger"><span class="bi bi-trash"/></a>
                                <a href="#" value="${row.churchID}" id="edit" class="btn btn-sm btn-outline-primary"><span class="bi bi-pencil-square"/></a>
                                <a href="#" value="${row.churchID}" id="view" class="btn btn-sm btn-outline-secondary"><span class="bi bi-gear"/></a>
                                `;
                       return a; 
                    }}
                ]
            });
        }
    });
}

$(document).on("click","#btnPositive", function(e){
    $.ajax({
            url: "<?php echo base_url();?>church/add",
            type:"post",
            dataType: "json",
            data:{
                about: $("#txtabout").val(),
                church_name: $("#txtchurch_name").val(),
                date_founded: $("#txtdate_founded").val(),     
                country: $('#cboCountry').find(":selected").val(),
                province: $('#cboProvince').find(":selected").val(),
                city: $('#cboCity').find(":selected").val(),
                barangay: $('#cboBarangay').find(":selected").val(),
                street: $("#txtstreet").val(),  
                subdivision: $("#txtsubdivision").val(),  
                house_block: $("#txthouseblock").val(),  
                privacy_settings: $('#cboPrivacySettings').find(":selected").val()
                },
            success: function(data){
                //console.log(data);
                        if(data.response=="success")
                            {
                            toastr["success"](data.message);
                            $("#example").DataTable().destroy();
                            fetch();
                            }
                        else
                            {
                            toastr["error"](data.message);
                            }
                    $("#form")[0].reset();
                    $("#modalDialogScrollable").modal('hide');
                    }
            });
        });


$(document).on("click","#btnUpdate", function(e){
    $.ajax({
            url: "<?php echo base_url();?>church/update",
            type:"post",
            dataType: "json",
            data:{
                churchID:$("#txtchurchID").val(),
                about: $("#txtabout").val(),
                church_name: $("#txtchurch_name").val(),
                date_founded: $("#txtdate_founded").val(),     
                country: $('#cboCountry').find(":selected").val(),
                province: $('#cboProvince').find(":selected").val(),
                city: $('#cboCity').find(":selected").val(),
                barangay: $('#cboBarangay').find(":selected").val(),
                street: $("#txtstreet").val(),  
                subdivision: $("#txtsubdivision").val(),  
                house_block: $("#txthouseblock").val(),  
                privacy_settings: $('#cboPrivacySettings').find(":selected").val()
                },
            success: function(data){
                console.log(data);
                        if(data.response=="success")
                            {
                            toastr["success"](data.message);
                            $("#example").DataTable().destroy();
                            fetch();
                            }
                        else
                            {
                            toastr["error"](data.message);
                            }
                    $("#form")[0].reset();
                    $("#modalDialogScrollable").modal('hide');
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
                url: "<?php echo base_url();?>church/delete",
                type:"post",
                dataType: "json",
                data:{
                    del_id: del_id
                }, success: function(data){

                    $("#example").DataTable().destroy();
                    fetch();

                    //console.log(data);
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

    e.preventDefault();

    var edit_id = $(this).attr("value");
    $.ajax({
        url: "<?php echo base_url();?>church/edit",
        type: "post", dataType: "json",
        data:{edit_id: edit_id}, 
        success: function(data){
            console.log(data);
            if(data.response=="success"){
                $("#txtchurchID").val(data.post.churchID);
                $("#txtabout").val(data.post.about);
                $("#txtchurch_name").val(data.post.church_name);
                $("#txtdate_founded").val(data.post.date_founded);
                var html = `<option value="" selected>- Select Country -</option>
                            <option value="`+ data.post.country +`" selected>`+data.post.country+`</option>`;
                $("#cboCountry").html(html);  
                html = `<option value="" selected>- Select Province -</option><option value="`+ data.post.province +`" selected>`+data.post.province+`</option>`;
                $("#cboProvince").html(html);  
                html = `<option value="" selected>- Select Municipality/City -</option><option value="`+ data.post.city +`" selected>`+data.post.city+`</option>`;
                $("#cboCity").html(html);  
                html = `<option value="" selected>- Select Municipality/City -</option><option value="`+ data.post.barangay +`" selected>`+data.post.barangay+`</option>`;
                $("#cboBarangay").html(html);  
                $("#txtstreet").val(data.post.street);
                $("#txtsubdivision").val(data.post.subdivision);
                $("#txthouseblock").val(data.post.house_block);
                $("#cboPrivacySettings").val(data.post.privacy_settings);
            }
        }
    });
});

$('#cboCountry').on('change', function() {
if($('#cboCountry').find(":selected").val()==""){
    $.ajax({
        url: '<?php echo base_url();?>church/spatial',
        type: "post", dataType: "json",
        data:{search_value: $('#cboCountry').find(":selected").val(), type:'fetch-country'}, 
        success: function(data){
            console.log(data);
            if(data.response=="success"){
                $("#cboCountry").html(data.html);   
            }
        }
    });
}else{
    $.ajax({
        url: '<?php echo base_url();?>church/spatial',
        type: "post", dataType: "json",
        data:{search_value: $('#cboCountry').find(":selected").val(), type:'fetch-province'}, 
        success: function(data){
            console.log(data);
            if(data.response=="success"){
                $("#cboProvince").html(data.html);   
                $("#cboCity").val('- Select City/Municipality -');
                $("#cboBarangay").val('- Select Barangay -');
            }
        }
    });
}
});       

$('#cboProvince').on('change', function() {
        $.ajax({
        url: '<?php echo base_url();?>church/spatial',
        type: "post", dataType: "json",
        data:{search_value: $('#cboProvince').find(":selected").val(), type:'fetch-city'}, 
        success: function(data){
            console.log(data);
            if(data.response=="success"){
                $("#cboCity").html(data.html);   
                $("#cboBarangay").val(1);
            }
        }
    });

});

$('#cboCity').on('change', function() {
  $.ajax({
        url: '<?php echo base_url();?>church/spatial',
        type: "post", dataType: "json",
        data:{search_value: $('#cboCity').find(":selected").val(), type:'fetch-barangay'}, 
        success: function(data){
            console.log(data);
            if(data.response=="success"){
                $("#cboBarangay").html(data.html);   
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

