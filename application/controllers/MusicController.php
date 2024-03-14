<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MusicController extends CI_Controller {
	public function index()
	{}

    public function all_songs(){
        $data = $this->MusicModel->get_all_songs($this->input->post('searchValue'),$this->input->post('limit'));
        echo json_encode($data);
    }

    public function all_album(){
        $data = $this->MusicModel->get_all_album($this->input->post('searchValue'),$this->input->post('limit'));
        echo json_encode($data);
    }

    public function all_artist(){
        $data = $this->MusicModel->get_all_artist($this->input->post('searchValue'),$this->input->post('limit'));
        echo json_encode($data);
    }

    public function get_artist_info(){
        if(isset($_POST['artistID'])){
        $data = $this->MusicModel->get_artist_info($this->input->post('artistID'));
        echo json_encode($data);
        }else{
        $this->load->view('errors/restricted');
        }
    }

    public function get_all_album_by_artist(){
        if(isset($_POST['artistID'])){
        $data = $this->MusicModel->get_all_album_by_artist($this->input->post('artistID'));
        echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }
    }

    public function get_album_info(){
        if(isset($_POST['albumID'])){
        $data = $this->MusicModel->get_album_info($this->input->post('albumID'));
        echo json_encode($data);
        }else{
            $this->load->view('errors/restricted');
        }
    }

    public function get_all_song_by_album(){
        if(isset($_POST['albumID'])){
            $data = $this->MusicModel->get_song_by_albumID($this->input->post('albumID'));
            echo json_encode($data);
            }else{
                $this->load->view('errors/restricted');
            }
    }

    public function get_all_video_source_from_song(){
        if(isset($_POST['songID'])){
            $data = $this->MusicModel->get_all_video_source_from_song($this->input->post('songID'),$this->input->post('category'));
            echo json_encode($data);
            }else{
                $this->load->view('errors/restricted');
            }
    }


}