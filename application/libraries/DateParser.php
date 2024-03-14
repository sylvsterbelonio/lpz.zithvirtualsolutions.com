<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class DateParser {
    function __construct(){
        $this->CI = & get_instance();
    }

    
    public function androidDate_to_serverDate($value){

        if($value!=""){

        $list_data = explode(" ",$value);

        if(count($list_data)>1)
            {
                $month = 0; $month=0; $year=0;

                switch(trim($list_data[0])){
                    case "Jan":
                        $month=1;
                        break;
                    case "Feb": 
                        $month=2;
                        break;   
                    case "Mar":
                        $month=3;
                        break;
                    case "Apr": 
                        $month=4;
                        break; 
                    case "May":
                        $month=5;
                        break;
                    case "Jun": 
                        $month=6;
                        break;   
                    case  "Jul":
                        $month=7;
                        break;
                    case "Aug": 
                        $month=8;
                        break; 
                    case  "Sep":
                        $month=9;
                        break;
                    case "Oct": 
                        $month=10;
                        break;   
                    case  "Nov":
                        $month=11;
                        break;
                    case "Dec": 
                        $month=12;
                        break;                      
                }

                return  trim($list_data[2]) . '-' . $month . '-' . trim($list_data[1])  . " 00:00:00";

            }else{
                return $value;
            }

        }
    else{
        return "0000-00-00 00:00:00";
        }    
    }

}