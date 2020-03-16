<?php
/**
* Author: Muhammet Ateş
*/
class Order extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Order_model');
		if ($this->session->userdata('user')->auth != 0 && $this->session->userdata('user')->auth != 3) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		$header_data = new StdClass;
		$data = new StdClass;
		$header_data->mainMenu = 'Order';
		$header_data->subMenu  = 'OrderList';

		$sayfa = $this->input->get('s', true);
		if ($sayfa == "" || $sayfa < 1) {
			redirect(site_url('Admin/Order?s=1'));
		}
		$q = $this->Order_model->getList($sayfa);
		if ($q!=false) 
		{
			if ($sayfa < 2) 
			{
				$data->prevPage = 1;
			}
			else
			{
				$data->prevPage = $sayfa-1;
			}
			if ($sayfa >= ceil($q->pageCount)) 
			{
				$data->nextPage = ceil($q->pageCount);
			}
			else
			{
				$data->nextPage = ceil($sayfa+1);
			}
			$data->list 		= $q->list;
			$data->selectedPage = $sayfa;
			$data->pageCount 	= $q->pageCount;
		}
		else
		{
			$data->prevPage 	= 1;
			$data->nextPage 	= 1;
			$data->list 		= array();
			$data->selectedPage = 1;
			$data->pageCount 	= 1;
		}
		$data->orderstatus = $this->Order_model->orderStatusArr;
		$data->paymenttype = $this->Order_model->paymentTypeArr;
		//$sonuc2['sonuc'] = array($this->session->flashdata('order_result1'), $this->session->flashdata('order_result2'));
		$data->efaturasonuc = array($this->session->flashdata('efaturasonuc1'), $this->session->flashdata('efaturasonuc2'));

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/order', $data);
		$this->load->view('Admin/footer');
	}

	public function PaymentStatus($id = 0, $new = 0)
	{
		if ($id == 0) {
			redirect(admin_url('Order'));
		}
		$this->Order_model->SetPaymentStatus((int)$id, (int)$new);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function OrderStatus($id = 0, $new = 0)
	{
		if ($id == 0) {
			redirect(admin_url('Order'));
		}
		$this->Order_model->SetOrderStatus((int)$id, (int)$new);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function View($id = 0)
	{
		if ($id == 0) {
			redirect(admin_url('Order'));
		}

		$header_data = new StdClass;
		$data = new StdClass;
		$header_data->mainMenu = 'Order';
		$header_data->subMenu  = 'OrderList';


		$data->orderstatus = $this->Order_model->orderStatusArr;
		$data->paymenttype = $this->Order_model->paymentTypeArr;

		$orderdata = $this->Order_model->GetOrderById($id);

		if ($orderdata->country == 212 && $orderdata->icountry == 212) {
			$orderdata->country = "TÜRKİYE";
			$orderdata->icountry = "TÜRKİYE";
			if ($orderdata->city == $orderdata->icity) {
				$gCityName = $this->Order_model->GetCityName($orderdata->city);
				$orderdata->city = $gCityName;
				$orderdata->icity = $gCityName;
				if ($orderdata->town == $orderdata->itown) {
					$gTownName = $this->Order_model->GetTownName($orderdata->town);
					$orderdata->town = $gTownName;
					$orderdata->itown = $gTownName;
				} else {
					$orderdata->town = $this->Order_model->GetTownName($orderdata->town);
					$orderdata->itown = $this->Order_model->GetTownName($orderdata->itown);
				}
			} else {
				$orderdata->city = $this->Order_model->GetCityName($orderdata->city);
				$orderdata->icity = $this->Order_model->GetCityName($orderdata->icity);
			}
		} else {
			if ($orderdata->country == 212) {
				$orderdata->country = "TÜRKİYE";
				$orderdata->city = $this->Order_model->GetCityName($orderdata->city);
				$orderdata->town = $this->Order_model->GetTownName($orderdata->town);
			} else {
				$orderdata->country = $this->Order_model->GetCountryName($orderdata->country);
			}

			if ($orderdata->icountry == 212) {
				$orderdata->icountry = "TÜRKİYE";
				$orderdata->icity = $this->Order_model->GetCityName($orderdata->icity);
				$orderdata->itown = $this->Order_model->GetTownName($orderdata->itown);
			} else {
				$orderdata->icountry = $this->Order_model->GetCountryName($orderdata->icountry);
			}
		}

		$data->order = $orderdata;
		$data->products = $this->Order_model->GetOrderLineByOrderId($id);
		$data->orderno = $id;

		 

		$this->load->view('Admin/header', $header_data);
		$this->load->view('Admin/order_view', $data);
		$this->load->view('Admin/footer');
	}

	public function ChangeStatus()
	{
		$id = $this->input->get('id', true);
		$status = $this->input->get('status', true);
		$new = $this->input->get('new', true);
		if (!$id || !$status) {
			redirect(admin_url('Order'));
		}

		$this->Order_model->ChangeStatus($id, $status, $new);
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function UpdateAddress($id = 0)
	{
		if ($id == 0) {
			redirect(admin_url('Order'));
		}

		if ($this->input->post()) {
			$newArr = array();
			foreach ($this->input->post() as $key => $value) {
				$newArr[$key] = $this->input->post($key, true);
			}
			if ($this->Order_model->UpdateAddress($id, $newArr)) {
				$this->session->set_flashdata('order_result1', 'Siparişin adresi güncellendi.');
				$this->session->set_flashdata('order_result2', 'success');
			} else {
				$this->session->set_flashdata('order_result1', 'Bir hata oluştu.');
				$this->session->set_flashdata('order_result2', 'danger');
			}
		}
		redirect($_SERVER['HTTP_REFERER']);

	}

	public function ExportExcel()
	{
		$this->Order_model->fetchDataFromTable();
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function KargoDateUpdate($order_line_id,$date)
	{
		$this->Order_model->KargoDateUpdate($order_line_id,$date);
		echo 1;
	}
	public function ProductUpdate($order_line_id)
	{
		$product_status = $this->input->post('product',true);
		$this->Order_model->ProductUpdate($order_line_id,$product_status);
		echo 1;
	}
}
?>