<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LOGIN_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		
	}
	public function isvalidate($username,$password)
	{
		$this->db->select('*');
		$this->db->from('tbl_login_details');
		$this->db->where("tbl_login_details.user_name='$username' and tbl_login_details.password='$password' and tbl_login_details.is_approved='1'");
		$res = $this->db->get();
		if($res->num_rows()>0)
		{
			$response['message'] = 'Login success';
			$response['status'] = '1';
			$response['user_id'] = $res->result_array()[0]['uid'];
			$response['email'] = $res->result_array()[0]['email'];
			$response['fullname'] = $res->result_array()[0]['full_name'];
			$response['usertype'] = $res->result_array()[0]['user_type'];
			$response['prof_img_link'] = $res->result_array()[0]['prof_img_link'];
			return $response;
		}
		else
		{

			$response['message'] = 'Login failed';
			$response['status'] = '0';
			return $response;
		}

	}
}
?>