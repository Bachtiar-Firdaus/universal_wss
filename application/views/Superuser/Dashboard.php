<!DOCTYPE html>
<html lang="en">

<head>
<title>Warehouse Security System</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/dist/sweetalert.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/dist/sweetalert-dev.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/sweetalert.css') ?>">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
<link href="<?php echo base_url('assets/css/simple-sidebar.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css_wss/style.css')?>" rel="stylesheet">
<style type="text/css">
    table.dataTable thead>tr>th.sorting_asc,
    table.dataTable thead>tr>th.sorting_desc,
    table.dataTable thead>tr>th.sorting,
    table.dataTable thead>tr>td.sorting_asc,
    table.dataTable thead>tr>td.sorting_desc,
    table.dataTable thead>tr>td.sorting {
      padding-right: 0;
  }

  table.dataTable thead .sorting:after {
    opacity: 0;
    content: "\e150";
  }

  
  .dropdown {
    margin: 10px 0 0 0;
  }

  .btn {
    background-color: #FA9644;
    color: white;
    border: 1px solid white;
    border-radius: 7px;
  }

  .btn:hover {
    background-color: rgb(233, 143, 70);
    color: white;
  }


  div.dataTables_wrapper div.dataTables_length select {

    margin: 0 10px;
  }

  .btn-custome1 {
    background-color: #39c0cc;
    color: white;
    border: 1px solid white;
    border-radius: 7px;
  }

  .btn-custome1:hover {
    background-color: #30a6b1;
    color: white;
  }

  .btn-custome2 {
    background-color: #FA9644;
    color: white;
    border: 1px solid white;
    border-radius: 7px;
  }

  .btn-custome2:hover {
    background-color: rgb(233, 143, 70);
    color: white;
  }
  
  .table {
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(0,0,0,0.15);
  }
</style>


<?php
                          foreach ($Global_Tonase as $data) 
                          {
                            $w = $data->GLOBAL_TONASE;
                            if($w == null)
                            {
                              $a = "0";
                            }else{
                              $a = $w;
                            }
                          }

                          foreach ($WSS_global_Tonnage as $data1) 
                          {
                            $x = $data1->WSS_global_Tonnage;
                            if($x == null)
                            {
                              $b = "0";
                            }else{
                              $b = $x;
                            }
                          }
                          foreach ($Global_Daily as $data) 
                          {
                            $y = $data->WSS_global_Tonnage;
                            $z = $data->Warehouse_Global_Tonnage;
                            if($y == null && $z == null)
                            {
                              $c = "0";
                              $d = "0";
                            }elseif($y != null && $z == null)
                            {
                              $c = $y;
                              $d = "0";
                            }elseif($y == null && $z != null)
                            {
                              $c = "0";
                              $d = $z;
                            }
                            else{
                            $c = $y;
                            $d = $z;
                            }
                          }
 

                    ?>

      

<script type="text/javascript">

$(function () {
    $('#Comparison_Between_Realization_and_Activity').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Comparison Between Realization and Activity'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Comparison Between Realization and Activity',
            data: [
                      <?php
                       echo "['" . "Pending <br> Realization" . "'," . $a ."],\n";
                       echo "['" . "Global <br> Realization" . "'," . $b ."],\n";
                      ?>
            ]
        }]
    });
});



$(function () {
    $('#Comparison_Between_System_WSS_and_Daily_Report').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Comparison Between System WSS and Daily Report'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Comparison Between Realization and Activity',
            data: [
                      <?php
                       echo "['" . "WSS <br> Global <br> Tonnage" . "'," . $c ."],\n";
                       echo "['" . "Warehouse <br> Global <br> Tonnage" . "'," . $d ."],\n";
                       ?>
            ]
        }]
    });
});



 
</script> 






<body>
    <div class="d-flex" id="wrapper">

        <?php $this->load->view('Superuser/templete/sidebar'); ?>

            <div id="page-content-wrapper">

                <?php $this->load->view('Superuser/templete/header'); ?>

                    <div class="container-fluid"> 
                      <div class="content-wrapper">
                        <section class="content">
                          <div class="container-fluid">
                            <div class="row">

                              <div class="col-md-6" style="padding-top: 50px">
                                <div class="card" style="border: none;">
                                  <div class="card-body" style="background-color: #39c0cc1a;">
                                 <div id="Comparison_Between_Realization_and_Activity"></div>
                                 </div>
                                </div>
                              </div>

                              <div class="col-md-6" style="padding-top: 50px">
                                <div class="card" style="border: none;">
                                  <div class="card-body" style="background-color: #39c0cc1a;">
                                 <div id="Comparison_Between_System_WSS_and_Daily_Report"></div>
                                 </div>
                                </div>
                              </div>



                            </div>
                          </div>
                        </section>
                      </div>
                    </div>








            </div>
    </div>



    <!-- <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>     -->
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>

  <script src="<?php echo base_url ('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>







</html>
