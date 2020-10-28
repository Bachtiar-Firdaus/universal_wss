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
        $MD5_Password = md5($Password);

        $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
        $secret='6Lfml9wZAAAAAO3XZcIn8w93VMGn2lychM8o891V'; 
        $credential = array(
              'secret' => $secret,
              'response' => $this->input->post('g-recaptcha-response')
          );
        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);
 
        $status= json_decode($response, true);
 
        if($status['success']){ 
        $field = $this->M_Login->Auth($Username,$MD5_Password);
        if($field > 0)
        	{ 
        		$data = $field->row_array();
        		$this->session->set_userdata('masuk',TRUE);
		        if($data['Username'] == $Username && $data['Password'] == $MD5_Password){
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
        }else{
 			$this->session->set_flashdata('message', 'Anda Terdeteksi Bukan Manusia ?');
        }
        redirect('Login');

	}

    function logout(){
        $this->session->sess_destroy();
        $url=base_url('');
        redirect($url);
    }

}
    
 