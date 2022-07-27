<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in'))
		{
		
			return redirect('Login/index');
		}
		if($this->session->userdata('user_type')=="admin")
		{
			$this->load->view('Partials/header');
			$this->load->view('Admin/sidebar');
			$this->load->view('Partials/footer');	
		}
		elseif ($this->session->userdata('user_type')!="admin") {
			$this->load->view('Partials/header');
			$this->load->view('Client/sidebar');
			$this->load->view('Partials/footer');	
		}
		
		header('Access-Control-Allow-Origin: *');
	}
	public function index()
	{
		$data['details'] = $this->PAYMENT_Model->do_getpayment();
		$this->load->view('Payment/payment',$data);
	}
	public function getpropvalue()
	{
		$pay_id = $this->input->post('pay_id');
		echo json_encode($this->PAYMENT_Model->getpropertyvalue($pay_id));
		exit();
	}
	public function addpayment()
	{
		$book_id = $this->input->post('book_id');
		//$data_approved = array('is_approved' => '1');
		//$response = $this->ADMIN_Model->do_approved_bookings($data_approved,$book_id);
		
		$propid = $this->input->post('propid');
		$data['property'] = $this->PROPERTY_Model->do_getpropowner($propid);
		$data['booking'] = $this->BOOKING_Model->do_getbooking($book_id);
		$data['broker'] = $this->BOOKING_Model->do_brokerlist();
	//	echo json_encode($data);
		$this->load->view('Payment/addpayment',$data);
	}
	public function insert_payment()
	{
		$data_rent = array();
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if($this->form_validation->run('addpayment'))
		{
			$data_booking = array(
				'buyer_id' => $this->input->post('buyer_id'),
				'seller_id' => $this->input->post('seller_id'),
				'propid' => $this->input->post('propid'),
				'broker_id' => $this->input->post('broker') 
				);
			$data_payment = array(
				'book_id'=> $this->input->post('book_id') ,
				'payment_method'=> $this->input->post('payment_method') ,
				'payment_type'=> $this->input->post('payment_type') 
				);
			if($this->input->post('payment_type')=='Full_Payment')
			{
				if($this->input->post('broker')!=0)
				{
					$commission = $this->input->post('commission');
					$data_payment['downpayment'] = $this->input->post('prop_value');
					$data_payment['total_amount_paid']=$data_payment['downpayment'];
					$remaining_amount = $data_payment['downpayment']-$commission;
					$data_payment['balance_amount'] = $remaining_amount;
					$data_commission['commission_amount'] = $commission;
					$data_commission['broker_id'] = $data_booking['broker_id'];
				}
				else
				{
					$data_payment['downpayment']=$this->input->post('prop_value');
					$data_payment['total_amount_paid']=$data_payment['downpayment'];
					$data_payment['balance_amount']=$data_payment['total_amount_paid'];	
				}
				$book_id = $this->input->post('book_id');
				$data_approved = array('is_approved' => '1');
				$this->ADMIN_Model->do_approved_bookings($data_approved,$book_id);
				
			}
			elseif($this->input->post('payment_type')=='Installment')
			{
				// for broker commission
				if($this->input->post('broker')!=0)
				{
					$commission = $this->input->post('commission');
					$data_payment['downpayment'] = $this->input->post('downpayment');
					$data_payment['total_amount_paid']=$data_payment['downpayment'];
					$remaining_amount = $data_payment['downpayment']-$commission;
					$data_payment['balance_amount'] = $remaining_amount;
					$data_commission['commission_amount'] = $commission;
					$data_commission['broker_id'] = $data_booking['broker_id'];
				}
				else
				{
					$data_payment['downpayment'] = $this->input->post('downpayment');	
					$data_payment['total_amount_paid']=$data_payment['downpayment'];	
					$data_payment['balance_amount']=$data_payment['total_amount_paid'];	
				}
				$book_id = $this->input->post('book_id');
				$data_approved = array('is_approved' => '1');
				$this->ADMIN_Model->do_approved_bookings($data_approved,$book_id);
				// end broker commission
				//
			}
			elseif($this->input->post('payment_type')=='Rent')
			{
				if($this->input->post('broker')!=0)
				{
					$commission = $this->input->post('commission');
					$data_payment['downpayment'] = $this->input->post('downpayment');
					$data_payment['total_amount_paid']=$data_payment['downpayment'];
					$remaining_amount = $data_payment['downpayment']-$commission;
					$data_payment['balance_amount'] = $remaining_amount;
					$data_commission['commission_amount'] = $commission;
					$data_commission['broker_id'] = $data_booking['broker_id'];
					$data_rent['rent_amount']= $this->input->post('rentamount');
				}
				else
				{
					$data_payment['downpayment'] = $this->input->post('downpayment');	
					$data_payment['total_amount_paid']=$data_payment['downpayment'];
					$data_payment['balance_amount']=$data_payment['total_amount_paid'];
					$data_rent['rent_amount']= $this->input->post('rentamount');	
				}
				$book_id = $this->input->post('book_id');
				$data_approved = array('is_approved' => '1');
				$this->ADMIN_Model->do_approved_bookings($data_approved,$book_id);
			}

			$response = $this->PAYMENT_Model->do_addpayment($data_booking,$data_payment,$data_commission,$data_rent);
			if($response['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been inserted');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Booking/index');
			}
			else
			{	
				return redirect('Payment/addpayment');
			}
		}
		else
		{
			$this->load->view('Payment/addpayment');
		}
	}
	public function installment()
	{
		$path = 'Payment/installment';
		$count_rows = count($this->PAGINATION_Model->getall_installments());
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);

		$data['payment'] = $this->PAYMENT_Model->getall_installments($config['per_page'],$this->uri->segment(3));
		$this->load->view('Payment/installment',$data);
	}
	public function addinstallment()
	{
		$data['payment'] = $this->PAYMENT_Model->do_getinstallment();
		$this->load->view('Payment/addinstallment',$data);
	}
	public function insert_installment()
	{
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if($this->form_validation->run('addinstallment'))
		{
			$data_payment = array(
				'pay_id'=> $this->input->post('payment_id') ,
				'installment_no'=> $this->input->post('installment_no') ,
				'installment_amount'=> $this->input->post('installment_amount') 
				);

			//	$data_payment['downpayment'] = $this->input->post('downpayment');	
			//	$data_payment['total_amount_paid']=$data_payment['downpayment'];
			$data_update = array(
				'prop_value'=>$this->input->post('prop_value'),
				'propid'=>$this->input->post('propid'),
				'buyer_id'=>$this->input->post('buyer_id'),
				'book_id'=>$this->input->post('book_id')
				);
			$response = $this->PAYMENT_Model->do_addinstallment($data_payment,$data_update);
			if($response['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been inserted');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Payment/installment');
			}
			else
			{	
				return redirect('Payment/addinstallment');
			}
		}
		else
		{
			$this->load->view('Payment/addinstallment');
		}
	}
	// extra
	public function delete_all_installment()
	{
		$pay_id = $this->input->post('pay_id');
		$response = $this->PAYMENT_Model->do_delete_pay_instal($pay_id);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Delete_Success','Deletion is Successfull');
			$this->session->set_flashdata('msg_class','alert alert-success');
			return redirect('Payment/index');
			//$this->load->view('Property/property');
		}
		else
		{
			$this->session->set_flashdata('Delete_Failed','Deletion is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			return redirect('Payment/index');
			//$this->load->view('Property/property');
		}	
	}
	public function delete_installment()
	{
		//$url = $this->uri->uri_string();
		$pay_inst_id = $this->input->post('pay_inst_id');
		$response = $this->PAYMENT_Model->do_delete_installment($pay_inst_id);
		$pay_id = $response['pay_id'];
		$booking = $this->PAYMENT_Model->getbooking($pay_id);
			
		if($response['status']==1)
		{
			$this->session->set_flashdata('Delete_Success','Deletion is Successfull');
			$this->session->set_flashdata('msg_class','alert alert-success');
			
			if($booking['status']=="completed")
			{
				$booking_status = "uncompleted";
				$book_id = $booking['book_id'];
				$status = "On Installment";
				$seller_id = $booking['seller_id'];
				$propid = $booking['propid'];
				$this->PAYMENT_Model->updateproperty($seller_id,$propid,$status);
				$this->PAYMENT_Model->updatebooking($booking_status,$book_id);
				//echo json_encode($booking);
			}
			
			return redirect('Payment/installment');
			//$this->load->view('Property/property');
		}
		else
		{
			$this->session->set_flashdata('Delete_Failed','Deletion is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			return redirect('Payment/installment');
			//$this->load->view('Property/property');
		}
	}
	
	public function edit_installment()
	{
		$pay_inst_id = $this->input->post('pay_inst_id');
		$pay_id = $this->input->post('pay_id');
		
		$data['installment'] = $this->PAYMENT_Model->do_edit_installment($pay_inst_id);
		$data['payment'] = $this->PAYMENT_Model->get_typeinstallment($pay_id);
		$this->load->view('Payment/edit_installment',$data);
	}
	public function update_installment()
	{
		
			$data_installment = array(
				'pay_id'=> $this->input->post('payment_id') ,
				'installment_no'=> $this->input->post('installment_no') ,
				'installment_amount'=> $this->input->post('installment_amount') 
				);
			
			$data_update = array(
				'prop_value'=> $this->input->post('prop_value') ,	
				'propid'=> $this->input->post('propid') ,	
				'buyer_id'=> $this->input->post('buyer_id') ,	
				'book_id'=> $this->input->post('book_id') ,	
				'seller_id'=> $this->input->post('seller_id') 
					
				);
			$data_previous = array(
				'pre_propid'=> $this->input->post('pre_propid') ,	
				'pre_book_id'=> $this->input->post('pre_book_id') ,	
				'pre_seller_id'=> $this->input->post('pre_seller_id') 
					
				);
			

			$pay_inst_id = $this->input->post('pay_inst_id');		
			$response = $this->PAYMENT_Model->do_update_installment($data_installment,$pay_inst_id);
		

			if($response['status']==1)
			{
				$this->session->set_flashdata('Update_Success','Record has been updated');
				$this->session->set_flashdata('msg_class','alert alert-success');

				$pre_pay_id = $this->input->post('pre_pay_id');
				if($data_installment['pay_id'] != $pre_pay_id)
				{
					$this->PAYMENT_Model->updateamount($pre_pay_id);
				    $booking_status = "uncompleted";
					$book_id = $data_previous['pre_book_id'];
					$status = "On Installment";
					$seller_id = $data_previous['pre_seller_id'];
					$propid = $data_previous['pre_propid'];
					$this->PAYMENT_Model->updateproperty($seller_id,$propid,$status);
					$this->PAYMENT_Model->updatebooking($booking_status,$book_id);

				}

				$pay_id = $data_installment['pay_id'];
				$paid_amount = $this->PAYMENT_Model->getpayment($pay_id);
				
				$total_amount_paid =  $paid_amount->total_amount_paid;

				if($data_update['prop_value']!= $total_amount_paid)
				{
					$booking_status = "uncompleted";
					$book_id = $data_update['book_id'];
					$status = "On Installment";
					$seller_id = $data_update['seller_id'];
					$propid = $data_update['propid'];
					$this->PAYMENT_Model->updateproperty($seller_id,$propid,$status);
					$this->PAYMENT_Model->updatebooking($booking_status,$book_id);
					//echo json_encode($booking);
				}
				else
				{
					$booking_status = "completed";
					$book_id = $data_update['book_id'];
					$status = "Sold";
					$seller_id = $data_update['buyer_id'];
					$propid = $data_update['propid'];
					$this->PAYMENT_Model->updateproperty($seller_id,$propid,$status);
					$this->PAYMENT_Model->updatebooking($booking_status,$book_id);	
				}
				return redirect('Payment/installment');
				//$this->load->view('Property/property');
			}
			else
			{	
				$this->session->set_flashdata('Update_Failed','Updation is Failed');
				$this->session->set_flashdata('msg_class','alert alert-danger');
				return redirect('Payment/edit_installment');
				//$this->load->view('Property/editproperty');
			}
		
	}
	public function payment_details()
	{
		$pay_id = $this->input->post('pay_id');
		$book_id = $this->input->post('book_id');
		$data['payment'] = $this->PAYMENT_Model->getpayment($pay_id);
		$data['installment'] = $this->PAYMENT_Model->getinstallmets($pay_id);
		$data['rent'] = $this->PAYMENT_Model->getrent($book_id);
		$this->load->view('Payment/payment_details',$data);
	}
	// Rent details
	public function rent()
	{
		$path = 'Payment/rent';
		$count_rows = count($this->PAGINATION_Model->do_getrent());
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);
		
		$data['rent'] = $this->PAYMENT_Model->do_getrent($config['per_page'],$this->uri->segment(3));
		$this->load->view('Payment/rent',$data);
	}
	public function addrent()
	{
		$data['payment'] = $this->PAYMENT_Model->get_paymentrent();
		$this->load->view('Payment/addrent',$data);
	}
	public function insert_rent()
	{
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if($this->form_validation->run('addrent'))
		{
			$data_rent = array(
				'rent_amount' => $this->input->post('rentamount'),
				'pay_id'=> $this->input->post('pay_id') ,
				'book_id'=> $this->input->post('book_id') 
				);

			$response = $this->PAYMENT_Model->do_addrent($data_rent);
			if($response['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been inserted');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Payment/rent');
			}
			else
			{	
				return redirect('Payment/addrent');
			}
		}
		else
		{
			$this->load->view('Payment/addrent');
		}
	}
	public function delete_rent()
	{
		$rent_id = $this->input->post('rent_id');
		$response = $this->PAYMENT_Model->do_delete_rent($rent_id);
			
		if($response['status']==1)
		{
			$this->session->set_flashdata('Delete_Success','Deletion is Successfull');
			$this->session->set_flashdata('msg_class','alert alert-success');
			
			return redirect('Payment/rent');
			//$this->load->view('Property/property');
		}
		else
		{
			$this->session->set_flashdata('Delete_Failed','Deletion is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			return redirect('Payment/rent');
			//$this->load->view('Property/property');
		}
	}
	public function edit_rent()
	{
		$rent_id = $this->input->post('rent_id');
		$pay_id = $this->input->post('pay_id');
		
		$data['rent'] = $this->PAYMENT_Model->do_edit_rent($rent_id);
		$data['payment'] = $this->PAYMENT_Model->get_typerent($pay_id);
		//echo json_encode($data);
		$this->load->view('Payment/edit_rent',$data);
	}
	public function update_rent()
	{
			$data_rent = array(
				'rent_amount' => $this->input->post('rentamount'),
				'pay_id'=> $this->input->post('pay_id') ,
				'book_id'=> $this->input->post('book_id') 
				);
			$rent_id = $this->input->post('rent_id');
			$response = $this->PAYMENT_Model->do_updaterent($data_rent,$rent_id);
			if($response['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been inserted');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Payment/rent');
			}
			else
			{	
				return redirect('Payment/edit_rent');
			}
		
	}
	public function get_bookingid()
	{
		$pay_id = $this->input->post('pay_id');
		echo json_encode($this->PAYMENT_Model->get_rent_booking($pay_id));
		exit();
	}

	// Buyer or seller side

	public function clientPayment()
	{
		$uid = $this->session->userdata('uid');
		$data['payment'] = $this->PAYMENT_Model->getClientPayment($uid);
		
		$this->load->view('Client/payment_history',$data);
	}
}
?>