<?php 
/**
* 
*/
class Giftcheck extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Gift_model');
		$this->load->helper('gift_helper');
		if ($this->session->userdata('user')->auth != 0) 
		{
			redirect(site_url('Admin'));
		}
	}

	public function index()
	{
		// Mevcut Kampanyalar

		$data = new StdClass;
		$data->mainMenu = 'Gift';
		$data->subMenu  = 'GiftList';

		$data->list = $this->Gift_model->gegtGifts();

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/gift_list', $data);
		$this->load->view('Admin/footer');
	}

	public function SetStatus($id,$status)
	{
		$this->Gift_model->SetStatus($id,$status);
		redirect(site_url('Admin/Giftcheck'));
	}

	public function Delete($id)
	{
		$this->Gift_model->delete($id);
		redirect(site_url('Admin/Giftcheck'));
	}

	public function Add()
	{
		$data = new StdClass;
		$data->mainMenu = 'Gift';
		$data->subMenu  = 'GiftAdd';

		$data->cur = $this->Gift_model->getCurrencyAll();

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/gift_add', $data);
		$this->load->view('Admin/footer');
	}

	public function GiftAdd()
	{
		$data = new StdClass;
		if ($this->input->post()) {
			$data->type 			= $this->input->post('type',true);
			$data->user_id 			= $this->input->post('user_id',true);
			$data->kod 				= $this->input->post('kod',true);
			$data->check_type 		= $this->input->post('check_type',true);
			$data->min_price 		= $this->input->post('min_price',true);
			$data->max_price 		= $this->input->post('max_price',true);
			$data->discount_type 	= $this->input->post('discount_type',true);
			$data->discount 		= $this->input->post('discount',true);
			$data->validity 		= $this->input->post('validity',true);

			if ($this->Gift_model->addGift($data)) {
				$this->session->set_flashdata('okey',1);
			}else{
				$this->session->set_flashdata('hata',1);
			}
		}else{
			$this->session->set_flashdata('hata',1);
		}
		redirect(site_url('Admin/Giftcheck/Add'));
	}
}
?>