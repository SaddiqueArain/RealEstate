<?php
// 28 functions
defined('BASEPATH') OR exit('No direct script access allowed');
class Property extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in'))
		{
		
			return redirect('Login/index');
		}
		if($this->session->userdata('user_type')!="admin")
		{
			$this->load->view('Partials/header');
			$this->load->view('Client/sidebar');
			$this->load->view('Partials/footer');
		}
		else
		{
			$this->load->view('Partials/header');
			$this->load->view('Admin/sidebar');
			$this->load->view('Partials/footer');
		}
		
		 header('Access-Control-Allow-Origin: *');
	}
	
	public function index() //use
	{
		// for pagination
		$path = 'Property/index';
		$table_name = 'tbl_property';
		$count_rows = $this->PROPERTY_Model->getrows($table_name);
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);

		$data['details'] = $this->PAGINATION_Model->do_propertylist($config['per_page'],$this->uri->segment(3));
		$this->load->view('Property/property',$data);
	}
	public function getcategory()
	{
		$type_id = $this->input->post('type_id');
		echo json_encode($this->PROPERTY_Model->do_getcategory($type_id));
		exit();
	}
	public function getpropowner()
	{
		$propid = $this->input->post('propid');
		echo json_encode($this->PROPERTY_Model->do_getpropowner($propid));
		exit();
	}
	public function getpropertycategory()
	{
		$propid =  $this->input->post('propid');
		echo json_encode($this->PROPERTY_Model->do_propertycategory($propid));
		exit();
	}

	public function insert_property()
	{
		$data['area'] = $this->PROPERTY_Model->do_arealist();
		$data['type'] = $this->PROPERTY_Model->do_typelist();
		$data['owner'] = $this->PROPERTY_Model->do_userlist();
		$data['city'] = $this->PROPERTY_Model->do_citylist();
		$this->load->view('Property/addproperty',$data);
	}
	public function addproperty()
	{
		$config = [
			'upload_path' =>'./upload/property_images/',
			'allowed_types' => 'gif|jpg|png',
		];
		$this->upload->initialize($config);
		$this->upload->do_upload('userfile');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if($this->form_validation->run('addproperty') )
		{
			$data_property = array(
				'prop_name'=> $this->input->post('prop_name') ,
				'prop_status'=> $this->input->post('prop_status') ,
				'prop_area_id'=> $this->input->post('prop_area') ,
				'prop_type_id'=> $this->input->post('prop_type') ,
				'pro_typecat_id'=> $this->input->post('type_category') ,
				'bedrooms'=> $this->input->post('bedrooms') ,
				'bathrooms'=> $this->input->post('bathrooms') ,
				'uid'=> $this->input->post('prop_owner') ,
				'prop_city'=> $this->input->post('prop_city') ,
				'prop_location'=> $this->input->post('prop_location') ,
				'prop_value'=> $this->input->post('prop_value'), 
				'prop_img_link'=> $this->input->post('userfile') 
				);
			$data_image = $this->upload->data();
			$image_path = base_url("upload/property_images/".$data_image['raw_name'].$data_image['file_ext']);
			$data_property['prop_img_link'] = $image_path;
			
			$response = $this->PROPERTY_Model->do_addproperty($data_property);
			if($response['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been inserted');
				$this->session->set_flashdata('msg_class','alert alert-success');
				if($this->session->userdata('user_type')=="admin")
				{
					return redirect('Property/index');
				}
				else if($this->session->userdata('user_type')=="buyer" || $this->session->userdata('user_type')=="seller")
				{
					return redirect('Client/propertylist');
				}
			}
			else
			{	
				
				return redirect('Property/insert_property');
			}
		}
		else
		{
			//$upload_error = $this->upload->display_errors();
			$this->load->view('Property/addproperty');
		}
	}
	public function getPropTypeCategory()
	{
		$type_cat_id = $this->input->post('prop_type_id');
		$response = $this->PROPERTY_Model->do_getPropTypeCategory($type_cat_id);
		echo json_encode($response);
		exit;
	}
	public function delete_property()
	{
		$propid = $this->input->post('propid');
		$response = $this->PROPERTY_Model->do_delete_property($propid);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Delete_Success','Deletion is Successfull');
			$this->session->set_flashdata('msg_class','alert alert-success');
			return redirect('Property/index');
			//$this->load->view('Property/property');
		}
		else
		{
			$this->session->set_flashdata('Delete_Failed','Deletion is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			return redirect('Property/index');
			//$this->load->view('Property/property');
		}
	}
	public function edit_property()
	{
		$propid = $this->input->post('propid');
		$data['area'] = $this->PROPERTY_Model->do_arealist();
		$data['type'] = $this->PROPERTY_Model->do_typelist();
		$data['city'] = $this->PROPERTY_Model->do_citylist();
		$data['category'] = $this->PROPERTY_Model->do_typecategorylist();
		$data['owner'] = $this->PROPERTY_Model->do_userlist();
		$data['specificdetails'] = $this->PROPERTY_Model->do_edit_property($propid);
		$this->load->view('Property/editproperty',$data);
	}
	public function update_property()
	{
		$config = [
			'upload_path' =>'./upload/property_images/',
			'allowed_types' => 'gif|jpg|png',
		];
		$this->upload->initialize($config);
		
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		
			$data_property = array(
				'prop_name'=> $this->input->post('prop_name') ,
				'prop_status'=> $this->input->post('prop_status') ,
				'prop_area_id'=> $this->input->post('prop_area') ,
				'prop_type_id'=> $this->input->post('prop_type') ,
				'uid'=> $this->input->post('prop_owner') ,
				'prop_location'=> $this->input->post('prop_location') ,
				'prop_value'=> $this->input->post('prop_value'), 
				'on_hold'=> $this->input->post('on_hold') 
				);
			if($this->upload->do_upload('userfile'))
			{
				$data_property['prop_img_link'] = $this->input->post('userfile');
				$data_image = $this->upload->data();
				$image_path = base_url("upload/property_images/".$data_image['raw_name'].$data_image['file_ext']);
				$data_property['prop_img_link'] = $image_path;
			}
			else
			{
				$data_property['prop_img_link'] = $this->input->post('getpath');
			}
			$propid = $this->input->post('propid');		
			$response = $this->PROPERTY_Model->do_update_property($data_property,$propid);
			if($response['status']==1)
			{
				$this->session->set_flashdata('Update_Success','Record has been updated');
				$this->session->set_flashdata('msg_class','alert alert-success');
				if($this->session->userdata('user_type')=="admin")
				{
					return redirect('Property/index');
				}
				else if($this->session->userdata('user_type')=="buyer" || $this->session->userdata('user_type')=="seller")
				{
					return redirect('Client/propertylist');
				}
				//$this->load->view('Property/property');
			}
			else
			{	
				$this->session->set_flashdata('Update_Failed','Updation is Failed');
				$this->session->set_flashdata('msg_class','alert alert-danger');
				return redirect('Property/edit_property');
				//$this->load->view('Property/editproperty');
			}
		
	}	
	//   Property Area Methods
	public function propertyarea()
	{
		// for pagination 
		$path = 'Property/propertyarea';
		$table_name = 'tbl_property_area';
		$count_rows = $this->PROPERTY_Model->getrows($table_name);
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);

		$data['details'] = $this->PAGINATION_Model->do_arealist($config['per_page'],$this->uri->segment(3));
		$this->load->view('Property/propertyarea',$data);
	}
	public function insert_property_area()
	{
		$this->load->view('Property/addpropertyarea');
	}
	public function addpropertyarea()
	{
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if($this->form_validation->run('addpropertyarea'))
		{
			$data_property = array(
				'prop_area'=> $this->input->post('prop_area')
				);

			$response = $this->PROPERTY_Model->do_add_propertyarea($data_property);
			if($response['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been inserted');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Property/propertyarea');
			}
			else
			{	
				return redirect('Property/insert_property_area');
			}
		}
		else
		{
			$this->load->view('Property/addpropertyarea');
		}
	}
	public function edit_property_area()
	{
		$prop_area_id = $this->input->post('prop_area_id');
		$data['areadetails'] = $this->PROPERTY_Model->do_edit_property_area($prop_area_id);
		$this->load->view('Property/editpropertyarea',$data);
	}
	public function update_property_area()
	{
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if($this->form_validation->run('addpropertyarea'))
		{
			$data_property = array(
				'prop_area'=> $this->input->post('prop_area') ,
				);
			$prop_area_id = $this->input->post('prop_area_id');		
			$response = $this->PROPERTY_Model->do_update_propertyarea($data_property,$prop_area_id);
			if($response['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been inserted');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Property/propertyarea');
			}
			else
			{	
				return redirect('Property/edit_property_area');
			}
		}
		else
		{
			$this->load->view('Property/editpropertyarea');
		}
	}
	public function delete_property_area()
	{
		$prop_area_id = $this->input->post('prop_area_id');
		$response = $this->PROPERTY_Model->do_delete_propertyarea($prop_area_id);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Delete_Success','Deletion is Successfull');
			$this->session->set_flashdata('msg_class','alert alert-success');
			return redirect('Property/propertyarea');
			//$this->load->view('Property/property');
		}
		else
		{
			$this->session->set_flashdata('Delete_Failed','Deletion is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			return redirect('Property/propertyarea');
			//$this->load->view('Property/property');
		}
	}
	// Property Type Methods
	public function propertytype()
	{
		// for pagination
		$path = 'Property/propertytype';
		$table_name = 'tbl_property_type';
		$count_rows = $this->PROPERTY_Model->getrows($table_name);
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);

		$data['details'] = $this->PAGINATION_Model->do_typelist($config['per_page'],$this->uri->segment(3));
		$this->load->view('Property/propertytype',$data);
	}
	public function insert_property_type()
	{
		$this->load->view('Property/addpropertytype');
	}
	public function addpropertytype()
	{
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if($this->form_validation->run('addpropertytype'))
		{
			$data_property = array(
				'prop_type'=> $this->input->post('prop_type')
				);

			$response = $this->PROPERTY_Model->do_add_propertytype($data_property);
			if($response['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been inserted');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Property/propertytype');
			}
			else
			{	
				return redirect('Property/insert_property_type');
			}
		}
		else
		{
			$this->load->view('Property/addpropertytype');
		}
	}
	public function edit_property_type()
	{
		$prop_type_id = $this->input->post('prop_type_id');
		$data['typedetails'] = $this->PROPERTY_Model->do_edit_property_type($prop_type_id);
		$this->load->view('Property/editpropertytype',$data);
	}
	public function update_property_type()
	{
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if($this->form_validation->run('addpropertytype'))
		{
			$data_property = array(
				'prop_type'=> $this->input->post('prop_type') ,
				);
			$prop_type_id = $this->input->post('prop_type_id');		
			$response = $this->PROPERTY_Model->do_update_propertytype($data_property,$prop_type_id);
			if($response['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been inserted');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Property/propertytype');
			}
			else
			{	
				return redirect('Property/edit_property_type');
			}
		}
		else
		{
			$this->load->view('Property/editpropertytype');
		}
	}
	public function delete_property_type()
	{
		$prop_type_id = $this->input->post('prop_type_id');
		$response = $this->PROPERTY_Model->do_delete_propertytype($prop_type_id);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Delete_Success','Deletion is Successfull');
			$this->session->set_flashdata('msg_class','alert alert-success');
			return redirect('Property/propertytype');
			//$this->load->view('Property/property');
		}
		else
		{
			$this->session->set_flashdata('Delete_Failed','Deletion is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			return redirect('Property/propertytype');
			//$this->load->view('Property/property');
		}
	}
	
	// Type Category Methods
	public function typecategory()
	{
		//for pagination
		$path = 'Property/typecategory';
		$table_name = 'tbl_proptype_category';
		$count_rows = $this->PROPERTY_Model->getrows($table_name);
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);

		$data['details'] =  $this->PAGINATION_Model->do_gettypecat($config['per_page'],$this->uri->segment(3));
		$this->load->view('Property/typecategory',$data);
	}
	public function insert_typecategory()
	{
		$data['type'] = $this->PROPERTY_Model->do_typelist();
		$this->load->view('Property/addtypecategory',$data);
	}
	public function addtypecategory()
	{
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if($this->form_validation->run('addtypecategory'))
		{
			$data_category = array(
				'prop_type_id'=> $this->input->post('prop_type'),
				'category_name'=> $this->input->post('category_name') 
				);

			$response = $this->PROPERTY_Model->do_add_typecategory($data_category);
			if($response['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been inserted');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Property/typecategory');
			}
			else
			{	
				return redirect('Property/insert_typecategory');
			}
		}
		else
		{
			$this->load->view('Property/addtypecategory');
		}
	}
	public function edit_typecategory()
	{
		$pro_typecat_id = $this->input->post('pro_typecat_id');
		$data['type'] = $this->PROPERTY_Model->do_typelist();
		$data['catdetails'] = $this->PROPERTY_Model->do_edit_typecategory($pro_typecat_id);
		$this->load->view('Property/edit-typecategory',$data);
	}
	public function update_typecategory()
	{
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if($this->form_validation->run('addtypecategory'))
		{
			$data_category = array(
				'prop_type_id'=> $this->input->post('prop_type'),
				'category_name'=> $this->input->post('category_name')
				);
			$pro_typecat_id = $this->input->post('pro_typecat_id');		
			$response = $this->PROPERTY_Model->do_update_typecategory($data_category,$pro_typecat_id);
			if($response['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been inserted');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Property/typecategory');
			}
			else
			{	
				return redirect('Property/edit_typecategory');
			}
		}
		else
		{
			$this->load->view('Property/edit-typecategory');
		}
	}
	public function delete_typecategory()
	{
		$type_category_id = $this->input->post('type_category_id');
		$response = $this->PROPERTY_Model->do_delete_typecategory($type_category_id);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Delete_Success','Deletion is Successfull');
			$this->session->set_flashdata('msg_class','alert alert-success');
			return redirect('Property/typecategory');
			//$this->load->view('Property/property');
		}
		else
		{
			$this->session->set_flashdata('Delete_Failed','Deletion is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			return redirect('Property/typecategory');
			//$this->load->view('Property/property');
		}
	} 

}


?>