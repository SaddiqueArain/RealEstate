<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ADMIN_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		
	}
	public function do_userlist($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_login_details');
		$this->db->where("tbl_login_details.is_approved='1' and tbl_login_details.user_type!='admin'");
		$this->db->limit($limit,$offset);
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getengineername()
	{
		$this->db->select('*');
		$this->db->from('tbl_login_details');
		$this->db->where("tbl_login_details.is_approved='1' and tbl_login_details.user_type='engineer'");
		$res = $this->db->get();
		return $res->result_array();
	}
	
	public function do_adduser($data_user)
	{
		$res = $this->db->insert('tbl_login_details',$data_user);
		
		if($data_user['user_type']==="engineer")
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
	public function do_edituser($uid)
	{
		$this->db->select('*');
		$this->db->from('tbl_login_details');
		$this->db->where("tbl_login_details.uid='$uid'");
		$res = $this->db->get();
		return $res->row();
	}
	public function do_updateuser($data_user,$uid)
	{
		$this->db->where('uid',$uid);
		$res = $this->db->update('tbl_login_details',$data_user);
		$response['message'] = "Record has been Updated ";
		$response['status'] = "1";
		return $response;	
	}
	public function do_approvals($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_login_details');
		$this->db->where("tbl_login_details.is_approved='0'");
		$this->db->limit($limit,$offset);
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_bookingapprovals($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_booking');
		$this->db->join('tbl_property','tbl_property.propid=tbl_booking.propid');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_booking.buyer_id');
		$this->db->where("tbl_booking.is_approved='0'");
		$this->db->limit($limit,$offset);
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_propertyapprovals($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.is_approved='0'");
		$this->db->limit($limit,$offset);

		$res = $this->db->get();
		return $res->result_array();	
	}
	
	public function do_approved_users($data_approved,$uid)
	{
		$this->db->where('tbl_login_details.uid',$uid);
		$res = $this->db->update('tbl_login_details',$data_approved);
		$response['message'] = "User is approved ";
		$response['status'] = "1";
		return $response;
	}

	public function do_rejected_users($uid)
	{
		$this->db->where("uid",$uid);
		$res = $this->db->delete('tbl_login_details');
		$response['message'] = "User is Rejected ";
		$response['status'] = "1";
		return $response;
	}
	public function do_approved_bookings($data_approved,$book_id)
	{
		$this->db->where('tbl_booking.book_id',$book_id);
		$res = $this->db->update('tbl_booking',$data_approved);
		$response['message'] = "Booking is approved ";
		$response['status'] = "1";
		return $response;
	}
	public function do_rejected_bookings($book_id,$propid)
	{
		$this->db->set('tbl_property.on_hold',"1");
		$this->db->where('tbl_property.propid',$propid);
		$res = $this->db->update('tbl_property');
		
		$this->db->where("book_id",$book_id);
		$res = $this->db->delete('tbl_booking');
		$response['message'] = "Booking is Rejected ";
		$response['status'] = "1";
		return $response;
	}
	public function do_approved_property($data_approved,$propid)
	{
		$this->db->where('tbl_property.propid',$propid);
		$res = $this->db->update('tbl_property',$data_approved);
		$response['message'] = "Property is approved ";
		$response['status'] = "1";
		return $response;
	}

	public function do_rejected_property($propid)
	{
		$this->db->where("propid",$propid);
		$res = $this->db->delete('tbl_property');
		$response['message'] = "Property is Rejected ";
		$response['status'] = "1";
		return $response;
	}
	public function do_messages($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_contact_us');
		$this->db->limit($limit,$offset);
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getmessage($contact_us_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_contact_us');
		$this->db->where("tbl_contact_us.contact_us_id='$contact_us_id'");
		$res = $this->db->get();
		return $res->row();	
	}
	public function do_delete_message($contact_us_id)
	{
		$this->db->where("contact_us_id",$contact_us_id);
		$res = $this->db->delete('tbl_contact_us');
		$response['message'] = "Message is Deleted ";
		$response['status'] = "1";
		return $response;
	}
	
}
?>