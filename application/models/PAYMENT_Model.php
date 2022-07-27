<?php
//17 - 2 functions
defined('BASEPATH') OR exit('No direct script access allowed');

class PAYMENT_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		
	}
	public function do_getpayment()
	{
		$this->db->select('*');
		$this->db->from('tbl_payment');
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getClientPayment($uid)
	{
		$this->db->select('*');
		$this->db->from('tbl_payment');
		$this->db->join('tbl_booking','tbl_booking.book_id=tbl_payment.book_id');
		$this->db->join('tbl_property','tbl_booking.propid=tbl_property.propid');
		$this->db->where("tbl_booking.buyer_id='$uid' or tbl_booking.seller_id='$uid'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getbookingpayment($book_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_payment');
		$this->db->where("tbl_payment.book_id='$book_id'");
		$res = $this->db->get();
		return $res->row();
	}
	public function getpayment($pay_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_payment');
		$this->db->where("tbl_payment.pay_id='$pay_id'");
		$res = $this->db->get();
		return $res->row();
	}
	public function get_paymentrent()
	{
		$this->db->select('*');
		$this->db->from('tbl_payment');
		$this->db->where("tbl_payment.payment_type='Rent'");
		$res = $this->db->get();
		return $res->result_array();
	}
	
	public function getrent($book_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_rent');
		$this->db->where("tbl_rent.book_id='$book_id'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getall_installments($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_payment_installments');
		$this->db->limit($limit,$offset);
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getinstallmets($pay_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_payment_installments');
		$this->db->where("tbl_payment_installments.pay_id='$pay_id'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function get_rent_booking($pay_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_payment');
		$this->db->where("tbl_payment.pay_id='$pay_id'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_addpayment($data_booking,$data_payment,$data_commission,$data_rent)
	{
		$brok_id = $data_booking['broker_id'];
		$last_id = $data_payment['book_id'];
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
			$this->db->set('tbl_booking.broker_id',$brok_id);
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
			$this->db->set('tbl_booking.broker_id',$brok_id);
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
			$this->db->set('tbl_booking.broker_id',$brok_id);
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
	public function do_addrent($data_rent)
	{
		$res = $this->db->insert('tbl_rent',$data_rent);
		$response['message'] = 'Data is inserted successfully';
		$response['status'] = '1';
		return $response;
	}
	public function do_getcommission($book_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_commission');
		$this->db->where("tbl_commission.book_id='$book_id'");
		$res = $this->db->get();
		return $res->row();
	}
	public function do_delete_commission($book_id)
	{
		$this->db->where("tbl_commission.book_id='$book_id'");
		$res = $this->db->delete('tbl_commission');
		$response['message'] = "Record has been deleted ";
		$response['status'] = "1";
		return $response;
	}
	
	public function do_getrent($limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('tbl_rent');
		$this->db->limit($limit,$offset);
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getpropertyvalue($pay_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_booking');
		$this->db->join('tbl_property','tbl_booking.propid=tbl_property.propid');
		$this->db->join('tbl_payment','tbl_booking.book_id=tbl_payment.book_id');
		//$this->db->join('tbl_payment_installments','tbl_payment.pay_id=tbl_payment_installments.pay_id');
		$this->db->where("tbl_payment.pay_id='$pay_id'");
		$res = $this->db->get();
		return $res->result_array();

	}
	public function get_typeinstallment($pay_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_payment');
		$this->db->join('tbl_booking','tbl_booking.book_id=tbl_payment.book_id');
		$this->db->where("tbl_payment.pay_id='$pay_id' or tbl_payment.payment_type='Installment' and tbl_booking.status!='completed'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function do_getinstallment()
	{
		$this->db->select('*');
		$this->db->from('tbl_payment');
		$this->db->join('tbl_booking','tbl_booking.book_id=tbl_payment.book_id');
		$this->db->where("tbl_payment.payment_type='Installment' and tbl_booking.status!='completed'");
		$res = $this->db->get();
		return $res->result_array();
	}
	public function getbalanceamount($pay_id)
	{
		$this->db->select('balance_amount');
		$this->db->from('tbl_payment');
		$this->db->where("tbl_payment.pay_id='$pay_id'");
		$res = $this->db->get();
		$total_balance_amount['balance_amount'] = $res->row()->balance_amount;
		return $total_balance_amount;	
	}
	// checking
	public function gettotalamount($pay_id)
	{
		$this->db->select('downpayment');
		$this->db->from('tbl_payment');
		$this->db->where("tbl_payment.pay_id='$pay_id'");
		$res = $this->db->get();
		$total_amount['downpayment'] = $res->row()->downpayment;   // 4000000
		return $total_amount;
	}
	public function installmentsum($pay_id)
	{
		$this->db->select_sum('installment_amount');
		$this->db->from('tbl_payment_installments');
		$this->db->where("tbl_payment_installments.pay_id='$pay_id'");
		$res = $this->db->get();
		$amount['sumamount'] = $res->row()->installment_amount;    //   6000000
		return $amount;
			
	}
	public function gettotalcommission($pay_id)
	{
		$this->db->select('commission_amount');
		$this->db->from('tbl_commission');
		$this->db->where("tbl_commission.pay_id='$pay_id'");
		$res = $this->db->get();
		$total_commission['commission_amount'] = $res->row()->commission_amount;   // 4000000
		return $total_commission;
	}
	public function updateamount($pay_id)
	{
		$total_amount = $this->gettotalamount($pay_id); // 3300000	
		$amount = $this->installmentsum($pay_id);  //5600000
		$total_amount['downpayment'] += $amount['sumamount']; //8000000
		$total_amount_paid = $total_amount['downpayment'];
		
		$response = $total_amount['downpayment'];

		$total_commission = $this->gettotalcommission($pay_id); //
		
		$total_amount['downpayment'] -= $total_commission['commission_amount'];
		
		//echo json_encode($total_amount);
		//$total_amount['downpayment'] += $amount['sumamount'];
		$total_balance = $total_amount['downpayment'];
		//echo json_encode($total_balance);
		//exit();
		//echo $abc;
		$this->db->set('tbl_payment.total_amount_paid',$total_amount_paid);
		$this->db->set('tbl_payment.balance_amount',$total_balance);
		$this->db->where('tbl_payment.pay_id',$pay_id);
		$res = $this->db->update('tbl_payment');
		
		return $response;  //   10000000

	}
	// end checking
	public function do_addinstallment($data_payment,$data_update)
	{
		$res = $this->db->insert('tbl_payment_installments',$data_payment);
		$pay_id = $data_payment['pay_id'];
		$total_amount_paid = $this->updateamount($pay_id); //10000000
	//	echo $prop_value;
		if($total_amount_paid==$data_update['prop_value'])
		{
			$book_id = $data_update['book_id'];
			//echo $book_id;
			$this->db->set('tbl_booking.status','completed');
			$this->db->where('tbl_booking.book_id',$book_id);
			$res = $this->db->update('tbl_booking');
			$seller_id = $data_update['buyer_id'];
			$propid = $data_update['propid'];
			$status = 'Sold';
			$this->updateproperty($seller_id,$propid,$status);
		}
		
		$response['message'] = 'Data is inserted successfully';
		$response['status'] = '1';
		return $response;
	}
	public function updateproperty($seller_id,$propid,$status )
	{
		$this->db->set('tbl_property.uid',$seller_id);
		$this->db->set('tbl_property.prop_status',$status);
		$this->db->set('tbl_property.on_hold','1');
		$this->db->where('tbl_property.propid',$propid);
		$res = $this->db->update('tbl_property');
		$response['message'] = "Record has been Updated ";
		$response['status'] = "1";
		return $response;
	}
	// operations
	public function do_delete_pay_instal($pay_id)
	{
		$this->db->where("tbl_payment_installments.pay_id='$pay_id'");
		$res = $this->db->delete('tbl_payment_installments');
		$response['message'] = "Record has been deleted ";
		$response['status'] = "1";
		return $response;
	}
	public function get_paymentid($pay_inst_id)
	{
		$this->db->select('pay_id');
		$this->db->from('tbl_payment_installments');
		$this->db->where("tbl_payment_installments.pay_inst_id='$pay_inst_id'");
		$res = $this->db->get();
		$payment_id = $res->row()->pay_id;
		return $payment_id;
	}
	public function getbooking($pay_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_booking');
		$this->db->join('tbl_payment','tbl_payment.book_id=tbl_booking.book_id');
		$this->db->where("tbl_payment.pay_id='$pay_id'");
		$res = $this->db->get();
		$booking['status'] = $res->row()->status;
		$booking['seller_id'] = $res->row()->seller_id;
		$booking['propid'] = $res->row()->propid;
		$booking['book_id'] = $res->row()->book_id;
		return $booking;
	}
	public function do_delete_installment($pay_inst_id)
	{
		$pay_id = $this->get_paymentid($pay_inst_id);
		
		$this->db->where("tbl_payment_installments.pay_inst_id='$pay_inst_id'");
		$res = $this->db->delete('tbl_payment_installments');
		
		$this->updateamount($pay_id);
		$response['message'] = "Record has been deleted ";
		$response['status'] = "1";
		$response['pay_id'] = $pay_id;
		 
		//$response['pay_id'] = $pay_id;
		return $response;
	}
	public function updatebooking($booking_status,$book_id)
	{
		$this->db->set('tbl_booking.status',$booking_status);
		$this->db->where('tbl_booking.book_id',$book_id);
		$res = $this->db->update('tbl_booking');
		$response['message'] = "Record has been Updated ";
		$response['status'] = "1";
		return $response;
	}
	public function do_edit_installment($pay_inst_id)
	{	
		$this->db->select('*');
		$this->db->from('tbl_payment');
		$this->db->join('tbl_payment_installments','tbl_payment_installments.pay_id=tbl_payment.pay_id');
		$this->db->where("tbl_payment_installments.pay_inst_id='$pay_inst_id'");
		$res = $this->db->get();
		return $res->row();
	}
	public function do_update_installment($data_installment,$pay_inst_id)
	{
		$pay_id = $data_installment['pay_id'];
		$this->db->where('tbl_payment_installments.pay_inst_id',$pay_inst_id);
		$res = $this->db->update('tbl_payment_installments',$data_installment);

		$this->updateamount($pay_id);

		$response['message'] = "Record has been Updated ";
		$response['status'] = "1";
		
		return $response;	
	}
	public function do_delete_rent($rent_id)
	{
		$this->db->where("tbl_rent.rent_id='$rent_id'");
		$res = $this->db->delete('tbl_rent');
		
		$response['message'] = "Record has been deleted ";
		$response['status'] = "1";
		 
		return $response;
	}
	public function do_edit_rent($rent_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_rent');
		$this->db->where("tbl_rent.rent_id='$rent_id'");
		$res = $this->db->get();
		return $res->row();//17 r p 48
	}
	public function get_typerent($pay_id )
	{
		$this->db->select('*');
		$this->db->from('tbl_payment');
		$this->db->where("tbl_payment.pay_id='$pay_id' or tbl_payment.payment_type='Rent'");
		$res = $this->db->get();
		return $res->result_array();//17 13 r p 48
	}
	public function do_updaterent($data_rent,$rent_id)
	{
		$this->db->where('tbl_rent.rent_id',$rent_id);
		$res = $this->db->update('tbl_rent',$data_rent);

		$response['message'] = "Record has been Updated ";
		$response['status'] = "1";
		
		return $response;
	}
}
?>