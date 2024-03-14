var errorMsg = "There is an error occured.";
var divLoading = `<div class="col-lg-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center mt-4 ">
                            <div class="spinner-grow spinner-grow-sm me-3 mt-1 " role="status">
                            <span class="visually-hidden">Loading...</span> 
                            </div>Loading data...
                        </div>
                    </div>
                   </div>`;
var divEmpty = `
                <div class="col-lg-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center mt-4 ">
                            <i class="ri-alert-fill me-2"></i>No Data Found...
                        </div>
                    </div>
                   </div>
                `;                   

function set_success_alert(data){
    toastr.options = {"closeButton": false,"debug": false, "newestOnTop": false,"progressBar": false,"positionClass": "toast-bottom-center","preventDuplicates": false,"onclick": null,"showDuration": "300","hideDuration": "1000","timeOut": "5000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}
    toastr["success"](data);
}

function set_error_alert(){
    toastr.options = {"closeButton": false,"debug": false, "newestOnTop": false,"progressBar": false,"positionClass": "toast-bottom-center","preventDuplicates": false,"onclick": null,"showDuration": "300","hideDuration": "1000","timeOut": "5000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}
    toastr["error"](errorMsg);
}

function set_error_alert_msg(data){
    toastr.options = {"closeButton": false,"debug": false, "newestOnTop": false,"progressBar": false,"positionClass": "toast-bottom-center","preventDuplicates": false,"onclick": null,"showDuration": "300","hideDuration": "1000","timeOut": "5000","extendedTimeOut": "1000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}
    toastr["error"](data);
}

function set_spin_div(data){
    $(data).html(divLoading);
}

function set_empty_div(data){
    $(data).html(divEmpty);
}

function set_delete_confirm(object){
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-outline-secondary me-3"
        },
        buttonsStyling: false
        });
    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won\'t be able to revert this!",
        icon: "error",
        showCancelButton: true,
        confirmButtonText: "<span class=\'bi bi-trash me-2\' ></span>Yes, delete it!",
        cancelButtonText: "<span class=\'bi bi-x-lg me-2\' ></span>Cancel",
        reverseButtons: true
        }).then((result) => {
            if(result.value){
                object.trigger("click");
            }
        });
}








function set_spin_button(button,defaultValue,mode){
    var load = "<span class=\'spinner-border spinner-border-sm\' role=\'status\' aria-hidden=\'true\'></span><span class=\'visually-hidden me-2\'>Loading...</span><span class=\'ms-2\'>" + $(button).text() + "</span>";
    if(mode){
        $(button).attr("disabled","disabled");
        $(button).html(load);
    }else{
        $(button).removeAttr("disabled");
        $(button).html(defaultValue);
    }   
}    

function set_form_disabled(mode){
    if(mode){
        $("input[type=text], textarea, select").attr("disabled","disabled");
    }else{
        $("input[type=text], textarea, select").removeAttr("disabled");
    }
}

function set_form_clear(){
        $("input[type=text], textarea, select").val("");
        $(".feedback-response").addClass("d-none");
}

function set_validatino_error_clear(){
    $(".feedback-response").addClass("d-none");
    $(".feedback-response").text("");
}
// set_validation_error(\''.$input['relName'].'\',data.rel_name,"txt");

function set_validation_error(fieldName,feedback,pre){
    if(feedback!="")
    {
    set_feedback($("#feedback_" + fieldName),feedback);
    $("#"+pre+fieldName).focus();
    $("#"+pre+fieldName).addClass("error-input-border");
    
    }
}

function set_feedback(parent,value){
        $(parent).removeClass('d-none');
        $(parent).html("<i class=\'ri-alert-line me-2\'></i>" + value);
}


