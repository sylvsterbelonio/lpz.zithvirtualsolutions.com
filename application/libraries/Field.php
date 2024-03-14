<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Field {

    function __construct(){
        $this->CI = & get_instance();
    }


    public function label_profile($key,$value,$class){
        return $this->wrapper('
        <label for="'.$key.'" class="'.$class.'">'.$value.'</label>
        ');
    }

    public function label_quick_add($value,$class){
        return $this->wrapper('
        <label class="col-md-4 col-lg-12 col-form-label '.$class.'"><b>'.$value.'</b></label>
        ');
    }

    public function label_headings_overview($value){
        return $this->wrapper('
        <h5 class="card-title">'.$value.'</h5>  
        ');
    }

    public function label_overview($value,$defaultValue,$label_size,$input_size){
        return $this->wrapper('
        <div class="row">
            <div class="'.$label_size.'">'.$value.'</div>
            <div class="'.$input_size.'">'.$defaultValue.'</div>
        </div>  
        ');
    }

    public function input_radio_profile($key,$value,$default_value, $choices,$label_size,$input_size){

        $list = explode(",",$choices);

        $header = '<div class="row mb-3">
                    <fieldset class="row mb-3">
                        <legend class="'.$label_size.'"><label>'.$value.'</label></legend>
                            <div class="'.$input_size.'">';
        
                $footer = '  </div>
                    </fieldset>
                </div>';
        
        $content='';
        $x=0;

        for($i=0;$i<count($list);$i++){
                if($default_value==trim($list[$i])){
                    $content .= '
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="'.$key.'" id="gridRadios'.$x.'_'.$key.'" value="'.trim($list[$i]).'" checked>
                        <label class="form-check-label" for="gridRadios'.$x.'_'.$key.'">'.trim($list[$i]).'</label>
                    </div>
                    ';
                }else{
                    $content .= '
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="'.$key.'" id="gridRadios'.$x.'_'.$key.'" value="'.trim($list[$i]).'">
                        <label class="form-check-label" for="gridRadios'.$x.'_'.$key.'">'.trim($list[$i]).'</label>
                    </div>
                    ';
                }        

                $x+=1;
            }

        return $this->wrapper($header.$content.$footer);
    }

    public function input_metric_profile($key,$value,$default_value,$source,$label_size){
        return $this->wrapper('
        <div class="row mb-3">
        <label for="'.$key.'" class="'.$label_size.'">'.$value.'</label>
        <div class="col-md-2 col-lg-3">
          <input id="txt'.$key.'" name="'.$key.'" type="number" class="form-control" value="'.$default_value.'">
        </div>
        <div class="col-md-2 col-lg-5">
          <select id="cbo'.$value.'" class="form-select" aria-label="">  
              '.
              $source
              .'
          </select>
        </div>
      </div>
        ');
    }

    public function input_select_profile($key,$value, $source,$label_size,$input_size){
        return $this->wrapper('
        <div class="row mb-3">
            <label class="'.$label_size.'">'.$value.'</label>
                <div class="'.$input_size.'">
                    <select id="cbo'.$key.'" class="form-select" aria-label="- Select '.$value.' -">
                    '.$source.'
                    </select>
                    <div id="feedback_'.$key.'" class="text-danger alert alert-danger mt-2 d-none feedback-response"></div>
                </div>
        </div>  
        ');
    }

    public function input_textarea_profile($key,$value,$defaultvalue,$label_size,$input_size){
        return $this->wrapper('
            <div class="row mb-3">  
                <label for="'.$key.'" class="'.$label_size.'">'.$value.'</label>
                    <div class="'.$input_size.'">
                        <textarea id="txt'.$key.'" name="'.$key.'" class="form-control" style="height: 100px">'.$defaultvalue.'</textarea>
                        <div id="feedback_'.$key.'" class="text-danger alert alert-danger mt-2 d-none feedback-response"></div>
                    </div>
            </div>
        ');
    }

    public function input_autocomplete_profile_rowClass($key,$value,$default_value,$label_size,$input_size,$filterMode,$limit,$rowClass){
        return $this->wrapper('
            <div class="row mb-3 '.$rowClass.'">
                    <label for="'.$key.'" class="'.$label_size.'">'.$value.'</label>
                    <div class="'.$input_size.'">
                            <input id="txt'.$key.'" type="text" name="'.$key.'" placeholder="'.$value.'" class="form-control" id="yours" value="'.$default_value.'">
                            <div id="feedback_'.$key.'" class="text-danger alert alert-danger mt-2 d-none feedback-response"></div>
                    </div>   
            </div> 
            <script>                             
            function loadAutocomplete_'.$key.'(text){
                        $.ajax({
                            url:"' . base_url() . 'simple-autocomplete",
                            type: "post", dataType: "json",
                            data:{
                                mode:\''.$filterMode.'\',
                                search: text,
                                limit: '.$limit.'
                            },
                            success:function(data){                                  
                                var text = data.html;
                                const nData = text.split(",");                                               
                                         $( "#txt'.$key.'" ).autocomplete({
                                            source: nData
                                          });              
                            }
                          });   
            }
            $("#txt'.$key.'").keyup(function(){
                var text = $(this).val();
                if(text!="")
                    {  loadAutocomplete_'.$key.'(text);  }
            });
            </script>
        ');
    }

    public function input_autocomplete_profile($key,$value,$default_value,$label_size,$input_size,$filterMode,$limit){
        return $this->wrapper('
            <div class="row mb-3">
                    <label for="'.$key.'" class="'.$label_size.'">'.$value.'</label>
                    <div class="'.$input_size.'">
                            <input id="txt'.$key.'" type="text" name="'.$key.'" placeholder="'.$value.'" class="form-control" id="yours" value="'.$default_value.'">
                            <div id="feedback_'.$key.'" class="text-danger alert alert-danger mt-2 d-none feedback-response"></div>
                    </div>   
            </div> 
            <script>                             
            function loadAutocomplete_'.$key.'(text){
                        $.ajax({
                            url:"' . base_url() . 'simple-autocomplete",
                            type: "post", dataType: "json",
                            data:{
                                mode:\''.$filterMode.'\',
                                search: text,
                                limit: '.$limit.'
                            },
                            success:function(data){                                  
                                var text = data.html;
                                const nData = text.split(",");                                               
                                         $( "#txt'.$key.'" ).autocomplete({
                                            source: nData
                                          });              
                            }
                          });   
            }
            $("#txt'.$key.'").keyup(function(){
                var text = $(this).val();
                if(text!="")
                    {  loadAutocomplete_'.$key.'(text);  }
            });
            </script>
        ');
    }

    public function input_date_profile($key,$value,$defaultvalue,$label_size,$input_size){
        return $this->wrapper('
            <div class="row mb-3">
                <label for="your'.$key.'" class="'.$label_size.'">'.$value.'</label>
                <div class="'.$input_size.'"> 
                    <input id="txt'.$key.'" type="date" name="'.$key.'" placeholder="'.$value.'" class="form-control" id="your'.$key.'" value="'.$defaultvalue.'">
                    <div id="feedback_'.$key.'" class="text-danger alert alert-danger mt-2 d-none feedback-response"></div>
                </div>   
            </div> 
        ');
    }

    public function input_date_profile_rowClass($key,$value,$defaultvalue,$label_size,$input_size,$rowClass){
        return $this->wrapper('
            <div class="row mb-3 '.$rowClass.'">
                <label for="your'.$key.'" class="'.$label_size.'">'.$value.'</label>
                <div class="'.$input_size.'"> 
                    <input id="txt'.$key.'" type="date" name="'.$key.'" placeholder="'.$value.'" class="form-control" id="your'.$key.'" value="'.$defaultvalue.'">
                    <div id="feedback_'.$key.'" class="text-danger alert alert-danger mt-2 d-none feedback-response"></div>
                </div>   
            </div> 
        ');
    }

    public function input_number_profile($key,$value,$defaultvalue,$label_size,$input_size){
    
        return $this->wrapper('
            <div class="row mb-3">
                <label for="your'.$key.'" class="'.$label_size.'">'.$value.'</label>
                <div class="'.$input_size.'"> 
                    <input id="txt'.$key.'" type="text" name="'.$key.'" placeholder="'.$value.'" class="form-control" id="your'.$key.'" value="'.$defaultvalue.'">
                    <div id="feedback_'.$key.'" class="text-danger "></div>
                </div>   
            </div> 
        ');
    }
    public function input_number_profile_rowClass($key,$value,$defaultvalue,$label_size,$input_size,$rowClass){
    
        return $this->wrapper('
            <div class="row mb-3 '.$rowClass.'">
                <label for="your'.$key.'" class="'.$label_size.'">'.$value.'</label>
                <div class="'.$input_size.'"> 
                    <input id="txt'.$key.'" type="text" name="'.$key.'" placeholder="'.$value.'" class="form-control" id="your'.$key.'" value="'.$defaultvalue.'">
                    <div id="feedback_'.$key.'" class="text-danger "></div>
                </div>   
            </div> 
        ');
    }

    public function input_text_family($key,$value,$defaultvalue,$label_size,$input_size){
        return $this->wrapper('
        <div class="row mb-3">
            <label for="your'.$key.'" class="'.$label_size.'">Name</label>
            <div class="'.$input_size.'"> 
                <input id="txt'.$key.'" type="text" name="'.$key.'" class="form-control" id="your'.$key.'"  value="'.$defaultvalue.'">
                <span class="badge bg-danger badge-number float-end"><span id="rel_status">Unlink</span></span>
                <div id="feedback_'.$key.'" class="text-danger alert alert-danger mt-2 d-none feedback-response"></div>
            </div>   
        </div>
        ');
    }
    public function input_text_profile($key,$value,$defaultvalue,$label_size,$input_size){
    
        return $this->wrapper('
            <div class="row mb-3">
                <label for="your'.$key.'" class="'.$label_size.'">'.$value.'</label>
                <div class="'.$input_size.'"> 
                    <input id="txt'.$key.'" type="text" name="'.$key.'" placeholder="'.$value.'" class="form-control" id="your'.$key.'" value="'.$defaultvalue.'">
                    <div id="feedback_'.$key.'" class="text-danger alert alert-danger mt-2 d-none feedback-response"></div>
                </div>   
            </div> 
        ');
    }

    public function input_text_profile_rowClass($key,$value,$defaultvalue,$label_size,$input_size,$rowClass){
    
        return $this->wrapper('
            <div class="row mb-3 '.$rowClass.'">
                <label for="your'.$key.'" class="'.$label_size.'">'.$value.'</label>
                <div class="'.$input_size.'"> 
                    <input id="txt'.$key.'" type="text" name="'.$key.'" placeholder="'.$value.'" class="form-control" id="your'.$key.'" value="'.$defaultvalue.'">
                    <div id="feedback_'.$key.'" class="text-danger alert alert-danger mt-2 d-none feedback-response"></div>
                </div>   
            </div> 
        ');
    }

    public function input_password_profile($key,$value,$defaultvalue,$label_size,$input_size){
    
        return $this->wrapper('
            <div class="row mb-3">
                <label for="your'.$key.'" class="'.$label_size.'">'.$value.'</label>
                <div class="'.$input_size.'"> 
                    <input id="txt'.$key.'" type="text" name="'.$key.'" placeholder="'.$value.'" class="form-control" id="your'.$key.'" value="'.$defaultvalue.'">
                    <div id="feedback_'.$key.'" class="text-danger alert alert-danger mt-2 d-none feedback-response"></div>
                </div>   
            </div> 
        ');
    }

    public function input_text($key,$value,$defaultvalue){
        return $this->wrapper('
        <label for="your'.$key .'" class="form-label">'.$value.'</label>
        <input id="txt'.$key.'" type="text" name="'.$key.'" class="form-control" placeholder="'.$value.'" id="your'.$key.'" value="'.$defaultvalue.'">
        <div id="feedback_'.$key.'" class="text-danger alert alert-danger mt-2 d-none feedback-response"></div>
        ');
    }

    public function input_text_required($key,$value,$defaultvalue){
        return $this->wrapper('
        <label for="your'.$key .'" class="form-label">'.$value.'</label>
        <input id="txt'.$key.'" type="text" name="'.$key.'" class="form-control" placeholder="'.$value.'" id="your'.$key.'" required value="'.$defaultvalue.'">
        <div id="feedback_'.$key.'" class="text-danger alert alert-danger mt-2 d-none feedback-response"></div>
        ');
    }

    public function input_text_hidden($key,$defaultvalue){
        return $this->wrapper('
            <div class="row mb-3">
                <input id="txt'.$key.'" type="hidden" class="d-none" value="'.$defaultvalue.'">  
            </div> 
        ');
    }

    public function input_password_required($key,$value,$defaultvalue){
        return $this->wrapper('
        <label for="your'.$key .'" class="form-label">'.$value.'</label>
        <input id="txt'.$key.'" type="password" name="'.$key.'" class="form-control" placeholder="'.$value.'" id="your'.$key.'" required value="'.$defaultvalue.'">
        <div id="feedback_'.$key.'" class="text-danger alert alert-danger mt-2 d-none feedback-response"></div>
        ');
    }

    public function button_default($key,$value,$class,$position){
        return $this->wrapper('
            <button id="btn'.$key.'" type="button" class="btn btn-'.$class.' float-'.$position.' me-2">'.$value.'</button>
        ');
    }

    private function wrapper($data){
        return $this->CI->ParameterModel->singleLine($data,"on");
    }

}