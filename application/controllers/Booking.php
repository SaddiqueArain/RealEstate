<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Booking extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in'))
		{
		
			return redirect('Login/index');
		}
		$this->load->view('Partials/header');
		$this->load->view('Admin/sidebar');
		$this->load->view('Partials/footer');
		 header('Access-Control-Allow-Origin: *');
	}
	public function index()
	{
		$path = 'Booking/index';
		$count_rows = count($this->PAGINATION_Model->getbooking());
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);

		$data['seller'] = $this->BOOKING_Model->getsellername();
		$data['broker'] = $this->BOOKING_Model->getbrokername();
		$data['booking'] = $this->BOOKING_Model->getbooking($config['per_page'],$this->uri->segment(3));
		$this->load->view('Booking/booking',$data);
	}
	public function buyer_booking()
	{
		$data_booking = array(
				'propid'=> $this->input->post('propid') ,
				'seller_id'=> $this->input->post('seller_id') ,
				'buyer_id'=> $this->input->post('buyer_id') ,
				'broker_id'=> $this->input->post('broker'), 
				'status'=> 'On Hold' ,
				'is_approved'=> '0' 
				);
		if($data_booking['broker_id']=="accept")
		{
			$data_booking['broker_id'] = '-1';
		}
		else
		{
			$data_booking['broker_id'] = '0';
		}
		$response = $this->BOOKING_Model->do_buyer_booking($data_booking);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Insert_Success','Booking is on Hold make payment to confirm');
			$this->session->set_flashdata('msg_class','alert alert-success');
			return redirect('Home/index');
		}
		else
		{	
		//	return redirect('Home/addbooking');
			echo "hahhahahah";
		}
	}
	
	public function addbooking()
	{
		$data['property'] = $this->PROPERTY_Model->getproplist();
		$data['owner'] = $this->PROPERTY_Model->do_userlist();
		$data['buyer'] = $this->PROPERTY_Model->do_buyerlist();
		$data['broker'] = $this->BOOKING_Model->do_brokerlist();
		$this->load->view('Booking/addbooking',$data);
	}
	public function insert_booking()
	{
		$data_rent = array();
		//$commission = "";
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if($this->form_validation->run('addbooking'))
		{
			$data_booking = array(
				'propid'=> $this->input->post('property_name') ,
				'seller_id'=> $this->input->post('owner_id') ,
				'buyer_id'=> $this->input->post('buyer') ,
				'broker_id'=> $this->input->post('broker'), 
				'status'=> 'uncompleted' 
				);
			$data_payment = array(
				'payment_method'=>$this->input->post('payment_method') ,
				'payment_type'=>$this->input->post('payment_type') ,
				//'downpayment'=>$this->input->post('downpayment'),
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
				
			}	 

			$response = $this->BOOKING_Model->do_addbooking($data_commission,$data_booking,$data_payment,$data_rent);
			if($response['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been inserted');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Booking/index');
			}
			else
			{	
				return redirect('Booking/addbooking');
			}
		}
		else
		{
			$this->load->view('Booking/addbooking');
		}

	}
	public function getpropertycategory()
	{
		$propid =  $this->input->post('propid');
		$data['property'] = $this->PROPERTY_Model->do_propertycategory($propid);
		return $data;
	}
	public function delete_booking()
	{
		$book_id = $this->input->post('book_id');
		$response = $this->BOOKING_Model->do_delete_booking($book_id);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Delete_Success','Deletion is Successfull');
			$this->session->set_flashdata('msg_class','alert alert-success');
			return redirect('Booking/index');
			//$this->load->view('Property/property');
		}
		else
		{
			$this->session->set_flashdata('Delete_Failed','Deletion is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			return redirect('Booking/index');
			//$this->load->view('Property/property');
		}
	}
	public function edit_booking()
	{
		$book_id = $this->input->post('book_id');
		$propid = $this->input->post('propid');
		$data['owner'] = $this->PROPERTY_Model->do_userlist();
		$data['buyer'] = $this->BOOKING_Model->getbuyername();
		$data['broker'] = $this->BOOKING_Model->getbrokername();
		$data['property'] = $this->PROPERTY_Model->do_getproplist($propid);//do_propertylist
		$data['payment'] = $this->PAYMENT_Model->do_getpayment();
		$data['commission'] = $this->PAYMENT_Model->do_getcommission($book_id);
		$data['booking'] = $this->BOOKING_Model->do_edit_booking($book_id);
		//$booking =  $data['booking'];
		//echo json_encode($booking->book_id);
		//exit();
		$this->load->view('Booking/editbooking',$data);
	}
	public function getrent()
	{
		$book_id = $this->input->post('book_id');
		$response = $this->PAYMENT_Model->getrent($book_id);
		echo json_encode($response);
		exit();
	}
	public function update_booking()
	{
		//echo $this->input->post('commission');
		//exit();
		$data_rent = array();
		$data_commission = array();
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			$data_booking = array(
				'propid'=> $this->input->post('property_name') ,
				'buyer_id'=> $this->input->post('buyer') ,
				'broker_id'=> $this->input->post('broker'), 
				'seller_id'=> $this->input->post('owner_id') 
				);
			$data_payment = array(
				'payment_method'=>$this->input->post('payment') ,
				'payment_type'=>$this->input->post('payment_type') ,
				'pay_id'=>$this->input->post('pay_id') ,
				//'downpayment'=>$this->input->post('downpayment'),
			);
			$data_ids = array(
					'book_id' => $this->input->post('book_id'),
					'prop_value' => $this->input->post('prop_value'),
					'pre_seller_id' => $this->input->post('pre_seller_id'),
					'pre_propid' => $this->input->post('pre_propid')
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
					$commission = $this->input->post('commission');
					$data_commission['commission_amount'] = $commission;
					$data_payment['downpayment']=$this->input->post('prop_value');
					$data_payment['total_amount_paid']=$data_payment['downpayment'];
					$data_payment['balance_amount']=$data_payment['total_amount_paid'];	
				}
			}
			elseif($this->input->post('payment_type')=='Installment')
			{
				if($this->input->post('broker')!=0)
				{
					$commission = $this->input->post('commission');
					$data_payment['downpayment'] = $this->input->post('downpayment');
					$data_payment['total_amount_paid']=$data_payment['downpayment'];
					$remaining_amount = $data_payment['downpayment']-$commission; //1920000
					$data_payment['balance_amount'] = $remaining_amount; //1920000
					$data_commission['commission_amount'] = $commission; //480000
					$data_commission['broker_id'] = $data_booking['broker_id'];
					
				}
				else
				{
					$commission = $this->input->post('commission');
					$data_commission['commission_amount'] = $commission;
					$data_payment['downpayment'] = $this->input->post('downpayment');	
					$data_payment['total_amount_paid']=$data_payment['downpayment'];	
					$data_payment['balance_amount']=$data_payment['total_amount_paid'];	
				}
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

					$commission = $this->input->post('commission');
					$data_commission['commission_amount'] = $commission;
					$data_payment['downpayment'] = $this->input->post('downpayment');	
					$data_payment['total_amount_paid']=$data_payment['downpayment'];
					$data_payment['balance_amount']=$data_payment['total_amount_paid'];
					$data_rent['rent_amount']= $this->input->post('rentamount');	
					
				}
				
			}		 
				
			$response = $this->BOOKING_Model->do_update_booking($data_commission,$data_booking,$data_payment,$data_rent,$data_ids);
			if($response['status']==1)
			{
				$this->session->set_flashdata('Update_Success','Record has been updated');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Booking/index');
			}
			else
			{	
				$this->session->set_flashdata('Update_Failed','Updation Failed');
				$this->session->set_flashdata('msg_class','alert alert-danger');
				return redirect('Booking/edit_booking');
			}
	}
	
}
?>