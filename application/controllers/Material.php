<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Material extends CI_Controller{
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
	// Material Opertaions
	public function index()
	{
		$path = 'Material/index';
		$count_rows = count($this->PAGINATION_Model->do_materiallist());
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);
		
		$data['details'] = $this->MATERIAL_Model->do_materiallist($config['per_page'],$this->uri->segment(3));
		$this->load->view('Material/material',$data);
	}
	public function addmaterial_type()
	{	
		$data['material_id'] = $this->input->post('material_id');
		$this->load->view('Material/addmaterial_type',$data);
	}
	public function insert_materialtype()
	{
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if($this->form_validation->run('addmaterialtype'))
		{
			$data_materialtype = array(
				'type_name' => $this->input->post('type_name'),
				'material_id' => $this->input->post('material_id')
			);

			$response = $this->MATERIAL_Model->add_material_type($data_materialtype);
			if($response['status']==1)
			{
				$this->session->set_flashdata('Insert_Success','Record has been inserted');
				$this->session->set_flashdata('msg_class','alert alert-success');
				return redirect('Material/index');
			}
			else
			{	

				$this->session->set_flashdata('Insert_Failed','Insertion Failed');
				$this->session->set_flashdata('msg_class','alert alert-danger');
				return redirect('Material/addmaterial_type');
			}
		}
		else
		{
			$this->load->view('Material/addmaterial_type');
		}

	}
	public function edit_material_type()
	{
		$mat_type_id = $this->input->post('mat_type_id');
		$data['type'] = $this->MATERIAL_Model->edit_materialtype($mat_type_id);
		$data['material'] = $this->MATERIAL_Model->get_material();
		$this->load->view('Material/edit_material_type',$data);
	}
	public function update_material_type()
	{
		$mat_type_id = $this->input->post('mat_type_id');
		$data_materialtype = array(
				'type_name' => $this->input->post('type_name'),
				'material_id' => $this->input->post('material_id')
			);

			$response = $this->MATERIAL_Model->update_material_type($data_materialtype,$mat_type_id);	
		if($response['status']==1)
		{
			$this->session->set_flashdata('Update_Success','Updation is Success');
			$this->session->set_flashdata('msg_class','alert alert-success');
			return redirect('Material/index');
		}
		else
		{
			$this->session->set_flashdata('Update_Failed','Updation is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			return redirect('Material/index');
			
		}
	}
	public function delete_materialtype()
	{
		$mat_type_id = $this->input->post('mat_type_id');
		$response = $this->MATERIAL_Model->delete_materialtype($mat_type_id);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Delete_Success','Deletion is Success');
			$this->session->set_flashdata('msg_class','alert alert-success');
			$this->load->view('Material/material');
		}
		else
		{
			$this->session->set_flashdata('Delete_Failed','Deletion is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			$this->load->view('Material/material');
			
		}
	}
	public function getMaterialType()
	{
		$material_id = $this->input->post('material_id');
		echo json_encode($this->MATERIAL_Model->get_material_type($material_id));
		exit();
	}
	
	
	public function edit_material()
	{
		$material_id = $this->input->post('material_id');
		$data['material'] = $this->MATERIAL_Model->edit_material($material_id);
		$this->load->view('Material/edit_material',$data);
	}
	public function update_material()
	{
		$material_id = $this->input->post('material_id');
		$data_material = array(
			'material_name' => $this->input->post('material_name')
		);
		$response = $this->MATERIAL_Model->update_material($data_material,$material_id);
		if($response['status']==1)
		{
			$this->session->set_flashdata('Update_Success','Updation is Success');
			$this->session->set_flashdata('msg_class','alert alert-success');
			return redirect('Material/index');
		}
		else
		{
			$this->session->set_flashdata('Update_Failed','Updation is Failed');
			$this->session->set_flashdata('msg_class','alert alert-danger');
			return redirect('Material/index');
			
		}
	}
	// Material Sub Type Operations
	public function material_details()
	{
		
		$path = 'Material/material_details';
		$material_id = $this->input->post('material_id');
		$count_rows = count($this->PAGINATION_Model->do_material_details($material_id));
		$config = $this->PAGINATION_Model->getpagination($path,$count_rows);
		
		$data['materialDetails'] = $this->MATERIAL_Model->get_materialdetails($config['per_page'],$this->uri->segment(3),$material_id);
		$this->load->view('Material/material_details',$data);
	}	
	public function demand_material()
	{
		$data_demand_material = array();
		$data_demand_quantity = array();
		$data_user = array('uid' => $this->session->userdata('uid') );
		if($this->input->post('wood_chk')==="accept")
		{
			$data_demand_material['wood'] =   $this->input->post('wood');
			$data_demand_quantity['wood_quantity'] = $this->input->post('wood_quantity').$this->input->post('wood_unit');
		}
		if($this->input->post('cement_chk')==="accept")
		{
			$data_demand_material['cement'] = $this->input->post('cement');
			$data_demand_quantity['cement_quantity'] = $this->input->post('cement_quantity').$this->input->post('cement_unit');
		}
		if($this->input->post('sand_chk')==="accept")
		{
			$data_demand_material['sand'] =  $this->input->post('sand');
			$data_demand_quantity['sand_quantity'] = $this->input->post('sand_quantity') .$this->input->post('sand_unit');
		}
		if($this->input->post('steel_chk')==="accept")
		{
			$data_demand_material['steel'] =  $this->input->post('steel');
			$data_demand_quantity['steel_quantity'] = $this->input->post('steel_quantity') .$this->input->post('steel_unit');
		}
		if($this->input->post('brick_chk')==="accept")
		{
			$data_demand_material['bricks'] =  $this->input->post('brick');
			$data_demand_quantity['bricks_quantity'] = $this->input->post('brick_quantity');
		}
		if($this->input->post('tile_chk')==="accept")
		{
			$data_demand_material['tiles'] =   $this->input->post('tile');
			$data_demand_quantity['tiles_quantity'] = $this->input->post('tile_quantity').$this->input->post('tile_unit');
		}
		if($this->input->post('plastic_chk')==="accept")
		{
			$data_demand_material['plastic'] =   $this->input->post('plastic');
			$data_demand_quantity['plastic_quantity'] = $this->input->post('plastic_quantity'). $this->input->post('plastic_unit') ;
		}
		if($this->input->post('glass_chk')==="accept")
		{
			$data_demand_material['glass'] =   $this->input->post('glass');
			$data_demand_quantity['glass_quantity'] =  $this->input->post('glass_quantity').$this->input->post('glass_unit');
		}
		if($this->input->post('concrete_chk')==="accept")
		{
			$data_demand_material['concrete'] =   $this->input->post('concrete');
			$data_demand_quantity['concrete_quantity'] = $this->input->post('concrete_unit').$this->input->post('concrete_quantity');
		}
		
		
		
		//echo json_encode($data_demand_material);
		//echo "//////////////////////////////////////////////////////////////////////";
		//echo json_encode($data_demand_quantity);
		//exit();
		$response = $this->MATERIAL_Model->do_demand_material($data_user,$data_demand_material,$data_demand_quantity);
		if($response['status']==1)
		{
			echo "Data is posted!!!!!!!!!!!!!!!!!!!!!!!!";
			exit();
		}
		else
		{
			echo "Failed";
			exit();
		}
	}
	
	
}
?>