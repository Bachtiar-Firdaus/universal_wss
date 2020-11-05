<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Search extends CI_Model{
    public function __construct()
    {
        parent::__construct();      
        if($this->session->userdata('Level') == "User"){
        }       
        elseif($this->session->userdata('Level') == "Superuser"){
        }
        elseif($this->session->userdata('Level') == "Administrator"){
        }
        else{
            $url=base_url();
            redirect($url);
        }
    }
    function TD_Legality(){
        $Param = $this->session->userdata('Account_Status');
        $query = $this->db->query("SELECT  *  FROM tbl_legality WHERE Account_Status = '$Param'");
        return $query;
    }          
    function TD_Vehicle(){
        $Param = $this->session->userdata('Account_Status');
        $query = $this->db->query("SELECT  *  FROM tbl_car WHERE Account_Status = '$Param'");
        return $query;
    }     

    function AC_Legality($Id_Legality){
        $Param = $this->session->userdata('Account_Status');
        $query = $this->db->query("SELECT  *  FROM tbl_legality WHERE Id_Legality = '$Id_Legality' AND Account_Status = '$Param'");
        return $query;
    }    
    function AC_Vehicle($Id_Car){
        $Param = $this->session->userdata('Account_Status');
        $query = $this->db->query("SELECT  *  FROM tbl_car WHERE Id_Car = '$Id_Car' AND Account_Status = '$Param'");
        return $query;
    }   
    function AC_Realization($Date_Realization){
        $Param = $this->session->userdata('Account_Status');
        $query = $this->db->query("SELECT  Date_Activities , SUM(Tonase) AS Tonase FROM tbl_activities WHERE Date_Activities = '$Date_Realization' AND Account_Status = '$Param'");
        return $query;
    } 


    function Cetak_Legality($First_Date,$Last_Date){
        $Param = $this->session->userdata('Account_Status');
        if($Param == "Administrator"){
            $query = $this->db->query("SELECT * FROM tbl_legality WHERE Date_Legality between '$First_Date' AND '$Last_Date'ORDER BY Date_Legality ASC");
            return $query->result();
        }else{
            $query = $this->db->query("SELECT * FROM tbl_legality WHERE (Date_Legality between '$First_Date' AND '$Last_Date')  AND Account_Status = '$Param' ORDER BY Date_Legality ASC");
            return $query->result();
        }
    } 

    function Cetak_Activities($First_Date,$Last_Date){
        $Param = $this->session->userdata('Account_Status');
        if($Param == "Administrator"){
            $query = $this->db->query("SELECT * FROM tbl_activities WHERE Date_Activities between '$First_Date' AND '$Last_Date' ORDER BY Date_Activities ASC");
            return $query->result();
        }else{
            $query = $this->db->query("SELECT * FROM tbl_activities WHERE (Date_Activities between '$First_Date' AND '$Last_Date') AND Account_Status = '$Param' ORDER BY Date_Activities ASC");
            return $query->result();
        }
    } 

    function Cetak_Realization($First_Date,$Last_Date){
        $Param = $this->session->userdata('Account_Status');
        if($Param == "Administrator"){
            $query = $this->db->query("SELECT * FROM tbl_realization WHERE Date_Realization between '$First_Date' AND '$Last_Date' ORDER BY Date_Realization ASC");
            return $query->result();
        }else{
            $query = $this->db->query("SELECT * FROM tbl_realization WHERE (Date_Realization between '$First_Date' AND '$Last_Date') AND Account_Status = '$Param' ORDER BY Date_Realization ASC");
            return $query->result();
        }
    } 
    function Cetak_Viat($id){
        $query = $this->db->query("SELECT * FROM tbl_activities WHERE Id_Activities = '$id'");
        return $query->result();
    } 
    function Cek_Vehicle($id){
        $query = $this->db->query("SELECT Id_Car FROM tbl_activities WHERE Id_Activities = '$id'");
        return $query;
    } 
    function Cetak_Car($Id_Car){
        $Param = $this->session->userdata('Account_Status');
        $query = $this->db->query("SELECT * FROM tbl_car WHERE Id_Car = '$Id_Car'");
        return $query->result();
    } 
    function Cek_Legality($id){
        $query = $this->db->query("SELECT Id_Legality FROM tbl_activities WHERE Id_Activities = '$id'");
        return $query;
    } 
    function Cetak_Legality2($Id_Legality){
        $Param = $this->session->userdata('Account_Status');
        if($Param == "Administrator"){
            $query = $this->db->query("SELECT * FROM tbl_legality WHERE Id_Legality = '$Id_Legality'");
            return $query->result();
        }else{
            $query = $this->db->query("SELECT * FROM tbl_legality WHERE Id_Legality = '$Id_Legality' AND Account_Status = '$Param'");
            return $query->result();
        }
    } 
       
    function Cetak_Manage_Accounts(){
        $query = $this->db->query("SELECT * FROM tbl_user ORDER BY Id_User ASC");
        return $query->result();
    }       

    function Get_Global_Tonase(){
        $Param = $this->session->userdata('Account_Status');
        if($Param == "Administrator"){
        $query = $this->db->query("SELECT SUM(TONASE) AS GLOBAL_TONASE FROM tbl_activities WHERE Date_Activities = ''");
        return $query->result();
        }else{
        $query = $this->db->query("SELECT SUM(TONASE) AS GLOBAL_TONASE FROM tbl_activities WHERE Date_Activities = '' AND Account_Status = '$Param'");
        return $query->result();
        }

    }    
    function Get_WSS_Global_Tonage(){
        $Param = $this->session->userdata('Account_Status');
        if($Param == "Administrator"){
        $query = $this->db->query("SELECT SUM(WSS_Daily_Tonnage) as WSS_global_Tonnage FROM tbl_realization");
        return $query->result();
        }else{
        $query = $this->db->query("SELECT SUM(WSS_Daily_Tonnage) as WSS_global_Tonnage FROM tbl_realization WHERE Account_Status = '$Param'");
        return $query->result();
        }

    }   
    function Get_Global_Daily(){
        $Param = $this->session->userdata('Account_Status');
        if($Param == "Administrator"){
        $query = $this->db->query("SELECT SUM(WSS_Daily_Tonnage) as WSS_global_Tonnage, SUM(Warehouse_Daily_Tonnage) as Warehouse_Global_Tonnage FROM tbl_realization");
        return $query->result();
        }else{
        $query = $this->db->query("SELECT SUM(WSS_Daily_Tonnage) as WSS_global_Tonnage, SUM(Warehouse_Daily_Tonnage) as Warehouse_Global_Tonnage FROM tbl_realization WHERE Account_Status = '$Param'");
        return $query->result();
        }

    }

  
}
?>
