<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Client extends CI_Controller{
	public function __construct(){
		parent::__construct();

		if(!$this->session->userdata('logged_in'))
		{
		
			return redirect('Login/index');
		}
		$this->load->view('Partials/header');
		$this->load->view('Client/sidebar');
		$this->load->view('Partials/footer');
		 header('Access-Control-Allow-Origin: *');
	}
	// Dashboard charts or calculations
	public function index()
	{
		
		$uid = $this->session->userdata('uid');
		$data['total_properties_forsale'] = count($this->CLIENT_Model->propertyforsale($uid));
		$data['total_properties_forrent'] = count($this->CLIENT_Model->propertyforrent($uid));
		$data['total_properties_oninstallment'] = count($this->LIST_Model->do_getproperty_oninstallment($uid));
		$data['total_properties_onrent'] = count($this->LIST_Model->do_getproperty_onrent($uid));
		$data['total_properties_sold'] = count($this->LIST_Model->do_getproperty_sold($uid));
		$data['total_properties_purchase'] = count($this->LIST_Model->do_purchasedproperty($uid));

		//$data['total_bookings'] = count($this->PAGINATION_Model->getbooking());
		$this->load->view('Client/dashboard',$data);	

	}
	public function pendingbooking()
	{
		$user_id = $this->session->userdata('uid');
		// for pagination
		$path = 'Client/pendingbooking';
		$count_rows = count($this->PAGINATION_Model->do_pendingbookings($user_id));
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);
		
		$data['seller'] = $this->BOOKING_Model->getsellername();
		$data['broker'] = $this->BOOKING_Model->getbrokername();
		$data['booking'] = $this->CLIENT_Model->do_pendingbookings($config['per_page'],$this->uri->segment(3),$user_id);
		$this->load->view('Client/bookingapprovals',$data);
	}
	public function bookinglist()
	{
		$buyer_id = $this->session->userdata('uid');
		// for pagination
		$path = 'Buyer/bookinglist';
		$count_rows = count($this->PAGINATION_Model->get_buyerbooking($buyer_id));
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);
		
		$data['seller'] = $this->BOOKING_Model->getsellername();
		$data['broker'] = $this->BOOKING_Model->getbrokername();
		$data['booking'] = $this->BOOKING_Model->get_buyerbooking($config['per_page'],$this->uri->segment(3),$buyer_id);
		$this->load->view('Client/bookinglist',$data);
	}
	public function pendingproperty()
	{
		$user_id = $this->session->userdata('uid');
		// for pagination
		$path = 'Client/pendingproperty';
		$count_rows = count($this->PAGINATION_Model->get_pendingproperty($user_id));
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);
		
		$data['details'] = $this->CLIENT_Model->get_pendingproperty($config['per_page'],$this->uri->segment(3),$user_id);
		$this->load->view('Client/propertyapprovals',$data);
	}
	public function propertylist()
	{
		$user_id = $this->session->userdata('uid');
		$path = 'Client/propertylist';
		$count_rows = count($this->PAGINATION_Model->get_userproperty($user_id));
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);

		$data['details'] = $this->PROPERTY_Model->get_userproperty($config['per_page'],$this->uri->segment(3),$user_id);
		$this->load->view('Property/property',$data);
	}

	public function getPayment()
	{
		$book_id = $this->input->post('book_id');
		$data['book_payment'] = $this->PAYMENT_Model->getbookingpayment($book_id);
		$this->load->view('Client/bookingpayment',$data);
	}
	public function getInstallment()
	{
		$pay_id = $this->input->post('pay_id');
		echo json_encode($this->PAYMENT_Model->getinstallmets($pay_id));
		exit();
	}
	public function do_demand()
	{
		$this->load->view('Material/demand_material');
	}
}
?>