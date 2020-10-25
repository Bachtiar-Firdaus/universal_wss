<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Legality');
		$this->load->model('M_Vehicle');
		$this->load->model('M_Activities');
		$this->load->model('M_Search');
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





	public function Vehicle()
	{	
		$data['contents'] = 'User/Vehicle';
		$this->load->view('User/index',$data);
	}

	public function ajax_list1()
	{
		$list = $this->M_Vehicle->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $M_Vehicle) {
			$row = array();
			$row[] = $no++;
			$row[] = $M_Vehicle->Id_Car;
			$row[] = $M_Vehicle->Number_Sim;
			$row[] = $M_Vehicle->Number_Police;
			$row[] = $M_Vehicle->Name;
			$row[] = $M_Vehicle->Document_SIM_STNK;
			$row[] = $M_Vehicle->Id_User;
			$row[] = '<a class="btn btn-sm" href="javascript:void(0)" title="Edit" onclick="edit_vehicle('."'".$M_Vehicle->Id_Car."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_Vehicle->count_all(),
						"recordsFiltered" => $this->M_Vehicle->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	public function ajax_add1()
	{
		$data = array(
				'Number_Sim' => $this->input->post('Number_Sim'),
				'Number_Police' => $this->input->post('Number_Police'),
				'Name' => $this->input->post('Name'),
			);

		if(!empty($_FILES['Document_SIM_STNK']['name']))
		{
			$upload = $this->_do_upload1();
			$data['Document_SIM_STNK'] = $upload;
		}

		$insert = $this->M_Vehicle->save($data);

		echo json_encode(array("status" => TRUE));
	}


	public function ajax_edit1($id)
	{
		$data = $this->M_Vehicle->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_update1()
	{
		$data = array(
				'Number_Sim' => $this->input->post('Number_Sim'),
				'Number_Police' => $this->input->post('Number_Police'),
				'Name' => $this->input->post('Name'),
			);

		if($this->input->post('remove_Document_SIM_STNK')) // if remove dokumen checked
		{
			if(file_exists('upload_vehicle/'.$this->input->post('remove_Document_SIM_STNK')) && $this->input->post('remove_Document_SIM_STNK'))
				unlink('upload_vehicle/'.$this->input->post('remove_Document_SIM_STNK'));
			$data['Document_SIM_STNK'] = '';
		}

		if(!empty($_FILES['Document_SIM_STNK']['name']))
		{
			$upload = $this->_do_upload1();
			
			//delete file
			$M_Vehicle = $this->M_Vehicle->get_by_id($this->input->post('Id_Car'));
			if(file_exists('upload_vehicle/'.$M_Vehicle->Document_SIM_STNK) && $M_Vehicle->Document_SIM_STNK)
				unlink('upload_vehicle/'.$M_Vehicle->Document_SIM_STNK);

			$data['Document_SIM_STNK'] = $upload;
		}

		$this->M_Vehicle->update(array('Id_Car' => $this->input->post('Id_Car')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete1($id)
	{
		$M_Vehicle = $this->M_Vehicle->get_by_id($id);
		if(file_exists('upload_vehicle/'.$M_Vehicle->Document_SIM_STNK) && $M_Vehicle->Document_SIM_STNK)
			unlink('upload_vehicle/'.$M_Vehicle->Document_SIM_STNK);
		
		$this->M_Vehicle->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload1()
	{
		$config['upload_path']          = 'upload_vehicle/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000000; 
        $config['max_width']            = 1000000; 
        $config['max_height']           = 1000000; 
        $config['file_name']            = round(microtime(true) * 1000); 

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('Document_SIM_STNK')) 
        {
            $data['inputerror'][] = 'Document_SIM_STNK';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); 
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	
	public function Activities()
	{	
		$data['record1']=  $this->M_Search->TD_Legality(); 
		$data['record2']=  $this->M_Search->TD_Vehicle(); 
		$data['contents'] = 'user/Activities';
		$this->load->view('user/index',$data);
	}	
	public function AC_Legality(){
        $Id_Legality=$_GET['Id_Legality'];
        $AC_Legality =$this->M_Search->AC_Legality($Id_Legality)->result();
        echo json_encode($AC_Legality);
    } 
	public function AC_Vehicle(){
        $Id_Car=$_GET['Id_Car'];
        $AC_Vehicle =$this->M_Search->AC_Vehicle($Id_Car)->result();
        echo json_encode($AC_Vehicle);
    } 
	public function ajax_list2()
	{
		$list = $this->M_Activities->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $M_Activities) {
			$row = array();
			$row[] = $no++;
			$row[] = $M_Activities->Id_Activities;
			$row[] = $M_Activities->Number_BP;
			$row[] = $M_Activities->Tonase;
			$row[] = $M_Activities->Time_In;
			$row[] = $M_Activities->Time_Out;
			$row[] = $M_Activities->Document_Delivery_Order;
			$row[] = $M_Activities->Document_Out;
			$row[] = $M_Activities->Id_User;
			$row[] = $M_Activities->Id_Legality;
			$row[] = $M_Activities->Id_Car;
			$row[] = '<a class="btn btn-sm" href="javascript:void(0)" title="Edit" onclick="edit_activities('."'".$M_Activities->Id_Activities."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a></br><a class="btn btn-sm" href="javascript:void(0)" title="Konfirmasi" onclick="edit_konfirmasi_activities('."'".$M_Activities->Id_Activities."'".')"><i class="glyphicon glyphicon-pencil"></i> Konfirmasi</a>';
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_Activities->count_all(),
						"recordsFiltered" => $this->M_Activities->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}
	public function ajax_add2()
	{
		$data = array(
				'Number_BP' => $this->input->post('Number_BP'),
				'Tonase' => $this->input->post('Tonase'),
				'Time_In' => date("Y-m-d H:i:s"),
				'Time_Out' => " - ",
				'Id_User' => "Otomatis",
				'Id_Legality' => $this->input->post('Id_Legality'),
				'Id_Car' => $this->input->post('Id_Car'),

			);

		if(!empty($_FILES['Document_Delivery_Order']['name']))
		{
			$upload = $this->_do_upload2();
			$data['Document_Delivery_Order'] = $upload;
		}

		$insert = $this->M_Activities->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit2($id)
	{
		$data = $this->M_Activities->get_by_id($id);
		echo json_encode($data);
	}
	public function ajax_update2()
	{
		$data = array(
				'Number_BP' => $this->input->post('Number_BP'),
				'Tonase' => $this->input->post('Tonase'),
				'Id_User' => "Otomatis",
				'Id_Legality' => $this->input->post('Id_Legality'),
				'Id_Car' => $this->input->post('Id_Car'),
			);

		if($this->input->post('remove_Document_Delivery_Order')) // if remove dokumen checked
		{
			if(file_exists('upload_activities/'.$this->input->post('remove_Document_Delivery_Order')) && $this->input->post('remove_Document_Delivery_Order'))
				unlink('upload_activities/'.$this->input->post('remove_Document_Delivery_Order'));
			$data['Document_Delivery_Order'] = '';
		}

		if(!empty($_FILES['Document_Delivery_Order']['name']))
		{
			$upload = $this->_do_upload2();
			
			//delete file
			$M_Activities = $this->M_Activities->get_by_id($this->input->post('Id_Activities'));
			if(file_exists('upload_activities/'.$M_Activities->Document_Delivery_Order) && $M_Activities->Document_Delivery_Order)
				unlink('upload_activities/'.$M_Activities->Document_Delivery_Order);

			$data['Document_Delivery_Order'] = $upload;
		}

		$this->M_Activities->update(array('Id_Activities' => $this->input->post('Id_Activities')), $data);
		echo json_encode(array("status" => TRUE));
	}	

	public function ajax_update_konfirmasi2()
	{
		$data = array(
				'Time_Out' => date("Y-m-d H:i:s"),
			);

		if($this->input->post('remove_Document_Out')) // if remove dokumen checked
		{
			if(file_exists('upload_activities/'.$this->input->post('remove_Document_Out')) && $this->input->post('remove_Document_Delivery_Order'))
				unlink('upload_activities/'.$this->input->post('remove_Document_Out'));
			$data['Document_Out'] = '';
		}

		if(!empty($_FILES['Document_Out']['name']))
		{
			$upload = $this->_do_upload_konfirmasi2();
			
			//delete file
			$M_Activities = $this->M_Activities->get_by_id($this->input->post('Id_Activities'));
			if(file_exists('upload_activities/'.$M_Activities->Document_Out) && $M_Activities->Document_Out)
				unlink('upload_activities/'.$M_Activities->Document_Out);

			$data['Document_Out'] = $upload;
		}

		$this->M_Activities->update(array('Id_Activities' => $this->input->post('Id_Activities')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete2($id)
	{
		$M_Activities = $this->M_Activities->get_by_id($id);
		if(file_exists('upload_activities/'.$M_Activities->Document_Delivery_Order) && $M_Activities->Document_Delivery_Order)
			unlink('upload_activities/'.$M_Activities->Document_Delivery_Order);
		
		$this->M_Activities->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	private function _do_upload2()
	{
		$config['upload_path']          = 'upload_activities/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000000; 
        $config['max_width']            = 1000000; 
        $config['max_height']           = 1000000; 
        $config['file_name']            = round(microtime(true) * 1000); 

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('Document_Delivery_Order')) 
        {
            $data['inputerror'][] = 'Document_Delivery_Order';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); 
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}	
	private function _do_upload_konfirmasi2()
	{
		$config['upload_path']          = 'upload_activities/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000000; 
        $config['max_width']            = 1000000; 
        $config['max_height']           = 1000000; 
        $config['file_name']            = round(microtime(true) * 1000); 

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('Document_Out')) 
        {
            $data['inputerror'][] = 'Document_Out';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); 
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

}



