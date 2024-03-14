<!-- ROW  -->           
<div class="row mb-3">
    <!-- LEFT COLUMN -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>

                        <div class="row mb-3">
                            <label for="yourRelName" class="col-md-4 col-lg-3 col-form-label">Name</label>
                            <div class="col-md-8 col-lg-9"> 
                                <input id="txtRelName" type="text" name="nickname" class="form-control" id="yourRelName" required value="">
                                <span class="badge bg-danger badge-number float-end"><span id="rel_status">Unlink</span></span>
                                <div id="feedback_rel_name" class="text-danger "></div>
                            </div>   
                        </div>

                        <div class="row mb-3">
                            <label for="yourDateofBirth" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                            <div class="col-md-8 col-lg-9"> 
                            <input id="txtrelDateOfBirth" type="date" name="date_of_birth" class="form-control" id="yourDateofBirth" required value="">
                            </div>   
                        </div>            
            </div>        
        </div>    
    </div>
    <!-- END OF LEFT COLUMN -->
    <!-- START OF RIGHT COLUMN -->                          
    <div class="col-lg-6">

        <div class="card">
            <div class="card-body">
            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>                
            <div class="row mb-3">
                        <label class="col-md-4 col-lg-3 col-form-label">Relationship</label>
                        <div class="col-md-8 col-lg-9">
                            <select id="cboRelRelatives" class="form-select" aria-label="- Select Relationship -">
                            <option value="" selected>- Select Relationship -</option>                            
                            <option value="Siblings">Siblings</option> 
                            <option value="Younger Brother">Younger Brother</option> 
                            <option value="Younger Sister">Younger Sister</option> 
                            <option value="Brother">Brother</option> 
                            <option value="Sister">Sister</option> 
                            <option value="Older Sister">Older Sister</option> 
                            <option value="Older Brother">Older Brother</option> 
                            <option value="Step Younger Sister">Step Younger Sister</option>       
                            <option value="Step Younger Brother">Step Younger Brother</option>         
                            <option value="Step Sister">Step Sister</option>       
                            <option value="Step Brother">Step Brother</option>   
                            <option value="Step Older Sister">Step Older Sister</option>       
                            <option value="Step Older Brother">Step Older Brother</option>                                                                            
                            <option value="Husband">Husband</option>
                            <option value="Wife">Wife</option>
                            <option value="Father">Father</option>
                            <option value="Mother">Mother</option>
                            <option value="Stepfather">Stepfather</option>
                            <option value="Stepmother">Stepmother</option>      
                            <option value="Father-in-Law">Father-in-Law</option>
                            <option value="Mother-in-Law">Mother-in-Law</option>                                                  
                            <option value="Godfather">Goddaughter</option>
                            <option value="Godmother">Godson</option>
                            <option value="Godfather">Godfather</option>
                            <option value="Godmother">Godmother</option>
                            <option value="Grandfather">Grandfather</option>
                            <option value="Grandmother">Grandmother</option>
                            <option value="Children">Children</option>
                            <option value="1st Cousins">Cousins</option>
                            <option value="1st Cousins">1st Cousins</option>
                            <option value="2nd Cousins">2nd Cousins</option>
                            <option value="Nephew">Nephew</option>
                            <option value="Uncle">Uncle</option>
                            <option value="Aunte">Aunte</option>

                            <option value="Son-in-Law">Son-in-Law</option>
                            <option value="Daughter-in-Law">Daughter-in-Law</option>
                            <option value="Legally Adopted">Legally Adopted</option>
                            <option value="Grandson">Grandson</option>
                            <option value="Granddaughter">Granddaughter</option>
                            <option value="Relatives">Relatives</option>
                            </select>
                            <div id="feedback_relative" class="text-danger "></div>    
                        </div>
                        </div>


                        <div class="row mb-3">
                            <label for="yourNickName" class="col-md-4 col-lg-3 col-form-label">Mobile No</label>
                            <div class="col-md-8 col-lg-9"> 
                                <input id="txtRelMobileNo" type="text" name="nickname" class="form-control" id="yourNickName" required value="">
                            </div>   
                        </div>          
                        
                        <div class="text-end">
                        <button id="btnFamilyBackgroundClear" type="submit" class="btn btn-primary"><span class="bi bi-arrow-repeat" style="margin-right:10px"></span>Clear</button>
                        <button id="btnFamilyBackgroundAdd" type="submit" class="btn btn-success"><span class="bi bi-plus-lg" style="margin-right:10px"></span>Add</button>
                    </div>
            </div>
        </div>
    </div>
    <!-- END OF RIGHT COLUMN -->  
</div>
 <!-- END OF ROW  -->     

 <section class="section profile">

        <div class="table-responsive">
            <table id="familyBackgroundTable" class="table table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th></th>
                        <th>Name</th>
                        <th>Birthdate</th>
                        <th>Relationship</th>
                        <th>Contact No</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>

</section>


<script>
var globalUserID;
var datatable;

$(document).on("click","#delete_family", function(e){
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
            url: "<?php echo base_url();?>profile/list-of-family/delete",
            type:"post",
            dataType: "json",
            data:{
                del_id: del_id
            }, success: function(data){

                //console.log(data);
                if(data.response=="success"){
                    swalWithBootstrapButtons.fire('Deleted!','Your record has been deleted.','success');
                }else{
                    swalWithBootstrapButtons.fire('Delete Failed','There is an error from the server.','error');
                }
                //alert(del_id);

                $("#familyBackgroundTable").DataTable().destroy();       
                            reloadFamilyBackground(globalUserID);
                            clearField();
                
            }  
            });

        }else{
            swalWithBootstrapButtons.fire('Cancelled','Your imaginary file is safe :)','error');
        }
         
    });
});

$(document).on("click","#btnFamilyBackgroundAdd", function(e){
   
   $("#btnFamilyBackgroundAdd").html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-right:10px"></span>Loading...`);
   $("#btnFamilyBackgroundAdd").attr("disabled","disabled");
   $("#btnFamilyBackgroundClear").hide();

   $.ajax({
           url: "<?php echo base_url();?>profile/list-of-selected-family/add",
           type:"post",
           dataType: "json",
           data:{
               sel_userID: globalUserID,
               civil_status: $('#cboCivilStatus').find(":selected").val(),
               rel_name: $("#txtRelName").val(),
               relationship: $('#cboRelRelatives').find(":selected").val(),
               rel_birthdate: $("#txtrelDateOfBirth").val(),
               rel_contact_no: $("#txtRelMobileNo").val(),
               rel_status: $("#rel_status").text(),  
               },
           success: function(data){
               console.log(data);

               $("#btnFamilyBackgroundAdd").html(`<span class="bi bi-plus-lg" style="margin-right:10px"></span>Add`);
               $("#btnFamilyBackgroundAdd").removeAttr("disabled");
               $("#btnFamilyBackgroundClear").show();

               if(data.response=="success")
                           {                                
                            $("#familyBackgroundTable").DataTable().destroy();       
                            reloadFamilyBackground(globalUserID);
                            clearField();
                           }
                       else
                           {    
                               if(data.rel_name!=""){
                               $("#txtRelName").focus()
                               $("#feedback_rel_name").text("* "+ data.rel_name);}                                                       
                               if(data.relationship!=""){
                               $("#cboRelRelatives").focus()
                               $("#feedback_relative").text("* "+ data.relationship);}                               
                           }
                   }  
           });

});














$("#btnClossFamilyBackground").click(function() {
  $("#lnkFamilyBackground").hide();
  $("#tabListChurch").trigger("click");
});


    $(document).on("click","#view", function(e){
        $("#familyBackgroundTable").DataTable().destroy();       
        globalUserID = $(this).attr("value");
        $("#lnkFamilyBackground").show();
        $("#tabAddChurch").trigger('click');
        reloadFamilyBackground(globalUserID);
});


function reloadFamilyBackground(){

    $.ajax({
        url:'<?php echo base_url();?>profile/list-of-selected-family',
        type:'post',
        data:{seluserID:globalUserID},
        dataType:'json',
        success: function (data){

            //console.log(data);
            var i = "1";
            datatable  = $("#familyBackgroundTable").DataTable({
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
                    {"render": function( data, type, row, meta ){
                        var a =`<img src="<?php echo base_url()?>${row.profile_photo_path}" height=32 width=32>`;
                        return a; 
                    }},
                    {"data":"rel_name"},
                    {"data":"rel_birthdate"},
                    {"data":"relationship"},
                    {"data":"rel_contact_no"},
                    {"data":"rel_status"},
                    {"render": function( data, type, row, meta ){
                       var a = `
                                <a href="#" value="${row.familyBackgroundID}" id="delete_family" class="btn btn-sm btn-outline-danger"><span class="bi bi-trash"/></a>
                                `;
                       return a; 
                    }}
                ]
            });
                     
             
        }
    });

   

}

function clearField(){
    $("#txtRelName").focus();
    $("#txtRelName").val("");
    $("#txtrelDateOfBirth").val("");
    $("#cboRelRelatives").val("");
    $("#txtRelMobileNo").val(""); 
    $("#feedback_rel_name").text("");
    $("#feedback_relative").text("");
}

    </script>