<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LIST_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		
	}
	
	//Property Count
	
	public function getproperty_oninstallment()
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->where("tbl_property.prop_status='On Installment'");
		$res = $this->db->get();
		return $res->result_array();		
	}
	public function getproperty_onrent()
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->where("tbl_property.prop_status='On Rent'");
		$res = $this->db->get();
		return $res->result_array();		
	}
	public function getproperty_sold()
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->where("tbl_property.prop_status='Sold'");
		$res = $this->db->get();
		return $res->result_array();		
	}
	public function do_getproperty_oninstallment($uid)
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->where("tbl_property.prop_status='On Installment' and tbl_property.uid='$uid'");
		$res = $this->db->get();
		return $res->result_array();		
	}
	public function do_getproperty_onrent($uid)
	{
		$this->db->select('*');
		$this->db->from('tbl_property');
		$this->db->where("tbl_property.prop_status='On Rent' and tbl_property.uid='$uid'");
		$res = $this->db->get();
		return $res->result_array();		
	}
	public function do_getproperty_sold($uid)
	{
		$this->db->select('*');
		$this->db->from('tbl_booking');
		$this->db->where("tbl_booking.status='completed' and tbl_booking.seller_id='$uid'");
		$res = $this->db->get();
		return $res->result_array();		
	}
	public function do_purchasedproperty($uid)
	{
		$this->db->select('*');
		$this->db->from('tbl_booking');
		$this->db->where("tbl_booking.status='completed' and tbl_booking.buyer_id='$uid'");
		$res = $this->db->get();
		return $res->result_array();		
	}
}
?>