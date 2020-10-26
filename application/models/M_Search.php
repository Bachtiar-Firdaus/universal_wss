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
}
?>
