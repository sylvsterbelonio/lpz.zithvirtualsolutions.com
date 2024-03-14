<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajax {

    function __construct(){
        $this->CI = & get_instance();
    }

    public function get_data($key,$url){
 
        return $this->wrapper('
        
        function ajax_'.$key.'(){
            $.ajax({
                url:"' . base_url() .$url.'",
                type:"post",
                dataType:"json",
                success: function (data){
                    console.log(data);
                    return_fetch_'.$key.'(data);
                }
            });
        }

       /*  function return_fetch_'.$key.'(data) */
        
     
        ');
    }

    private function wrapper($data){
        return $this->CI->ParameterModel->singleLine($data,"on");
    }

}