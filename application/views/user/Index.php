<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Warehouse Security System</title>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dist/sweetalert.css') ?>">

    <script type="text/javascript" src="<?php echo base_url('assets/dist/sweetalert.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/dist/sweetalert-dev.js') ?>"></script>

  <!-- icon link -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url('assets/css/simple-sidebar.css') ?>" rel="stylesheet">

  <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
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

  <!-- <style type="text/css">

    .dropdown-item:hover{
      background-color: #35B8C4;
    }

    .list-group-item:hover{
      background-color: red;
    }

    #copyright{
    bottom: 0;
    width: 100%;
    position: fixed;
    height:70px;
    line-height:50px;
    background:#F5F5F5;
    color:#666666;
    padding-left: 10px;
  }
  </style> -->

</head>

<body>

  <div class="d-flex" id="wrapper">


    <!-- Sidebar -->
    <?php $this->load->view('user/templete/sidebar'); ?>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">


      <!-- header -->
      <?php $this->load->view('user/templete/header'); ?>
      <!-- #header -->

      <div class="container-fluid"> 
        <!-- <h1>dayat</h1> -->
        <?php $this->load->view($contents); ?>
      </div>


      <!-- <?php $this->load->view('user/templete/footer'); ?> -->


    </div>

   

    
    <!-- /#page-content-wrapper -->

  </div>


  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <!-- <script src="<?php echo base_url ('assets/vendor/jquery/jquery.min.js') ?>"></script> -->
  

<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>    
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
