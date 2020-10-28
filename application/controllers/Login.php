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

        $field = $this->M_Login->Auth($Username,$Password);

        if($field > 0)
        	{ 
        		$data = $field->row_array();
        		$this->session->set_userdata('masuk',TRUE);
		        if($data['Username'] == $Username && $data['Password'] == $Password){
		            $this->session->set_userdata('Username',$data['Username']);
		            $this->session->set_userdata('Account_Status',$data['Account_Status']);
		            $this->session->set_userdata('Level',$data['Level']);
		            if($data['Level'] == "User"){
		            	redirect('User');
		            }elseif ($data['Level'] == "Superuser") {
		            	redirect('Superuser');
		            }elseif ($data['Level'] == "Administrator") {
		            	redirect('Administrator');
		            }else{
		            	redirect('Login');
		            }
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
