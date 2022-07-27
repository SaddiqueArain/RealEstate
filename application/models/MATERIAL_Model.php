<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MATERIAL_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		
	}
	public function do_materiallist($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_material');
		$this->db->limit($limit,$offset);
		$res = $this->db->get();
		return $res->result_array();
				
	}
	public function get_materialdetails($limit,$offset,$material_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_material_type');
		$this->db->join('tbl_material','tbl_material.material_id=tbl_material_type.material_id');
		$this->db->where("tbl_material_type.material_id='$material_id'");
		$this->db->limit($limit,$offset);
		$res = $this->db->get();
		return $res->result_array();
	}
	public function get_material_type($material_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_material_type');
		$this->db->where("tbl_material_type.material_id='$material_id'");
		
		$res = $this->db->get();
		return $res->result_array();
	}
	public function get_material()
	{
		$this->db->select('*');
		$this->db->from('tbl_material');
		
		$res = $this->db->get();
		return $res->result_array();
	}
	public function edit_material($material_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_material');
		$this->db->where("tbl_material.material_id='$material_id'");
		
		$res = $this->db->get();
		return $res->row();
	}
	public function update_material($data_material,$material_id)
	{
		$this->db->where('material_id',$material_id);
		$res = $this->db->update('tbl_material',$data_material);
		$response['message'] = 'Data is update successfully';
		$response['status'] = '1';
		return $response;
	}
	public function add_material_type($data_materialtype)
	{
		$res = $this->db->insert('tbl_material_type',$data_materialtype);
		$response['message'] = 'Data is inserted successfully';
		$response['status'] = '1';
		return $response;
	}
	public function edit_materialtype($mat_type_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_material_type');
		$this->db->where("tbl_material_type.mat_type_id='$mat_type_id'");
		
		$res = $this->db->get();
		return $res->row();
	}
	public function update_material_type($data_materialtype,$mat_type_id)
	{
		$this->db->where('mat_type_id',$mat_type_id);
		$res = $this->db->update('tbl_material_type',$data_materialtype);
		$response['message'] = 'Data is update successfully';
		$response['status'] = '1';
		return $response;
	}
	public function delete_materialtype($mat_type_id)
	{
		$this->db->where('mat_type_id',$mat_type_id);
		$res = $this->db->delete('tbl_material_type');
		$response['message'] = 'Data is deleted successfully';
		$response['status'] = '1';
		return $response;
	}
	public function do_demand_material($data_user,$data_demand_material,$data_demand_quantity)
	{
		$res = $this->db->insert('tbl_demand',$data_user);
		$demand_id = $this->db->insert_id();
		$data_demand_material['demand_id'] = $demand_id;
		$res = $this->db->insert('tbl_demand_material',$data_demand_material);
		$demand_material_id = $this->db->insert_id();
		$data_demand_quantity['demand_material_id'] = $demand_material_id;
		$res = $this->db->insert('tbl_demand_quantity',$data_demand_quantity);

		$response['message'] = 'Data is inserted successfully';
		$response['status'] = '1';
		return $response;
	}
	public function get_MaterialDemand()
	{
		$this->db->select('*');
		$this->db->from('tbl_demand');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_demand.uid');
		$this->db->join('tbl_demand_material','tbl_demand_material.demand_id=tbl_demand.demand_id');
		$this->db->join('tbl_demand_quantity','tbl_demand_quantity.demand_material_id=tbl_demand_material.demand_material_id');
		
		$res = $this->db->get();
		return $res->result_array();
	}
	public function materialType()
	{
		$this->db->select('*');
		$this->db->from('tbl_material_type');
		$res = $this->db->get();
		return $res->result_array();
	}

}
?>