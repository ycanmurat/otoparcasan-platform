<?php
/**
* Author: Muhammet Ateş
*/
class Currency extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Currency_model');
		if ($this->session->userdata('user')->auth != 0) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$header_data = new StdClass;
		$header_data->mainMenu = 'Currency';
		$header_data->subMenu  = 'CurrencyList';
		//$this->Currency_model->setDovizApi();
		$data['currency'] = $this->Currency_model->getAllCurrency();
		$data['sonuc'] = array($this->session->flashdata('currency_result1'), $this->session->flashdata('currency_result2'));

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/currency', $data);
		$this->load->view('Admin/footer');
	}

	public function SetStatus($id, $new)
	{
		try {
			$this->Currency_model->updateStatusById($id,$new);
			redirect(site_url('Admin/Currency'));
		} catch (Exception $e) {
			redirect(site_url('Admin/Currency'));
		}
	}
}
?>