<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class EbookModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }


    public function get_top_10_ebook($type){
        $query = $this->db->query("
        SELECT *, 
        (SELECT COUNT(*) FROM ebook_history_list a WHERE a.ebookID = b.`ebookID` AND `type`= 'view') AS 'view',
        (SELECT COUNT(*) FROM ebook_history_list a WHERE a.ebookID = b.`ebookID` AND `type`= 'favorite') AS 'favorite',
        (SELECT COUNT(*) FROM ebook_history_list a WHERE a.ebookID = b.`ebookID` AND `type`= 'download') AS 'download'
        FROM
        ebook b  
        ORDER BY $type DESC 
        LIMIT 0, 10 
        ");
        return $query->result_array(); 
    }

    public function get_list_ebook($filter){

        $orderMode="";
        if($filter['orderType']=="A-Z Ascending") $orderMode = " ORDER BY bookName ASC ";
        if($filter['orderType']=="Z-A Descending") $orderMode = " ORDER BY bookName DESC ";
        if($filter['orderType']=="Newest to Oldest") $orderMode = " ORDER BY dtCreated DESC  ";
        if($filter['orderType']=="Oldest to Newest") $orderMode = " ORDER BY dtCreated ASC ";


        $query = $this->db->query("
        SELECT *, 
        (SELECT COUNT(*) FROM ebook_history_list a WHERE a.ebookID = b.`ebookID` AND `type`= 'view') AS 'view',
        (SELECT COUNT(*) FROM ebook_history_list a WHERE a.ebookID = b.`ebookID` AND `type`= 'favorite') AS 'favorite',
        (SELECT COUNT(*) FROM ebook_history_list a WHERE a.ebookID = b.`ebookID` AND `type`= 'download') AS 'download'
        FROM
        ebook b
        WHERE bookName LIKE '%".$filter['bookName']."%' OR bookTag LIKE '%".$filter['bookName']."%'
        $orderMode ".$filter['limit']."
        ");
        return $query->result_array();
    }

    public function get_similar_list_ebook($filter){

        $tags = explode(",",$filter['bookTag']);
        $conditionTags = "";

        for($i=0;$i<count($tags);$i++){
            if($i==0){
                $conditionTags.=" bookTag LIKE '%". $tags[$i] . "%'";
            }else{
                $conditionTags.=" OR bookTag LIKE '%". $tags[$i] . "%'";
            }

        } 

        $query = $this->db->query("
        SELECT *
        FROM
        ebook
        WHERE ebookID != ".$filter['ebookID']. " AND ($conditionTags)
        ".$filter['limit']."
        ");
        return $query->result_array();
    }

    public function get_ebook($ebookID){
        $query = $this->db->query("  
        SELECT * ,
            (SELECT COUNT(*) FROM ebook_history_list a WHERE a.ebookID = `ebook`.`ebookID` AND `type`= 'view') AS 'view',
            (SELECT COUNT(*) FROM ebook_history_list a WHERE a.ebookID = `ebook`.`ebookID` AND `type`= 'favorite') AS 'favorite',
            (SELECT COUNT(*) FROM ebook_history_list a WHERE a.ebookID = `ebook`.`ebookID` AND `type`= 'download') AS 'download'
         FROM
        `ebook_info`
        INNER JOIN `ebook`
            ON (
            `ebook_info`.`ebookInfoID` = `ebook`.`ebookInfoID`
            )
                
        WHERE `ebook`.`ebookID` = $ebookID");
        return $query->result_array();
    }

    public function get_count_ebook(){
        $query = $this->db->query("
        SELECT COUNT(*) as 'total'
        FROM
        ebook 
        ");
        return $query->result_array();
    }

    public function android_add_history_analytics($action){
        $query = $this->db->query("select * from ebook_history_list where ebookID=".$action['ebookID']." AND type='".$action['type']."' AND userID=".$action['userID']);
        if($query->num_rows()==0){

            if($action["action"]=="add"){
                    //ADD HISTORY
                    $data = [
                        'ebookID' => $action["ebookID"],
                        'type' => $action["type"],
                        'userID' => $action["userID"],
                    ];
                    $this->db->insert('ebook_history_list',$data);
            }else{
                $this->db->query("DELETE FROM ebook_history_list where ebookID = ". $action["ebookID"] . " AND type='favorite'");
            }

        }else{
            if($action['type']=="Download"){
                //ADD HISTORY
                $data = [
                    'ebookID' => $action["ebookID"],
                    'type' => $action["type"],
                    'userID' => $action["userID"],
                ];
                $this->db->insert('ebook_history_list',$data);
            }
        }

        $query = $this->db->query("SELECT  
        (SELECT COUNT(*) FROM ebook_history_list a WHERE a.ebookID = b.`ebookID` AND `type`= 'view') AS 'view',
        (SELECT COUNT(*) FROM ebook_history_list a WHERE a.ebookID = b.`ebookID` AND `type`= 'favorite') AS 'favorite',
        (SELECT COUNT(*) FROM ebook_history_list a WHERE a.ebookID = b.`ebookID` AND `type`= 'download') AS 'download'
        
        FROM  ebook b WHERE  b.ebookID = " . $action['ebookID']);
        return $query->result_array();

    }

    public function get_list_books_by_author($author){
        $query = $this->db->query("  
        SELECT * ,
            (SELECT COUNT(*) FROM ebook_history_list a WHERE a.ebookID = `ebook`.`ebookID` AND `type`= 'view') AS 'view',
            (SELECT COUNT(*) FROM ebook_history_list a WHERE a.ebookID = `ebook`.`ebookID` AND `type`= 'favorite') AS 'favorite',
            (SELECT COUNT(*) FROM ebook_history_list a WHERE a.ebookID = `ebook`.`ebookID` AND `type`= 'download') AS 'download'
         FROM
        `ebook_info`
        INNER JOIN `ebook`
            ON (
            `ebook_info`.`ebookInfoID` = `ebook`.`ebookInfoID`
            )
                
        WHERE `ebook`.`bookAuthor` LIKE '$author'");
        return $query->result_array();
    }

}