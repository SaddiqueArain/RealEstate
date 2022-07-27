<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->view('Home/header');
		
	}
	public function index()
	{
		$data['property'] = $this->PROPERTY_Model->getproperty();
		$data['current'] = $this->PROJECT_Model->onGoingProject();
		$data['completed'] = $this->PROJECT_Model->completedProject();
		$data['city'] = $this->PROPERTY_Model->do_citylist();
		$data['type'] = $this->PROPERTY_Model->do_typelist();
		$data['area'] = $this->PROPERTY_Model->do_arealist();
		
		$this->load->view('Home/home',$data);
	}
	public function getsubtype()
	{
		$type_id = $this->input->post('type_id');
		echo json_encode($this->PROPERTY_Model->do_getsubtype($type_id));
		exit();

	}
	public function desired_property()
	{
		$prop_status = $this->input->post('prop_status');
		$city_name = $this->input->post('city_name');
		$type = $this->input->post('type');
		$sub_type = $this->input->post('sub_type');
		$location = $this->input->post('location');
		$area = $this->input->post('area');
		//exit();
		$data['desired'] = $this->HOME_Model->getdesired_property($prop_status,$city_name,$type,$sub_type,$location,$area);
		//echo $prop_status;
		//echo $city_name;
		//echo $type;
		//echo $sub_type;
		//echo $location;
		
		//echo json_encode($data);
		$this->load->view('Home/desired_property',$data);
		//exit();
	}
	public function propertyinfo()
	{
		$propid = $this->input->post('propid');
		$data['property'] = $this->PROPERTY_Model->do_propertycategory($propid);
		$this->load->view('Home/viewproperty',$data);
	}
	public function getproperties()
	{
		//$data['forsale'] = $this->HOME_Model->propertyforsale();
		//$data['forrent'] = $this->HOME_Model->propertyforrent();
		$data['homes'] = $this->HOME_Model->propertyhouse();
		$data['plots'] = $this->HOME_Model->propertyplots();
		$data['commercial'] = $this->HOME_Model->propertycommercial();
		$this->load->view('Home/properties',$data);
	}
	public function about()
	{
		$this->load->view('Home/about');
		//$this->load->view('Home/footer');
	}
	public function contact()
	{
		$this->load->view('Home/contact');
	}
	public function insert_message()
	{
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		
		if($this->form_validation->run('contactUs'))
		{
			$data_message = array(
				'full_name' => $this->input->post('full_name') ,
				'email' => $this->input->post('email'),
				'contact_number' => $this->input->post('contact_number'),
				'subject' => $this->input->post('subject'), 
				'message' => $this->input->post('message') 
				);

			$response = $this->HOME_Model->do_addmessage($data_message);
			
			if($response['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been inserted');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Home/index');
			}
			else
			{	

				$this->session->set_flashdata('Insert_Failed','Insertion Failed');
				$this->session->set_flashdata('msg_class','alert alert-danger');
				return redirect('Home/contact');
			}
		}
		else
		{
			$this->load->view('Home/contact');
		}
	}
	public function projects()
	{
		$data['residencial'] = $this->HOME_Model->getResidencials();
		$data['offices'] = $this->HOME_Model->getOffices();
		$data['mall'] = $this->HOME_Model->getMalls();
		$this->load->view('Home/projects',$data);
	}
	public function completeprojectinfo()
	{
		$project_id = $this->input->post('project_id');
		$data['complete'] = $this->PROJECT_Model->getprojectdetails($project_id);
		$this->load->view('Home/viewcomplete_project',$data);
	}
	public function currentprojectinfo()
	{
		$project_id = $this->input->post('project_id');
		$data['current'] = $this->PROJECT_Model->getprojectdetails($project_id);
		$this->load->view('Home/viewcurrent_project',$data);
	}
}
?>