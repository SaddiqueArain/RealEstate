<?php
// 30 fucntions
defined('BASEPATH') OR exit('No direct script access allowed');

class PROPERTY_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		
	}
	public function getrows($table_name) //use
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$res = $this->db->get();
		return $res->num_rows();
	}
	
	public function get_userproperty($limit,$offset,$user_id) //use
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.is_approved='1' and tbl_property.uid='$user_id'");
		$this->db->limit($limit,$offset);

		$res = $this->db->get();
		return $res->result_array();	
	}
	public function getproperty()
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->limit(8);
		$this->db->where("tbl_property.is_approved='1' and tbl_property.on_hold='1' and (tbl_property.prop_status='Available for Buying' or
			 tbl_property.prop_status='Available for Rent')");
		
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_getcategory($type_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_proptype_category');
		//$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_proptype_category.prop_type_id');
		$this->db->where("tbl_proptype_category.prop_type_id='$type_id'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_getsubtype($type_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_proptype_category');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_proptype_category.prop_type_id');
		$this->db->where("tbl_property_type.prop_type='$type_id'");
		$res = $this->db->get();
		return $res->result_array();
	}	
	public function do_getproplist($propid)
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.on_hold='1' and (tbl_property.prop_status='Available for Buying' or
			 tbl_property.prop_status='Available for Rent') or tbl_property.propid='$propid'");

		$res = $this->db->get();
		return $res->result_array();	
	}
	
	public function getproplist()
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->where("tbl_property.on_hold='1' and (tbl_property.prop_status='Available for Buying' or
			 tbl_property.prop_status='Available for Rent') and tbl_property.is_approved='1'");

		$res = $this->db->get();
		return $res->result_array();	
	}
	//extra
	
	public function do_propertylist()
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$res = $this->db->get();
		return $res->result_array();	
	}
	// end extra
	public function do_propertycategory($propid)
	{	
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.propid='$propid'");
		$res = $this->db->get();
		return $res->result_array();	
	}
	public function do_getpropowner($propid)
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.propid='$propid'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_arealist()
	{
		$this->db->select('*');
		$this->db->from('tbl_property_area');
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_citylist()
	{
		$this->db->select('*');
		$this->db->from('tbl_city');
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_typelist()
	{
		$this->db->select('*');
		$this->db->from('tbl_property_type');
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_gettypecat()
	{
		$this->db->select('*');
		$this->db->from('tbl_proptype_category');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_proptype_category.prop_type_id');
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_typecategorylist()
	{
		$this->db->select('*');
		$this->db->from('tbl_proptype_category');
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_userlist()
	{
		$this->db->select('*');
		$this->db->from('tbl_login_details');
		$this->db->where("tbl_login_details.user_type='admin' or tbl_login_details.user_type='seller' and tbl_login_details.is_approved='1'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_buyerlist()
	{
		$this->db->select('*');
		$this->db->from('tbl_login_details');
		$this->db->where("tbl_login_details.user_type='admin' or tbl_login_details.user_type='buyer' and tbl_login_details.is_approved='1'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_addproperty($data_property)
	{
		if($this->session->userdata('user_type')!='admin')
		{
			$data_property['is_approved']='0';
		}
		$res = $this->db->insert('tbl_property',$data_property);
		$response['message'] = 'Data is inserted successfully';
		$response['status'] = '1';
		return $response;
	}
	public function do_getPropTypeCategory($type_cat_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_proptype_category');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_proptype_category.prop_type_id');
		$this->db->where("tbl_property_type.prop_type_id='$type_cat_id'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_delete_property($propid)
	{
		$this->db->where("propid=$propid");
		$res = $this->db->delete('tbl_property');
		$response['message'] = "Record has been deleted ";
		$response['status'] = "1";
		return $response;	
	}
	public function do_edit_property($propid)
	{	
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->join('tbl_property_area','tbl_property_area.prop_area_id=tbl_property.prop_area_id');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_property.prop_type_id');
		$this->db->join('tbl_proptype_category','tbl_proptype_category.pro_typecat_id=tbl_property.pro_typecat_id');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_property.uid');
		$this->db->where("tbl_property.propid='$propid'");
		$res = $this->db->get();
		return $res->row();
	}
	public function do_update_property($data_property,$propid)
	{
		$this->db->where('tbl_property.propid',$propid);
		$res = $this->db->update('tbl_property',$data_property);
		$response['message'] = "Record has been Updated ";
		$response['status'] = "1";
		return $response;	
	}
	// Methods for property area
	public function do_add_propertyarea($data_property)
	{
		$res = $this->db->insert('tbl_property_area',$data_property);
		$response['message'] = 'Data is inserted successfully';
		$response['status'] = '1';
		return $response;
	}
	public function do_edit_property_area($prop_area_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_property_area');
		$this->db->where("tbl_property_area.prop_area_id='$prop_area_id'");
		$res = $this->db->get();
		return $res->row();

	}
	public function do_update_propertyarea($data_property,$prop_area_id)
	{
		$this->db->where('tbl_property_area.prop_area_id',$prop_area_id);
		$res = $this->db->update('tbl_property_area',$data_property);
		$response['message'] = "Record has been Updated ";
		$response['status'] = "1";
		return $response;
	}
	public function do_delete_propertyarea($prop_area_id)
	{
		$this->db->where("prop_area_id=$prop_area_id");
		$res = $this->db->delete('tbl_property_area');
		$response['message'] = "Record has been deleted ";
		$response['status'] = "1";
		return $response;
	}

	// Property Type Methods

	public function do_add_propertytype($data_property)
	{
		$res = $this->db->insert('tbl_property_type',$data_property);
		$response['message'] = 'Data is inserted successfully';
		$response['status'] = '1';
		return $response;
	}
	public function do_edit_property_type($prop_type_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_property_type');
		$this->db->where("tbl_property_type.prop_type_id='$prop_type_id'");
		$res = $this->db->get();
		return $res->row();

	}
	public function do_update_propertytype($data_property,$prop_type_id)
	{
		$this->db->where('tbl_property_type.prop_type_id',$prop_type_id);
		$res = $this->db->update('tbl_property_type',$data_property);
		$response['message'] = "Record has been Updated ";
		$response['status'] = "1";
		return $response;
	}
	public function do_delete_propertytype($prop_type_id)
	{
		$this->db->where("prop_type_id=$prop_type_id");
		$res = $this->db->delete('tbl_property_type');
		$response['message'] = "Record has been deleted ";
		$response['status'] = "1";
		return $response;
	}
	// Type Category Methods
	public function do_add_typecategory($data_category)
	{
		$res = $this->db->insert('tbl_proptype_category',$data_category);
		$response['message'] = 'Data is inserted successfully';
		$response['status'] = '1';
		return $response;
	}
	public function do_edit_typecategory($pro_typecat_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_proptype_category');
		$this->db->join('tbl_property_type','tbl_property_type.prop_type_id=tbl_proptype_category.prop_type_id');
		$this->db->where("tbl_proptype_category.pro_typecat_id='$pro_typecat_id'");
		$res = $this->db->get();
		return $res->row();

	}
	public function do_update_typecategory($data_category,$pro_typecat_id)
	{
		$this->db->where('pro_typecat_id',$pro_typecat_id);
		$res = $this->db->update('tbl_proptype_category',$data_category);
		$response['message'] = "Record has been Updated ";
		$response['status'] = "1";
		return $response;
	}
	public function do_delete_typecategory($type_category_id)
	{
		$this->db->where("pro_typecat_id=$type_category_id");
		$res = $this->db->delete('tbl_proptype_category');
		$response['message'] = "Record has been deleted ";
		$response['status'] = "1";
		return $response;
	}
}
?>