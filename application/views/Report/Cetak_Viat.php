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
            'margin: 0 auto;
            padding-top: 0px;
            padding-bottom: 1px;
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
            border:0px solid #000;
            padding: 1px;
            text-align: left;
            font-size: 13px;
        }
        .td1{
            border:1px solid #000;
            padding: 1px;
            text-align: center;
            font-size: 13px;
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


        p{
            font-size: 12px;
        }

    </style>
    
    
</head>
<body >

<table>
</table>
<h3 style="text-align: center; "><b>FIAT ACTIVITIES</b></h3>
<h3 style="text-align: center; "></h3>
 <?php 

     foreach($Cetak_Legality as $t){
     foreach($Cetak_Car as $s){
     foreach($Cetak_Viat as $r){?>



<table>
    <tr>
        <td style="width: 160px"> ID LEGALITY</td>
        <td style="width: 10px"> :</td>
        <td style="width: 180px"> <?php echo $r->Id_Legality; ?></td>
        <td style="width: 160px"> ID CAR</td>
        <td style="width: 10px"> :</td>
        <td style="width: 180px"> <?php echo $r->Id_Car; ?></td>
     </tr>

    <tr>
        <td> NUMBER</td>
        <td> :</td>
        <td> <?php echo $t->Number; ?></td>
        <td> NUMBER SIM</td>
        <td> :</td>
        <td> <?php echo $s->Number_Sim; ?></td>
    </tr>
    <tr>
        <td> TRANSPORTIR</td>
        <td> :</td>
        <td> <?php echo $t->Transportir; ?></td>
        <td> NUMBER POLICE</td>
        <td> :</td>
        <td> <?php echo $s->Number_Police; ?></td>
    </tr>
    <tr>
        <td> CUSTOMER</td>
        <td> :</td>
        <td> <?php echo $t->Customer; ?></td>        
        <td> NAME</td>
        <td> :</td>
        <td> <?php echo $s->Name; ?></td> 
    </tr>
    <tr>
        <td> PARTY</td>
        <td> :</td>
        <td> <?php echo $t->Party; ?></td>          
        <td> ID ACTIVITIES</td>
        <td> :</td>
        <td> <?php echo $r->Id_Activities; ?></td>       
    </tr>
    <tr>
        <td> COMMODITY</td>
        <td> :</td>
        <td> <?php echo $t->Commodity; ?></td>           
        <td> NUMBER BP</td>   
        <td> :</td>
        <td> <?php echo $r->Number_BP; ?></td>   
    </tr>
    <tr>
        <td> PURPOSE OF UNLOADING</td>
        <td> :</td>
        <td> <?php echo $t->Purpose_of_Unloading; ?></td>             
        <td> TONASE</td>
        <td> :</td>
        <td> <?php echo $r->Tonase; ?></td>         
    </tr>
    <tr>
        <td> DATE LEGALITY</td>
        <td> :</td>
        <td> <?php echo $t->Date_Legality; ?></td>         
        <td> TIME IN</td>  
        <td> :</td>
        <td> <?php echo $r->Time_In; ?></td>    
    </tr>
    <?php }}}?> 
</table>
<table style="padding-top: 30px">      
    <tr>
        <td style="width: 160px" class ="td1">Admin WSS</td>
        <td style="width: 10px" class ="td1"></td>
        <td style="width: 160px" class ="td1">Lead Warehouse</td>         
        <td style="width: 180px" class ="td1">Checker</td>  
        <td style="width: 10px" class ="td1"></td>
        <td style="width: 180px" class ="td1">Driver</td>    
    </tr>  
</table>

<table style="padding-top: 80px">      
    <tr>
        <td style="width: 160px" class ="td1">(__________________)</td>
        <td style="width: 10px" class ="td1"></td>
        <td style="width: 160px" class ="td1">(__________________)</td>         
        <td style="width: 180px" class ="td1">(__________________)</td>  
        <td style="width: 10px" class ="td1"></td>
        <td style="width: 180px" class ="td1">(__________________)</td>    
    </tr>  
</table>
</body>
</html>