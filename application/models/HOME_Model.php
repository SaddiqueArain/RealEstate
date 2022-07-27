<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HOME_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		
	}
	public function propertyforsale()
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.prop_status='Available for Buying' and tbl_property.is_approved='1' and tbl_property.on_hold='1'");
		
		$res = $this->db->get();
		return $res->result_array();
	}
	public function propertyforrent()
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.prop_status='Available for Rent' and tbl_property.is_approved='1' and tbl_property.on_hold='1'");
		
		$res = $this->db->get();
		return $res->result_array();
	}
	public function propertyhouse()
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.is_approved='1' and tbl_property_type.prop_type='Homes' and tbl_property.on_hold='1' and (tbl_property.prop_status='Available for Buying'or tbl_property.prop_status='Available for Rent')");
		
		$res = $this->db->get();
		return $res->result_array();
	}
	public function propertyplots()
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.is_approved='1' and tbl_property_type.prop_type='Plots'and tbl_property.on_hold='1' and (tbl_property.prop_status='Available for Buying'or tbl_property.prop_status='Available for Rent')");
		
		$res = $this->db->get();
		return $res->result_array();
	}
	public function propertycommercial()
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.is_approved='1' and tbl_property_type.prop_type='Commercial' and tbl_property.on_hold='1' and (tbl_property.prop_status='Available for Buying'or tbl_property.prop_status='Available for Rent')");
		
		$res = $this->db->get();
		return $res->result_array();
	}
	// Contact US
	public function do_addmessage($data_message)
	{
		$this->db->insert('tbl_contact_us',$data_message);
		$response['status'] = '1';
		return $response;
	}
	// Projects
	public function getMalls()
	{
		$this->db->select('*');
		$this->db->from('tbl_project_type');
		$this->db->join('tbl_project','tbl_project.project_type_id=tbl_project_type.project_type_id');
		$this->db->where("tbl_project_type.type_name='Mall'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getOffices()
	{
		$this->db->select('*');
		$this->db->from('tbl_project_type');
		$this->db->join('tbl_project','tbl_project.project_type_id=tbl_project_type.project_type_id');
		$this->db->where("tbl_project_type.type_name='Offices'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getResidencials()
	{
		$this->db->select('*');
		$this->db->from('tbl_project_type');
		$this->db->join('tbl_project','tbl_project.project_type_id=tbl_project_type.project_type_id');
		$this->db->where("tbl_project_type.type_name='Housing'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getdesired_property($prop_status,$city_name,$type,$sub_type,$location,$area)
	{
		if($area > 0 && $location=="" )
		{
			$this->db->select('*');
			$this->db->from('tbl_property');
			$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
			$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
			$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
			$this->db->where("tbl_property.prop_status='$prop_status' and tbl_property.is_approved=1 and tbl_property.on_hold=1 and tbl_property.prop_city='$city_name' and tbl_property_type.prop_type='$type' and tbl_proptype_category.category_name='$sub_type' and tbl_property_area.prop_area='$area'");
		}
		else if($location !="" && $area==0)
		{
			$this->db->select('*');
			$this->db->from('tbl_property');
			$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
			$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
			$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
			$this->db->where("tbl_property.prop_status='$prop_status' and tbl_property.is_approved=1 and tbl_property.on_hold=1 and tbl_property.prop_city='$city_name' and tbl_property_type.prop_type='$type' and tbl_proptype_category.category_name='$sub_type' and tbl_property.prop_location='$location'");
		}
		elseif ($area > 0 && $location != "") 
		{
			$this->db->select('*');
			$this->db->from('tbl_property');
			$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
			$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
			$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
			$this->db->where("tbl_property.prop_status='$prop_status' and tbl_property.is_approved=1 and tbl_property.on_hold=1 and tbl_property.prop_city='$city_name' and tbl_property_type.prop_type='$type' and tbl_proptype_category.category_name='$sub_type' and tbl_property.prop_location='$location' and tbl_property_area.prop_area='$area'");
		}
		else
		{
			$this->db->select('*');
			$this->db->from('tbl_property');
			$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
			$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
			$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
			$this->db->where("tbl_property.prop_status='$prop_status' and tbl_property.is_approved=1 and tbl_property.on_hold=1 and tbl_property.prop_city='$city_name' and tbl_property_type.prop_type='$type' and tbl_proptype_category.category_name='$sub_type'");
		}
		// and tbl_property.prop_location='$location' and tbl_property_area.prop_area='$area'");
	
		$res = $this->db->get();
		return $res->result_array();
	}
}
?>