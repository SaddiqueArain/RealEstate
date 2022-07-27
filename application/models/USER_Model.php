<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class USER_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
		
	}
	public function do_register($data_login)
	{
		if($data_login['user_type']=='buyer' and $data_login['user_type']=='seller')
		{
			$data_login['is_approved']='1';
		}
		$res = $this->db->insert('tbl_login_details',$data_login);
		if($data_login['user_type']==="engineer")
		{
			$last_id = $this->db->insert_id();
			$conf = [
			'upload_path' =>'./upload/engineers_cv/',
			'allowed_types' => 'doc|docx|pdf',
			];
				$this->upload->initialize($conf);
		
			if( $this->upload->do_upload('uploadcv'))
			{
				$data_cv = $this->upload->data();
				$cv_path = base_url("upload/engineers_cv/".$data_cv['raw_name'].$data_cv['file_ext']);
				$data_engineer['cv_path_link'] = $cv_path;
				$data_engineer['uid'] = $last_id;
				$res = $this->db->insert('tbl_engineer_file',$data_engineer);
			}
		}
		$response['message'] = 'Data is inserted successfully';
		$response['status'] = '1';
		return $response;
	}
}
?>