<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{

	public function __construct(){
		parent::__construct();
	
	}
	public function index()
	{
		if($this->session->userdata('logged_in'))
		{
			if($this->session->userdata('user_type')=="admin")
			{
				return redirect('Admin/index');
			}
			else if($this->session->userdata('user_type')=="buyer")
			{
				return redirect('Buyer/index');
			}
			
			
		}
			$this->load->view('Admin/login');	
	}

	public function is_validate()
	{
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		
		if($this->form_validation->run('logincheck'))
		{
			$username = $this->input->post('username');
			$password = $this->input->post('pass');

			// model of login will be load here from autoload
			$response = $this->LOGIN_Model->isvalidate($username,$password);
			if($response['status']==1)
			{
				$newdata = array(
					'uid' =>$response['user_id'] ,
					'email'=>$response['email'],
					'full_name'=>$response['fullname'],
					'user_type'=>$response['usertype'],
					'prof_image'=>$response['prof_img_link'],
					'logged_in' => TRUE
					 );
				$this->session->set_userdata($newdata);
			
				if($response['usertype']=='admin')
				{
					return redirect ('Admin/index');

				}
				else if ($response['usertype']=='buyer')
				{
					return redirect ('Home/index');

				}
				else if ($response['usertype']=='seller')
				{
					return redirect ('Client/index');

				}
			}
			else
			{
				$this->session->set_flashdata('Login_Failed','Invalid Username or password');
				$this->session->set_flashdata('msg_class','alert-danger');
				return redirect ('Login/index');
				//echo "failed";
			}
		}
		else
		{
			$this->load->view('Admin/login');
		}

	}
	public function logout()
	{
		if($this->session->userdata('user_type')=="admin")
		{
			$this->session->sess_destroy();
			return redirect('Login/index');
		}
		else if($this->session->userdata('user_type')=="buyer")
		{
			$this->session->sess_destroy();
			return redirect('Home/index');
		}
		else if($this->session->userdata('user_type')=="seller")
		{
			$this->session->sess_destroy();
			return redirect('Login/index');
		}
		
	}
}


?>