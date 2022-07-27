<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CLIENT_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		
	}
	public function do_pendingbookings($limit,$offset,$user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_booking');
		$this->db->join('tbl_property','tbl_property.propid=tbl_booking.propid');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_booking.buyer_id');
		$this->db->where("tbl_booking.is_approved='0' and tbl_booking.buyer_id='$user_id'");
		$this->db->limit($limit,$offset);
		$res = $this->db->get();
		return $res->result_array();
	}
	public function get_pendingproperty($limit,$offset,$user_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.is_approved='0' and tbl_property.uid='$user_id'");
		$this->db->limit($limit,$offset);
		$res = $this->db->get();
		return $res->result_array();	
	}
	public function propertyforsale($uid)
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.prop_status='Available for Buying' and tbl_property.is_approved='1' and tbl_property.on_hold='1' and tbl_property.uid='$uid'");
		
		$res = $this->db->get();
		return $res->result_array();
	}
	public function propertyforrent($uid)
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.prop_status='Available for Rent' and tbl_property.is_approved='1' and tbl_property.on_hold='1' and tbl_property.uid='$uid'");
		
		$res = $this->db->get();
		return $res->result_array();
	}
}
?>