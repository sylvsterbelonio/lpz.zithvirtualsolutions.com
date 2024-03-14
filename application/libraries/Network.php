<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Network {

    function __construct(){
        $this->CI = & get_instance();
    }

    public function getDisciples($checker,$source){
        $button = $this->CI->ParameterModel->getGroupParameter('button');
        $modal = $this->CI->ParameterModel->getGroupParameter('modal');
        $input = $this->CI->ParameterModel->getGroupParameter('input-network');
        $width = $this->CI->ParameterModel->getGroupParameter('col-width');



        return $this->wrapper('
        
        <div class="p-3 ">
        <div id="network-content" class="row g-2">

            
            '.
            $this->disciple_form($checker,$source)
            .'

            <div class="col-lg-6">
            <div class="card mb-1">
                <div id="div-list-of-members" class="card-body p-0">
                    
                </div>
            </div>
        </div>


        </div>
        </div>
        

        <div class="modal" id="networkCreateModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Create Network Name</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form id="frmCreateNetwork">
                            '.
                            $this->CI->field->input_text_profile($input['key-networkName'],$input['networkName'],"",$width['label'],$width['div-input'])
                            .' 
                            '.
                            $this->CI->field->input_textarea_profile($input['key-networkAbout'],$input['networkAbout'],"",$width['label'],$width['div-input'])
                            .' 
                            '.
                            $this->CI->field->input_textarea_profile($input['key-networkDescription'],$input['networkDescription'],"",$width['label'],$width['div-input'])
                            .' 
                            '.
                            $this->CI->field->input_select_profile($input['key-networkMode'],$input['networkMode'],$this->CI->ParameterModel->getDefaultParameterList('Mode of Invitation','Invite Only'),$width['label'],$width['div-input'])
                            .' 
                            '.
                            $this->CI->field->input_select_profile($input['key-networkPrivacy'],$input['networkPrivacy'],$this->CI->ParameterModel->getDefaultParameterList('Privacy Settings','Ministry'),$width['label'],$width['div-input'])
                            .' 
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button id="btnCreateModalNetwork" type="button" class="btn btn-success">'.$button['create'].'</button>
                    </div>
                  </div>
                </div>
        </div><!-- End Modal Dialog Scrollable-->

        '.
        $this->CI->modal->searchModalDialog($modal['key-searchDialog'],$modal['searchDialog'])
        .'
        
        <script>

        $("#btnCreateModalNetwork").click(function(){
            networkRecord();
        });

        $("#btnCreateNetwork").click(function(){
            set_spin_button($("#btnCreateModalNetwork"),"'.$button['create'].'",false);
            set_form_disabled(false);
            set_form_clear();
            $("#networkCreateModal").modal("show");  
        });

        function networkRecord(){
            
            set_spin_button($("#btnUpdateNetwork"),"",true);
            set_spin_button($("#btnCreateModalNetwork"),"",true);
            set_form_disabled(true);

            $.ajax({
                url: "'. base_url() . 'church/network/disciples/create",
                type:"post",dataType: "json",
                data:{
                    networkName:$("#txtnetworkName").val(),
                    networkAbout:$("#txtnetworkAbout").val(),
                    networkDescription:$("#txtnetworkDescription").val(),
                    networkMode: $("#cbonetworkMode").find(":selected").val(),
                    networkPrivacy:$("#cbonetworkPrivacy").find(":selected").val(),
                },
                success: function(data)
                    {
                    /* console.log(data); */

                    set_spin_button($("#btnUpdateNetwork"),"'.$button['update-network'].'",false);

                    set_spin_button($("#btnCreateModalNetwork"),"'.$button['create'].'",false);
                    set_form_disabled(false);
                    
                        if(data.response=="success")
                            {
                            set_success_alert(data.message);
                            $("#networkCreateModal").modal("hide"); 
                            $("#network-content").html(data.post);
                            set_alert(data.message,"success");
                            }
                        else
                            {
                            set_error_alert();
                            set_validation_error("networkName",data.networkName,"txt");
                            set_validation_error("networkMode",data.networkMode,"cbo");
                            set_validation_error("networkPrivacy",data.networkPrivacy,"cbo");
                            }        
                    }
                });    
        }


        function deleteRecord(){
            $.ajax({
                url: "'. base_url() . 'church/network/disciples/delete",
                type:"post",dataType: "json",
                data:{
                    action:"delete",
                },
                success: function(data)
                    {
                    console.log(data);
                    $("#div-list-of-members").html("");
                    set_success_alert(data.message);
                    $("#network-content").html(data.post);
                    }
                });    
        }

        $("#btnDeleteNetwork").click(function(){
          set_delete_confirm($("#deleteRecord"));
        });
        $("#deleteRecord").click(function(){
            deleteRecord();
        });

        $("#btnUpdateNetwork").click(function(){
            networkRecord();
        });

        $("#btnAddMemberNetwork").click(function(){
            $("#md'.$modal['key-searchDialog'].'").modal("show");
            searchValue();
        });

        $("#txt'.$modal['key-searchDialog'].'").keyup(function(e){ 
            var code = e.key; 
            if(code==="Enter") e.preventDefault();
            if(code===" " || code==="Enter" || code===","|| code===";"){
              searchValue($("#txt'.$modal['key-searchDialog'].'").val());
            } 
        });
        
        $("#btn'.$modal['key-searchDialog'].'").click(function(){
            searchValue($("#txt'.$modal['key-searchDialog'].'").val());
        });

        function searchValue(){

            set_spin_div($("#div'.$modal['key-searchDialog'].'"));
            
            $.ajax({
                url: "'. base_url() . 'church/network/disciple/search",
                type:"post",dataType: "json",
                data:{
                    name:$("#txt'.$modal['key-searchDialog'].'").val(),
                },
                success: function(data)
                    {
                        if(data.response=="success"){
                            if(data.count=="0")
                            set_empty_div($("#div'.$modal['key-searchDialog'].'"));
                            else
                            $("#div'.$modal['key-searchDialog'].'").html(data.post);                       
                        }

                    }
                });   
        }

        function selectMember(id)
        {
            $.ajax({
                url: "'. base_url() . 'church/network/disciple/add/member",
                type:"post",dataType: "json",
                data:{
                    id:id,
                    action:"add",
                },
                success: function(data)
                    {
                        if(data.response=="success"){
                            loadMembers();                        
                        }
                        else{
                            set_error_alert_msg(data.message);
                        }
                        $("#md'.$modal['key-searchDialog'].'").modal("hide");
                    }
                });   
        }

        loadMembers();
        function loadMembers(){
            $.ajax({
                url: "'. base_url() . 'church/network/disciple/load/members",
                type:"post",dataType: "json",
                data:{
                    id:"",
                },
                success: function(data)
                    {
                        console.log(data);
                        if(data.response=="success"){
                             $("#div-list-of-members").html(data.post);                   
                        }

                    }
                });   
        }

        var delMember=0;
        function deleteMember(id){
            delMember=id;
            set_delete_confirm($("#deleteMember"));
        }

        $("#deleteMember").click(function(){
            $.ajax({
                url: "'. base_url() . 'church/network/disciple/add/member",
                type:"post",dataType: "json",
                data:{
                    id:delMember,
                    action:"remove",
                },
                success: function(data)
                    {
                        if(data.response=="success"){
                            loadMembers();                        
                        }
                        $("#md'.$modal['key-searchDialog'].'").modal("hide");
                    }
                });   
        });

        </script>
        
        ');
    }

    public function get_network_members($query){
        $html='<div class="p-4">
        <h5 align=center>List of 12 Disciples</h5>';

        if(count($query->result())>1){
            foreach($query->result_array() as $row)
            {
                            
                if($row['userID']!=$_SESSION['userID']){
                    $html.='

                        <div class="card mb-1">
                            <div class="card-body p-0">
                                <div class="d-flex bd-highlight">
                                    <div class="p-2 bd-highlight">
                                        <img class="rounded mx-auto d-block" src="'.base_url($row['profile_photo_path']).'" style="width:100%;max-height:100px;max-width:100px;min-width:110px">
                                    </div>
                                    <div class="p-2 bd-highlight ">
                                        <div class="d-flex flex-column-reverse bd-highlight mt-4">

                                                                        
                                        <div class="bd-highlight">
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                                <option>Open this select menu</option>
                                                <option value="1" >Primary Leader</option>
                                                <option value="2" selected>Disciple</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    
                                    
                                            <div class="bd-highlight"><b>'.$row['first_name'].' ' . $row['middle_name'] . ' ' . $row['last_name']  .'</b></div>
                                                                                                                    
                                        </div>    
                                    </div>
                                
                                    <div class="ms-auto p-2 mt-2 bd-highlight">
                                        <div class="filter mt-4 me-2 p-1 ps-2 pe-2 rounded-5 btn-sm more-button" data-bs-toggle="dropdown">
                                            <a class="icon " href="#" ><i class="bi bi-three-dots-vertical"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow ms-2">
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2 pt-1 text-primary"></i>View Profile</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="deleteMember('.$row['userID'].')"><i class="bi bi-bookmark-x me-2 pt-1 text-danger" ></i>Remove</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-exclamation-triangle me-2 pt-1 text-"></i>Report</a></li>
                                            </ul>
                                            </div>
                                        </div>
                                    </div>    
                                </div>                   
                            </div>     
                    ';
                } 
            
            }

        }
        else if($_SESSION['currentNetworkID']==0){
            $html='';
        }
        else{
            $html.='<div class="col-lg-12">
                        <div class=" mb-0">
                            <div class="card-body">
                            <div class="d-flex align-items-center justify-content-center mt-4 ">
                                <i class="ri-alert-fill me-2"></i>No Members Found
                            </div>
                        </div>
                    </div>';
        }


        $html.='</div>';

    return $html;

    }

    private function disciple_form($checker,$source){
        $button = $this->CI->ParameterModel->getGroupParameter('button');
        $input = $this->CI->ParameterModel->getGroupParameter('input-network');
        $width = $this->CI->ParameterModel->getGroupParameter('col-width');
        if($checker>0){
            foreach($source as $row) 
                {
                $_SESSION['currentNetworkID'] = $row['networkID']; 
                return '
                <div class="col-lg-6">
                    <div class="card mb-1">
                        <div class="card-body p-0">
                            <div class="d-grid gap-2 m-4">
                                <div class="col-xl-12 mb-0">
                                    <div class="card">
                                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                                <img style="max-width:150px" id="imgProfile" src="'.base_url('assets/images/network_logo.png') .'" alt="Profile" class="rounded-circle">
                                            </div>
                                    </div>
                                </div>
                            '.
                            $this->CI->field->input_text_profile($input['key-networkName'],$input['networkName'],$row['networkName'],$width['label'],$width['div-input'])
                            .' 

                            '.
                            $this->CI->field->input_textarea_profile($input['key-networkAbout'],$input['networkAbout'],$row['networkAbout'],$width['label'],$width['div-input'])
                            .' 
                            '.
                            $this->CI->field->input_textarea_profile($input['key-networkDescription'],$input['networkDescription'],$row['networkDescription'],$width['label'],$width['div-input'])
                            .'

                            '.
                            $this->CI->field->input_select_profile($input['key-networkMode'],$input['networkMode'],$this->CI->ParameterModel->getDefaultParameterList('Mode of Invitation',$row['networkMode']),$width['label'],$width['div-input'])
                            .'
                            '.
                            $this->CI->field->input_select_profile($input['key-networkPrivacy'],$input['networkPrivacy'],$this->CI->ParameterModel->getDefaultParameterList('Privacy Settings',$row['networkPrivacy']),$width['label'],$width['div-input'])
                            .'
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button id="btnUpdateNetwork" type="button" class="btn btn-primary">'.$button['update-network'].'</button>
                                    <button id="btnAddMemberNetwork" type="button" class="btn btn-success"><i class="bi bi-person-plus-fill me-2"></i><span class="mobile-role-text">Add Member</span></button>
                                    <button id="deleteRecord" class="d-none" />
                                    <button id="deleteMember" class="d-none" />
                                    <button id="btnDeleteNetwork" type="button" class="btn btn-danger"><i class="bi bi-x-lg me-2"></i><span class="mobile-role-text">Delete</span></button>                
                                </div>                       
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }
        }else{
            $_SESSION['currentNetworkID']=0;
            return '
            <div class="col-lg-6">
                <div class="card mb-1">
                    <div class="card-body p-0">
                        
                        <div class="d-grid gap-2 m-4">
                        <p align=center class="text-danger"><i class="ri-alert-fill me-2"></i>No Data Found</p>
                            <button id="btnCreateNetwork" class="btn btn-success"><i class="bi bi-plus-lg me-2"></i>Create A Network</button>
                        </div>

                    </div>
                </div>
            </div>
            ';
        }
    }

    private function wrapper($data){
        return $this->CI->ParameterModel->singleLine($data,"on");
    }


}