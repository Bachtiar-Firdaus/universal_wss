<?php
class M_Search extends CI_Model{
          
    function TD_Legality(){
        return $this->db->get('tbl_legality');
    }          
    function TD_Vehicle(){
        return $this->db->get('tbl_car');
    }     
    function TD_Realization(){
        $query = $this->db->query("SELECT Date_Activities FROM tbl_activities LEFT OUTER JOIN tbl_realization ON tbl_activities.Date_Activities = tbl_realization.Date_Realization WHERE tbl_realization.Date_Realization IS null GROUP BY Date_Activities");
        return $query;
    }

    function AC_Legality($Id_Legality){
        $query = $this->db->query("SELECT  *  FROM tbl_legality WHERE Id_Legality = '$Id_Legality'");
        return $query;
    }    
    function AC_Vehicle($Id_Car){
        $query = $this->db->query("SELECT  *  FROM tbl_car WHERE Id_Car = '$Id_Car'");
        return $query;
    }   
    function AC_Realization($Date_Realization){
        $query = $this->db->query("SELECT  Date_Activities , SUM(Tonase) AS Tonase FROM tbl_activities WHERE Date_Activities = '$Date_Realization'");
        return $query;
    } 


    function Cetak_Legality($First_Date,$Last_Date){
        $query = $this->db->query("SELECT * FROM tbl_legality WHERE Date_Legality between '$First_Date' AND '$Last_Date' ORDER BY Date_Legality DESC");
        return $query->result();
    } 

    function Cetak_Activities($First_Date,$Last_Date){
        $query = $this->db->query("SELECT * FROM tbl_activities WHERE Date_Activities between '$First_Date' AND '$Last_Date' ORDER BY Date_Activities DESC");
        return $query->result();
    } 

    function Cetak_Realization($First_Date,$Last_Date){
        $query = $this->db->query("SELECT * FROM tbl_realization WHERE Date_Realization between '$First_Date' AND '$Last_Date' ORDER BY Date_Realization DESC");
        return $query->result();
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
        $query = $this->db->query("SELECT * FROM tbl_car WHERE Id_Car = '$Id_Car'");
        return $query->result();
    } 
    function Cek_Legality($id){
        $query = $this->db->query("SELECT Id_Legality FROM tbl_activities WHERE Id_Activities = '$id'");
        return $query;
    } 
    function Cetak_Legality2($Id_Legality){
        $query = $this->db->query("SELECT * FROM tbl_legality WHERE Id_Legality = '$Id_Legality'");
        return $query->result();
    } 
       
    function Cetak_Manage_Accounts(){
        $query = $this->db->query("SELECT * FROM tbl_user ORDER BY Id_User DESC");
        return $query->result();
    }
}
?>
