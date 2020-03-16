<?php

class Referances extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Referances_model');
		if ($this->session->userdata('user')->auth != 0) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$data 					= new StdClass;
		$header_data 			= new StdClass;
		$header_data->mainMenu 	= 'Referances';
		$header_data->subMenu  	= 'ReferancesList';

		$data->list = $this->Referances_model->ListsReferances();
		if ($data->list == '') 
		{
			$data->list = array();
			
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/referances',$data);
		$this->load->view('Admin/footer');
	}
	public function Add()
	{
		$header_data 			= new StdClass;
		$info 					= new StdClass;
		$data 					= new StdClass;
		$header_data->mainMenu 	= 'Referances';
		$header_data->subMenu  	= 'ReferancesAdd';

		if ($this->input->post()) 
		{
			$info->img_url 			= $this->session->flashdata('referancesImage');
			$info->referances_title = $this->input->post('referances_title',true);
			$info->in_order 		= $this->input->post('in_order',true);
			if ($this->Referances_model->AddReferances($info)) 
			{
				$this->session->set_flashdata('true',1);
			}
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/referances_add',$data);
		$this->load->view('Admin/footer');
	}
	public function ImageUpload()
	{	
		$info = $this->Referances_model->ReferancesImageUpload();
		if ($info != false) {
			$this->session->set_flashdata('referancesImage', $info);
		}
	}
	public function ReferancesDelete($Id = 0)
	{
		if ((int)$Id == 0) 
		{
			redirect(admin_url('Referances'));
		}
		else
		{ 
			if ($this->Referances_model->ReferancesDelete($Id)) 
			{
				redirect(admin_url('Referances'));
			}
			else
			{
				redirect(admin_url('Hata Satırı : Referances Controller 70'));
			}
		}
	}
	public function StatusEdit($Id = 0, $St = 0)
	{
		if ($Id == 0 || ($St != 0 && $St != 1)) 
		{
			redirect(admin_url('Referances'));
		}
		$this->Referances_model->StatusEditModel($Id, $St);
		try 
		{
			$this->Referances_model->StatusEditModel($Id, $St);
			redirect($_SERVER['HTTP_REFERER']);
		} 
		catch (Exception $e) 
		{
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
?>