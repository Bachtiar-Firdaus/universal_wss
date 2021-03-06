<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Legality extends CI_Model {

	var $table = 'tbl_legality';
	var $column_order = array('Id_Legality','Number','Transportir','Customer','Party','Balance','Commodity','Purpose_of_Unloading','Date_Legality','Account_Status','Document_Legality',null); 
	var $column_search = array('Id_Legality','Number','Transportir','Customer','Party','Balance','Commodity','Purpose_of_Unloading','Document_Legality','Date_Legality','Account_Status');
	var $order = array('Id_Legality' => 'desc'); 

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
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);
		if($this->session->userdata('Account_Status') == "Administrator"){
		}else{
		$this->db->like('Account_Status', $this->session->userdata('Account_Status'));
		}
		$i = 0;
	
		foreach ($this->column_search as $item)
		{
			if($_POST['search']['value'])
			{
				
				if($i===0) 
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) 
					$this->db->group_end(); 
			}
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('Id_Legality',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('Id_Legality', $id);
		$this->db->delete($this->table);
	}


}
