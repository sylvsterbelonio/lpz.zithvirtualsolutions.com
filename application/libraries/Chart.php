<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Chart {

    function __construct(){
        $this->CI = & get_instance();
    }

    private function consolidate_data($raw){
        $data='';
        for($i=0;$i<count($raw);$i++)
        {
            $data.='{
                   name: \'' . $raw[$i][0] . '\',
                   data: [';        
           for($y=1;$y<count($raw[$i]);$y++)
               {
               $data.=$raw[$i][$y] . ',';
               }                   
           $data.=']},';  
        }
        return $data;
    }
    public function generate_APEXCHART_bar_chart($key,$title,$legendTitle){

        $raw = array (
            array('Evangelized',100,2,3,4,5,6,7,8,9,10,11,12),
            array("Consolidated",1,2,3,4,5,6,7,8,9,10,11,12),
            array("Drop",1,2,3,4,5,6,7,8,9,10,11,12)
          );
          
          $data=$this->consolidate_data($raw);

       return $this->wrapper('
        <div class="col-xxl-12 col-md-12">
            <div class="card info-card sales-card">
              <div class="card-body">
                    <h5 class="card-title" align=center>'.$title.'</h5>
                        <!-- Column Chart -->
                        <div id="chart'.$key.'"></div>
                            <script>
                                $( document ).ready(function() {
                                new ApexCharts(document.querySelector("#chart'.$key.'"), {
                                    series: [
                                        '.$data.'
                                    ],
                                    chart: {
                                    type: \'bar\',
                                    height: 350
                                    },
                                    legend: {
                                        labels: {
                                        
                                        },
                                        markers: {
                                            colors: \'#0dcaf0\'
                                        }
                                    },
                                    colors: [\'#0dcaf0\', \'#dc3545\', \'#198754\'],

                                    fill: {
                                        opacity: 1,                                   
                                   },
                                    plotOptions: {
                                    bar: {
                                        horizontal: false,
                                        columnWidth: \'55%\',
                                        endingShape: \'rounded\'
                                    },
                                    },
                                    dataLabels: {
                                    enabled: false,
                                    
                                    },
                                    stroke: {
                                    show: true,
                                    width: 2,
                                    colors: [\'transparent\']
                                    },
                                    xaxis: {
                                    categories: [\'Jan\', \'Feb\', \'Mar\', \'Apr\', \'May\', \'Jun\', \'Jul\', \'Aug\', \'Sep\',\'Oct\',\'Nov\',\'Dec\'],
                                    },
                                    yaxis: {
                                    title: {
                                        text: \''.$legendTitle.'\'
                                    }
                                    },
                                    
                                    markers: {
                                        colors: [\'#0dcaf0\', \'#dc3545\', \'#198754\']
                                    },

                                    tooltip: {
                                    y: {
                                        formatter: function(val) {
                                        return "" + val + " persons"
                                        }
                                    }
                                    }
                                }).render();
                                });
                                </script>
                                <!-- End Column Chart -->
                </div>           
            </div>
        </div>
        ');
    }

    private function wrapper($data){
        return $this->CI->ParameterModel->singleLine($data,"off");
    }

}