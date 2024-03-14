<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class MusicModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function get_all_songs($searchValue, $limit){
        $query = $this->db->query("
        SELECT song.songID, songTitle,albumPhoto, yearReleased, albumName, artistName, songType, 
        (SELECT COUNT(*) FROM song_history_list WHERE song.songID = song_history_list.songID AND song_history_list.type='views') AS 'views',
        (SELECT COUNT(*) FROM song_history_list WHERE song.songID = song_history_list.songID AND song_history_list.type='download') AS 'download',
        (SELECT COUNT(*) FROM song_history_list WHERE song.songID = song_history_list.songID AND song_history_list.type='favorite') AS 'favorite'
        FROM
          `song_artist`
          INNER JOIN `song_album`
            ON (
              `song_artist`.`artistID` = `song_album`.`artistID`
            )
          INNER JOIN `song` 
            ON (
              `song_album`.`albumID` = `song`.`albumID`
            ) WHERE songTitle LIKE '%$searchValue%'  ORDER BY songTitle, albumName, artistName $limit
        ");
        return $query->result_array();
    }

    public function get_all_album($searchValue,$limit){
        $query = $this->db->query("
        SELECT albumID, albumPhoto, albumName, yearReleased, artistName
        FROM
        `song_artist`
        INNER JOIN `song_album`
            ON (
            `song_artist`.`artistID` = `song_album`.`artistID`
            )
            WHERE albumName LIKE '%$searchValue%'
            ORDER BY albumName $limit
        ");
        return $query->result_array();
    }

    public function get_all_album_by_artist($artistID){
        $query = $this->db->query("
        SELECT albumID, albumPhoto, albumName, yearReleased, artistName
        FROM
        `song_artist`
        INNER JOIN `song_album`
            ON (
            `song_artist`.`artistID` = `song_album`.`artistID`
            )
            WHERE song_album.artistID = $artistID order by albumName
        ");
        return $query->result_array();
    }

    public function get_all_artist($searchValue,$limit){
        $query = $this->db->query("SELECT * from song_artist where artistName LIKE '%$searchValue%' order by artistName $limit");
        return $query->result_array();
    }

    public function get_artist_info($id){
        $query = $this->db->query("SELECT * from song_artist where artistID =$id");
        return $query->result_array();
    }

    public function get_album_info($id){
        $query = $this->db->query("SELECT * from song_album where albumID =$id");
        return $query->result_array();
    }

    public function get_song_by_albumID($id){
        $query = $this->db->query("
        SELECT song.songID, songTitle,albumPhoto, yearReleased, albumName, artistName, songType, 
        (SELECT COUNT(*) FROM song_history_list WHERE song.songID = song_history_list.songID AND song_history_list.type='views') AS 'views',
        (SELECT COUNT(*) FROM song_history_list WHERE song.songID = song_history_list.songID AND song_history_list.type='download') AS 'download',
        (SELECT COUNT(*) FROM song_history_list WHERE song.songID = song_history_list.songID AND song_history_list.type='favorite') AS 'favorite'
        FROM
          `song_artist`
          INNER JOIN `song_album`
            ON (
              `song_artist`.`artistID` = `song_album`.`artistID`
            )
          INNER JOIN `song` 
            ON (
              `song_album`.`albumID` = `song`.`albumID`
            ) WHERE song.albumID = $id ORDER BY songTitle
        ");
        return $query->result_array();
    }

    public function get_all_video_source_from_song($id,$category){
      $query = $this->db->query("SELECT * from song_video_souce where songID =$id AND videoCategory='$category' order by youtubeTitle");
      return $query->result_array();
  }


}