<?php 
/**
* 
*/
class Indirim extends Core_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->load->model('Admin/Indirim_model');
		$this->load->model('Api_model','api');
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
		$data->mainMenu = 'Indirim';
		$data->subMenu  = 'IndirimList';

		$data->list = $this->Indirim_model->gegtGifts();

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/indirim_list');
		$this->load->view('Admin/footer');
	}

	public function SetStatus($id,$status)
	{
		$this->Indirim_model->SetStatus($id,$status);
		redirect(site_url('Admin/Indirim'));
	}

	public function Delete($id)
	{
		$this->Indirim_model->delete($id);
		redirect(site_url('Admin/Indirim'));
	}

	public function Add()
	{
		$data = new StdClass;
		$data->mainMenu = 'Indirim';
		$data->subMenu  = 'IndirimList';

		if ($this->input->post()) {
			$this->form_validation->set_rules('discount', 'İndirim Oranı', 'required|trim|greater_than[0]');
			$this->form_validation->set_rules('validity', 'Son Kullanma Tarihi', 'required|trim');

			$postData = new StdClass;
			$postData->marka 		= $this->input->post('marka',true);
			$postData->cari 		= $this->input->post('cari',true);
			$postData->ustKategori 	= $this->input->post('ustKategori',true);
			$postData->anaKategori 	= $this->input->post('anaKategori',true);
			$postData->altKategori 	= $this->input->post('altKategori',true);
			$postData->discount 	= $this->input->post('discount',true);
            $postData->validity     = $this->input->post('validity',true);
			$postData->validity2 	= $this->input->post('validity2',true);
			if ($this->form_validation->run() != FALSE){
				if ($this->Indirim_model->indirimAdd($postData)) {
					$this->session->set_flashdata('okey',1);
				}else{
					$this->session->set_flashdata('hata',1);
				}
				redirect(site_url('Admin/Indirim/Add'));
			}
		}

		$data->datas = $this->api->getAllCampainData();

		//prex($data->datas);

		$this->load->view('Admin/header',$data);
		$this->load->view('Admin/indirim_add');
		$this->load->view('Admin/footer');
	}
}
?>