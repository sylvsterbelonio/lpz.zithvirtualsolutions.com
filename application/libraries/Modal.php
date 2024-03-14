<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modal {

    function __construct(){
        $this->CI = & get_instance();
    }

    public function swal_confirm_modal($key){
        $prop = $this->CI->ParameterModel->getGroupParameter('swal-modal-delete');

        return $this->wrapper('
        <button id="swal_response_'.$key.'" class="d-none"></button>
        <script>
        var sel_id;
        function swal_modal_confirm_'.$key.'(id){
            sel_id = id;
            $("#swal_response_'.$key.'").text(id);

                    const swalWithBootstrapButtons_'.$key.' = Swal.mixin({
                        customClass: {
                            confirmButton: "'.$prop['confirmButton'].'",
                            cancelButton: "'.$prop['cancelButton'].'"
                        },
                        buttonsStyling: false
                        });
                    swalWithBootstrapButtons_'.$key.'.fire({
                        title: "'.$prop['title'].'",
                        text: "'.$prop['text'].'",
                        icon: "'.$prop['icon'].'",
                        showCancelButton: true,
                        confirmButtonText: "'.$prop['confirmButtonText'].'",
                        cancelButtonText: "'.$prop['cancelButtonText'].'",
                        reverseButtons: true
                        }).then((result) => {
                            if(result.value){

                                $("#swal_response_'.$key.'").trigger("click");
                            }
                        });
        }
        $("#swal_response_'.$key.'").click(function(){/* Do */});
        </script>    
        ');

    }

    public function toolbar_modal_notification(){
        return $this->wrapper('
        <!-- Notification Modal -->
        <div class="modal" id="notification_dialog" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body" id="notification_dialog_content">
                        </div>
                        <div class="modal-footer">
                            <button id="btnNotificationRead" type="button" class="btn btn-primary" data-bs-dismiss="modal">Read</button>
                            <button id="btnNotificationAccept" type="button" class="btn btn-primary" data-bs-dismiss="modal">Accept</button>
                            <button id="btnNotificationDecline" type="button" class="btn btn-danger" data-bs-dismiss="modal">Decline</button>
                        </div>
                </div>
            </div>
        </div>
        <!-- End Notification Modal-->
        ');
    }

    public function large_modal_scrollable($id,$title,$content,$type){

        $button = $this->CI->ParameterModel->getGroupParameter('button');

        if($type=="close")
            {
                $data = '
                <div class="modal" id="'.$id.'" tabindex="-1">
                <div class="modal-dialog modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">'.$title.'</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body p-4">
                          '.$content.'
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">'.$button['close'].'</button>
                      </div>
                    </div>
                </div>
              </div>
                ';

               return $this->wrapper($data);
            }

    }

    public function searchModalDialog($key,$value){
        //txt-Key - search text
        //btn-key - button search
        //div-key - content
        return '
            <div class="modal" id="md'.$key.'" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">'.$value.'</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body " >                
                        <div class="row">
                        <div class="col-md-5 col-lg-12 mx-auto">
                            <div class="input-group">
                            <input id="txt'.$key.'" class="form-control border-end-0 border" type="search" placeholder="Search Name" value="" id="example-search-input">
                            <span class="input-group-append">
                                <button id="btn'.$key.'" class="btn btn-outline-primary rounded-end border " type="button" style="border-top-left-radius: 0px 0px; border-bottom-left-radius: 0px 0px;">
                                <i class="bi bi-search"></i>
                                </button>
                            </span>
                            </div>
                        </div>
                        </div>       
                        <div id="div'.$key.'" class="" style="height:200px"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg me-2"></i>Cancel</button>
                    </div>
                    </div>
                </div>
            </div><!-- End Modal Dialog Scrollable-->
        ';
    }

    private function wrapper($data){
        return $this->CI->ParameterModel->singleLine($data,"on");
    }

}