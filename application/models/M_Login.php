<?php
class M_Login extends CI_Model{

	function Auth($Username,$Password){
		$query=$this->db->query("SELECT * FROM tbl_login WHERE Username='$Username' AND Password='$Password' LIMIT 1");
		return $query;
	}
}