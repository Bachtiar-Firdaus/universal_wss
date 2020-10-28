<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_Login');
	}

	public function index()
	{
		$this->load->view('Login');
	}

	function Auth()
	{
        $Username=htmlspecialchars($this->input->post('Username',TRUE),ENT_QUOTES);
        $Password=htmlspecialchars($this->input->post('Password',TRUE),ENT_QUOTES);

        $dat=$this->m_login->Auth($Username,$Password);

        if($dat > 0)
        	{ 
        		$data=$dat->row_array();
        		$this->session->set_userdata('masuk',TRUE);
		        if($data['level']=='1'){
		            $this->session->set_userdata('akses','1');
		            $this->session->set_userdata('ses_id',$data['id']);
		            $this->session->set_userdata('ses_nama',$data['Username']);
		            redirect('Login');
       			}if($data['level']=='2'){
		            $this->session->set_userdata('akses','2');
		            $this->session->set_userdata('ses_id',$data['id']);
		            $this->session->set_userdata('ses_nama',$data['Username']);
		            redirect('Login');
       			}else{ 
					$url=base_url();
					echo $this->session->set_flashdata('msg','Username Atau Password Salah !!!');
					redirect('Login');				
	    	    }
	    	}
	}

    function logout(){
        $this->session->sess_destroy();
        $url=base_url('');
        redirect($url);
    }

}
