<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PROJECT_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		
	}
	public function do_projectlist($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_project');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_project.owner_id');
		$this->db->limit($limit,$offset);
		$res = $this->db->get();
		return $res->result_array();
				
	}
	public function onGoingProject()
	{
		$this->db->select('*');
		$this->db->from('tbl_project');
		$this->db->where("tbl_project.status='On Going'");
		$this->db->limit(4);
		$res = $this->db->get();
		return $res->result_array();
	}
	public function completedProject()
	{
		$this->db->select('*');
		$this->db->from('tbl_project');
		$this->db->where("tbl_project.status='Completed'");
		$this->db->limit(8);
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getproject($project_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_project');	
		$this->db->join('tbl_project_type','tbl_project_type.project_type_id=tbl_project.project_type_id');	
		$this->db->where("tbl_project.project_id='$project_id'");
		$res = $this->db->get();
		return $res->row();
	}
	public function getprojectdetails($project_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_project');	
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_project.owner_id');	
		$this->db->join('tbl_project_type','tbl_project_type.project_type_id=tbl_project.project_type_id');	
		$this->db->where("tbl_project.project_id='$project_id'");
		$res = $this->db->get();
		return $res->row();
	}
	public function getfiles($project_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_project_files');
		$this->db->join('tbl_project','tbl_project.project_id=tbl_project_files.project_id');
		$this->db->where("tbl_project_files.project_id='$project_id'");
		
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getprojectengineers($project_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_project_engineers');
		$this->db->join('tbl_project','tbl_project.project_id=tbl_project_engineers.project_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_project_engineers.engineer_id');
		$this->db->where("tbl_project.project_id='$project_id'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getProjectlist()
	{
		$this->db->select('*');
		$this->db->from('tbl_project');
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getownerlist()
	{
		$this->db->select('*');
		$this->db->from('tbl_login_details');
		$this->db->where("tbl_login_details.user_type ='buyer' or tbl_login_details.user_type='seller' or tbl_login_details.user_type='client' or tbl_login_details.user_type='admin'");
		$res = $this->db->get();
		return $res->result_array();
	}
	
	public function getengineerlist()
	{
		$this->db->select('*');
		$this->db->from('tbl_login_details');
		$this->db->where("tbl_login_details.user_type ='engineer' and tbl_login_details.is_approved='1'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getproject_typelist()
	{
		$this->db->select('*');
		$this->db->from('tbl_project_type');
		$res = $this->db->get();
		return $res->result_array();
	}
//	$response['status'] = '1';
//		return $response;
	public function do_addproject($data_project,$field_name, $conf = array())
	{
				
		$this->db->insert('tbl_project',$data_project);
		$last_id = $this->db->insert_id();

		$data_engineer = array(
					'project_id' => $last_id
				);
				$engineer_assoc = '';
				
				 foreach($this->input->post('engineer_assoc') as $row)
				 {
				  $data_engineer['engineer_id'] = $row;
				  $this->db->insert('tbl_project_engineers',$data_engineer);
				 }
				

		$files = $_FILES[$field_name];
		$file_upload = sizeof($_FILES[$field_name]['tmp_name']);
		$image = array();
		$multiple = array();

		for($i = 0; $i < $file_upload; $i++ )
		{
			$_FILES[$field_name]['name'] = $files['name'][$i];
			$_FILES[$field_name]['type'] = $files['type'][$i];
			$_FILES[$field_name]['tmp_name'] = $files['tmp_name'][$i];
			$_FILES[$field_name]['error'] = $files['error'][$i];
			$_FILES[$field_name]['size'] = $files['size'][$i];

			$upload_path = FCPATH.$conf['upload_path'];
			if(!is_dir($upload_path))
			{
				mkdir($upload_path,0777,true);
			}
			$config = [
			'upload_path' =>$upload_path,
			'allowed_types' => $conf['allowed_types'],
			'max_size' => 0,
			
			];

			$this->upload->initialize($config);
			if($this->upload->do_upload($field_name))
			{
				$data = $this->upload->data();
				chmod($data['full_path'], 0777);

				$multiple[$i] = $data['file_name'];
				$data_file = array('file_name' => $multiple[$i],
				'project_id'=>$last_id,
				'file_path_link'=> base_url($conf['upload_path'])); 
				$this->db->insert('tbl_project_files',$data_file);

			}
		}
		$multiple['status'] = '1';
		return $multiple;
		
	}
	public function do_updateproject($data_project,$project_id)
	{
		$this->db->where("project_id=$project_id");
		$res = $this->db->update('tbl_project',$data_project);
		$response['message'] = "Record has been updated ";
		$response['status'] = "1";
		return $response;
	}
	public function do_delete_project($project_id)
	{
		$this->db->where("project_id=$project_id");
		$res = $this->db->delete('tbl_project');
		$response['message'] = "Record has been deleted ";
		$response['status'] = "1";
		return $response;
	}
	public function do_delete_file($file_id)
	{
		$this->db->where("file_id=$file_id");
		$res = $this->db->delete('tbl_project_files');
		$response['message'] = "Record has been deleted ";
		$response['status'] = "1";
		return $response;	
	}
	public function do_delete_engineer($project_eng_id)
	{
		$this->db->where("project_eng_id=$project_eng_id");
		$res = $this->db->delete('tbl_project_engineers');
		$response['message'] = "Record has been deleted ";
		$response['status'] = "1";
		return $response;
	}
	public function addproject_engineers($data_engineer)
	{
		$engineer_assoc = '';
				
		 foreach($this->input->post('engineer_assoc') as $row)
		 {

		  $data_engineer['engineer_id'] = $row;
		 // $res = $this->db->insert('tbl_project_engineers',$data_engineer);
		 	$msg = '';
			$this->db->db_debug = false;
			if(!$this->db->insert('tbl_project_engineers',$data_engineer)){
			   $error = $this->db->error();
			   if($error['code'] == 1062){
			      $msg = 'Already Exist cannot Duplicate';
			      $response['message'] = $msg;
			      $response['status'] = "0";
			   }
			}
			else
			{
				$response['message'] = "Insertion Success";
			      $response['status'] = "1";
			}
			$this->db->db_debug = true;
		 }
		// echo $msg;
		
		
		return $response;
	}
	public function do_addfiles($data_file,$field_name, $conf = array())
	{
		$files = $_FILES[$field_name];
		$file_upload = sizeof($_FILES[$field_name]['tmp_name']);
		$image = array();
		$multiple = array();

		for($i = 0; $i < $file_upload; $i++ )
		{
			$_FILES[$field_name]['name'] = $files['name'][$i];
			$_FILES[$field_name]['type'] = $files['type'][$i];
			$_FILES[$field_name]['tmp_name'] = $files['tmp_name'][$i];
			$_FILES[$field_name]['error'] = $files['error'][$i];
			$_FILES[$field_name]['size'] = $files['size'][$i];

			$upload_path = FCPATH.$conf['upload_path'];
			if(!is_dir($upload_path))
			{
				mkdir($upload_path,0777,true);
			}
			$config = [
			'upload_path' =>$upload_path,
			'allowed_types' => $conf['allowed_types'],
			'max_size' => 0,
			
			];

			$this->upload->initialize($config);
			if($this->upload->do_upload($field_name))
			{
				$data = $this->upload->data();
				chmod($data['full_path'], 0777);

				$multiple[$i] = $data['file_name'];
				$data_file['file_name'] = $multiple[$i];
				$data_file['file_path_link'] = base_url($conf['upload_path']); 
				$this->db->insert('tbl_project_files',$data_file);

			}
		}
		$multiple['status'] = '1';
		return $multiple;
	}


	
}
?>
