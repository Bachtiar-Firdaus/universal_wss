<?php
class M_Search extends CI_Model{
          
    function TD_Legality(){
        return $this->db->get('tbl_legality');
    }          
    function TD_Vehicle(){
        return $this->db->get('tbl_car');
    }

    function AC_Legality($Id_Legality){
        $query = $this->db->query("SELECT  *  FROM tbl_legality WHERE Id_Legality = '$Id_Legality'");
        return $query;
    }    
    function AC_Vehicle($Id_Car){
        $query = $this->db->query("SELECT  *  FROM tbl_car WHERE Id_Car = '$Id_Car'");
        return $query;
    }    
}
?>
