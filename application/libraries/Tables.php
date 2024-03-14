<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tables {

    function __construct(){
        $this->CI = & get_instance();
    }

    private function generate_header($data){
        $value = explode(",",$data);
        $html='
        ';
        for($i=0;$i<count($value);$i++){
            $html.='<th>'.$value[$i].'</th>';
        }
        $html.='';

        return $html;
    }

    private function generate_key($id,$data){
      
        $data = "tempUserID, first_name, middle_name,last_name, gender,mobileno, email, status, action(edit-delete)";

        $value = explode(",",$data);
        
        $html='';
    
        for($i = 1 ;$i<count($value);$i++){

            $subValue = explode("(", $value[$i] );

            if(count($subValue)>1){
                $subsubValue = explode(")",$subValue[1]);

                    if($subsubValue[0]=='image'){
                        $html.='
                        {\'render\': function( data, type, row, meta ){
                            var a =`<img src=\''.base_url().'${row.'.trim($subValue[0]).'}\' height=32 width=32>`;
                            return a; 
                        }},';
                    }

                    

                if(trim($subValue[0])=='action'){

                    $temp1 = '{\'render\': function( data, type, row, meta ){
                        var a = `';

                    //action(edit-delete)
                    // subvalue(0)=action subvalue(1)= add-edit-delete)
                    $subsubValue = explode(")",$subValue[0]);

                    //subsubvalue(0)=add-edit subsubvalue(1) = ''
                    $actionType = explode("-",$subsubValue[0]);

                    $tempbody=''; 
                    
                   


                        
                    $tempbody = '<span onclick=\'dtable_edit_'.$id.'(${row.'.$value[0].'})\' class=\'btn btn-sm btn-outline-danger\'><i class=\'bi bi-trash\'></i></span>
                    <span onclick=\'dtable_delete_'.$id.'(${row.'.$value[0].'})\' class=\'btn btn-sm btn-outline-primary\'><i class=\'bi bi-pencil-square\'></i></span>
                   ';    

                   $temp3 = ' `;
                   return a; 
                    }}';

                    $html.=$temp1.$tempbody.$temp3;


                  
                }
              
            }else{
                $html.='{\'data\':\''.trim($value[$i]).'\'},';
            }

        }


        return $html;
    }

    public function generate_datatable($key,$table,$width){
      
        $key_elements =  $this->generate_key($key,"a");

        return $this->wrapper('
        
        <div class="'.$width.'">
        <div class="card mb-1">
            <div id="div-list-of-members" class="card-body ps-4 pe-4 pt-4">
                    <div class="table-responsive">
                    <table id="tbl'.$key.'" class="table table-striped table-hover" style="width:100%">
                        <thead>
                        <tr id="tr'.$key.'">
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

        <script>
        function generate_header'.$key.'(header){
            var raw = header;
            var row = raw.split(",");
            var html="<th>No</th>";
            for(var i=0; i<row.length;i++){
                html+="<th>"+row[i]+"</th>";
            }
            html+="";
            $("#tr'.$key.'").html(html);
        }

        function generate_table(data){
            generate_header'.$key.'(data.header);
            var i = "1";
            $("#tbl'.$key.'").DataTable({
                "data": data.posts,
                "responsive":true,
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                "columns": [
                    {"render": function(){
                        return a = i++;
                    }},
                    '.
                    $key_elements
                    .'                    
                ]
            });          
        }
        </script>
        ');
    }

    public function generate_data($query,$prop){
        $data = array();
        $i=0;
        foreach($query as $row) {

            $dataset = array();
            foreach($prop as $subrow) {
               if($subrow['mode']=='secured'){
                $dataset[$subrow['group_name']] = $row[$subrow['group_name']];
               }else{
                $dataset[$subrow['group_name']] = $row[$subrow['group_name']];
               }
            }
            $data[$i] = $dataset;
            $i+=0;
           }   
        return $data;   
    }

    private function wrapper($data){
        return $this->CI->ParameterModel->singleLine($data,"off");
    }
}