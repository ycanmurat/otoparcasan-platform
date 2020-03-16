<?php

class Discount extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Discount_model');
		if ($this->session->userdata('user')->auth != 0) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$data 					= new StdClass;
		$header_data 			= new StdClass;
		$header_data->mainMenu 	= 'Discount';
		$header_data->subMenu  	= 'DiscountList';

		$data->discounts_product = $this->Discount_model->discountList();
		if ($data->discounts_product == false) 
		{
			$data->no_data = 1;
		}
		else
		{
			$data->no_data = 0;
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/discount',$data);
		$this->load->view('Admin/footer');
	}
	public function Add()
	{
		$data 					= new StdClass;
		$header_data 			= new StdClass;
		$discountInfo 			= new StdClass;
		$header_data->mainMenu 	= 'Discount';
		$header_data->subMenu  	= 'DiscountAdd';

		$data->product_status = $this->Discount_model->productInfo();
		if ($data->product_status == false) 
		{
			redirect(site_url('Admin/Discount'));
		}
		if ($this->input->post()) 
		{
			$discountInfo->product_id 		= $this->input->post('product_id',true);
			$discountInfo->discount_title 	= $this->input->post('discount_title',true);
			if ($this->Discount_model->discountAddQuery($discountInfo)) 
			{
				$this->session->set_flashdata('true',1);
			}
		}
		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/discount_add',$data);
		$this->load->view('Admin/footer');
	}
	public function discountDelete($Id = 0)
	{
		if ((int)$Id == 0) 
		{
			redirect(admin_url('Discount'));
		}
		else
		{ 
			if ($this->Discount_model->discountDelete($Id)) 
			{
				redirect(admin_url('Discount'));
			}
			else
			{
				redirect(admin_url('Hata Satırı : Discount Controller 68'));
			}
		}
	}
}
?>