<?php
 if (!defined('BASEPATH'))
 exit('No direct script access allowed');

class HomeModel extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function getMainFeatures(){
        $query = $this->db->query('SELECT * FROM blog_main_features LIMIT 0,5');

        $counter=0;
        $html=' <!-- Carousel Start -->
                <div class="container-fluid p-0 mb-5">
                    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">';

        foreach($query->result_array() as $row)
        {


           if($counter==0)
                {
                    $html.=' <div class="carousel-item active">
                    <img class="w-100" src="' . base_url() . $row['coverPhoto'].'" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7 pt-5">
                                    <h1 class="display-4 text-white mb-3 animated slideInDown">'.$row['headings'].'</h1>
                                    <p class="fs-5 text-white-50 mb-5 animated slideInDown">'.$row['shortDescription'].'</p>
                                    <a class="btn btn-primary py-2 px-3 animated slideInDown" href="'.base_url().$row['url'].'">
                                        Learn More
                                        <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                                            <i class="fa fa-arrow-right"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                }
           else {
                $html.=' <div class="carousel-item">
                <img class="w-100" src="' . base_url() . $row['coverPhoto'].'" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 pt-5">
                                <h1 class="display-4 text-white mb-3 animated slideInDown">'.$row['headings'].'</h1>
                                <p class="fs-5 text-white-50 mb-5 animated slideInDown">'.$row['shortDescription'].'</p>
                                <a class="btn btn-primary py-2 px-3 animated slideInDown" href="'.base_url().$row['url'].'">
                                    Learn More
                                    <div class="d-inline-flex btn-sm-square bg-white text-primary rounded-circle ms-2">
                                        <i class="fa fa-arrow-right"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';


           }      

           $counter=1;
        } 

        $html.='            </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <!-- Carousel End -->';

        return $html;
    }

}