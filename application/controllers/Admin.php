<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller{
	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('logged_in'))
		{
		
			return redirect('Login/index');
		}
		$this->load->view('Partials/header');
		$this->load->view('Admin/sidebar');
		$this->load->view('Partials/footer');
		 header('Access-Control-Allow-Origin: *');


	}
	// Dashboard charts or calculations
	public function index()
	{
		// users that are approved
		$data['total_users'] = count($this->PAGINATION_Model->do_userlist());
		$data['request_users'] = count($this->PAGINATION_Model->do_approvals());
		$data['total_sellers'] = count($this->BOOKING_Model->getsellername());
		$data['total_buyers'] = count($this->BOOKING_Model->getbuyername());
		$data['total_brokers'] = count($this->BOOKING_Model->getbrokername());
		$data['total_engineers'] = count($this->ADMIN_Model->getengineername());

		$data['total_properties_forsale'] = count($this->HOME_Model->propertyforsale());
		$data['total_properties_forrent'] = count($this->HOME_Model->propertyforrent());
		$data['total_properties_oninstallment'] = count($this->LIST_Model->getproperty_oninstallment());
		$data['total_properties_onrent'] = count($this->LIST_Model->getproperty_onrent());
		$data['total_properties_sold'] = count($this->LIST_Model->getproperty_sold());

		$data['total_bookings'] = count($this->PAGINATION_Model->getbooking());//is_approved
		
		//$data['total_completed_projects'] = count($this->LIST_Model->do_approvals());
		//$data['total_ongoing_projects'] = count($this->LIST_Model->do_approvals());
		$this->load->view('Admin/dashboard',$data);	
	}
	// User information
	public function userlist()
	{
		// for pagination
		$path = 'Admin/userlist';
		$count_rows = count($this->PAGINATION_Model->do_userlist());
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);
		
		$data['user'] = $this->ADMIN_Model->do_userlist($config['per_page'],$this->uri->segment(3));
		$this->load->view('Admin/users',$data);
	}
	public function adduser()
	{
		$this->load->view('Admin/adduser');
	}
	public function insert_user()
	{
		$config = [
			'upload_path' =>'./upload/profile_images/',
			'allowed_types' => 'gif|jpg|png',
		];
		
		$this->upload->initialize($config);
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if($this->form_validation->run('addusers') && $this->upload->do_upload('userfile'))
		{
			$data_user = array(
				'user_name' => $this->input->post('user_name') ,
				'user_type' => $this->input->post('user_type'),
				'full_name' => $this->input->post('full_name'),
				'email' => $this->input->post('email'), 
				'address' => $this->input->post('address'), 
				'contact_no' => $this->input->post('contact_no'), 
				'is_approved' => '1' 
				);
			$data_image = $this->upload->data();
			$image_path = base_url("upload/profile_images/".$data_image['raw_name'].$data_image['file_ext']);
			$data_user['prof_img_link'] = $image_path;
			
			
			$response = $this->ADMIN_Model->do_adduser($data_user);
			if($response['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been inserted');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Admin/userlist');
			}
			else
			{	

				$this->session->set_flashdata('Insert_Failed','Insertion Failed');
				$this->session->set_flashdata('msg_class','alert alert-danger');
				return redirect('Admin/adduser');
			}
		}
		else
		{
			$upload_error = $this->upload->display_errors();
			$this->load->view('Admin/adduser',compact($upload_error));
		}
	}
	public function edit_user()
	{
		$uid = $this->input->post('uid');
		$data['userdetails'] = $this->ADMIN_Model->do_edituser($uid);
		$this->load->view('Admin/edituser',$data);
	}
	public function update_user()
	{
		$data_user = array(
			'user_name' => $this->input->post('user_name') ,
			'user_type' => $this->input->post('user_type'),
			'full_name' => $this->input->post('full_name'),
			'email' => $this->input->post('email'), 
			'address' => $this->input->post('address'), 
			'contact_no' => $this->input->post('contact_no'), 
			'is_approved' => $this->input->post('is_approved') 
			);
		if($this->upload->do_upload('userfile'))
		{
			$data_user['prof_img_link'] = $this->input->post('userfile');
			$data_image = $this->upload->data();
			$image_path = base_url("upload/property_images/".$data_image['raw_name'].$data_image['file_ext']);
			$data_user['prof_img_link'] = $image_path;
		}
		else
		{
			$data_user['prof_img_link'] = $this->input->post('getpath');
		}
		$uid = $this->input->post('uid');
		$response = $this->ADMIN_Model->do_updateuser($data_user,$uid);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Update_Success','Record has been updated');
			$this->session->set_flashdata('msg_class','alert alert-success');
			return redirect('Admin/userlist');
		}
		else
		{	

			$this->session->set_flashdata('Update_Failed','Updation Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			return redirect('Admin/edit_user');
		}
		
	}
	// User Request for approvals
	public function userapprovals()
	{
		// fro pagination 
		$path = 'Admin/userapprovals';
		$count_rows = count($this->PAGINATION_Model->do_approvals());
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);
		$data['approvals'] = $this->ADMIN_Model->do_approvals($config['per_page'],$this->uri->segment(3));
		$this->load->view('Admin/userapprovals',$data);
	}
	public function approved_user()
	{
		$uid = $this->input->post('uid');
		$data_approved = array('is_approved' => '1');
		$response = $this->ADMIN_Model->do_approved_users($data_approved,$uid);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Approve_Success','User is Approved');
			$this->session->set_flashdata('msg_class','alert alert-success');
			//return redirect('Admin/dashboard');
			$this->load->view('Admin/userapprovals');
		}
		else
		{
			$this->session->set_flashdata('Approve_Failed','Approval is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			//return redirect('Admin/dashboard');
			$this->load->view('Admin/userapprovals');
			//$this->load->view('Admin/Property/property');
		}	
	}
	public function rejected_user()
	{
		$uid = $this->input->post('uid');
		$response = $this->ADMIN_Model->do_rejected_users($uid);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Reject_Success','User Rejection is Success');
			$this->session->set_flashdata('msg_class','alert alert-success');
			//return redirect('Admin/userlist');
			$this->load->view('Admin/userapprovals');
		}
		else
		{
			$this->session->set_flashdata('Reject_Failed','Rejection is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			//return redirect('Admin/dashboard');
			$this->load->view('Admin/userapprovals');
			//$this->load->view('Admin/Property/property');
		}
	}
	public function bookingapprovals()
	{
		$path = 'Admin/bookingapprovals';
		$count_rows = count($this->PAGINATION_Model->do_bookingapprovals());
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);
		$data['seller'] = $this->BOOKING_Model->getsellername();
		$data['broker'] = $this->BOOKING_Model->getbrokername();
		$data['approvals'] = $this->ADMIN_Model->do_bookingapprovals($config['per_page'],$this->uri->segment(3));
		$this->load->view('Admin/bookingapprovals',$data);	
	}
	public function rejected_booking()
	{
		$book_id = $this->input->post('book_id');
		$propid = $this->input->post('propid');
		$response = $this->ADMIN_Model->do_rejected_bookings($book_id,$propid);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Reject_Success','Booking Rejection of property is Success');
			$this->session->set_flashdata('msg_class','alert alert-success');
			//return redirect('Admin/bookingapprovals');
			if($this->session->userdata('user_type')=="admin")
			{
				return redirect('Admin/bookingapprovals');
			}
			elseif ($this->session->userdata('user_type')=="buyer") 
			{
				return redirect('Client/pendingbooking');
			}
			
		}
		else
		{
			$this->session->set_flashdata('Reject_Failed','Rejection is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			//return redirect('Admin/bookingapprovals');
			if($this->session->userdata('user_type')=="admin")
			{
				return redirect('Admin/bookingapprovals');
			}
			elseif ($this->session->userdata('user_type')=="buyer") 
			{
				return redirect('Client/pendingbooking');
			}
			//$this->load->view('Admin/Property/property');
		}
	}
	 
	public function propertyapprovals()
	{
		$path = 'Admin/propertyapprovals';
		$count_rows = count($this->PAGINATION_Model->do_propertyapprovals());
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);
		$data['approvals'] = $this->ADMIN_Model->do_propertyapprovals($config['per_page'],$this->uri->segment(3));
		$this->load->view('Admin/propertyapprovals',$data);	
	}
	public function approved_property()
	{
		$propid = $this->input->post('propid');
		$data_approved = array('is_approved' => '1');
		$response = $this->ADMIN_Model->do_approved_property($data_approved,$propid);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Approve_Success','User is Approved');
			$this->session->set_flashdata('msg_class','alert alert-success');
			//return redirect('Admin/dashboard');
			$this->load->view('Admin/propertyapprovals');
		}
		else
		{
			$this->session->set_flashdata('Approve_Failed','Approval is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			//return redirect('Admin/dashboard');
			$this->load->view('Admin/propertyapprovals');
			//$this->load->view('Admin/Property/property');
		}	
	}
	public function rejected_property()
	{
		$propid = $this->input->post('propid');
		$response = $this->ADMIN_Model->do_rejected_property($propid);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Reject_Success','User Rejection is Success');
			$this->session->set_flashdata('msg_class','alert alert-success');
			//return redirect('Admin/userlist');
			$this->load->view('Admin/propertyapprovals');
		}
		else
		{
			$this->session->set_flashdata('Reject_Failed','Rejection is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			//return redirect('Admin/dashboard');
			$this->load->view('Admin/propertyapprovals');
			//$this->load->view('Admin/Property/property');
		}
	}
	public function messages()
	{
		$path = 'Admin/messages';
		$count_rows = count($this->PAGINATION_Model->do_messages());
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);
		$data['message'] = $this->ADMIN_Model->do_messages($config['per_page'],$this->uri->segment(3));
		$this->load->view('Admin/messages',$data);
	}
	public function view_message()
	{
		$contact_us_id = $this->input->post('contact_us_id');
		$data['messages'] = $this->ADMIN_Model->getmessage($contact_us_id);
		$this->load->view('Admin/view_message',$data);
	}
	public function reply_message()
	{
		$contact_us_id = $this->input->post('contact_us_id');
		$email = $this->input->post('email');
		$subject = $this->input->post('subject');
		$message = $this->input->post('reply');
		$this->email->from('fahadbuilder31@gmail.com','Fahad');
		$this->email->to($email);
		$this->email->subject("Reply of ".$subject);
		$this->email->message($message);
		if(! $this->email->send())
		{
			$this->session->set_flashdata('Reply_Failed','Message Reply is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			return redirect('Admin/messages');
			//echo "Email not send";
		}
		else
		{
			// "Email has been send";
			$this->session->set_flashdata('Reply_Success','Message Reply is Success');
			$this->session->set_flashdata('msg_class','alert alert-success');
			return redirect('Admin/messages');
		}
		
	}
	public function delete_message()
	{
		$contact_us_id = $this->input->post('contact_us_id');
		$response = $this->ADMIN_Model->do_delete_message($contact_us_id);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Delete_Success','Message Deletion is Success');
			$this->session->set_flashdata('msg_class','alert alert-success');
			//return redirect('Admin/userlist');
			$this->load->view('Admin/messages');
		}
		else
		{
			$this->session->set_flashdata('Delete_Failed','Message Deletion is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			//return redirect('Admin/dashboard');
			$this->load->view('Admin/messages');
			//$this->load->view('Admin/Property/property');
		}
	}
	// Material
	public function request_material()
	{
		$data['demand'] = $this->MATERIAL_Model->get_MaterialDemand();
		$data['material'] = $this->MATERIAL_Model->materialType();
		//echo json_encode($data);
		//exit();
		$this->load->view('Admin/material_request',$data);	
	}
}


?>