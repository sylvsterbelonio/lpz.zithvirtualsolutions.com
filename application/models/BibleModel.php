<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class BibleModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function get_all_mnemonic_verse($searchValue,$version,$language, $limit){
        $query = $this->db->query("SELECT * FROM bible_mnemonic_verses WHERE bibleVersion LIKE '$version%' and language LIKE '$language%' AND ( tag LIKE '%$searchValue%' or verse LIKE '%$searchValue%' ) $limit");
        return $query->result_array();
    }

    public function get_all_distinct_column($columnName,$table){
        $query = $this->db->query("SELECT distinct $columnName FROM $table ORDER BY $columnName");
        return $query->result_array();
    }

    public function bible_get_all_language(){
        $query = $this->db->query("SELECT distinct language FROM holy_bible ORDER BY language");
        return $query->result_array();
    }
    public function bible_get_all_list($searchValue,$language, $limit){
        $query = $this->db->query("SELECT * FROM holy_bible WHERE language LIKE '%$language%' AND (shortBibleName LIKE '$searchValue%' OR longBibleName LIKE '%$searchValue%')  ORDER BY shortBibleName, longBibleName $limit");
        return $query->result_array();
    }

    public function bible_get($id){
        $query = $this->db->query("SELECT * FROM holy_bible WHERE holyBibleID = $id");
        return $query->result_array();
    }

}