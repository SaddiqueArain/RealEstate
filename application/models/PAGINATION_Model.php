<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PAGINATION_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		
	}
	public function getpagination($path,$count_rows) //use
	{
		$config = [
			'base_url' => base_url($path),
			'per_page' => 5,
			'total_rows' => $count_rows,
			'full_tag_open' => "<ul class='pagination'>",
			'full_tag_close' => "</ul>",
			'next_tag_open' => "<li>",
			'next_tag_close' => "</li>",
			'prev_tag_open' => "<li>",
			'prev_tag_close' => "</li>",
			'num_tag_open' => "<li>",
			'num_tag_close' => "</li>",
			'cur_tag_open' => "<li class='active'><a>",
			'cur_tag_close' => "</a></li>",			
		];
		$this->pagination->initialize($config);
		return $config;
	}
	// Admin related for pagination 
	public function do_userlist()
	{
		$this->db->select('*');
		$this->db->from('tbl_login_details');
		$this->db->where("tbl_login_details.is_approved='1' and tbl_login_details.user_type!='admin'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_approvals()
	{
		$this->db->select('*');
		$this->db->from('tbl_login_details');
		$this->db->where("tbl_login_details.is_approved='0'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_bookingapprovals()
	{
		$this->db->select('*');
		$this->db->from('tbl_booking');
		$this->db->where("tbl_booking.is_approved='0'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_propertyapprovals()
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->where("tbl_property.is_approved='0'");
		$res = $this->db->get();
		return $res->result_array();
	}
	// Property related for pagination
	public function get_userproperty($user_id) //use
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.uid='$user_id'");
		
		$res = $this->db->get();
		return $res->result_array();	
	}
	public function get_pendingproperty($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.is_approved='0' and tbl_property.uid='$user_id'");
		
		$res = $this->db->get();
		return $res->result_array();	
	}
	public function do_propertylist($limit,$offset) //use
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.is_approved='1'");
		$this->db->limit($limit,$offset);

		$res = $this->db->get();
		return $res->result_array();	
	}
	public function do_arealist($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_property_area');
		$this->db->limit($limit,$offset);
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_typelist($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_property_type');
		$this->db->limit($limit,$offset);
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_gettypecat($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_proptype_category');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_proptype_category.prop_type_id');
		$this->db->limit($limit,$offset);
		$res = $this->db->get();
		return $res->result_array();
	}

	// For Booking Module
	public function getbooking()
	{
		$this->db->select('*');
		$this->db->from('tbl_booking');
		$this->db->join('tbl_property','tbl_property.propid=tbl_booking.propid');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_booking.buyer_id');
		$this->db->where("tbl_booking.is_approved='1'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function get_buyerbooking($buyer_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_booking');
		$this->db->join('tbl_property','tbl_property.propid=tbl_booking.propid');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_booking.buyer_id');
		$this->db->where("tbl_booking.is_approved='1' and tbl_booking.buyer_id='$buyer_id'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_pendingbookings($user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_booking');
		$this->db->join('tbl_property','tbl_property.propid=tbl_booking.propid');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_booking.buyer_id');
		$this->db->where("tbl_booking.is_approved='0' and tbl_booking.buyer_id='$user_id'");
		$res = $this->db->get();
		return $res->result_array();
	}
	// For payment Module
	public function getall_installments()
	{
		$this->db->select('*');
		$this->db->from('tbl_payment_installments');
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_getrent()
	{
		$this->db->select('*');
		$this->db->from('tbl_rent');
		$res = $this->db->get();
		return $res->result_array();
	}

	// for project Module
	public function do_projectlist()
	{
		$this->db->select('*');
		$this->db->from('tbl_project');
		$res = $this->db->get();
		return $res->result_array();
	}

	// for material module
	public function do_materiallist()
	{
		$this->db->select('*');
		$this->db->from('tbl_material');
		$res = $this->db->get();
		return $res->result_array();			
	}
	public function do_material_details($material_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_material_type');
		$this->db->join('tbl_material','tbl_material.material_id=tbl_material_type.material_id');
		$this->db->where("tbl_material_type.material_id='$material_id'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_messages()
	{
		$this->db->select('*');
		$this->db->from('tbl_contact_us');
		$res = $this->db->get();
		return $res->result_array();
	}

}
?>
	