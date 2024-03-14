<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mission {

    function __construct(){
        $this->CI = & get_instance();
    }

    public function evangelize_form(){
        $input = $this->CI->ParameterModel->getGroupParameter('input');
        $table = $this->CI->ParameterModel->getGroupParameter('table');
        $button = $this->CI->ParameterModel->getGroupParameter('button');
        $width = $this->CI->ParameterModel->getGroupParameter('col-width');
        $heading = $this->CI->ParameterModel->getGroupParameter('heading');

        $datatable_key = $this->CI->MissionModel->get_evangelized_datatable_list_key();

        return $this->wrapper('
        
        <div class="p-3 ">
            <div id="network-content" class="row g-2">

                    <div class="col-lg-6">
                        <div class="card mb-1">
                            <div class="card-body ps-4 pe-4">
                            
                                <div class="row mt-4 mb-0">
                                    
                                


                                <div class="col-xxl-12 col-md-12">
                                <div class="card info-card sales-card">
                                        <div class="card-body">
                                        <h5 class="card-title text-primary">TODAY <span>  <b>Total</b> Evangalized | Drop | Consolidated</span></h5>
                                            <div class="d-flex align-items-center">
                                                    <div class="ps-3">
                                                        <h4 class="text-info"><b>50</b></h4>
                                                        <span class="text-info small pt-1 fw-bold" ><i class="bi bi-caret-up-fill me-2 text-info" ></i>Evangelized</span> <span class="text-muted small pt-2 ps-1"></span>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h4 class="text-danger"><b>50</b></h4>
                                                        <span class="text-danger small pt-1 fw-bold" ><i class="bi bi-caret-down-fill me-2 text-danger"></i>Drop</span> <span class="text-muted small pt-2 ps-1"></span>
                                                    </div>
                                                    <div class="ps-3">
                                                    <h4 class="text-success"><b>50</b></h4>
                                                    <span class="text-success small pt-1 fw-bold"><i class="bi bi-check-lg me-2 text-success"></i>Consolidated</span> <span class="text-muted small pt-2 ps-1"></span>
                                                </div>
                                            </div>
                                        </div>           
                                </div>
                                </div>

                                '.
                                $this->CI->chart->generate_APEXCHART_bar_chart('key','This year 2023','No. of Personsx')
                                .'



                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card mb-1">
                            <div id="div-list-of-members" class="card-body ps-4 pe-4">
                            '.
                            $this->CI->field->label_headings_overview($heading['prof-info'])
                            .
                                $this->CI->field->input_text_profile($input['key-first_name'],$input['first_name'],"",$width['label'],$width['div-input'])
                                .
                                $this->CI->field->input_text_profile($input['key-middle_name'],$input['middle_name'],"",$width['label'],$width['div-input'])
                                .
                                $this->CI->field->input_text_profile($input['key-last_name'],$input['last_name'],"",$width['label'],$width['div-input'])
                                .
                                $this->CI->field->input_date_profile($input['key-date_of_birth'],$input['date_of_birth'],"",$width['label'],$width['div-input'])
                                .
                                $this->CI->field->input_radio_profile($input['gender'],$this->CI->profile->sex("Unspecified"),$width['label'],$width['div-input'])
                                .
                                $this->CI->field->input_select_profile($input['key-CivilStatus'],$input['CivilStatus'],$this->CI->ParameterModel->getDefaultParameterList('Civil Status',''),$width['label'],$width['div-input'])
                                .
                                $this->CI->field->input_textarea_profile($input['key-address'],$input['address'],'',$width['label'],$width['div-input'])
                                .
                                $this->CI->field->input_select_profile($input['key-Country'],$input['Country'],'',$width['label'],$width['div-input'])
                                .
                                $this->CI->field->input_select_profile($input['key-Province'],$input['Province'],'',$width['label'],$width['div-input'])
                                .
                                $this->CI->field->input_select_profile($input['key-City'],$input['City'],'',$width['label'],$width['div-input'])
                                .
                                $this->CI->field->input_select_profile($input['key-Barangay'],$input['Barangay'],'',$width['label'],$width['div-input'])
                                .
                                $this->CI->field->input_text_profile($input['key-mobileno'],$input['mobileno'],'',$width['label'],$width['div-input'])
                                .
                                $this->CI->field->input_text_profile($input['key-email'],$input['email'],'',$width['label'],$width['div-input'])
                                .
                                $this->CI->field->input_select_profile($input['key-evangelize_status'],$input['evangelize_status'],$this->CI->ParameterModel->getDefaultParameterList('Evangelization','Evangelized'),$width['label'],$width['div-input'])
                                .
                                $this->CI->field->button_default('eva'.$button['key-add'],$button['add'],'success','end')
                                .
                                $this->CI->field->button_default('eva'. $button['key-update'],$button['update'],'primary d-none','end')
                                .'

                            </div>
                        </div>
                    </div>

                   '.$this->CI->tables->generate_datatable($table['key-evangelize'],$table, $width['table-lg']).'

            </div>
        </div>

        <script>


        fetch();

        $("#btnevaadd").click(function(){

            var raw = "tempUserID, first_name(image), middle_name, last_name, gender,mobileno, email, status(edit,delete)";
            var row = raw.split(",");
            var html="";

            for(var i=0; i<row.length;i++){
                
                var checker = row[i].split("(");
                if(checker.length>1){
          
                }else{
                    html+="{\'data\':\'" + row[i] +"\'},";
                }
            }

            alert(html);
            
        });
    
        function fetch(){
            $.ajax({
                url:"' . base_url() .'church/mission/list",
                type:"post",
                dataType:"json",
                success: function (data){
                    generate_table(data);
                }
            });
           
        }

        function dtable_edit_'.$table['key-evangelize'].'(id){
            alert("edit" + id);
        }

        function dtable_delete_'.$table['key-evangelize'].'(id){
            alert("del" + id);
        }








        </script>

        ');
    }

    private function wrapper($data){
        return $this->CI->ParameterModel->singleLine($data,"off");
    }
}