<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BOOKING_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		
	}
	public function getsellername()
	{
		$this->db->select('*');
		$this->db->distinct();
		$this->db->from('tbl_login_details');
		//$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_booking.seller_id');
		$this->db->where("tbl_login_details.user_type='seller' or tbl_login_details.user_type='admin' and tbl_login_details.is_approved='1'");
		$res = $this->db->get();
		return $res->result_array();	
	}
	public function getbuyername()
	{
		$this->db->select('*');
		$this->db->from('tbl_login_details');
		//$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_booking.buyer_id');
		$this->db->where("tbl_login_details.user_type='buyer' or tbl_login_details.user_type='admin' and tbl_login_details.is_approved='1'");
		$res = $this->db->get();
		return $res->result_array();	
	}
	public function getbrokername()
	{
		$this->db->select('*');
		$this->db->from('tbl_login_details');
		$this->db->where("tbl_login_details.user_type='admin' or tbl_login_details.user_type='broker' and tbl_login_details.is_approved='1'");
		$res = $this->db->get();
		return $res->result_array();		
	}
	public function do_getbooking($book_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_booking');
		$this->db->join('tbl_property','tbl_property.propid=tbl_booking.propid');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_booking.buyer_id');
		$this->db->where("tbl_booking.book_id='$book_id'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getbooking($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_booking');
		$this->db->join('tbl_property','tbl_property.propid=tbl_booking.propid');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_booking.buyer_id');
		$this->db->where("tbl_booking.is_approved='1'");
		$this->db->limit($limit,$offset);
		$res = $this->db->get();
		return $res->result_array();
	}
	public function get_buyerbooking($limit,$offset,$buyer_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_booking');
		$this->db->join('tbl_property','tbl_property.propid=tbl_booking.propid');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_booking.buyer_id');
		$this->db->where("tbl_booking.is_approved='1' and tbl_booking.buyer_id='$buyer_id'");
		$this->db->limit($limit,$offset);
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_brokerlist()
	{
		$this->db->select('*');
		$this->db->from('tbl_login_details');
		$this->db->where("tbl_login_details.user_type='admin' or tbl_login_details.user_type='broker' and tbl_login_details.is_approved='1'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_buyer_booking($data_booking)
	{
		$res = $this->db->insert('tbl_booking',$data_booking);
		$propid = $data_booking['propid'];
		$this->db->set('tbl_property.on_hold',"0");
		$this->db->where('tbl_property.propid',$propid);
		$res = $this->db->update('tbl_property');
		$response['message'] = 'Data is inserted successfully';
		$response['status'] = '1';
		return $response;
	}
	public function do_addbooking($data_commission,$data_booking,$data_payment,$data_rent)
	{
		$res = $this->db->insert('tbl_booking',$data_booking);
		$last_id = $this->db->insert_id();
		$data_payment['book_id'] = $last_id;
		$res = $this->db->insert('tbl_payment',$data_payment);
		$last_payment_id = $this->db->insert_id();
		if($data_payment['payment_type']=="Full_Payment")
		{
			if($data_booking['broker_id'] !=0)
			{
				$data_commission['book_id'] = $last_id;
				$data_commission['pay_id'] = $last_payment_id;
				$res = $this->db->insert('tbl_commission',$data_commission);
			}
			$this->db->set('tbl_booking.status','completed');
			$this->db->where('tbl_booking.book_id',$last_id);
			$res = $this->db->update('tbl_booking');
			$seller_id = $data_booking['buyer_id'];
			$propid = $data_booking['propid'];
			$status = 'Sold';
			$this->updateproperty($seller_id,$propid,$status);
		}
		elseif ($data_payment['payment_type']=="Installment") 
		{
			if($data_booking['broker_id'] !=0)
			{
				$data_commission['book_id'] = $last_id;
				$data_commission['pay_id'] = $last_payment_id;
				$res = $this->db->insert('tbl_commission',$data_commission);
			}
			$this->db->set('tbl_booking.status','uncompleted');
			$this->db->where('tbl_booking.book_id',$last_id);
			$res = $this->db->update('tbl_booking');
			$seller_id = $data_booking['seller_id'];
			$propid = $data_booking['propid'];
			$status = 'On Insatallments';
			$this->updateproperty($seller_id,$propid,$status);
		}
		elseif ($data_payment['payment_type']=="Rent") 
		{
			if($data_booking['broker_id'] !=0)
			{
				$data_commission['book_id'] = $last_id;
				$data_commission['pay_id'] = $last_payment_id;
				$res = $this->db->insert('tbl_commission',$data_commission);
			}
			$data_rent['pay_id'] = $last_payment_id;
			$data_rent['book_id'] = $last_id;
			$res = $this->db->insert('tbl_rent',$data_rent);
			$this->db->set('tbl_booking.status','rented');
			$this->db->where('tbl_booking.book_id',$last_id);
			$res = $this->db->update('tbl_booking');
			$seller_id = $data_booking['seller_id'];
			$propid = $data_booking['propid'];
			$status = 'On Rent';
			$this->updateproperty($seller_id,$propid,$status);
		}
		
		$response['message'] = 'Data is inserted successfully';
		$response['status'] = '1';
		return $response;
	}
	public function updateproperty($seller_id,$propid,$status)
	{
		$this->db->set('tbl_property.uid',$seller_id);
		$this->db->set('tbl_property.prop_status',$status);
		$this->db->where('tbl_property.propid',$propid);
		$res = $this->db->update('tbl_property');
		$response['message'] = "Record has been Updated ";
		$response['status'] = "1";
		return $response;
	}
	// OPerations
	public function do_delete_booking($book_id)
	{
		$this->db->where("book_id=$book_id");
		$res = $this->db->delete('tbl_booking');
		$response['message'] = "Record has been deleted ";
		$response['status'] = "1";
		return $response;	
	}
	public function do_edit_booking($book_id)
	{	
		$this->db->select('*');
		$this->db->from('tbl_booking');
		$this->db->join('tbl_property','tbl_property.propid=tbl_booking.propid');
		$this->db->join('tbl_login_details','tbl_login_details.uid=tbl_booking.seller_id');
		$this->db->join('tbl_payment','tbl_payment.book_id=tbl_booking.book_id');
		$this->db->where("tbl_booking.book_id='$book_id'");
		$res = $this->db->get();
		return $res->row();
	}
	public function do_update_booking($data_commission,$data_booking,$data_payment,$data_rent,$data_ids)
	{
		
		$book_id = $data_ids['book_id'];
		$prop_value	= $data_ids['prop_value'];

		// for previous property change
		if($data_booking['propid']!=$data_ids['pre_propid'])
		{
			$seller_id = $data_ids['pre_seller_id'];
			$propid = $data_ids['pre_propid'];
			$status = 'Available for Buying';
			$this->updateproperty($seller_id,$propid,$status);
		}
		// end previous property

		$this->db->where('tbl_booking.book_id',$book_id);
		$res = $this->db->update('tbl_booking',$data_booking);
		$pay_id = $data_payment['pay_id'];
		$this->db->where('tbl_payment.pay_id',$pay_id);
		$res = $this->db->update('tbl_payment',$data_payment);
		
		if($data_payment['payment_type']=="Full_Payment")
		{
			if($data_booking['broker_id'] != 0)
			{
				$res = $this->db->select('book_id')
				->from('tbl_commission')
				->where("tbl_commission.book_id='$book_id'")->get();
				if($res->num_rows()>0)
				{
					$this->db->where('tbl_commission.book_id',$book_id);
					$res = $this->db->update('tbl_commission',$data_commission);
				}
				else
				{
					$data_commission['book_id'] = $book_id;
					$data_commission['pay_id'] = $pay_id;
					$res = $this->db->insert('tbl_commission',$data_commission);
				}
					

					$this->db->set('tbl_booking.status','completed');
					$this->db->where('tbl_booking.book_id',$book_id);
					$res = $this->db->update('tbl_booking');

					$seller_id = $data_booking['buyer_id'];
					$propid = $data_booking['propid'];
					$status = 'Sold';
					$this->updateproperty($seller_id,$propid,$status);
					$pay_id = $data_payment['pay_id'];
					$this->PAYMENT_Model->do_delete_pay_instal($pay_id);	
			}
			else
			{
				$commission = $data_commission['commission_amount'];
				$total_balance_amount = $this->PAYMENT_Model->getbalanceamount($pay_id);
				$balance_amount = $total_balance_amount['balance_amount'];
				
				$balance_amount = $balance_amount + $commission;
				$this->db->set('tbl_payment.balance_amount',$balance_amount);
				$this->db->where('tbl_payment.pay_id',$pay_id);
				$res = $this->db->update('tbl_payment');

				$this->PAYMENT_Model->do_delete_commission($book_id);

				$this->db->set('tbl_booking.status','completed');
				$this->db->where('tbl_booking.book_id',$book_id);
				$res = $this->db->update('tbl_booking');

				$seller_id = $data_booking['buyer_id'];
				$propid = $data_booking['propid'];
				$status = 'Sold';
				$this->updateproperty($seller_id,$propid,$status);
				$pay_id = $data_payment['pay_id'];
				$this->PAYMENT_Model->do_delete_pay_instal($pay_id);	
			}
			
		}
		else if($data_payment['payment_type']=="Installment")
		{
			
			if($data_booking['broker_id'] != 0)
			{
				$res = $this->db->select('book_id')
				->from('tbl_commission')
				->where("tbl_commission.book_id='$book_id'")->get();
				if($res->num_rows()>0)
				{
					
					$this->db->where('tbl_commission.book_id',$book_id);
					$res = $this->db->update('tbl_commission',$data_commission);
					$total_amount_paid = $this->PAYMENT_Model->updateamount($pay_id);
				} 
				else
				{
					$data_commission['book_id'] = $book_id;
					$data_commission['pay_id'] = $pay_id;
					$res = $this->db->insert('tbl_commission',$data_commission);
					$total_amount_paid = $this->PAYMENT_Model->updateamount($pay_id);

					$total_balance_amount = $this->PAYMENT_Model->getbalanceamount($pay_id);
					$total_balance_amount['balance_amount'] -= $data_commission['commission_amount'];
					$balance_amount = $total_balance_amount['balance_amount'];

					$this->db->set('tbl_payment.balance_amount',$balance_amount);
					$this->db->where('tbl_payment.book_id',$book_id);
					$res = $this->db->update('tbl_payment');

				}
				
			}
			else
			{
				$total_amount_paid = $this->PAYMENT_Model->updateamount($pay_id);
				$commission = $data_commission['commission_amount'];
				$total_balance_amount = $this->PAYMENT_Model->getbalanceamount($pay_id);
				
				
				$total_commission = $this->PAYMENT_Model->gettotalcommission($pay_id);
				$total_balance_amount['balance_amount'] += $total_commission['commission_amount'];
				$balance_amount = $total_balance_amount['balance_amount'];
				
				$this->db->set('tbl_payment.balance_amount',$balance_amount);
				$this->db->where('tbl_payment.pay_id',$pay_id);
				$res = $this->db->update('tbl_payment');

				$this->PAYMENT_Model->do_delete_commission($book_id);

			}
			$total_amount_paid = $this->PAYMENT_Model->updateamount($pay_id);
			if($total_amount_paid==$prop_value)
			{
				$this->db->set('tbl_booking.status','completed');
				$this->db->where('tbl_booking.book_id',$book_id);
				$res = $this->db->update('tbl_booking');
				$seller_id = $data_booking['buyer_id'];
				$propid = $data_booking['propid'];
				$status = 'Sold';
				$this->updateproperty($seller_id,$propid,$status);
			}
			elseif ($total_amount_paid!=$prop_value) 
			{
				$this->db->set('tbl_booking.status','uncompleted');
				$this->db->where('tbl_booking.book_id',$book_id);
				$res = $this->db->update('tbl_booking');

				$seller_id = $data_booking['seller_id'];
				$propid = $data_booking['propid'];
				$status = 'On Insatallments';
				$this->updateproperty($seller_id,$propid,$status);
			}
		}
		else if($data_payment['payment_type']=="Rent")
		{
			
			if($data_booking['broker_id'] != 0)
			{
				$res = $this->db->select('book_id')
				->from('tbl_commission')
				->where("tbl_commission.book_id='$book_id'")->get();
				if($res->num_rows()>0)
				{
					
					$this->db->where('tbl_commission.book_id',$book_id);
					$res = $this->db->update('tbl_commission',$data_commission);
					$total_amount_paid = $this->PAYMENT_Model->updateamount($pay_id);
				} 
				else
				{
					$data_commission['book_id'] = $book_id;
					$data_commission['pay_id'] = $pay_id;
					$res = $this->db->insert('tbl_commission',$data_commission);
					$total_amount_paid = $this->PAYMENT_Model->updateamount($pay_id);

					$total_balance_amount = $this->PAYMENT_Model->getbalanceamount($pay_id);
					$balance_amount = $total_balance_amount['balance_amount'];
					
					$this->db->set('tbl_payment.balance_amount',$balance_amount);
					$this->db->where('tbl_payment.book_id',$book_id);
					$res = $this->db->update('tbl_payment');

				}

				$rent_amount = $data_rent['rent_amount'];
				$this->db->set('tbl_rent.rent_amount',$rent_amount);
				$this->db->where('tbl_rent.book_id',$book_id);
				$res = $this->db->update('tbl_rent');

				$seller_id = $data_booking['seller_id'];
				$propid = $data_booking['propid'];
				$status = 'On Rent';
				$this->updateproperty($seller_id,$propid,$status);
				
			}
			else
			{

				$rent_amount = $data_rent['rent_amount'];
				$this->db->set('tbl_rent.rent_amount',$rent_amount);
				$this->db->where('tbl_rent.book_id',$book_id);
				$res = $this->db->update('tbl_rent');

				$total_amount_paid = $this->PAYMENT_Model->updateamount($pay_id);
				$commission = $data_commission['commission_amount'];
				$total_balance_amount = $this->PAYMENT_Model->getbalanceamount($pay_id);
				
				
				$total_commission = $this->PAYMENT_Model->gettotalcommission($pay_id);
				$total_balance_amount['balance_amount'] += $total_commission['commission_amount'];
				$balance_amount = $total_balance_amount['balance_amount'];
				
				$this->db->set('tbl_payment.balance_amount',$balance_amount);
				$this->db->where('tbl_payment.pay_id',$pay_id);
				$res = $this->db->update('tbl_payment');

				$seller_id = $data_booking['seller_id'];
				$propid = $data_booking['propid'];
				$status = 'On Rent';
				$this->updateproperty($seller_id,$propid,$status);


				$this->PAYMENT_Model->do_delete_commission($book_id);

			}
			//$total_amount_paid = $this->PAYMENT_Model->updateamount($pay_id);
			
		}
		$response['message'] = "Record has been Updated ";
		$response['status'] = "1";
		return $response;	
	}

}
?>