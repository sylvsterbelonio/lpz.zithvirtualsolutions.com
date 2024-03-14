<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class SecurityModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function encrypt($data){
        return base64_encode($data);
    }

    function encryptor($string,$action) {
        $output = false;
    
        $encrypt_method = "AES-256-CBC";
        //pls set your unique hashing key
        $secret_key = 'sylvster';
        $secret_iv = 'JesusismySavior2023';
    
        // hash
        $key = hash('sha256', $secret_key);
    
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
    
        //do the encyption given text/string/number
        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            //decrypt the given text/string/number
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
    
        return $output;
    }

}