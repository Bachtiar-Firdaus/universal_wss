<!DOCTYPE html>
<html>
<head>
  <title><?=$title?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
   <style>

        table{
            border-collapse: collapse;
            width: 100%;
            'margin: 0 auto;
            padding-top: 1px;
            padding-bottom: 1px;
        }        
        .table1{
            border-collapse: collapse;
            width: 35%;
            'margin: 0 auto;
            padding-top: 1px;
            padding-bottom: 1px;
        }        
        .table2{
            border-collapse: collapse;
            width: 100%;
            'margin: 0 auto;
            padding-top: 1px;
            padding-bottom: 1px;
        }
        .table2 td{
            border: 1px solid white; background-color: white;
            text-align: right;
        }      
        .table1 td{
            border: 1px solid white; background-color: white;
            text-align: left;
        }
        .daus{
            border: 1px solid white; background-color: white;

        }
        h2{
            text-align: center;
        }
        h1{
            text-align: center;
        }
        table th{
            border:1px solid #000;
            padding: 1px;
            font-weight: bold;
            text-align: center;
        }
        table td{
            border:1px solid #000;
            padding: 1px;
            text-align: center;
        }

        #judul{
            font-size: 20px;
            font-weight: bold;
        }

        #tebal2{
            font-weight: bold;
        }

        #tebal{
            border:1px solid #000;
            padding: 3px;
            font-weight: normal;
            text-align: center;
        }

        #garis{
            width: 40%;
            border: 1px solid #000000;
        }
        #nis{
            text-align: left;
        }
        th {
            font-size: 11px;
        }
        td{
            font-size: 11px;
        }
        p{
            font-size: 12px;
        }

    </style>
    
    
</head>
<body >

<table>
</table>
<h3 style="text-align: center; "><b>REPORT ACTIVITIES</b></h3>
<h3 style="text-align: center; "></h3>

<table class="table1">
<tr>
    <td>PERIODE</td>
    <td>:</td>
    <td><?php echo $this->input->post('First_Date')," S/D ",$this->input->post('Last_Date');?></td>
</tr>
</table>

<table class="table2">
    <tr>
    <td style="text-align: right;">KG</td> 
    </tr>
</table>

<table>
     <tr>
        <th>No</th>
        <th>Id Activities</th>
        <th>Number BP</th>
        <th>Tonase</th>
        <th>Time In</th>
        <th>Time Out</th>
        <th>Document Delivery Order</th>
        <th>Document Out</th>
        <th>Id User</th>
        <th>Id Legality</th>
        <th>Id Vehicle</th>
    </tr>

     <?php 
     $no = '1';

     foreach($Cetak_Activities as $r){?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $r->Id_Activities; ?></td>
        <td><?php echo $r->Number_BP; ?></td>
        <td><?php echo $r->Tonase; ?></td>
        <td><?php echo $r->Time_In; ?></td>
        <td><?php echo $r->Time_Out; ?></td>
        <td><?php echo $r->Document_Delivery_Order; ?></td>
        <td><?php echo $r->Document_Out; ?></td>
        <td><?php echo $r->Id_User; ?></td>
        <td><?php echo $r->Id_Legality; ?></td>
        <td><?php echo $r->Id_Car; ?></td>

    </tr>
    <?php }?> 

   

</table>
<!-- 

    <script>
        window.print();
    </script> -->


</body>
</html>