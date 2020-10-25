<?php
class M_Search extends CI_Model{
          
    function TD_Legality(){
        return $this->db->get('tbl_legality');
    }
    function AC_Legality($Id_Legality){
        $query = $this->db->query("SELECT  *  FROM tbl_legality WHERE Id_Legality = '$Id_Legality'");
        return $query;
    }    
}
?>
