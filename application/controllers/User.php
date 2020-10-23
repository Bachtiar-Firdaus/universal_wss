<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Legality');
	}
	public function index()
	{	
		$data['contents'] = 'User/Legality';
		$this->load->view('User/index',$data);
	}

	public function Legality()
	{	
		$data['contents'] = 'User/Legality';
		$this->load->view('User/index',$data);
	}
	public function ajax_list()
	{
		$list = $this->M_Legality->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $M_Legality) {			
            $row[] = $no++;
			$row = array();
            $row[] = $M_Legality->Id_Legality;
            $row[] = $M_Legality->Number;
            $row[] = $M_Legality->Transportir;
            $row[] = $M_Legality->Customer;
            $row[] = $M_Legality->Party;
            $row[] = $M_Legality->Balance;
            $row[] = $M_Legality->Commodity;
            $row[] = $M_Legality->Purpose_of_Unloading;
            $row[] = $M_Legality->Date;
            $row[] = $M_Legality->Id_User;

			//add html for action
			$row[] = '	<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="document_legality('."'".$M_Legality->Id_Legality."'".')"><i class="glyphicon glyphicon-pencil"></i> Dokumen</a>
						<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_legality('."'".$M_Legality->Id_Legality."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  		<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_legality('."'".$M_Legality->Id_Legality."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_Legality->count_all(),
						"recordsFiltered" => $this->M_Legality->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->M_Legality->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$data = array(
				'Number' => $this->input->post('Number'),
				'Transportir' => $this->input->post('Transportir'),
				'Customer' => $this->input->post('Customer'),
				'Party' => $this->input->post('Party'),
				'Balance' => $this->input->post('Balance'),
				'Commodity' => $this->input->post('Commodity'),
				'Purpose_of_Unloading' => $this->input->post('Purpose_of_Unloading'),
				'Date' => date("Y-m-d"),
				'Id_User' => 0,
			);
		$insert = $this->M_Legality->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'Number' => $this->input->post('Number'),
				'Transportir' => $this->input->post('Transportir'),
				'Customer' => $this->input->post('Customer'),
				'Party' => $this->input->post('Party'),
				'Balance' => $this->input->post('Balance'),
				'Commodity' => $this->input->post('Commodity'),
				'Purpose_of_Unloading' => $this->input->post('Purpose_of_Unloading'),
				'Id_User' => 0,
			);
		$this->M_Legality->update(array('Id_Legality' => $this->input->post('Id_Legality')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->M_Legality->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

}



