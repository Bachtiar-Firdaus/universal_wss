<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Legality');
		$this->load->model('M_Vehicle');
		$this->load->model('M_Activities');
		$this->load->model('M_Search');
		$this->load->model('M_Realization');
		$this->load->model('M_Manage_Accounts');
	}
	
	public function index()
		{	
			$data['contents'] = 'Administrator/Dashboard';
			$this->load->view('Administrator/index',$data);
		}	
	public function Manage_Accounts()
		{	
			$data['contents'] = 'Administrator/Manage_Accounts';
			$this->load->view('Administrator/index',$data);
		}

	public function ajax_list_Manage_Accounts()
	{
		$list = $this->M_Manage_Accounts->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $M_Manage_Accounts) {
			$row = array();
			$row[] = $no++;
			$row[] = $M_Manage_Accounts->Id_User;
			$row[] = $M_Manage_Accounts->Username;
			$row[] = $M_Manage_Accounts->Password;
			$row[] = $M_Manage_Accounts->Account_Status;
			$row[] = $M_Manage_Accounts->Level;
			$row[] = '<a class="btn btn-sm btn-custome1" href="javascript:void(0)" title="Edit" onclick="edit_manage_accounts('."'".$M_Manage_Accounts->Id_User."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_Manage_Accounts->count_all(),
						"recordsFiltered" => $this->M_Manage_Accounts->count_filtered(),
						"data" => $data,
				);
		echo json_encode($output);
	}

	public function ajax_edit_Manage_Accounts($id)
	{
		$data = $this->M_Manage_Accounts->get_by_id($id);
		echo json_encode($data);
	}

	public function Legality()
	{	
		$data['contents'] = 'Administrator/Legality';
		$this->load->view('Administrator/index',$data);
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
			$row[] = '<a class="btn btn-sm btn-custome1" href="javascript:void(0)" title="View" onclick="view_legality('."'".$M_Legality->Id_Legality."'".')"><i class="glyphicon glyphicon-pencil"></i> View</a>';
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


	public function ajax_edit($id)
	{
		$data = $this->M_Legality->get_by_id($id);
		echo json_encode($data);
	}

	public function Vehicle()
	{	
		$data['contents'] = 'Administrator/Vehicle';
		$this->load->view('Administrator/index',$data);
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
			$row[] = '<a class="btn btn-sm btn-custome1" href="javascript:void(0)" title="View" onclick="view_vehicle('."'".$M_Vehicle->Id_Car."'".')"><i class="glyphicon glyphicon-pencil"></i> View</a>';
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

	public function ajax_edit1($id)
	{
		$data = $this->M_Vehicle->get_by_id($id);
		echo json_encode($data);
	}

	public function Activities()
	{	
		$data['contents'] = 'Administrator/Activities';
		$this->load->view('Administrator/index',$data);
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

			$row[] = '<a class="btn btn-sm" href="javascript:void(0)" title="View" onclick="view_activities('."'".$M_Activities->Id_Activities."'".')"><i class="glyphicon glyphicon-pencil"></i> View</a></br>

				<a class="btn btn-sm" href="javascript:void(0)" title="View Viat" onclick="Cetak_Viat('."'".$M_Activities->Id_Activities."'".')"><i class="glyphicon glyphicon-pencil"></i> View Viat</a></br>

				<a class="btn btn-sm" href="javascript:void(0)" title="View Konfirmasi" onclick="edit_konfirmasi_activities('."'".$M_Activities->Id_Activities."'".')"><i class="glyphicon glyphicon-pencil"></i> View Konfirmasi</a>';
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

	public function ajax_edit2($id)
	{
		$data = $this->M_Activities->get_by_id($id);
		echo json_encode($data);
	}
	public function Realization()
	{	
		$data['contents'] = 'Administrator/Realization';
		$this->load->view('Administrator/index',$data);
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
			$row[] = '<a class="btn btn-sm btn-custome1" href="javascript:void(0)" title="View" onclick="edit_realization('."'".$M_Realization->Id_Realization."'".')"><i class="glyphicon glyphicon-pencil"></i> View</a>';
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

	public function ajax_edit3($id)
	{
		$data = $this->M_Realization->get_by_id($id);
		echo json_encode($data);
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
