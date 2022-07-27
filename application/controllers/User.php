<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

	public function __construct(){
		parent::__construct();
		
	}
	public function index()
	{
		$this->load->view('Admin/signup');
	}
	public function email($emailTo)
	{
		$this->email->from('fahadbuilder31@gmail.com','Fahad');
		$this->email->to($emailTo);
		$this->email->subject("Registration for Buying Property ");
		$this->email->message("Approvall for registeration");
		if(! $this->email->send())
		{
			show_error($this->email->print_debugger());
			echo "Email not send";
		}
		else
		{
			echo "Email has been send";
		}

	}
	public function register()
	{
		$config = [
			'upload_path' =>'./upload/profile_images/',
			'allowed_types' => 'gif|jpg|png',
		];
		$this->upload->initialize($config);
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if($this->form_validation->run('signup') && $this->upload->do_upload('userfile'))
		{
			$data_login = array(
				'user_name' => $this->input->post('username') ,
				'password' => $this->input->post('pass'),
				'full_name' => $this->input->post('fullname'),
				'email' => $this->input->post('email'), 
				'address' => $this->input->post('address'), 
				'contact_no' => $this->input->post('contact'), 
				'user_type' => $this->input->post('usertype'),
				'prof_img_link' => $this->input->post('profilepic')
				);
			$data_image = $this->upload->data();
			$image_path = base_url("upload/profile_images/".$data_image['raw_name'].$data_image['file_ext']);
			$data_login['prof_img_link'] = $image_path;
			$response = $this->USER_Model->do_register($data_login);
			if($response['status']==1)
			{
				$emailTo = $this->input->post('email');
				$this->email($emailTo);
				return redirect('Login/index');
			}
			else
			{	
				return redirect('User/index');
			}
		}
		else
		{
			$upload_error = $this->upload->display_errors();
			$this->load->view('Admin/signup',compact($upload_error));
		}
	}
}
?>