<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superuser extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Legality');
		$this->load->model('M_Vehicle');
		$this->load->model('M_Activities');
		$this->load->model('M_Search');
		$this->load->model('M_Realization');
	}
	public function index()
	{	
		$data['contents'] = 'Superuser/Legality';
		$this->load->view('Superuser/index',$data);
	}

	public function Legality()
	{	
		$data['contents'] = 'Superuser/Legality';
		$this->load->view('Superuser/index',$data);
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
			$row[] = $M_Legality->Date_Legality;
			$row[] = $M_Legality->Id_User;
			$row[] = $M_Legality->Document_Legality;

			if($M_Legality->Party <= $M_Legality->Balance){
				$row[] = '<a class="btn btn-sm btn-custome1" href="javascript:void(0)" title="Edit" onclick="edit_legality('."'".$M_Legality->Id_Legality."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
		  				    <a class="btn btn-sm" href="javascript:void(0)" title="Hapus" onclick="delete_legality('."'".$M_Legality->Id_Legality."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
			} else{
				$row[] = '<a class="btn btn-sm btn-custome1" href="javascript:void(0)" title="Edit" onclick="edit_legality('."'".$M_Legality->Id_Legality."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
			}

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
				'Date_Legality' => $this->input->post('Date_Legality'),
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
				'Date_Legality' => $this->input->post('Date_Legality'),
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
		$data['contents'] = 'Superuser/Vehicle';
		$this->load->view('Superuser/index',$data);
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
			$row[] = '<a class="btn btn-sm" href="javascript:void(0)" title="Edit" onclick="edit_vehicle('."'".$M_Vehicle->Id_Car."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
		  			  <a class="btn btn-sm" href="javascript:void(0)" title="Hapus" onclick="delete_vehicle('."'".$M_Vehicle->Id_Car."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
		$data['contents'] = 'Superuser/Activities';
		$this->load->view('Superuser/index',$data);
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

			$row[] = '<a class="btn btn-sm" href="javascript:void(0)" title="Edit" onclick="edit_activities('."'".$M_Activities->Id_Activities."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm" href="javascript:void(0)" title="Cetak Viat" onclick="Cetak_Viat('."'".$M_Activities->Id_Activities."'".')"><i class="glyphicon glyphicon-pencil"></i> Cetak Viat</a></br>
				<a class="btn btn-sm" href="javascript:void(0)" title="Konfirmasi" onclick="edit_konfirmasi_activities('."'".$M_Activities->Id_Activities."'".')"><i class="glyphicon glyphicon-pencil"></i> Konfirmasi</a>
				<a class="btn btn-sm" href="javascript:void(0)" title="Hapus" onclick="delete_activities('."'".$M_Activities->Id_Activities."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

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
				'Date_Activities' => date("Y-m-d"),
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

	public function Realization()
	{	
		$data['record2']=  $this->M_Search->TD_Realization();
		$data['contents'] = 'Superuser/Realization';
		$this->load->view('Superuser/index',$data);
	}	
	public function AC_Realization(){
        $Date_Realization=$_GET['Date_Realization'];
        $AC_Realization =$this->M_Search->AC_Realization($Date_Realization)->result();
        echo json_encode($AC_Realization);
    } 

	public function ajax_list3()
	{
		$list = $this->M_Realization->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $M_Realization) {
			$row = array();
			$row[] = $no++;
			$row[] = $M_Realization->Id_Realization;
			$row[] = $M_Realization->WSS_Daily_Tonnage;
			$row[] = $M_Realization->Warehouse_Daily_Tonnage;
			$row[] = $M_Realization->Information;
			$row[] = $M_Realization->Date_Realization;
			$row[] = $M_Realization->Document_Realization;
			$row[] = $M_Realization->Id_User;
			$row[] = '<a class="btn btn-sm" href="javascript:void(0)" title="Edit" onclick="edit_realization('."'".$M_Realization->Id_Realization."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				<a class="btn btn-sm" href="javascript:void(0)" title="Hapus" onclick="delete_realization('."'".$M_Realization->Id_Realization."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_Realization->count_all(),
						"recordsFiltered" => $this->M_Realization->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_add3()
	{
		$data = array(
				'WSS_Daily_Tonnage' => $this->input->post('WSS_Daily_Tonnage'),
				'Warehouse_Daily_Tonnage' => $this->input->post('Warehouse_Daily_Tonnage'),
				'Information' => $this->input->post('Information'),
				'Date_Realization' => $this->input->post('Date_Realization'),
				'Id_User' => "0",
			);

		if(!empty($_FILES['Document_Realization']['name']))
		{
			$upload = $this->_do_upload3();
			$data['Document_Realization'] = $upload;
		}
		$insert = $this->M_Realization->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit3($id)
	{
		$data = $this->M_Realization->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_update3()
	{
		$data = array(
				'WSS_Daily_Tonnage' => $this->input->post('WSS_Daily_Tonnage'),
				'Warehouse_Daily_Tonnage' => $this->input->post('Warehouse_Daily_Tonnage'),
				'Information' => $this->input->post('Information'),
				'Date_Realization' => $this->input->post('Date_Realization'),
				'Id_User' => "0",
			);

		if($this->input->post('remove_Document_Realization')) // if remove dokumen checked
		{
			if(file_exists('upload_realization/'.$this->input->post('remove_Document_Realization')) && $this->input->post('remove_Document_Realization'))
				unlink('upload_realization/'.$this->input->post('remove_Document_Realization'));
			$data['Document_Realization'] = '';
		}

		if(!empty($_FILES['Document_Realization']['name']))
		{
			$upload = $this->_do_upload3();
			
			//delete file
			$M_Realization = $this->M_Realization->get_by_id($this->input->post('Id_Realization'));
			if(file_exists('upload_realization/'.$M_Realization->Document_Realization) && $M_Realization->Document_Realization)
				unlink('upload_realization/'.$M_Realization->Document_Realization);

			$data['Document_Realization'] = $upload;
		}

		$this->M_Realization->update(array('Id_Realization' => $this->input->post('Id_Realization')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete3($id)
	{
		$M_Realization = $this->M_Realization->get_by_id($id);
		if(file_exists('upload_realization/'.$M_Realization->Document_Realization) && $M_Realization->Document_Realization)
			unlink('upload_realization/'.$M_Realization->Document_Realization);
		
		$this->M_Realization->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	private function _do_upload3()
	{
		$config['upload_path']          = 'upload_realization/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000000; 
        $config['max_width']            = 1000000; 
        $config['max_height']           = 1000000; 
        $config['file_name']            = round(microtime(true) * 1000); 

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('Document_Realization')) 
        {
            $data['inputerror'][] = 'Document_Realization';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); 
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

    public function Cetak_Legality(){     
        $First_Date = $this->input->post('First_Date'); 
        $Last_Date = $this->input->post('Last_Date');  
        $data['Cetak_Legality'] = $this->M_Search->Cetak_Legality($First_Date,$Last_Date);
 	    $this->load->library('pdf');
	    $this->pdf->setPaper('F4', 'potrait');
	    $this->pdf->filename = "laporan-PDF.pdf";
	    $this->pdf->load_view('Report/Report_Legality', $data);
    }
    public function Cetak_Activities(){     
        $First_Date = $this->input->post('First_Date'); 
        $Last_Date = $this->input->post('Last_Date');  
        $data['Cetak_Activities'] = $this->M_Search->Cetak_Activities($First_Date,$Last_Date);
 	    $this->load->library('pdf');
	    $this->pdf->setPaper('F4', 'potrait');
	    $this->pdf->filename = "laporan-PDF.pdf";
	    $this->pdf->load_view('Report/Report_Activities', $data);
    }
    public function Cetak_Realization(){     
        $First_Date = $this->input->post('First_Date'); 
        $Last_Date = $this->input->post('Last_Date');  
        $data['Cetak_Realization'] = $this->M_Search->Cetak_Realization($First_Date,$Last_Date);
 	    $this->load->library('pdf');
	    $this->pdf->setPaper('F4', 'potrait');
	    $this->pdf->filename = "laporan-PDF.pdf";
	    $this->pdf->load_view('Report/Report_Realization', $data);
    }
    public function Cetak_Viat($id){     
        $data['Cetak_Viat'] = $this->M_Search->Cetak_Viat($id);
        $data1 = $this->M_Search->Cek_Vehicle($id);
		$result = $data1->row();
		$Id_Car = $result->Id_Car;
        $data['Cetak_Car'] = $this->M_Search->Cetak_Car($Id_Car);
        $data2 = $this->M_Search->Cek_Legality($id);
		$result2 = $data2->row();
		$Id_Legality = $result2->Id_Legality;
        $data['Cetak_Legality'] = $this->M_Search->Cetak_Legality2($Id_Legality);

 	    $this->load->library('pdf');
	    $this->pdf->setPaper('F4', 'potrait');
	    $this->pdf->filename = "laporan-PDF.pdf";
	    $this->pdf->load_view('Report/Cetak_Viat', $data);
    }


}
