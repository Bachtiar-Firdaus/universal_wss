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
			$row = array();
			$row[] = $no++;
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
			$row[] = $M_Legality->Document_Legality;
			$row[] = '<a class="btn btn-sm" href="javascript:void(0)" title="Edit" onclick="edit_legality('."'".$M_Legality->Id_Legality."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_Legality->count_all(),
						"recordsFiltered" => $this->M_Legality->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
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
				'Date' => $this->input->post('Date'),
				'Id_User' => "0",
			);

		if(!empty($_FILES['Document_Legality']['name']))
		{
			$upload = $this->_do_upload();
			$data['Document_Legality'] = $upload;
		}

		$insert = $this->M_Legality->save($data);

		echo json_encode(array("status" => TRUE));
	}


	public function ajax_edit($id)
	{
		$data = $this->M_Legality->get_by_id($id);
		echo json_encode($data);
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
				'Date' => $this->input->post('Date'),
				'Id_User' => "0",
			);

		if($this->input->post('remove_dokumen')) // if remove dokumen checked
		{
			if(file_exists('upload_legality/'.$this->input->post('remove_dokumen')) && $this->input->post('remove_dokumen'))
				unlink('upload_legality/'.$this->input->post('remove_dokumen'));
			$data['Document_Legality'] = '';
		}

		if(!empty($_FILES['Document_Legality']['name']))
		{
			$upload = $this->_do_upload();
			
			//delete file
			$M_Legality = $this->M_Legality->get_by_id($this->input->post('Id_Legality'));
			if(file_exists('upload_legality/'.$M_Legality->Document_Legality) && $M_Legality->Document_Legality)
				unlink('upload_legality/'.$M_Legality->Document_Legality);

			$data['Document_Legality'] = $upload;
		}

		$this->M_Legality->update(array('Id_Legality' => $this->input->post('Id_Legality')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$M_Legality = $this->M_Legality->get_by_id($id);
		if(file_exists('upload_legality/'.$M_Legality->Document_Legality) && $M_Legality->Document_Legality)
			unlink('upload_legality/'.$M_Legality->Document_Legality);
		
		$this->M_Legality->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload()
	{
		$config['upload_path']          = 'upload_legality/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000000; 
        $config['max_width']            = 1000000; 
        $config['max_height']           = 1000000; 
        $config['file_name']            = round(microtime(true) * 1000); 

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('Document_Legality')) 
        {
            $data['inputerror'][] = 'Document_Legality';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); 
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}


}



