<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Project extends CI_Controller{
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
	public function abc()
	{
		$this->load->view('Project/abc');
	}
	public function index()
	{
		$path = 'Project/index';
		$count_rows = count($this->PAGINATION_Model->do_projectlist());
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);
		
		$data['details'] = $this->PROJECT_Model->do_projectlist($config['per_page'],$this->uri->segment(3));
		$this->load->view('Project/projects',$data);
	}
	public function project_details()
	{
		$project_id = $this->input->post('project_id');
		$data['project'] = $this->PROJECT_Model->getproject($project_id);
		$data['files'] = $this->PROJECT_Model->getfiles($project_id);
		$data['engineer'] = $this->PROJECT_Model->getprojectengineers($project_id);
		$this->load->view('Project/project_details',$data);
	}
	public function addproject()
	{
		$data['owner'] = $this->PROJECT_Model->getownerlist();
		$data['engineer'] = $this->PROJECT_Model->getengineerlist();
		$data['type'] = $this->PROJECT_Model->getproject_typelist();
		$data['city'] = $this->PROPERTY_Model->do_citylist();
		$this->load->view('Project/addproject',$data);
	}
	public function insert_project()
	{
		$config = [
			'upload_path' =>'./upload/project_images/',
			'allowed_types' => 'gif|jpg|png',
		];
		$this->upload->initialize($config);
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if($this->form_validation->run('addproject') && $this->upload->do_upload('userfile'))
		{
			$data_project = array(
				'project_title' => $this->input->post('project_title') ,
				'status' => $this->input->post('status'),
				'owner_id' => $this->input->post('owner_id'),
				'project_type_id' => $this->input->post('project_type_id'),
				'project_description' => $this->input->post('project_description'), 
				'location' => $this->input->post('location'), 
				'city' => $this->input->post('city'), 
				'price' => $this->input->post('price') 
				);
				
			$data_image = $this->upload->data();
			$image_path = base_url("upload/project_images/".$data_image['raw_name'].$data_image['file_ext']);
			$data_project['proj_img_link'] = $image_path;
			$multiple = $this->PROJECT_Model->do_addproject($data_project,'file',array(

			'upload_path' =>'upload/project_files/',
			'allowed_types' => 'gif|jpg|png|pdf|doc|docx|ppt'
			));
			
			if($multiple['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been inserted');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Project/index');
			}
			else
			{	

				$this->session->set_flashdata('Insert_Failed','Insertion Failed');
				$this->session->set_flashdata('msg_class','alert alert-danger');
				return redirect('Project/addproject');
			}
		}
		else
		{
			$data['owner'] = $this->PROJECT_Model->getownerlist();
			$data['engineer'] = $this->PROJECT_Model->getengineerlist();
			$this->load->view('Project/addproject',$data);
		}

	}
	public function edit_project()
	{
		$project_id = $this->input->post('project_id');
		$data['project'] = $this->PROJECT_Model->getproject($project_id);
		$data['owner'] = $this->PROJECT_Model->getownerlist();
		$data['type'] = $this->PROJECT_Model->getproject_typelist();
		$data['city'] = $this->PROPERTY_Model->do_citylist();
		$this->load->view('Project/edit_project',$data);
	}
	public function update_project()
	{
		$project_id = $this->input->post('project_id');
		$data_project = array(
				'project_title' => $this->input->post('project_title') ,
				'status' => $this->input->post('status'),
				'owner_id' => $this->input->post('owner_id'),
				'project_type_id' => $this->input->post('project_type_id'),
				'project_description' => $this->input->post('project_description') ,
				'completion_date' => $this->input->post('complete_date'),
				'location' => $this->input->post('location'), 
				'city' => $this->input->post('city'), 
				'price' => $this->input->post('price')  
				);
				
			$response = $this->PROJECT_Model->do_updateproject($data_project,$project_id);
			
			if($response['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been updated');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Project/index');
			}
			else
			{	

				$this->session->set_flashdata('Insert_Failed','Updation Failed');
				$this->session->set_flashdata('msg_class','alert alert-danger');
				return redirect('Project/edit_project');
			}
	}

	public function delete_project_file()
	{
		$file_id = $this->input->post('file_id');
		echo json_encode($this->PROJECT_Model->do_delete_file($file_id));
	}
	public function delete_project_engineer()
	{
		$project_eng_id = $this->input->post('project_eng_id');
		echo json_encode($this->PROJECT_Model->do_delete_engineer($project_eng_id));
	}
	public function delete_project()
	{
		$project_id = $this->input->post('project_id');
		$response = $this->PROJECT_Model->do_delete_project($project_id);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Delete_Success','Deletion is Successfull');
			$this->session->set_flashdata('msg_class','alert alert-success');
			return redirect('Project/index');
			
		}
		else
		{
			$this->session->set_flashdata('Delete_Failed','Deletion is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			return redirect('Project/index');
			
		}
	}
	public function add_engineer()
	{
		//$project_id = '4';
		$data['engineer'] = $this->PROJECT_Model->getengineerlist();
		$data['project'] = $this->PROJECT_Model->getProjectlist();
		$this->load->view('Project/addengineers',$data);
	}
	
	public function insert_project_engineer()
	{
		$data_engineer = array(
					'project_id' => $this->input->post('project_name')
				);
		$response = $this->PROJECT_Model->addproject_engineers($data_engineer);
		
		if($response['status']==1)
		{
			//echo json_encode($response['message']);
			//exit();
			$this->session->set_flashdata('Insert_Success',$response['message']);
			$this->session->set_flashdata('msg_class','alert alert-success');
			return redirect('Project/index');
		}
		else
		{	

			$this->session->set_flashdata('Insert_Failed',$response['message']);
			$this->session->set_flashdata('msg_class','alert alert-danger');
			return redirect('Project/add_engineer');
		}		
	}
	public function add_files()
	{
		$data['project'] = $this->PROJECT_Model->getProjectlist();
		$this->load->view('Project/addfiles',$data);
	}
	public function insert_project_files()
	{
		$data_file = array(
			'project_id' => $this->input->post('project_name')
		);
		$multiple = $this->PROJECT_Model->do_addfiles($data_file,'file',array(

			'upload_path' =>'upload/project_files/',
			'allowed_types' => 'gif|jpg|png|pdf|doc|docx|ppt'
			));
		if($multiple['status']==1)
		{
			$this->session->set_flashdata('Insert_Success','Record has been inserted');
			$this->session->set_flashdata('msg_class','alert alert-success');
			return redirect('Project/index');
		}
		else
		{	

			$this->session->set_flashdata('Insert_Failed','Insertion Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			return redirect('Project/add_files');
		}
	}
}
?>
